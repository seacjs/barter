<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082543_create_deal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%deal}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'product_type' => $this->string(), // product or service
            'product_id' => $this->integer(),
            'transaction_id' => $this->integer(),
            'status' => $this->smallInteger(),
        ]);

        $this->addForeignKey('fk-deal-transaction_id','{{%deal}}','transaction_id','{{%money_transaction}}','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deal}}');
    }
}
