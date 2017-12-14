<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

$script = <<< JS
    var messengerBox = document.getElementById("messenger-box");
    messengerBox.scrollTop = messengerBox.scrollHeight;
JS;


$this->registerJs($script, \yii\web\View::POS_END);
?>
<?php Pjax::begin([
    'id' => 'pjax-ticket-dialog-box',
    'enablePushState' => false
]); ?>

    <ul class="media-list messenger-box inbox-widget nicescroll" id="messenger-box">


        <?php foreach ($theme->dialog as $message): ?>
            <li class="media">
                <div class="media-avatar" style="background-image: url(<?= \rgen3\tickets\Module::$defaultUserImage ?>)"></div>
                <div class="media-body">

                    <?= $message->message; ?>

                    <br>
                    <div class="text-muted message-information">
                        <span class="pull-left">

                            <?= $message->answeredBy->username; ?>

                        </span>
                        <span class="pull-right">

                            <?= Yii::$app->formatter->asDateTime($message->answeredBy->created_at); ?>

                        </span>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>


    </ul>

<?php Pjax::end(); ?>

<?= $this->render('dialog_box_form', ['theme' => $theme]); ?>