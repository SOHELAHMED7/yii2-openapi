<?php

/**
 * Table for Editcolumn
 */
class m200000_000002_create_table_editcolumns extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%editcolumns}}', [
            'id' => $this->primaryKey(),
            'device' => $this->text()->null(),
            'connection' => 'enum("WIRED", "WIRELESS") NOT NULL DEFAULT \'WIRED\'',
            'camelCaseCol' => 'enum("ONE", "TWO", "THREE") NOT NULL DEFAULT \'TWO\'',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%editcolumns}}');
    }
}
