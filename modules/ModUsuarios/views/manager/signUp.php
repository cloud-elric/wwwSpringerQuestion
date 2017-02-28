<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

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
<style>
.panel{
	text-align: left;
}
</style>
<div class="page vertical-align text-center">
	<div class="page-content vertical-align-middle">
	
		<div class="panel">
		
			<div class="panel-body">
		
			    <h2>ASCO-SEP <br><br>5th Edition Online Self-assessment</h2>
			<br>
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