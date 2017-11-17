<?php

namespace rgen3\tickets\models;

use rgen3\tickets\traits\Translatable;
use yii\db\ActiveRecord;

class TicketStatus extends ActiveRecord implements \rgen3\tickets\interfaces\Translatable
{
    use Translatable;

    public static function tableName()
    {
        return '{{%ticket_statuses}}';
    }

    public function rules()
    {
        return [
            [['id', 'sort'], 'integer']
        ];
    }

    public function getMessages()
    {
        return $this->hasMany(TicketMessage::className(), ['id' => 'status_id']);
    }

}