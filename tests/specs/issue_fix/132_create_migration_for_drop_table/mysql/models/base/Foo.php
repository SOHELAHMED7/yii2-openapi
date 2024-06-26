<?php

namespace app\models\base;

/**
 * 132_create_migration_for_drop_table
 *
 * @property int $id
 * @property int $factor
 *
 */
abstract class Foo extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%foos}}';
    }

    public function rules()
    {
        return [
            'factor_integer' => [['factor'], 'integer'],
        ];
    }
}
