<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

$this->title = 'Registro';
// $this->params['breadcrumbs'][] = ['label' => 'Ent Usuarios', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;

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
		
			    <h1><?= Html::encode($this->title) ?></h1>
			
			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
			    
				<?=Html::a('Login', ['login'])?>
				<br>
				<?=Html::a('Recuperar contraseña', ['peticion-pass'])?>
			
			</div>
		
		</div>
		
	</div>
</div>
