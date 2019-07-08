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
        return User::find()->select(['id', 'username'])->with('playback')->all();
    }
}