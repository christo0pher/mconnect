<?php

use yii\db\Migration;

/**
 * Class m190708_123229_add_playback_table
 */
class m190708_123229_add_playback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('playback', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'playback_id' => $this->string(),
            'playback_position' => $this->decimal(16, 6),
            'playback_state' => $this->string(),
            'playback_timestamp' => $this->decimal(16, 6),
            'playback_time' => $this->dateTime(3),
        ]);

        $this->addForeignKey('user_playback_connection', 'playback', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('playback');
    }
}
