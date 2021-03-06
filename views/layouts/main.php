<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register ( $this );
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<script> var basePath = '<?=Yii::$app->urlManager->createAbsoluteUrl ( [''] );?>'; </script>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags()?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head()?>
</head>
<body class="page-register-v3 layout-full">
<?php $this->beginBody()?>
 <?php
	NavBar::begin ( [ 
			'brandLabel' => 'ASCO-SEP 5th Edition Online Self-assessment',
			'brandOptions' => [ 
					'class' => 'myclass' 
			],
			'brandUrl' => [ 
					'site/ver-modulos' 
			],
			'options' => [ 
					'class' => 'navbar-inverse' 
			] 
	] );
	echo Nav::widget ( [ 
			'options' => [ 
					'class' => 'navbar-nav navbar-right' 
			],
			'items' => [ 
					
					[
					'label' => 'My Modules',
					'url' => [
							'/site/seleccionar-mas-modulos'
					]],
					
					Yii::$app->user->isGuest ? ([ 
							'label' => 'Login',
							'url' => [ 
									'/site/login' 
							] 
					]) : ('<li>' . Html::a ( 'Logout', [ 
							'logout' 
					] ) . '</li>'),
					

					 
			] 
	] );
	NavBar::end ();
	?>

        
        <?= $content?>
        
        <?=$this->render('//site/contactUs')?>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
