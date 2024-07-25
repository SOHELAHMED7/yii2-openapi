<?php

/**
 * Table for Tag
 */
class m200000_000001_create_table_v2_tags extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%v2_tags}}', [
            'id' => $this->bigPrimaryKey(),
            0 => 'name varchar(100) NOT NULL',
            'lang' => 'enum("ru", "eng") NOT NULL',
        ]);
        $this->createIndex('v2_tags_name_key', '{{%v2_tags}}', 'name', true);
    }

    public function down()
    {
        $this->dropIndex('v2_tags_name_key', '{{%v2_tags}}');
        $this->dropTable('{{%v2_tags}}');
    }
}
