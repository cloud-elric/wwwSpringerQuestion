<?php

use yii\helpers\Html;
use yii\widgets\Pjax;


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

$this->registerCssFile ( '@web/css/bootstrap-extend.min.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

$this->registerJsFile ( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', [
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
		
			    <h2><?= Html::encode($this->title) ?></h2>
			
			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

			    <div class="col-md-12 text-right">
					<?=Html::a('Login', ['login'])?>
				</div>
			
			</div>
		
		</div>
		
	</div>
</div>
<?php 
Pjax::end();