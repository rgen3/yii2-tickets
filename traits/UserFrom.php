<?php

namespace rgen3\tickets\traits;

use rgen3\tickets\Module;

trait UserFrom
{
    private $userFrom;

    public function rules()
    {
        $userModel = Module::$userModel;
        return [
            ['userFrom', 'integer'],
            [
                ['userFrom', 'assignedTo'],
                'exist',
                'skipOnError' => false,
                'targetClass' => $userModel::className(),
                'targetAttribute' => ['assignedTo' => 'id']
            ],
        ];
    }

    public function setUserFrom($userId = null)
    {
        $this->userFrom = $userId ?? \Yii::$app->user->id;
    }

    public function getUserFrom()
    {
        return $this->userFrom;
    }
}