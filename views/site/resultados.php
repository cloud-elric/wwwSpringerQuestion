<?php
use yii\helpers\Html;
use app\models\ViewScoreModuloUsuario;
use app\models\ViewUsuarioRespuesta;

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/resultados.css', [ 
		'depends' => [ 
				\app\assets\AppAsset::className () 
		] 
] );

?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
		
		
		
<?php
$i=1;
foreach ( $respuestasUsuario as $respuestaUsuario ) {
	$pregunta = $respuestaUsuario->idPregunta;
	$respuestaCorrecta = $pregunta->getEntRespuestas ()->where ( [ 
			'b_correcto' => 1 
	] )->one ();
	$respuesta = $respuestaUsuario->idRespuesta;
	$isCorrecta = $respuesta->id_respuesta==$respuestaCorrecta->id_respuesta;
	
	$score = ViewScoreModuloUsuario::find()->where(['id_modulo'=>$pregunta->id_modulo, 'id_usuario'=>$respuestaUsuario->id_usuario])->one();
	
	?>
	
	<?php if($i==1){?>
	
	<div class="panel panel-info">
			<div class="panel-heading">
			<h5>Module Complete <span class="pull-right">You got <?=ViewUsuarioRespuesta::find()->where(['id_modulo'=>$pregunta->id_modulo, 'id_usuario'=>$respuestaUsuario->id_usuario, 'b_correcto'=>1])->count()?> correct answers out of <?=count($respuestasUsuario)?></span></h5>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6 col-md-offset-6 text-right">
								<h4><?=$score?$score->num_puntuacion_usuario:0?> Credits earned</h4>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<?php 
	$i++;
	}?>
	<div class="panel">
				<div class="panel-body">
					<div class="row">
					
						<div class="col-md-12">
							<blockquote><?=$pregunta->num_orden?>.- <?=$pregunta->txt_descripcion . " " . $pregunta->txt_pregunta?></blockquote>
						</div>
						<div class="col-md-8">
							<?php
							
							foreach($pregunta->entRespuestas as $respuestaP){
							$acierto = (($respuestaP->id_respuesta==$respuesta->id_respuesta)&&($respuestaP));
								?>
								<div class="col-md-12">
									<div class="alert <?=$acierto?'alert-warning':'alert-info'?>" role="alert">
										<p>
											<?=$respuestaP->txt_letra . '.-' . $respuestaP->txt_respuesta?>
										</p>
									</div>	
								</div>
							<?php 
							}
							?>
						</div>
						<div class="col-md-4">
						<div class="col-md-12">
							<div class="panel <?=$isCorrecta?'success':'danger'?>" role="alert">
								<div class="panel-body">
								 <?=$isCorrecta?'You answer was <h1>CORRECT</h1>':'You answer was <h1>WRONG</h1>'?>
								 </div>
							</div>
						</div>
						</div>
						<div class="col-md-12">
							<div class="alert alert-success">
									<strong>Correct answer:</strong> <?=$respuestaCorrecta->txt_letra . '.-' . $respuestaCorrecta->txt_respuesta?>
							</div>
						</div>
						
						<div class="col-md-12">
						
							<p>
								<?='<p><strong>Rationable:</strong></p><p>' . $respuestaCorrecta->txt_justificacion.'</p>'?>
							</p>
							
							<p>
								<?='<p><strong>Suggested Reading:</strong></p><em>' . $respuestaCorrecta->txt_lectura_sugerida.'</em>'?>
							</p>
						</div>
					</div>
				</div>
			</div>
	
	<?php
// 	echo '<strong>Respuesta que se dio:</strong>' . $respuesta->txt_letra . '.-' . $respuesta->txt_respuesta . '<br>';
// 	echo '<strong>Respuesta correcta:</strong>' . $respuestaCorrecta->txt_letra . '._' . $respuestaCorrecta->txt_respuesta . '<br>';
// 	echo '<strong>Justificación:</strong>' . $respuestaCorrecta->txt_justificacion . '<br>';
// 	echo '<strong>Lectura sugerida</strong>' . $respuestaCorrecta->txt_lectura_sugerida . '<br><br>';
}
?>



</div>


	</div>
	
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<?=Html::a('Return to home', ['site/ver-modulos'], ['class'=>'btn btn-primary btn-block'])?>
	<br><br>
</div>
	</div>
</div>