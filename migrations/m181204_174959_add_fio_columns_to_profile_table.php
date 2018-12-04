<?php

use yii\db\Migration;

/**
 * Handles adding fio to table `profile`.
 */
class m181204_174959_add_fio_columns_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('profile','surname', $this->string());
        $this->addColumn('profile','second_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('profile', 'surname');
        $this->dropColumn('profile', 'second_name');
    }
}
