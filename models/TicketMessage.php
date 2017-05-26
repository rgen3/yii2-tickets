<?php

namespace rgen3\tickets\models;

use common\models\User;
use yii\db\ActiveRecord;

class TicketMessage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{ticket_message}}';
    }

    public function rules()
    {
        return [
            [['id', 'answered_by'], 'integer'],
            ['is_new', 'boolean'],
            [
                'answered_by',
                'exist',
                'skipOnError' => false,
                'targetClass' => User::className(),
                'targetAttribute' => ['user_id' => 'id']
            ]
        ];
    }

    public function getManager()
    {
        return $this->hasOne(User::class, ['answered_by' => 'id']);
    }
}