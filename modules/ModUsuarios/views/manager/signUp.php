<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

$this->title = 'Registro';
// $this->params['breadcrumbs'][] = ['label' => 'Ent Usuarios', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
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
