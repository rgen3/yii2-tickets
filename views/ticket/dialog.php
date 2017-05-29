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
                    <div class="list-group-item open-request">
                        <?php $receiver = $theme->receiver ?? false; ?>
                        <?php if ($receiver): ?>
                        <p><?= Yii::t('app',
                                'Name: {username}',
                                [
                                    'username' => $receiver->first_name,
                                ]
                            );
                        ?></p>
                        <p><?= Yii::t('app',
                                'Email: {email}',
                                [
                                    'email' => $receiver->email,
                                ]
                            );
                            ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3>
                        <?= Yii::t('app', 'Ticktes'); ?>
                        <?= Html::a(Yii::t('app', 'Create ticket'), \yii\helpers\Url::to(['/ticket/create']), ['class' => 'btn btn-success  pull-right']); ?>
                    </h3>
                    <?php foreach ($dataProvider->getModels() as $model): ?>
                        <?= Html::a($model->subject, $model->id, [
                            'class' => "list-group-item " . (($theme && $model->id === $theme->id) ? 'list-group-item-success' : '')
                        ]); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-md-9 current-chat">
            <div class="row current-chat-area">
                <div class="col-md-12">
                    <ul class="media-list">
                        <?php if ($theme) foreach ($theme->dialog as $message): ?>
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
                </div>
            </div>
            <?php if ($theme): ?>
            <div class="row current-chat-footer">
                <div class="panel-footer">
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><?= Yii::t('app', 'Send'); ?></button>
                  </span>
                  </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>