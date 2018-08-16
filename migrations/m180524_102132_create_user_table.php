<?php

use yii\db\Migration;

class m180524_102132_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email_confirm_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'name' => $this->string()->notNull(),
            'second_name' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'online_at' => $this->integer()->notNull(),
        ], $tableOptions);

        /**
         * for region and city administrators
         */
        $this->createTable('{{%region_admin}}',[
            'user_id' => $this->integer(),
            'region_id' => $this->integer(),
        ]);
        $this->createTable('{{%city_admin}}',[
            'user_id' => $this->integer(),
            'city_id' => $this->integer(),
        ]);

        $this->addPrimaryKey('pk-region_admin','{{%region_admin}}',['user_id', 'region_id']);
        $this->addPrimaryKey('pk-city_admin','{{%city_admin}}',['user_id', 'city_id']);

        $this->addForeignKey('fk-region_admin-region_id','{{%region_admin}}','region_id','region','id');
        $this->addForeignKey('fk-region_admin-user_id','{{%region_admin}}','user_id','user','id');

        $this->addForeignKey('fk-city_admin-city_id','{{%city_admin}}','city_id','city','id');
        $this->addForeignKey('fk-city_admin-user_id','{{%city_admin}}','user_id','user','id');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
