<?php

use yii\helpers\Html;
?>
<div class="table-responsive col-lg-12">
    <h3 class="sub-header">Тикеты
        <?= Html::a(Yii::t('app', 'Create ticket'), \yii\helpers\Url::to(['/ticket/create']), ['class' => 'btn btn-success  pull-right']); ?>
    </h3>
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>id</th>
            <th>Дата</th>
            <th>Отправитель</th>
            <th>Получатель</th>
            <th>Прочитано</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div class="text-center col-lg-12">
        <ul class="pagination pagination-sm">

        </ul>
    </div>
</div>