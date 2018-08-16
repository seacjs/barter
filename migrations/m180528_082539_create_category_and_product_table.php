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
        $this->createTable('{{%option_g}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
            'type' => $this->smallInteger()
        ]);
        $this->addForeignKey('fk-option_g_bool-category_id','{{%option_g}}','category_id','{{%category_goods}}','id');

        $this->createTable('{{%option_variant_g}}', [
            'id' => $this->primaryKey(),
            'option_id' => $this->integer(),
            'name' => $this->string(),
            'value' => $this->string(),
        ]);
        $this->addForeignKey('fk-option_variant_g-option_id','{{%option_variant_g}}','option_id','{{%option_g}}','id');

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

            'price' => $this->integer(),
            'status' => $this->smallInteger(),
            'category_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk-product_goods-category_id','{{%product_goods}}','category_id','{{%category_goods}}','id');
        $this->addForeignKey('fk-product_goods-user_id','{{%product_goods}}','user_id','{{%user}}','id');

        /**
         * option values
         */
        $this->createTable('{{%option_value_g}}', [
            'product_id' => $this->integer(),
            'option_id' => $this->integer(),
            'value' => $this->string()
        ]);
//        $this->addPrimaryKey('pk-option_value_g','option_value_g',['product_id', 'option_id']);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%option_value_g}}');
        $this->dropTable('{{%product_goods}}');
        $this->dropTable('{{%option_variant_g}}');
        $this->dropTable('{{%option_g}}');
        $this->dropTable('{{%category_goods}}');
    }
}
