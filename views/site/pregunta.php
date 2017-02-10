<?php
use yii\helpers\Html;

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/resultados.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

echo Html::beginForm ( [ 
		'ver-preguntas',
		'modulo' => $modulo->id_modulo 
], 'post');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
		
		<div class="panel">
				<div class="panel-body">
					<div class="row">
					
						<div class="col-md-12">
							<blockquote><?=$pregunta->num_orden?>.- <?=$pregunta->txt_descripcion . " " . $pregunta->txt_pregunta?></blockquote>
						</div>
						<div class="col-md-8 col-md-offset-2">
							<?php
							
							foreach ( $pregunta->entRespuestas as $respuesta ) {
								?>
								<div class="col-md-6">
									<div class="alert alert-info" role="alert">
										<p>
											<?= Html::radio ( 'respuesta', false, [ 
			'value' => $respuesta->id_respuesta 
	] ) . $respuesta->txt_letra . ".-" . $respuesta->txt_respuesta ?>
										</p>
									</div>	
								</div>
							<?php 
							}
							?>
						</div>
						<div class="col-md-12 text-center">
						<?=Html::submitButton('Siguiente', ['class'=>'btn btn-success'])?>
						</div>
					</div>
				</div>
			</div>
			</div>
	</div>
</div>

<?php 

echo Html::endForm ();
?>
