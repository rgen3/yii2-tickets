<?php

namespace rgen3\tickets\models;

use yii\db\ActiveRecord;
use yii\web\User;

class TicketAttachment extends ActiveRecord
{
    public static function tableName()
    {
        return '{{ticket_attachments}}';
    }

    public function rules()
    {
        return [
            [['message_id', 'user_id', 'id'], 'integer'],
            [['attachment_name', 'attachment_type'], 'safe'],
            [
                'message_id',
                'exist',
                'skipOnError' => false,
                'targetClass' => TicketMessage::className(),
                'targetAttribute' => ['message_id' => 'id']
            ],
            [
                'reassigned_to',
                'exist',
                'skipOnError' => false,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ]
        ];
    }

    public function getMessage()
    {
        return $this->hasOne(TicketMessage::class, ['message_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['user_id' => 'id']);
    }
}