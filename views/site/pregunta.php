<?php
use yii\helpers\Html;
use yii\web\View;

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/resultados.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

echo Html::beginForm( [ 
		'ver-preguntas',
		'modulo' => $modulo->id_modulo,
		
], 'post', ['id'=> 'form_preg']);
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
			'value' => $respuesta->id_respuesta,
			'class' => 'js_radio_preg'
	] ) . $respuesta->txt_letra . ".-" . $respuesta->txt_respuesta ?>
										</p>
									</div>	
								</div>
							<?php 
							}
							?>
						</div>
						<div class="col-md-12 text-center">
						<?=Html::submitButton('<span class="ladda-label">Siguiente</span>', ['id' => 'btn_siguinte', 'class' => 'btn btn-success ladda-button', 'data-style' => 'zoom-in'])?>
						</div>
					</div>
				</div>
			</div>
			</div>
	</div>
</div>

<?php 

echo Html::endForm ();

$this->registerJs ( "
// 	$('body').on(
// 		'beforeSubmit',
// 		'#form_preg',
// 		function() {
// 			alert();
// 			var boton = Ladda.create(document.getElementById('btn_siguinte'));
// 			boton.start();
			
// 			if($('input.js_radio_preg').is(':checked')){
				
// 			}else{
// 				e.preventDefault();
// 				swal('Cuestionario', 'Necesitas contestar la pregunta!');
// 				boton.stop();
// 				return false;	
// 			}			
// 		});
		
	$('#form_preg').submit(function(){
		var boton = Ladda.create(document.getElementById('btn_siguinte'));
		boton.start();
			
		if($('input.js_radio_preg').is(':checked')){
			return true;	
		}else{
			swal('Cuestionario', 'Necesitas contestar la pregunta!');
			boton.stop();
			return false;	
		}	
	});
", View::POS_END );
?>

