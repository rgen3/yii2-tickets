<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

$style = <<< CSS
    #messenger-box {
        height: auto;
        min-height: 100px;
        max-height: 300px;
        border: 1px solid rgba(0,0,0,.15);
        box-shadow: inset 0 0 20px rgba(0,0,0,.075);
        padding: 1rem;
        border-radius: 4px;
    }
    #messenger-box .media:not(:last-child){
        margin-bottom: 1rem;
    }
    #messenger-box .media > *{
        align-self:  center;
    }
    #messenger-box .media-avatar{
        width: 28px;
        height: 28px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: left 50% top 50%;
        -webkit-background-size: cover;
        background-size: cover;
    }
    #messenger-box .media-body{
        margin-left: 1rem;
        padding-bottom: .2rem;
        border-bottom: 1px solid rgba(0,0,0,.15);
    }
    #messenger-box .media:last-child .media-body{
        border-bottom-color: transparent;
    }
    .field-createmessage-dialogid{
        margin: 0 !important;
    }
    .message-information{
        margin-top: .5rem;
        font-size: .75rem;
    }
CSS;

$this->registerCss($style, [], 'messenger-style');

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