<?php

namespace rgen3\tickets\models;

use rgen3\tickets\traits\Translatable;
use yii\db\ActiveRecord;

class TicketStatus extends ActiveRecord implements \rgen3\tickets\interfaces\Translatable
{
    use Translatable;
    public static function tableName()
    {
        return [
            [['id', 'sort'], 'integer']
        ];
    }
}