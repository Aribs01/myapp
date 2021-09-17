<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnnouncedPuResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announced-pu-results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'polling_unit_uniqueid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'party_abbreviation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'party_score')->textInput() ?>

    <?= $form->field($model, 'entered_by_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_entered')->textInput() ?>

    <?= $form->field($model, 'user_ip_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
