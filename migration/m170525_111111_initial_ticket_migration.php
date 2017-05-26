<?php

class m170525_111111_initial_ticket_migration extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{ticket_statuses}}', [
            'id' => $this->primaryKey(),
            'sort' => $this->integer()
        ]);

        $this->createTable('{{ticket_status_translation}}', [
            'parent_id' => $this->integer(),
            'language_code' => $this->string(10),
            'title' => $this->text(),
            'description' => $this->text()
        ]);

        $this->addPrimaryKey(
            'pk-ticket-status_ticket-status-translation',
            '{{ticket_status_translation}}',
            ['parent_id', 'language_code']
        );

        $this->addForeignKey(
            'fk-ticket-status_ticket-status-translation',
            '{{ticket_status_translation}}',
            '{{parent_id}}',
            '{{ticket_statuses}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{ticket_themes}}', [
            'id' => $this->primaryKey(),
            'user_from' => $this->integer(),
            'assigned_to'   => $this->integer(),
            'subject' => $this->text(),
            'is_closed' => $this->boolean(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addForeignKey(
            'fk-ticket-theme_author',
            '{{ticket_themes}}',
            'user_from',
            '{{user}}',
            'id',
            'CASCADE',
            'CASCADE'
            );

        $this->addForeignKey(
            'fk-ticket-theme_manager',
            '{{ticket_themes}}',
            'assigned_to',
            '{{user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{ticket_assigned}}', [
            'id' => $this->primaryKey(),
            'ticket_id' => $this->integer(),
            'reassigned_from' => $this->integer(),
            'reassigned_to' => $this->integer(),
            'assign_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addForeignKey(
            'fk-ticket_assigned-from_theme_manager',
            '{{ticket_assigned}}',
            'reassigned_from',
            '{{user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-ticket_assigned-to_theme_manager',
            '{{ticket_assigned}}',
            'reassigned_to',
            '{{user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{ticket_messages}}', [
            'id' => $this->primaryKey(),
            'message' => $this->text(),
            'is_new' => $this->boolean(),
            'answered_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addForeignKey(
            'fk-ticket_messages-manager',
            '{{ticket_messages}}',
            'answered_by',
            '{{user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('{{ticket_attachments}}', [
            'id' => $this->primaryKey(),
            'message_id' => $this->integer(),
            'user_id' => $this->integer(),
            'attachment_name' => $this->text(),
            'attachment_type' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-ticket_attachments-message',
            '{{ticket_attachments}}',
            'message_id',
            '{{ticket_messages}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-ticket_assigned-user',
            '{{ticket_attachments}}',
            'user_id',
            '{{user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey('fk-ticket_assigned-user', '{{ticket_attachments}}');
        $this->dropForeignKey('fk-ticket_attachments-message', '{{ticket_attachments}}');
        $this->dropForeignKey('fk-ticket_assigned-from_theme_manager', '{{ticket_assigned}}');
        $this->dropForeignKey('fk-ticket_messages-manager', '{{ticket_messages}}');
        $this->dropForeignKey('fk-ticket_assigned-to_theme_manager', '{{ticket_assigned}}');
        $this->dropForeignKey('fk-ticket-theme_manager','{{ticket_themes}}');
        $this->dropForeignKey('fk-ticket-theme_author', '{{ticket_themes}}');
        $this->dropForeignKey('fk-ticket-status_ticket-status-translation','{{ticket_status_translation}}');

        $this->dropTable('{{ticket_attachments}}');
        $this->dropTable('{{ticket_messages}}');
        $this->dropTable('{{ticket_assigned}}');
        $this->dropTable('{{ticket_themes}}');
        $this->dropTable('{{ticket_status_translation}}');
        $this->dropTable('{{ticket_statuses}}');
    }
}