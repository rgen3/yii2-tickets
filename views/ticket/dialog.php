<?php
use yii\helpers\Html;

use rgen3\tickets\assets\ticketAsset;
ticketAsset::register($this);

$this->title = Yii::t('app', 'Тикеты');
?>

<div class="row tickets-block">
    <div class='<?= $theme ? "col-lg-4 col-md-5 col-sm-12" : "col-lg-12" ?>'>
        <div class="card-box">

            <div class="row chats-row">
                <div class="col-md-12">

                    <?= Html::a(Yii::t('app', 'Create ticket'), \yii\helpers\Url::to(['/ticket/create']), ['class' => 'btn btn-success']); ?>

                </div>
            </div>
            <div class="row">

                <!-- стрелка, которая показывает \ скрывает тикеты -->
                <i class="ion-ios7-arrow-down moreTickets"></i>

                <?= $this->render(
                        'dialog/ticket_list',
                        [
                            'dataProvider' => $dataProvider,
                            'themeId' => $theme && $theme->id ? $theme->id : false
                        ]
                ); ?>
                
            </div>
        </div>
    </div>
        
    <?php if ($theme): ?>
        <div class="col-lg-8 col-md-7 col-sm-12">
            <div class="card-box floatChat">

                <?= $this->render('dialog/manager_info', ['receiver' => $receiver, 'theme' => $theme]); ?>

                <?= $this->render('dialog/dialog_box', ['theme' => $theme]); ?>

            </div>
        </div>
    <?php endif; ?>

</div>