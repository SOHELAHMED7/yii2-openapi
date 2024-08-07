<?php

/**
 * Table for Bigpk
 */
class m200000_000000_delete_table_bigpks extends \yii\db\Migration
{
    public function up()
    {
        $this->dropTable('{{%bigpks}}');
    }

    public function down()
    {
        $this->createTable('{{%bigpks}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(150)->null()->defaultValue(null),
        ]);
    }
}
