<?php

namespace rgen3\tickets\controllers;

use yii\web\Controller;

class Message extends Controller
{
    public function actionIndex()
    {
        return $this->render('list');
    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDialog()
    {

    }
}