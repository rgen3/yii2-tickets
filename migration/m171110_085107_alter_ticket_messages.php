<?php

use yii\db\Migration;

/**
 * Class m171110_085107_alter_ticket_messages
 */
class m171110_085107_alter_ticket_messages extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{ticket_messages}}', 'status_id', $this->integer()->defaultValue(1));
        $this->addColumn('{{ticket_messages}}', 'status_at', $this->date()->null());
        $this->addForeignKey('fk-messages_to_status', '{{ticket_messages}}', 'status_id', '{{ticket_statuses}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-messages_to_status', 'ticket_messages');
        $this->dropColumn('{{ticket_messages}}', 'status');
        $this->dropColumn('{{ticket_messages}}', 'status_at');
    }
}
