<?php
use yii\widgets\Pjax;
use yii\helpers\Html;

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
		
			    <h2>ASCO-SEP <br><br>5th Edition Online Self-assessment</h2>
				<p>
					Se ha enviado un correo eléctronico a la dirección proporcionada. En el encontrará un link para poder recuperar su contraseña. 
				</p>
				<div class="col-md-12 text-right">
					<?=Html::a('Login', ['login'])?>
				</div>
			</div>
		
		</div>
		
	</div>
</div>
<?php 
Pjax::end();