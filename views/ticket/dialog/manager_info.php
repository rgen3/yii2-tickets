<?php

use yii\helpers\Html;

?>
<div class="row" style="margin-bottom: 1rem">
    <?php if ($receiver): ?>
        <div class="col-lg-12">
            <h4>
                <?= Yii::t('app', 'Название тикета: ') ?>
                <?= $theme->subject ?? '' ?> 
            </h4>
        </div>
        <div class="col-lg-6 col-md-12"><?= Yii::t('app',
                'Name: {username}',
                [
                    'username' => $receiver->first_name,
                ]
            );
            ?>
        </div>
        <div class="col-lg-6 col-md-12"><?= Yii::t('app',
                'Email: {email}',
                [
                    'email' => $receiver->email,
                ]
            );
            ?>
        </div>
    <?php endif; ?>
</div>