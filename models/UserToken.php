<?php

namespace app\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "user_token".
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property string $client_info
 * @property string $created_at
 *
 * @property User $user
 */
class UserToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'token'], 'required'],
            [['user_id'], 'integer'],
            [['client_info', 'created_at'], 'string'],
            [['token'], 'string', 'max' => 255],
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
            'token' => Yii::t('app', 'Token'),
            'client_info' => Yii::t('app', 'Client Info'),
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
     * @return UserTokenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserTokenQuery(get_called_class());
    }

    public static function createForUser($id)
    {
        $token = new self();

        $token->user_id = $id;

        $token->token = md5($id . date('Ymdhis') . time());

        $token->client_info = $_SERVER['HTTP_USER_AGENT'];

        $token->save();

        return $token;
    }
}
