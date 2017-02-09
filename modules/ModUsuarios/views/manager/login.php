<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Ingresar';
$this->params['breadcrumbs'][] = $this->title;

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
		
		<div class="form-group form-material floating">
    	    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
		</div>

		<div class="form-group form-material floating">
	        <?= $form->field($model, 'password')->passwordInput() ?>
		</div>

        <?php $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
               <?= Html::submitButton('Ingresar', ['class' => 'btn btn-primary btn-block btn-lg margin-top-40', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    
</div>

<?=Html::a('Reenviar correo de activación', ['reenviar-activacion'])?>
<br>
<?=Html::a('Olvide mi contraseña', ['peticion-pass'])?>

</div>
		
		</div>
		
	</div>
</div>
