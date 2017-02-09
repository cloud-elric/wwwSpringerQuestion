<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>
    
	<div class="form-group form-material floating">
	    <?= $form->field($model, 'txt_username')->textInput(['maxlength' => true]) ?>
	</div>
	
	<div class="form-group form-material floating">
	    <?= $form->field($model, 'txt_apellido_paterno')->textInput(['maxlength' => true]) ?>
	</div>
	
	<div class="form-group form-material floating">
	    <?= $form->field($model, 'txt_apellido_materno')->textInput(['maxlength' => true]) ?>
	</div>
	
	<div class="form-group form-material floating">
	    <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true]) ?>
    </div>
    
    <div class="form-group form-material floating">
	    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
    </div>
    
    <?php $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success btn-block btn-lg margin-top-40' : 'btn btn-primary btn-block btn-lg margin-top-40']) ?>
    </div>

    <?php ActiveForm::end(); ?>

