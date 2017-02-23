<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';
/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile ( '@web/css/register-v3.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

$this->registerCssFile ( '@web/css/bootstrap-extend.min.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );
?>

<div class="page vertical-align text-center">
	<div class="page-content vertical-align-middle">
	
		<div class="panel">
		
			<div class="panel-body">

				<div class="ent-usuarios-form">
				
				    <?php $form = ActiveForm::begin(); ?>
				  
				    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder'=>'Contraseña'])->label(false) ?>
				    
				    <?= $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true, 'placeholder'=>'Repetir contraseña'])->label(false) ?>
				
				    <div class="form-group">
				        <?= Html::submitButton($model->isNewRecord ? 'Cambiar password' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block btn-lg margin-top-40' : 'btn btn-primary btn-block btn-lg margin-top-40']) ?>
				    </div>
				
				    <?php ActiveForm::end(); ?>
				
				</div>
				
			</div>
		
		</div>
		
	</div>
</div>
