<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

$style = <<< CSS
    .messenger-box {
        height: 500px;
        overflow-y: scroll;
    }
CSS;

$this->registerCss($style, [], 'messenger-style');

$script = <<< JS
    var messengerBox = document.getElementById("messenger-box");
    messengerBox.scrollTop = messengerBox.scrollHeight;
JS;


$this->registerJs($script, \yii\web\View::POS_END);
?>
<div class="row current-chat-area">
    <div class="col-md-12">
        <?php Pjax::begin([
            'id' => 'pjax-ticket-dialog-box',
            'enablePushState' => false
        ]); ?>
        <ul class="media-list messenger-box" id="messenger-box">
            <?php foreach ($theme->dialog as $message): ?>
                <li class="media">
                    <div class="media-body">
                        <div class="media">
                            <span class="pull-left" href="#">
                                <?= Html::img(\rgen3\tickets\Module::$defaultUserImage, [
                                    'class' => 'media-object img-circle'
                                ]); ?>
                            </span>
                            <div class="media-body">
                                <?= $message->message; ?>
                                <br>
                                <small class="text-muted">
                                    <?= $message->answeredBy->username; ?> |
                                    <?= Yii::$app->formatter->asDateTime($message->answeredBy->created_at); ?>
                                </small>
                                <hr>
                            </div>
                        </div>

                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php Pjax::end(); ?>
    </div>
</div>
<?= $this->render('dialog_box_form', ['theme' => $theme]); ?>