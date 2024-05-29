<?php

/**
 * Table for Contact
 */
class m200000_000001_create_table_contacts extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer()->notNull(),
            'active' => $this->boolean()->null()->defaultValue(false),
            'nickname' => $this->text()->null()->defaultValue(null),
        ]);
        $this->addForeignKey('fk_contacts_account_id_accounts_id', '{{%contacts}}', 'account_id', '{{%accounts}}', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_contacts_account_id_accounts_id', '{{%contacts}}');
        $this->dropTable('{{%contacts}}');
    }
}
