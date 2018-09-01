<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082542_create_money_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%system_money}}', [
            'value' => $this->integer(),
            'total' => $this->integer(),
        ]);

        $this->createTable('{{%system_money_log}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'message' => $this->string(),
            'value' => $this->integer(),

            'operation' => $this->smallInteger(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);


        /* TRANSACTIONS */
        $this->createTable('{{%money_transaction}}', [
            'id' => $this->primaryKey(),

            'from_id' => $this->integer(),
            'to_id' => $this->integer(),

            'operation' => $this->smallInteger(),
            'operation_id' => $this->integer(),

            'message' => $this->string(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

            'status' => $this->smallInteger(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%money_transaction}}');
        $this->dropTable('{{%system_money_log}}');
        $this->dropTable('{{%system_money}}');
    }
}
