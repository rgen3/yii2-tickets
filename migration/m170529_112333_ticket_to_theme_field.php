<?php

class m170529_112333_ticket_to_theme_field extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('{{ticket_messages}}', 'theme_id', 'integer');
        $this->addForeignKey(
            'fk-ticket_messages-ticket_theme',
            '{{ticket_messages}}',
            'theme_id',
            '{{ticket_themes}}',
            'id',
            'RESTRICT',
            'CASCADE'
            );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-ticket_messages-ticket_theme',
            '{{ticket_messages}}'
        );
        $this->dropColumn(
            '{{ticket_messages}}',
            'theme_id'
        );
    }
}