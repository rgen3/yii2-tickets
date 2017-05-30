<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(['method' => 'post', 'action' => 'create']); ?>
    <div class="col-lg-12 form-group">
        <?= $form->field($model, 'subject')->textInput();?>
        <?= $form->field($model, 'message')->textarea([
            'rows' => 7
        ]);?>
    </div>
    <div class="col-lg-12 form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']); ?>
        <?php /* <?= $form->field($model, 'status')->checkbox(); ?> */ ?>
    </div>
<?php ActiveForm::end(); ?>