<?php

/**
 * @copyright Copyright (c) 2018 Carsten Brandt <mail@cebe.cc> and contributors
 * @license https://github.com/cebe/yii2-openapi/blob/master/LICENSE
 */

namespace cebe\yii2openapi\lib\migrations;

use cebe\yii2openapi\lib\items\DbIndex;
use yii\db\ColumnSchema;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;

final class PostgresMigrationBuilder extends BaseMigrationBuilder
{
    /**
     * @param array|ColumnSchema[] $columns
     * @throws \yii\base\InvalidConfigException
     */
    protected function buildColumnsCreation(array $columns):void
    {
        foreach ($columns as $column) {
            $tableName = $this->model->getTableAlias();
            if ($column->dbType === 'enum') {
                $this->migration->addUpCode($this->recordBuilder->createEnum($column->name, $column->enumValues))
                                ->addDownCode($this->recordBuilder->dropEnum($column->name), true);
            }
            $this->migration->addUpCode($this->recordBuilder->addColumn($tableName, $column))
                            ->addDownCode($this->recordBuilder->dropColumn($tableName, $column->name));
        }
    }

    /**
     * @param array|ColumnSchema[] $columns
     * @throws \yii\base\InvalidConfigException
     */
    protected function buildColumnsDrop(array $columns):void
    {
        foreach ($columns as $column) {
            $tableName = $this->model->getTableAlias();
            $this->migration->addDownCode($this->recordBuilder->addDbColumn($tableName, $column))
                            ->addUpCode($this->recordBuilder->dropColumn($tableName, $column->name));
            if ($column->dbType === 'enum') {
                $this->migration->addDownCode($this->recordBuilder->createEnum($column->name, $column->enumValues), true)
                                ->addUpCode($this->recordBuilder->dropEnum($column->name));
            }
        }
    }

    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function buildColumnChanges(ColumnSchema $current, ColumnSchema $desired, array $changed):void
    {
        $tableName = $this->model->getTableAlias();
        $isChangeToEnum = $current->type !== $desired->type && !empty($desired->enumValues);
        $isChangeFromEnum = $current->type !== $desired->type && !empty($current->enumValues);
        $isChangedEnum = $current->type === $desired->type && !empty($current->enumValues);
        if ($isChangedEnum) {
            // Generation for change enum values not supported. Do it manually
            // This action require several steps and can't be applied during single transaction
            return;
        }

        if (!empty(array_intersect(['type', 'size'
                    , 'dbType', 'phpType'
                    , 'precision', 'scale', 'unsigned'
        ], $changed))) {
            $addUsing = $this->isNeedUsingExpression($desired->type, $current->type);
            $this->migration->addUpCode($this->recordBuilder->alterColumnType($tableName, $desired));
            $this->migration->addDownCode($this->recordBuilder->alterColumnTypeFromDb($tableName, $current, $addUsing));
        }
        if (in_array('allowNull', $changed, true)) {
            if ($desired->allowNull === true) {
                $this->migration->addUpCode($this->recordBuilder->dropColumnNotNull($tableName, $desired));
                $this->migration->addDownCode($this->recordBuilder->setColumnNotNull($tableName, $current), true);
            } else {
                $this->migration->addUpCode($this->recordBuilder->setColumnNotNull($tableName, $desired));
                $this->migration->addDownCode($this->recordBuilder->dropColumnNotNull($tableName, $current), true);
            }
        }
        if (in_array('defaultValue', $changed, true)) {
            $upCode = $desired->defaultValue === null
                ? $this->recordBuilder->dropColumnDefault($tableName, $desired)
                : $this->recordBuilder->setColumnDefault($tableName, $desired);
            $downCode = $current->defaultValue === null
                ? $this->recordBuilder->dropColumnDefault($tableName, $current)
                : $this->recordBuilder->setColumnDefaultFromDb($tableName, $current);
            if ($upCode && $downCode) {
                $this->migration->addUpCode($upCode)->addDownCode($downCode, true);
            }
        }
        if ($isChangeToEnum) {
            $this->migration->addUpCode($this->recordBuilder->createEnum($desired->name, $desired->enumValues), true);
        }
        if ($isChangeFromEnum) {
            $this->migration->addUpCode($this->recordBuilder->dropEnum($current->name));
        }

        if ($isChangeFromEnum) {
            $this->migration
                ->addDownCode($this->recordBuilder->createEnum($current->name, $current->enumValues));
        }
        if ($isChangeToEnum) {
            $this->migration->addDownCode($this->recordBuilder->dropEnum($current->name), true);
        }
    }

