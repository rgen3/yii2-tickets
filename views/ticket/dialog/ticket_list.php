<?php
    use yii\helpers\Html;
?>
<?php foreach ($dataProvider->getModels() as $model): ?>
	<div class="col-lg-6 col-md-12">
		<?= Html::a(
		$model->subject,
		'/ticket/dialog/' . $model->id,
		[
		    'class' => "list-group-item " . (($model->id === $themeId) ? 'list-group-item-success' : '')
		]); ?>
	</div>
<?php endforeach; ?>