<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';
?>

<div class="ent-usuarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Reenviar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
