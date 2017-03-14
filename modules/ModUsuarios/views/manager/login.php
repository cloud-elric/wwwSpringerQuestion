<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\web\View;

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';
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
				    <h2>ASCO-SEP <br><br>5th Edition Online Self-assessment</h2>
				
				
				    <?php $form = ActiveForm::begin(['id'=>'form-login']); ?>
						
						<div class="form-group">
				    	    <?= $form->field($model, 'username')->textInput(['placeholder'=>'Email'])->label(false) ?>
						</div>
				
						<div class="form-group">
					        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>
						</div>
				
				        <?php $form->field($model, 'rememberMe')->checkbox([
				            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
				        ]) ?>
				
				        <div class="form-group">
				               <?= Html::submitButton('<span class="ladda-label">Sign in</span>', ['id'=>'submit-button','data-style'=>'zoom-in', 'class' =>'btn btn-success btn-block btn-lg margin-top-40 ladda-button']) ?>
				        </div>
						<div class="form-group">
							<?=Html::a('Create an account', ['sign-up'], ['class'=>'btn btn-primary btn-block btn-lg'])?>
						</div>
				    <?php ActiveForm::end(); ?>
				    
				</div>
				<div class="col-md-12 text-right">
				<?=Html::a('Forgot password?', ['peticion-pass'])?>
				</div>
				
			</div>
		
		</div>
		
	</div>
	
<!-- 	<button class="btn btn-default js-contact-us">Contact us</button> -->
</div>

<?php 
$this->registerJs ( "
$('body').on(
		'beforeSubmit',
		'#form-login',
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
