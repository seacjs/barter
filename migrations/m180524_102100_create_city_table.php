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
