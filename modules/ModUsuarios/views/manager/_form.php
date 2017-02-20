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
    $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true]); 
    $model->aceptarTerminos = false;
    ?>
<div class="form-group">
 <?= $form->field($model, 'aceptarTerminos')->checkbox(['class'=>'js-aceptar-terminos'])?>
 </div>
 
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
		
		
		if(!$(this).prop('checked')){
			swal('Wait', 'You must agree to read the privacy notice', 'warning');
		
		return false;
		}
		
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
		
$(document).ready(function(){
	$('.js-aceptar-terminos').on('click', function(e){
		
		if(!$(this).prop('checked')){
			$('.js-aceptar-terminos').prop('checked', false);
		}else{
		$('#myModal').modal('show')
			e.preventDefault();
		}
	});
		
		$('#js-aceptar-aviso').on('click',function(){
			$('.js-aceptar-terminos').prop('checked', true);
		$('#myModal').modal('hide');
			
		});
		
})	
", View::POS_END );
?>


</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Aviso de privacidad</h4>
      </div>
      <div class="modal-body text-left">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vehicula nec mi in consequat. Integer vitae arcu in leo bibendum vehicula nec in risus. Aenean consequat, lectus in molestie scelerisque, augue mauris auctor tellus, vel laoreet mauris velit at orci. Morbi aliquam hendrerit ante at semper. Sed pulvinar tellus tortor, eu sagittis augue hendrerit quis. Maecenas maximus eros nisi, a laoreet quam pellentesque a. Ut pretium urna id sem faucibus, at pulvinar neque mattis. Vivamus consequat posuere nulla, et commodo ligula volutpat ut. Aliquam vehicula varius mauris, viverra blandit orci tristique sit amet. Suspendisse orci arcu, laoreet quis quam in, iaculis tincidunt nibh. Aliquam erat volutpat.</p>

		 <p>Integer nec turpis quam. Proin et nisi nisl. Cras fermentum euismod metus vitae maximus. Quisque bibendum erat at ipsum molestie condimentum. Vivamus pretium elementum hendrerit. Praesent a quam fringilla, luctus dolor quis, egestas elit. Proin molestie risus eu scelerisque cursus. Nam sollicitudin a metus eget sodales. Etiam placerat, urna ut auctor blandit, libero ante ultrices justo, ut condimentum ipsum ipsum ut lorem. Donec est lorem, consectetur non mattis in, ultrices non ex. Etiam sed ex sit amet nibh interdum placerat. Nam tempor a ante a dictum. Donec in lacus non tellus ultrices cursus ac eget felis.</p>

		 <p>Suspendisse tortor velit, ornare ut vestibulum ac, scelerisque eu arcu. Mauris non justo sit amet risus bibendum faucibus sed a est. In vitae nunc porta ipsum hendrerit imperdiet. Integer nunc lorem, efficitur tincidunt arcu id, aliquet accumsan ante. Vestibulum sed augue porta, feugiat enim et, convallis nunc. Morbi posuere augue in sapien ullamcorper viverra. Etiam ultricies vestibulum enim sit amet condimentum. Fusce elementum sed purus sit amet aliquam. Etiam a enim iaculis, fringilla nibh sit amet, malesuada risus. Mauris rhoncus velit eget mi egestas commodo. Donec in leo dignissim, mattis metus vel, eleifend mi. Aenean molestie pretium finibus. Curabitur eu ornare sem. Aenean viverra sollicitudin nulla nec bibendum. Pellentesque in leo in odio volutpat feugiat non a arcu.</p>

		 <p>Fusce condimentum blandit augue sit amet rutrum. In quis sem varius, feugiat lacus et, dignissim nisl. Morbi et ex eget tortor sollicitudin malesuada vitae a nunc. Sed sed nisl blandit, egestas dui a, malesuada tellus. Fusce nisi orci, dictum at finibus ac, dignissim ut ante. Nam in elit tincidunt, dictum dui ac, gravida lorem. Nam quis vestibulum mauris. Phasellus vel libero sed dui ornare euismod sed quis est. Morbi id tempus nunc. Duis finibus vulputate efficitur. Curabitur posuere, enim sed molestie varius, nibh magna euismod felis, sed pretium lacus ante tincidunt metus. Donec non turpis dictum, sodales purus at, dapibus arcu. Etiam egestas, urna faucibus accumsan mattis, tellus purus consequat lorem, id accumsan eros mauris in urna.</p>

			 <p>Mauris egestas dignissim vestibulum. Donec vehicula rhoncus vehicula. Integer vel porttitor lorem. Pellentesque ac enim quis elit cursus varius vel commodo risus. Fusce posuere pharetra nunc, et lobortis metus sollicitudin sed. In condimentum magna quis lacus pretium, at eleifend sapien dictum. Phasellus pellentesque augue at dignissim tincidunt. Quisque nec sapien non sem commodo congue. Integer urna elit, consequat sit amet tortor ut, interdum dignissim nisl. Nullam eget tortor lacinia, aliquet purus eu, consectetur mauris. Aenean vestibulum ac neque eu congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consequat mi erat, nec faucibus eros commodo sed.</p>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" id="js-aceptar-aviso">He leído aviso de privacidad</button>
      </div>
    </div>
  </div>
</div>