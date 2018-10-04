<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082545_create_wish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wish}}', [
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'user_id' => $this->integer(),
            'product_type' => $this->integer(),
            'product_id' => $this->integer(),
        ]);
        $this->addPrimaryKey('pk-wish','wish',['user_id','product_type','product_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deal}}');
    }
}
