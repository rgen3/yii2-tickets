<?php

namespace rgen3\tickets\controllers;

use rgen3\tickets\models\forms\CreateTicket;
use rgen3\tickets\models\search\Dialog;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class Message extends Controller
{
    public function actionIndex()
    {
        return $this->actionDialog(false);
    }

    public function actionCreate()
    {
        $model = new CreateTicket();
        $model->load(\Yii::$app->request->post());

        if ($model->validate())
        {
            $themeId = $model->save();
            if ($themeId !== false)
            {
                return $this->redirect(['/ticket/dialog/' . $themeId]);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDialog($id)
    {
        $model = new CreateTicket();
        $searchModel = new Dialog();
        $params = [
            'Dialog' =>
            [
                'themeId' => (int) $id
            ]
        ];

        $dataProvider = $searchModel->search($params);

        $theme = current(
            array_filter($dataProvider->getModels(), function($item) use ($id) { return $item->id == $id;})
        );

        return $this->render('dialog', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'theme' => $theme
        ]);
    }
}