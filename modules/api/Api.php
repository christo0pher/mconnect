<?php

namespace app\modules\api;

use yii\web\Response;

/**
 * api module definition class
 */
class Api extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        \Yii::$app->response->format = Response::FORMAT_JSON;
    }
}
