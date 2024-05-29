<?php

/**
 * Table for Account
 */
class m200000_000000_create_table_accounts extends \yii\db\Migration
{
    public function safeUp()
    {
        $this->createTable('{{%accounts}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'paymentMethodName' => $this->text()->null()->defaultValue(null),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%accounts}}');
    }
}
