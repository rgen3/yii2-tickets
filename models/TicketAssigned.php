<?php

namespace rgen3\tickets\models;

use rgen3\tickets\Module;
use yii\db\ActiveRecord;

class TicketAssigned extends ActiveRecord
{
    public static function tableName()
    {
        return '{{ticket_assigned}}';
    }

    public function rules()
    {
        $userModel = Module::$userModel;
        return [
            [['id', 'reassigned_from', 'reassigned_to'], 'integer'],
            [
                'reassigned_from',
                'exist',
                'skipOnError' => false,
                'targetClass' => $userModel::className(),
                'targetAttribute' => ['reassigned_from' => 'id']
            ],
            [
                'reassigned_to',
                'exist',
                'skipOnError' => false,
                'targetClass' => $userModel::className(),
                'targetAttribute' => ['reassigned_to' => 'id']
            ]
        ];
    }

    public function getReassignedFrom()
    {
        return $this->hasOne(Module::$userModel, ['reassigned_from' => 'id']);
    }

    public function getReassignedTo()
    {
        return $this->hasOne(Module::$userModel, ['reassigned_to' => 'id']);
    }


}