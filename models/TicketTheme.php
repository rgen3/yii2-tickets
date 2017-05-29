<?php

namespace rgen3\tickets\models;

use common\models\User;
use rgen3\tickets\Module;
use yii\db\ActiveRecord;

class TicketTheme extends ActiveRecord
{
    public static function tableName()
    {
        return '{{ticket_themes}}';
    }

    public function rules()
    {
        $userModel = Module::$userModel;
        return [
            [['id', 'user_from', 'assigned_to'], 'integer'],
            [['subject'], 'safe'],
            [['is_closed'], 'boolean'],
            [
                'user_from',
                'exist',
                'skipOnError' => false,
                'targetClass' => $userModel::className(),
                'targetAttribute' => ['user_from' => 'id']
            ],
            [
                'assigned_to',
                'exist',
                'skipOnError' => false,
                'targetClass' => $userModel::className(),
                'targetAttribute' => ['assigned_to' => 'id']
            ]
        ];
    }

    public function getSender()
    {
        return $this->hasOne(Module::$userModel, ['id' => 'user_from']);
    }

    public function getReceiver()
    {
        return $this->hasOne(Module::$userModel, ['id' => 'assigned_to']);
    }

    public function getLastMessage()
    {
        return $this->hasOne(TicketMessage::class, ['theme_id' => 'id'])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(1);
    }

    public function getDialog()
    {
        return $this->hasMany(TicketMessage::class, ['theme_id' => 'id']);
    }
}