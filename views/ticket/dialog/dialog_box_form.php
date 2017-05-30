<?php

use \rgen3\tickets\models\forms\CreateMessage;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$model = new \rgen3\tickets\models\forms\CreateMessage();

$script = <<< JS
    jQuery('body').on('submit', '#ticket-message-form', function ()
    {
        var form = $('#ticket-message-form'),
            data = form.serialize();

        jQuery.ajax({
            url : '/ticket/answer',
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response)
            {
                jQuery.pjax.reload({container: '#pjax-ticket-dialog-box'});
            },
            error: function(response)
            {
                
            }
        });
        return false;
    });
JS;

//$this->registerJs($script, \yii\web\View::POS_END);

?>
<div class="row current-chat-footer">
    <div class="panel-footer">
        <?php $form = ActiveForm::begin([
            'id' => 'ticket-message-form',
            'method' => 'post',
            'action' => ['/ticket/answer'],
            'options' => ['data-pjax' => true ]
        ]); ?>
        <?= $form->field($model, 'dialogId')->hiddenInput([
            'value' => $theme->id
        ])->label(false); ?>
        <?= $form->field($model, 'message', [
            'template' => '<div class="col-sm-12">{label}</div><div class="col-sm-10">{error}</div><div class="col-sm-10">{input}</div>',
        ]); ?>
        <?= Html::submitButton(
            Yii::t('app', 'Send'),
            [
                'class' => 'btn btn-success col-sm-2',
                'type' => 'button'
            ]); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>