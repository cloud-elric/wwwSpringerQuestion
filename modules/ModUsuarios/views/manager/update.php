<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';
$this->params['breadcrumbs'][] = ['label' => 'Ent Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_usuario, 'url' => ['view', 'id' => $model->id_usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ent-usuarios-update">

    <h1>ASCO-SEP <br><br>5th Edition Online Self-assessment</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
