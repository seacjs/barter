<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082544_create_conflict_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conflict}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deal_id' => $this->integer(),
            'user_id' => $this->integer(),
            'user_target_id' => $this->integer(),
            'status' => $this->smallInteger(),
        ]);

        $this->addForeignKey('fk-conflict-deal_id','{{%conflict}}','deal_id','{{%deal}}','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deal}}');
    }
}
