<?php
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
foreach ( $respuestasUsuario as $respuestaUsuario ) {
	$pregunta = $respuestaUsuario->idPregunta;
	$respuestaCorrecta = $pregunta->getEntRespuestas ()->where ( [ 
			'b_correcto' => 1 
	] )->one ();
	$respuesta = $respuestaUsuario->idRespuesta;
	$isCorrecta = $respuesta->id_respuesta==$respuestaCorrecta->id_respuesta;
	?>
	
	<div class="panel">
				<div class="panel-body">
					<div class="row">
					<div class="col-md-12">
							<div class="alert <?=$isCorrecta?'alert-success':'alert-danger'?>" role="alert">
								 <?=$isCorrecta?'You answer is correct.':'You answer is wrong.'?>
							</div>
						</div>
						<div class="col-md-12">
							<blockquote><?=$pregunta->num_orden?>.- <?=$pregunta->txt_descripcion . " " . $pregunta->txt_pregunta?></blockquote>
						</div>
						<div class="col-md-8 col-md-offset-2">
							<?php
							
							foreach($pregunta->entRespuestas as $respuestaP){
							$acierto = (($respuestaP->id_respuesta==$respuesta->id_respuesta)&&($respuestaP));
								?>
								<div class="col-md-6">
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
						
						<div class="col-md-4 col-md-offset-4">
							<div class="alert alert-success">
									<strong>Correct answer:</strong> <?=$respuestaCorrecta->txt_letra . '.-' . $respuestaCorrecta->txt_respuesta?>
							</div>
						</div>
						
						<div class="col-md-12">
						
							<p>
								<?='<p><strong>Justificación:</strong></p><p>' . $respuestaCorrecta->txt_justificacion.'</p>'?>
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
</div>