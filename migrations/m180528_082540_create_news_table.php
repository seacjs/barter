<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082540_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),

            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'h1' => $this->string(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'content' => $this->text(),

            'active' => $this->smallInteger(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
