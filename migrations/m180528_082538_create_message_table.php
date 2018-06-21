<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082538_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'message' => $this->string(),
            'from' => $this->integer(),
            'to' => $this->integer(),
            'status' => $this->smallInteger(),
        ]);

        $this->createTable('{{%message_ignorelist}}', [
            'user_id' => $this->integer(),
            'blocks_user_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('pk-message_ignorelist', '{{%message_ignorelist}}', ['user_id', 'blocks_user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message_ignorelist}}');
        $this->dropTable('{{%message}}');
    }
}
