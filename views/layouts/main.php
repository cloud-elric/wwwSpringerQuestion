<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<script> var basePath = '<?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>'; </script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-register-v3 layout-full">
<?php $this->beginBody() ?>
 <?php
    NavBar::begin([
        'brandLabel' => '',
    		'brandOptions' => ['class' => 'myclass'],
        'brandUrl' => ['site/ver-modulos'],
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'.
            		'<li>'
            				. Html::a(
            						'Logout',
            						['seleccionar-mas-modulos']
            						)
            						. '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

        
        <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
