<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 08.07.19
 * Time: 15:46
 */

namespace app\modules\api\controllers;

use app\models\Playback;

class UserController extends ApiController
{
    /**
     * @return array
     */
    public function actionSavePlayback()
    {
        /** @var \app\models\User $user */
        $user = \Yii::$app->user->identity;

        if (!($playback = $user->playback)) {
            $playback = new Playback();
            $playback->user_id = $user->id;
        }

        $playback->load(\Yii::$app->request->post());

        if (!$playback->validate()) {
            return ['success' => false, 'errors' => $playback->errors];
        }

        return ['success' => $playback->save(), 'errors' => $playback->errors, 'message' => 'Saved the playback state'];
    }
}