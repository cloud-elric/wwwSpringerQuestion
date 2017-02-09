<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */

$this->title = 'Registro';
// $this->params['breadcrumbs'][] = ['label' => 'Ent Usuarios', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ent-usuarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?=Html::a('Login', ['login'])?>
<br>
<?=Html::a('Recuperar contraseña', ['peticion-pass'])?>
