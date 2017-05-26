<?php

namespace rgen3\tickets\models;

use common\models\User;
use yii\db\ActiveRecord;

class TicketTheme extends ActiveRecord
{
    public static function tableName()
    {
        return '{{ticket_themes}}';
    }

    public function rules()
    {
        return [
            [['id', 'user_from', 'assigned_to'], 'integer'],
            [['subject'], 'safe'],
            [['is_closed'], 'boolean'],
            [
                'user_from',
                'exist',
                'skipOnError' => false,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ],
            [
                'assigned_to',
                'exist',
                'skipOnError' => false,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ]
        ];
    }

    public function getSender()
    {
        return $this->hasOne(User::class, ['user_from' => 'id']);
    }

    public function getReceiver()
    {
        return $this->hasOne(User::class, ['assigned_to' => 'id']);
    }
}