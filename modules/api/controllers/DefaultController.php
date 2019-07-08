<?php

namespace app\modules\api\controllers;

use app\models\User;
use app\models\UserToken;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Default controller for the `api` module
 */
class DefaultController extends \yii\rest\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'auth' => ['post'],
                    'register' => ['post'],
                    'index' => ['get', 'post']
                ],
            ],
            'authenticator' => [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBasicAuth::class,
                    HttpBearerAuth::class,
                    QueryParamAuth::class,
                ],
                'except' => ['auth', 'register'],
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return array
     */
    public function actionIndex()
    {
        return [
            'success' => true,
            'message' => 'You are authorized',
        ];
    }

    /**
     * @return array
     */
    public function actionAuth()
    {
        if ($username = \Yii::$app->request->post('username')) {
            if ($password = \Yii::$app->request->post('password')) {
                $user = User::findByUsername($username);

                if ($user) {
                    if ($user->validatePassword($password)) {

                        $token = UserToken::createForUser($user->id);

                        return ['success' => true, 'token' => $token->token];
                    }
                    else {
                        $errorMessage = 'Password does not match';
                    }
                }
                else {
                    return $this->actionRegister();
                }
            }
            else {
                $errorMessage = 'Password is empty';
            }
        }
        else {
            $errorMessage = 'Username is empty';
        }

        return ['success' => false, 'message' => $errorMessage];
    }

    /**
     * @return array
     */
    public function actionRegister()
    {
        if ($username = \Yii::$app->request->post('username')) {
            if ($password = \Yii::$app->request->post('password')) {
                $user = new User();

                $user->username = $username;
                $user->password = $user->createPasswordHash($password);

                if ($user->save()) {
                    $token = UserToken::createForUser($user->id);

                    return ['success' => true, 'token' => $token->token];
                }
                else {
                    return ['success' => false, 'message' => 'Could not save the user', 'details' => $user->errors];
                }
            }
            else {
                $errorMessage = 'Password is empty';
            }
        }
        else {
            $errorMessage = 'Username is empty';
        }

        return ['success' => false, 'message' => $errorMessage];
    }
}
