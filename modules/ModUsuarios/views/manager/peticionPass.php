<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile ( '@web/css/register-v3.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );
?>

<div class="page vertical-align text-center">
	<div class="page-content vertical-align-middle">
	
		<div class="panel">
		
			<div class="panel-body">

				<div class="site-login">
				    <h1><?= Html::encode($this->title) ?></h1>
				
				    <?php $form = ActiveForm::begin(); ?>
				
				        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
				
				        <div class="form-group">
			                <?= Html::submitButton('Recuperar password', ['class' => 'btn btn-primary btn-block btn-lg margin-top-40', 'name' => 'login-button']) ?>
				        </div>
				
				    <?php ActiveForm::end(); ?>
				</div>
				
			</div>
		
		</div>
		
	</div>
</div>
