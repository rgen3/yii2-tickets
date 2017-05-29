<?php

use yii\helpers\Html;
use \yii\grid\GridView;


?>
<div class="table-responsive col-lg-12">
    <h3 class="sub-header">Тикеты
        <?= Html::a(Yii::t('app', 'Create ticket'), \yii\helpers\Url::to(['/ticket/create']), ['class' => 'btn btn-success  pull-right']); ?>
    </h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'profile-panel-detailed-grid',
        'options' => ['class' => 'detail-grid-view table-responsive'],
        'columns' => [
            'id',
            [
                'attribute' => Yii::t('app', 'Assigned to'),
                'value' => function ($item) {
                    return $item->receiver->username;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => Yii::t('app', 'Is read'),
                'value' => function ($item) {
                    $message = false;
                    if (isset($item->lastMessage->is_new))
                    {
                        $message = $item->lastMessage->is_new;
                    }
                    return Yii::$app->formatter->asBoolean($message);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => Yii::t('app', 'Date created'),
                'value' => function($item)
                {
                    return Yii::$app->formatter->asDatetime($item->created_at);
                }
            ],
            [
                'attribute' => Yii::t('app', 'Actions'),
                'format' => 'html',
                'value' => function($item)
                {
                    return Html::a(
                        Yii::t('app', 'Answer'),
                        \yii\helpers\Url::to(['/ticket/dialog/' . $item->id]),
                        [
                            'class' => 'btn btn-success'
                        ]
                    );
                }
            ]
        ]
    ]); ?>
</div>