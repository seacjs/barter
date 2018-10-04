<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m180524_104210_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'user_id' => $this->primaryKey(),
            'name' => $this->string(),
            'city_id' => $this->integer(),
            'address' => $this->string(512),
            'birthday' => $this->string(),
            'phone' =>  $this->integer(),
            'telegram_on' => $this->smallInteger(),
            'viber_on' => $this->smallInteger(),
            'whatsapp_on' => $this->smallInteger(),
            'skype' => $this->string(),

            'show_city' => $this->smallInteger(),
            'show_address' => $this->smallInteger(),
            'show_birthday' => $this->smallInteger(),
            'show_phone' => $this->smallInteger(),
            'show_skype' => $this->smallInteger(),
            'show_email' => $this->smallInteger(),
        ]);

//        $this->addForeignKey('fk-profile-user_id','profile','user_id','user','id');
        $this->addForeignKey('fk-profile-city_id','profile','city_id','city','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
    }
}
