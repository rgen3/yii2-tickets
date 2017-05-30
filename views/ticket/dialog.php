<?php

use yii\helpers\Html;

?>
<div class="header-offers">
    <div class="row">
        <div class="col-sm-4">
            <h3 class="offers-title"><?= $theme->subject ?? ''; ?></h3>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 pull-right">
            <div class="row chats-row">
                <div class="col-md-12">
                    <?= $this->render('dialog/manager_info', ['receiver' => $receiver]); ?>
                </div>
                <div class="col-md-12">
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
        <div class="col-md-9 current-chat">
            <?php if ($theme): ?>
                <?= $this->render('dialog/dialog_box', ['theme' => $theme]); ?>
            <?php endif; ?>
        </div>
    </div>
</div>