<?php

use yii\db\Migration;

/**
 * Handles adding name to table `{{%playback}}`.
 */
class m190806_133845_add_name_column_to_playback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('playback', 'name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('playback', 'name');
    }
}
