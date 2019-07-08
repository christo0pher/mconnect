<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "playback".
 *
 * @property int $id
 * @property int $user_id
 * @property string $playback_id
 * @property double $playback_position
 * @property string $playback_state
 * @property double $playback_timestamp
 * @property string $playback_time
 *
 * @property User $user
 */
class Playback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'playback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['playback_position', 'playback_timestamp'], 'number'],
            [['playback_time'], 'safe'],
            [['playback_id', 'playback_state'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'playback_id' => Yii::t('app', 'Playback ID'),
            'playback_position' => Yii::t('app', 'Playback Position'),
            'playback_state' => Yii::t('app', 'Playback State'),
            'playback_timestamp' => Yii::t('app', 'Playback Timestamp'),
            'playback_time' => Yii::t('app', 'Playback Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return PlaybackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaybackQuery(get_called_class());
    }
}
