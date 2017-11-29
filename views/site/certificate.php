<?php
use yii\web\View;
use yii\helpers\Html;
use app\models\ViewScoreModuloUsuario;
use app\models\ViewScoreTotalUsuario;

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';

$this->registerCssFile(
    '@web/webAssets/css/styles.css',
    ['depends' => [\app\assets\AppAsset::className()]]
);
$this->registerCssFile(
    '@web/webAssets/css/print.css',
    ['depends' => [\app\assets\AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/plugins/print-area/print-area.js',
    ['depends' => [\app\assets\AppAsset::className()]]
);

$this->registerJsFile(
    '@web/webAssets/js/print.js',
    ['depends' => [\app\assets\AppAsset::className()]]
);
$idUsuario = Yii::$app->user->identity->id_usuario;
$modulosPuntuacion = ViewScoreModuloUsuario::find()->where(['id_usuario'=>$idUsuario])->all();
$totalPuntuacion = ViewScoreTotalUsuario::find()->where(['id_usuario'=>$idUsuario])->one();

?>
<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<?=Html::a('Back', ['site/ver-modulos'], ['class'=>'btn btn-primary'])?>
						</div>
					</div>
					<!-- <h2>Certificate for <?=Yii::$app->user->identity->txt_username?> <?=Yii::$app->user->identity->txt_apellido_paterno?></h2>
					<button class="btn btn-success js-print">Print</button> -->
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 form-group">
		<div id="page-certificate" class="page-certificate">
		<h2>El consejo Mexicano de Oncología 
			<span>Otorga:</span> <?=round($totalPuntuacion->num_puntuacion_usuario, 2)?> puntos de recertificación al Dr:
		</h2>
		<h1><?=Yii::$app->user->identity->txt_username?> <?=Yii::$app->user->identity->txt_apellido_paterno?></h1>
		<h2>que tras haber realizado las actividades correspondientes al programa de auto estudio ASCO-SEP</h2>
		<h3>Medical Oncology Self Evaluation Program</h3>
		<h2>5a edición ha reunido el siguiente puntaje:</h2>
		<div class="score-container">
			<ul class="materia">
				<?php 
				foreach($modulosPuntuacion as $modulo){
				?>
					<li><?=$modulo->txt_nombre?></li>
				<?php
			}?>
				
			</ul>
			<ul class="puntaje">
			<?php 
				foreach($modulosPuntuacion as $modulo){
				?>
					<li><?=round($modulo->num_puntuacion_usuario, 2)?></li>
				<?php
			}?>
				
			</ul>
		</div>
	</div>
  	<a href="" class="print-btn btn btn-primary js-print"><i class="glyphicon glyphicon-print"></i> Imprimir certificado</a>
		</div>
	</div>
	


</div>

<?php
$this->registerJs ( "
	
		$(document).ready(function(){
			$('.js-print').on('click', function(e){
				e.preventDefault();
				$( '.page-certificate' ).printArea();
			});
		});
		
", View::POS_END );