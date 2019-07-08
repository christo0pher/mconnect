<?php

use yii\db\Migration;

/**
 * Class m190708_122240_add_users_table
 */
class m190708_122240_add_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user',[
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique()->comment("Username"),
            'password' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
