<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\assets\AppAsset;

use yii\helpers\Html;

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
  <?php 
  $this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',  [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] )
  ?> 
</head>
<body class="page-register-v3 layout-full">
<?php $this->beginBody()?>

        
        <?= $content?>

<?=$this->render('//site/contactUs')?>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
