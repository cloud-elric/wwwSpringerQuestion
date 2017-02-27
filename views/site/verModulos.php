<?php
use yii\helpers\Html;
$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';
// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/ver-modulos.css', [ 
		'depends' => [ 
				\app\assets\AppAsset::className () 
		] 
] );
$puntuacionMinima = 52;
$porcentaje = 0;
?>
<style>
.progress {
    height: 35px;
    margin-bottom: 0px; 
    overflow: hidden;
    background-color: #f5f5f5;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<div class="alert alert-info" role="alert" id="js-instrucciones">
				Choose the topic that you want to do a quiz on from the list that appears: -> Please select the module you wish to review.
			</div>
		</div>
	</div>
	
<!-- 	<div class="row"> -->
<!-- 	<div class=" col-md-12"> -->
<!-- 		<div class="panel"> -->
<!-- 			<div class="panel-body"> -->
<!-- 				<p>INSTRUCCIONES:</p> -->
<!-- 				<p>Leer detenidamente cada una de los capitulos contenidos en la seccion impresa.</p> -->
<!-- 				<p>Una vez finalizada la lectutura podrá acceder al módulo de evaluación, el cual está localizado en la página <a target="_blank" href="http://www.certificaonco.com.mx">www.certificaonco.com.mx</a></p> -->
<!-- 				<p>Si es la primera vez que ingresa, tendrá que seguir el proceso de registro, durante el cual le solicitará sus datos personales, aceptar el aviso de privacidad, asi como -->
<!-- 				colocar la clave de acceso contenida en este material.</p> -->
<!-- 				<p>Puede ir realizando las evaluaciones de manera parcial o bien aplicar a los mismos en una sola sesión.</p> -->
<!-- 				<p>Una vez terminada cada una de las evaluaciones podrá consultar las respuestas correctas.Tendrá acceso también a la calificación de cada uno de los módulos.</p> -->
<!-- 				<p>Para solicitar el diploma con la acreditación de los puntos de recertificación pulse Diploma.</p> -->
<!-- 				<p>Dudas y aclaraciones, mande un e-mail a la siguiente direccion: </p> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 		</div> -->
<!-- 	</div> -->
	
	<div class="row  ver-modulos">
		<?php
		foreach ( $modulos as $modulo ) {
			// usuario logueado
			$usuario = Yii::$app->user->identity;
			// numero de preguntas del modulo
			$numPreguntas = $modulo->getEntPreguntas ()->count ();
			
			// numero de preguntas contestadas por el usuario
			$numPreguntasContestadas = $modulo->getEntRespuestasUsuarios ()->where ( [ 
					'id_usuario' => $usuario->id_usuario 
			] )->count ();
			?>
			
			<div class="col-md-3">
			<a
				class="<?=($numPreguntasContestadas==$numPreguntas)&&$numPreguntas>0?'complete':''?>"
				href="<?=Yii::$app->urlManager->createAbsoluteUrl ( ['site/ver-preguntas', 'modulo'=>$modulo->id_modulo] )?>">
				<div class="panel">
					<div class="panel-body">
						<h6 class="text-center"><?=$modulo->txt_nombre?></h6>
					</div>
					<div class="panel-footer">
						<p class="text-right">
						<?=($numPreguntasContestadas==$numPreguntas)&&$numPreguntas>0?'Complete':$numPreguntasContestadas . '/' . $numPreguntas?>
					</p>
					</div>
				</div>
			</a>
		</div>
		<?php
		}
		?>
	</div>
	
	<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		
		<div class="panel">
		<div class="panel-body">
		<div class="row">
					<?php
					$scoreUsuario = 0;
					if($avanceUsuario){
						$scoreUsuario = $avanceUsuario->num_puntuacion_usuario;
						$porcentaje = ($scoreUsuario*100)/$puntuacionMinima;
					}
					?>
					<div class="col-md-8">
					<p>Current Credits  <?=$scoreUsuario?> out of 52 Total</p>
					<div class="progress">
						<div class="progress-bar progress-bar-striped active"
							role="progressbar" aria-valuenow="<?=$scoreUsuario?>" aria-valuemin="0"
							aria-valuemax="<?=$puntuacionMinima?>" style="width: <?=$porcentaje?>%">
							<!--  <span class=""><?=$scoreUsuario?></span>-->
						</div>
					</div>
					</div>
					<div class="col-md-4">
					<p><br></p>
						<?php
						$habilitarBoton = $porcentaje>=100;
						if($habilitarBoton){
							echo Html::a('Get certificate', ['site/certificate'], ['class'=>'btn btn-primary btn-block']);
						}else{?>
						<a class="btn btn-primary btn-block " href="javascript: void(0)" disabled="">Get certificate</a>
						<?php }
						?>
					</div>
		</div>			
					</div>
		</div>
		
		</div>
		</div>
	</div>
</div>