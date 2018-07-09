<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082539_create_category_and_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        /**
         * CATEGORY
         */
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),

            'title' => $this->string(),
            'description' => $this->string(),
            'keywords' => $this->string(),
            'h1' => $this->string(),

            'left_key' => $this->integer()->notNull(),
            'right_key' => $this->integer()->notNull(),
            'level' => $this->integer()->notNull(),

            'content' => $this->text(),
            'active' => $this->smallInteger(),
        ]);

        /**
         * option names
         */
        $this->createTable('{{%option_bool}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->createTable('{{%option_string}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->createTable('{{%option_integer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk-option_bool-category_id','{{%option_bool}}','category_id','{{%category}}','id');
        $this->addForeignKey('fk-option_string-category_id','{{%option_string}}','category_id','{{%category}}','id');
        $this->addForeignKey('fk-option_integer-category_id','{{%option_integer}}','category_id','{{%category}}','id');

        /**
         * PRODUCT
         */
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),

            'content' => $this->text(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

            'status' => $this->smallInteger(),
            'category_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk-product-category_id','{{%product}}','category_id','{{%category}}','id');
        $this->addForeignKey('fk-product-user_id','{{%product}}','user_id','{{%user}}','id');

        /**
         * option values
         */
        $this->createTable('{{%value_bool}}', [
            'value' => $this->smallInteger(),
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);
        $this->createTable('{{%value_string}}', [
            'value' => $this->string(),
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);
        $this->createTable('{{%value_integer}}', [
            'value' => $this->integer(),
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%value_integer}}');
        $this->dropTable('{{%value_string}}');
        $this->dropTable('{{%value_bool}}');

        $this->dropTable('{{%product}}');

        $this->dropTable('{{%option_integer}}');
        $this->dropTable('{{%option_string}}');
        $this->dropTable('{{%option_bool}}');

        $this->dropTable('{{%category}}');
    }
}
