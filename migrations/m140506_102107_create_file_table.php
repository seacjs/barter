<?php

use yii\db\Migration;

/**
 * Handles the creation for table `product`.
 */
class m140506_102107_create_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),

            'component' => $this->string()->notNull(), // table name
            'component_id' => $this->integer(),
            'sort' => $this->integer(),

            'path' => $this->string()->notNull(),
            'base_url' => $this->string(),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),

            'title' => $this->string(),
            'extension' => $this->string(),
            'created_at' => $this->integer()->notNull()->defaultValue(time()),

            'size' => $this->integer(),
            'upload_ip' => $this->string(),

        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%file}}');
    }


}