    protected function compareColumns(ColumnSchema $current, ColumnSchema $desired):array
    {
        $changedAttributes = [];

        $this->modifyCurrent($current);
        $this->modifyDesired($desired);
        $this->modifyDesiredInContextOfCurrent($current, $desired);

        // for docs, please see MysqlMigrationBuilder file
        $desiredFromDb = $this->tmpSaveNewCol($desired);
        $this->modifyDesired($desiredFromDb);
        $this->modifyDesiredInContextOfCurrent($current, $desiredFromDb);

        foreach (['type', 'size', 'allowNull', 'defaultValue', 'enumValues'
                    , 'dbType', 'phpType'
                    , 'precision', 'scale', 'unsigned'
        ] as $attr) {
            if ($current->$attr !== $desiredFromDb->$attr) {
                $changedAttributes[] = $attr;
            }
        }
        return $changedAttributes;
    }

    protected function createEnumMigrations():void
    {
        $enums = $this->model->getEnumAttributes();
        foreach ($enums as $attr) {
            $this->migration
                ->addUpCode($this->recordBuilder->createEnum($attr->columnName, $attr->enumValues), true)
                ->addDownCode($this->recordBuilder->dropEnum($attr->columnName), true);
        }
    }

    protected function isDbDefaultSize(ColumnSchema $current):bool
    {
        $defaults = ['char' => 1, 'string' => 255];
        return isset($defaults[$current->type]);
    }

    /**
     * @return array|DbIndex[]
     * @throws \yii\base\NotSupportedException
     * @throws \yii\db\Exception
     */
    protected function findTableIndexes():array
    {
        static $sql = <<<'SQL'
SELECT
    "ic"."relname" AS "name",
    "ia"."attname" AS "column_name",
    "i"."indisunique" AS "index_is_unique",
    "i"."indisprimary" AS "index_is_primary",
    "it"."amname"  AS "index_type"
FROM "pg_class" AS "tc"
INNER JOIN "pg_namespace" AS "tcns"
    ON "tcns"."oid" = "tc"."relnamespace"
INNER JOIN "pg_index" AS "i"
    ON "i"."indrelid" = "tc"."oid"
INNER JOIN "pg_class" AS "ic"
    ON "ic"."oid" = "i"."indexrelid"
INNER JOIN "pg_attribute" AS "ia"
    ON "ia"."attrelid" = "i"."indexrelid"
INNER JOIN pg_am it on it.oid = ic.relam
WHERE "tcns"."nspname" = :schemaName AND "tc"."relname" = :tableName
ORDER BY "ia"."attnum"
SQL;
        $indexes = $this->db->createCommand(
            $sql,
            [
                ':schemaName' => $this->db->getSchema()->defaultSchema,
                ':tableName' => $this->db->tablePrefix . $this->model->tableName,
            ]
        )->queryAll();
        $indexes = ArrayHelper::index($indexes, null, 'name');

        $dbIndexes = [];
        foreach ($indexes as $name => $index) {
            if ((bool)$index[0]['index_is_primary']) {
                continue;
            }
            $dbIndex = DbIndex::make(
                $this->model->tableName,
                ArrayHelper::getColumn($index, 'column_name'),
                $index[0]['index_type'] === 'btree' ? null : $index[0]['index_type'],
                (bool)$index[0]['index_is_unique']
            );
            $dbIndexes[$dbIndex->name] = $dbIndex;
        }
        return $dbIndexes;
    }

    public static function getColumnSchemaBuilderClass(): string
    {
        return \yii\db\ColumnSchemaBuilder::class;
    }

    public function modifyCurrent(ColumnSchema $current): void
    {
        /** @var $current \yii\db\pgsql\ColumnSchema */
        if ($current->phpType === 'integer' && $current->defaultValue !== null) {
            $current->defaultValue = (int)$current->defaultValue;
        }
        // TODO this is not concretely correct, reason is in BaseMigrationBuilder
        if (!empty($current->enumValues)) {
            $current->type = 'enum';
            $current->dbType = 'enum';
        }
    }

    public function modifyDesired(ColumnSchema $desired): void
    {
        /** @var $desired cebe\yii2openapi\db\ColumnSchema|\yii\db\pgsql\ColumnSchema */
        if (in_array($desired->phpType, ['int', 'integer']) && $desired->defaultValue !== null) {
            $desired->defaultValue = (int)$desired->defaultValue;
        }
        if ($decimalAttributes = \cebe\yii2openapi\lib\ColumnToCode::isDecimalByDbType($desired->dbType)) {
            $desired->precision = $decimalAttributes['precision'];
            $desired->scale = $decimalAttributes['scale'];
        }
        // TODO this is not concretely correct, reason is in BaseMigrationBuilder
        if (!empty($desired->enumValues)) {
            $desired->type = 'enum';
            $desired->dbType = 'enum';
        }
    }

    public function modifyDesiredInContextOfCurrent(ColumnSchema $current, ColumnSchema $desired): void
    {
        /** @var $current \yii\db\pgsql\ColumnSchema */
        /** @var $desired cebe\yii2openapi\db\ColumnSchema|\yii\db\pgsql\ColumnSchema */
        if ($current->type === $desired->type && !$desired->size && $this->isDbDefaultSize($current)) {
            $desired->size = $current->size;
        }
    }
}
