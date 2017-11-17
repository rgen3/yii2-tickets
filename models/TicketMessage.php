<?php

namespace rgen3\tickets\models;

use common\models\User;
use rgen3\tickets\Module;
use yii\db\ActiveRecord;

class TicketMessage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ticket_messages}}';
    }

    public function rules()
    {
        $userModel = Module::$userModel;
        return [
            [['id', 'answered_by', 'theme_id'], 'integer'],
            ['is_new', 'boolean'],
            [
                'answered_by',
                'exist',
                'skipOnError' => false,
                'targetClass' => $userModel::className(),
                'targetAttribute' => ['answered_by' => 'id']
            ]
        ];
    }

    public function getAnsweredBy()
    {
        return $this->hasOne(Module::$userModel, ['id' => 'answered_by']);
    }

    public function getStatus()
    {
        return $this->hasOne(TicketStatus::class, ['id' => 'status_id']);
    }


}