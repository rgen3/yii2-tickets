<?php

namespace rgen3\tickets\controllers;

use rgen3\tickets\models\forms\CreateMessage;
use rgen3\tickets\models\forms\CreateTicket;
use rgen3\tickets\models\search\Dialog;
use rgen3\tickets\Module;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

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
            if ($model->save() !== false)
            {
                return $this->redirect(['/ticket/dialog/' . $model->dialogId]);
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

        if ($dataProvider->totalCount === 0)
        {
            return $this->render('create', ['model' => $model]);
        }

        $userModel = Module::$userModel;
        $data = [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'theme' => $theme,
            'receiver' => $theme->receiver ?? $userModel::findOne(['id' => Module::$defaultAdminId])
        ];

        if (\Yii::$app->request->isPjax)
        {
            return $this->renderPartial('dialog/dialog_box', ['theme' => $theme]);
        }

        return $this->render('dialog', $data);
    }

    public function actionAnswer()
    {
        $model = new CreateMessage();
        $model->load(\Yii::$app->request->post());
        $model->create();
        if (!\Yii::$app->request->isAjax)
        {
            return $this->redirect(["/ticket/dialog/{$model->dialogId}"]);
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $model;
    }
}