<?php
use yii\helpers\Html;

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/ver-modulos.css', [ 
		'depends' => [ 
				\app\assets\AppAsset::className () 
		] 
] );
$puntuacionMinima = 15;
$porcentaje = 0;
?>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<div class="form-group">
		<?php 
		if(false){
		#if($avanceUsuario && $avanceUsuario->num_puntuacion_usuario<$puntuacionMinima){?>
		<div class="panel">
		<div class="panel-body">
					<p>Score for get certificate</p>
					<?php
					$scoreUsuario = 0;
					if($avanceUsuario){
						$scoreUsuario = $avanceUsuario->num_puntuacion_usuario;
						$porcentaje = ($scoreUsuario*100)/15;
					}
					?>
					<div class="progress">
						<div class="progress-bar progress-bar-striped active"
							role="progressbar" aria-valuenow="<?=$scoreUsuario?>" aria-valuemin="0"
							aria-valuemax="<?=$puntuacionMinima?>" style="width: <?=$porcentaje?>%">
							<span class=""><?=$scoreUsuario?></span>
						</div>
					</div>
					</div>
		</div>
		<?php }else{
		echo Html::a('Get certificate', ['site/certificate'], ['class'=>'btn btn-primary btn-block']);
		}?>
		</div>
		</div>
	</div>
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
			
			<div class="col-md-4">
			<a
				class="<?=($numPreguntasContestadas==$numPreguntas)&&$numPreguntas>0?'complete':''?>"
				href="<?=Yii::$app->urlManager->createAbsoluteUrl ( ['site/ver-preguntas', 'modulo'=>$modulo->id_modulo] )?>">
				<div class="panel">
					<div class="panel-body">
						<h3 class="text-center"><?=$modulo->txt_nombre?></h3>
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
</div>