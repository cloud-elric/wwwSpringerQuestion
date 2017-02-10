<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\web\View;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

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
Pjax::begin();
?>

<div class="page vertical-align text-center">
	<div class="page-content vertical-align-middle">
	
		<div class="panel">
		
			<div class="panel-body">

				<div class="site-login">
				    <h1><?= Html::encode($this->title) ?></h1>
				
				
				    <?php $form = ActiveForm::begin(); ?>
						
						<div class="form-group">
				    	    <?= $form->field($model, 'username')->textInput(['placeholder'=>'Email'])->label(false) ?>
						</div>
				
						<div class="form-group">
					        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Contraseña'])->label(false) ?>
						</div>
				
				        <?php $form->field($model, 'rememberMe')->checkbox([
				            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
				        ]) ?>
				
				        <div class="form-group">
				               <?= Html::submitButton('<span class="ladda-label">Ingresar</span>', ['id'=>'submit-button','data-style'=>'zoom-in', 'class' =>'btn btn-primary btn-block btn-lg margin-top-40 ladda-button']) ?>
				        </div>
				
				    <?php ActiveForm::end(); ?>
				    
				</div>
				<div class="col-md-12 text-right">
				<?=Html::a('Olvide mi contraseña', ['peticion-pass'])?>
				</div>
			</div>
		
		</div>
		
	</div>
</div>

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

Pjax::end();
