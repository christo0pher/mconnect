<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 08.07.19
 * Time: 15:46
 */

namespace app\modules\api\controllers;

use app\models\User;

class UsersController extends ApiController
{
    public function actionList()
    {
        return User::find()
                   ->select(['id', 'username'])
                   ->andWhere(['!=', 'id', \Yii::$app->user->id])
                   ->with('playback')
                   ->asArray(1)
                   ->all();
    }

    public function actionSearch()
    {
        $text = \Yii::$app->request->post('text');

        return User::find()
            ->select(['id', 'username'])
            ->andWhere(['LIKE', 'username', $text])
            ->andWhere(['!=', 'id', \Yii::$app->user->id])
            ->limit(200)
            ->asArray(1)
            ->all();
    }
}