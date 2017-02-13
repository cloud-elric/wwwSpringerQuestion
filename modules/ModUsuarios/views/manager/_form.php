<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin(); ?>
    
	<div class="form-group">
	    <?= $form->field($model, 'txt_username')->textInput(['maxlength' => true, 'placeholder'=>'Nombre'])->label(false) ?>
	</div>
	
	<div class="form-group">
	    <?= $form->field($model, 'txt_apellido_paterno')->textInput(['maxlength' => true, 'placeholder'=>'Apellido paterno'])->label(false) ?>
	</div>
	
	<!-- <div class="form-group">
	    <?php $form->field($model, 'txt_apellido_materno')->textInput(['maxlength' => true, 'placeholder'=>'Apellido materno'])->label(false) ?>
	</div> -->
	
	<div class="form-group">
	    <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true, 'placeholder'=>'Correo eléctronico'])->label(false) ?>
    </div>
    
    <div class="form-group">
	    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true, 'placeholder'=>'Código'])->label(false) ?>
    </div>
    
    <?php $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="ladda-label">'.($model->isNewRecord ? 'Registrar' : 'Actualizar').'</span>', ['id'=>'submit-button','data-style'=>'zoom-in', 'class' =>($model->isNewRecord ? 'btn btn-success btn-block btn-lg margin-top-40' : 'btn btn-primary btn-block btn-lg margin-top-40'). ' ladda-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php 
$this->registerJs ( "
$('body').on(
		'beforeSubmit',
		'form',
		function() {
			var form = $(this);
			// return false if form still have some validation errors
			if (form.find('.has-error').length) {
				return false;
			}
			//$('#js-editar-submit').attr('value', 'editar');
			var button = document.getElementById('submit-button');
			var l = Ladda.create(button);
		 	l.start();
		
		});
		
	
", View::POS_END );
?>


</script>