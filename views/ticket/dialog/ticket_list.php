<?php
    use yii\helpers\Html;
?>

<h3>
    <?= Yii::t('app', 'Ticktes'); ?>
    <?= Html::a(Yii::t('app', 'Create ticket'), \yii\helpers\Url::to(['/ticket/create']), ['class' => 'btn btn-success  pull-right']); ?>
</h3>
<?php foreach ($dataProvider->getModels() as $model): ?>
    <?= Html::a(
        $model->subject,
        '/ticket/dialog/' . $model->id,
        [
            'class' => "list-group-item " . (($model->id === $themeId) ? 'list-group-item-success' : '')
        ]); ?>
<?php endforeach; ?>
