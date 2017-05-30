<?php

namespace rgen3\tickets\models\forms;

use rgen3\tickets\models\TicketMessage;
use rgen3\tickets\traits\UserFrom;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CreateMessage extends Model
{
    use UserFrom;

    public $messageId;
    public $message;
    public $dialogId;
    public $isNew = 0;

    private $assignedTo;

    public function init()
    {
        $this->setUserFrom();
    }

    public function rules()
    {
        $rules = [
            ['messageId', 'integer'],
            ['message', 'safe'],
            ['dialogId', 'integer'],
            ['isNew', 'boolean']
        ];

        $rules = ArrayHelper::merge($rules, UserFrom::rules());
        return $rules;
    }

    public function create()
    {
        $model = new TicketMessage();
        $model->answered_by = $this->getUserFrom();
        $model->theme_id = $this->dialogId;
        $model->is_new = $this->isNew;
        $model->message = $this->message;

        if ($model->validate())
        {
            return $model->save();
        }

        return $model->errors;
    }

    public function readMessage()
    {
        $model = TicketMessage::findOne(['id' => $this->messageId]);
        $model->is_new = 0;
        $model->save();
    }
}