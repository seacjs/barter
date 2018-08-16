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
        $this->createTable('{{%category_goods}}', [
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
        $this->createTable('{{%option_g_bool}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->createTable('{{%option_g_string}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->createTable('{{%option_g_integer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk-option_g_bool-category_id','{{%option_g_bool}}','category_id','{{%category_goods}}','id');
        $this->addForeignKey('fk-option_g_string-category_id','{{%option_g_string}}','category_id','{{%category_goods}}','id');
        $this->addForeignKey('fk-option_g_integer-category_id','{{%option_g_integer}}','category_id','{{%category_goods}}','id');

        /**
         * PRODUCT
         */
        $this->createTable('{{%product_goods}}', [
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

        $this->addForeignKey('fk-product_goods-category_id','{{%product_goods}}','category_id','{{%category_goods}}','id');
        $this->addForeignKey('fk-product_goods-user_id','{{%product_goods}}','user_id','{{%user}}','id');

        /**
         * option values
         */
        $this->createTable('{{%value_g_bool}}', [
            'value' => $this->smallInteger(),
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);
        $this->createTable('{{%value_g_string}}', [
            'value' => $this->string(),
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);
        $this->createTable('{{%value_g_integer}}', [
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
        $this->dropTable('{{%value_g_integer}}');
        $this->dropTable('{{%value_g_string}}');
        $this->dropTable('{{%value_g_bool}}');

        $this->dropTable('{{%product_goods}}');

        $this->dropTable('{{%option_g_integer}}');
        $this->dropTable('{{%option_g_string}}');
        $this->dropTable('{{%option_g_bool}}');

        $this->dropTable('{{%category_goods}}');
    }
}
