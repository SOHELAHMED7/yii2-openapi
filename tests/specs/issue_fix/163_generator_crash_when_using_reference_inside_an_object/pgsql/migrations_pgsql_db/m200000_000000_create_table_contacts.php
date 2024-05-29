<?php

/**
 * Table for Contact
 */
class m200000_000000_create_table_contacts extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%contacts}}');
    }
}
