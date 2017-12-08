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
    'template' => '{label}{error}{input}',
]); ?>
<?= Html::submitButton(
    Yii::t('app', 'Send'),
    [
        'class' => 'btn btn-success',
        'type' => 'button'
    ]); ?>
<?php ActiveForm::end(); ?>