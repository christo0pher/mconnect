<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Playback]].
 *
 * @see Playback
 */
class PlaybackQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Playback[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Playback|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
