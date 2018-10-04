<?php

use yii\db\Migration;

/**
 * Handles the creation of table `message`.
 */
class m180528_082540_create_category_and_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        /**
         * CATEGORY SERVICE
         */
        $this->createTable('{{%category_service}}', [
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
        $this->createTable('{{%option_s_bool}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->createTable('{{%option_s_string}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->createTable('{{%option_s_integer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
        ]);
        $this->addForeignKey('fk-option_s_bool-category_id','{{%option_s_bool}}','category_id','{{%category_service}}','id');
        $this->addForeignKey('fk-option_s_string-category_id','{{%option_s_string}}','category_id','{{%category_service}}','id');
        $this->addForeignKey('fk-option_s_integer-category_id','{{%option_s_integer}}','category_id','{{%category_service}}','id');

        /**
         * PRODUCT
         */
        $this->createTable('{{%product_service}}', [
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

        $this->addForeignKey('fk-product_service-category_id','{{%product_service}}','category_id','{{%category_service}}','id');
        $this->addForeignKey('fk-product_service-user_id','{{%product_service}}','user_id','{{%user}}','id');

        /**
         * option values
         */
        $this->createTable('{{%value_s_bool}}', [
            'value' => $this->smallInteger(),
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);
        $this->createTable('{{%value_s_string}}', [
            'value' => $this->string(),
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
        ]);
        $this->createTable('{{%value_s_integer}}', [
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
        $this->dropTable('{{%value_s_integer}}');
        $this->dropTable('{{%value_s_string}}');
        $this->dropTable('{{%value_s_bool}}');

        $this->dropTable('{{%product_service}}');

        $this->dropTable('{{%option_s_integer}}');
        $this->dropTable('{{%option_s_string}}');
        $this->dropTable('{{%option_s_bool}}');

        $this->dropTable('{{%category_service}}');
    }
}
