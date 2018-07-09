<?php

use yii\db\Migration;

/**
 * Handles the creation of table `file`.
 */
class m180524_102100_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),
        ]);

        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer(),
            'name' => $this->string(),
            'slug' => $this->string(),
        ]);

        $this->createTable('{{%metro}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'name' => $this->string(),
            'slug' => $this->string(),
        ]);

        /* todo: foreaign keys */
//        $this->addForeignKey('fk-city-region_id', '{{%city}}', 'region_id', '{{%region}}', 'id');
//        $this->addForeignKey('fk-metro-city_id', '{{%metro}}', 'city_id', '{{%city}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metro}}');
        $this->dropTable('{{%city}}');
        $this->dropTable('{{%region}}');
    }
}
