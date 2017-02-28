<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;


$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';
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
				
				        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Email'])->label(false) ?>
				
				        <div class="form-group">
			                <?= Html::submitButton('Retrieve password', ['class' => 'btn btn-primary btn-block btn-lg margin-top-40', 'name' => 'login-button']) ?>
				        </div>
				
				    <?php ActiveForm::end(); ?>
				    <div class="col-md-12 text-right">
				<?=Html::a('Login', ['login'])?>
				</div>
				</div>
				
			</div>
		
		</div>
		
	</div>
</div>
<?php 
Pjax::end();