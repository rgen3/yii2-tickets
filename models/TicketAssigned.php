<?php

namespace rgen3\tickets\models;

use common\models\User;
use yii\db\ActiveRecord;

class TicketAssigned extends ActiveRecord
{
    public static function tableName()
    {
        return '{{ticket_assigned}}';
    }

    public function rules()
    {
        return [
            [['id', 'reassigned_from', 'reassigned_to'], 'integer'],
            [
                'reassigned_from',
                'exist',
                'skipOnError' => false,
                'targetClass' => User::className(),
                'targetAttribute' => ['reassigned_from' => 'id']
            ],
            [
                'reassigned_to',
                'exist',
                'skipOnError' => false,
                'targetClass' => User::className(),
                'targetAttribute' => ['reassigned_to' => 'id']
            ]
        ];
    }

    public function getReassignedFrom()
    {
        return $this->hasOne(User::class, ['reassigned_from' => 'id']);
    }

    public function getReassignedTo()
    {
        return $this->hasOne(User::class, ['reassigned_to' => 'id']);
    }


}