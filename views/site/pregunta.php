<?php
use yii\helpers\Html;
use yii\web\View;
use app\models\EntRespuestasUsuarios;

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/resultados.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

echo Html::beginForm( [ 
		'ver-preguntas',
		'modulo' => $modulo->id_modulo,
		'id'=>$pregunta->id_pregunta
		
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
								<div class="col-md-12">
									<div class="alert alert-info" role="alert">
										<p>
										<?php 
										
										$respuestaUsuario = EntRespuestasUsuarios::find()->where(['id_respuesta'=>$respuesta->id_respuesta, 'id_modulo'=>$modulo->id_modulo, 'id_usuario'=>Yii::$app->user->identity->id_usuario])->one();
										
										?>
											<?= Html::radio ( 'respuesta', $respuestaUsuario, [ 
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
						
						<?php if($pregunta->num_orden>1){?>
							<div class="col-md-6 text-center">
							<?=Html::a('<span class="ladda-label">Preview</span>',['ver-preguntas', 'modulo'=>$modulo->id_modulo, 'id'=>$preguntaAnterior->id_pregunta], ['id' => 'btn_anterior', 'class' => 'btn btn-success ladda-button', 'data-style' => 'zoom-in'])?>
							</div>
						<?php }
						
						if($numPreguntas == $pregunta->num_orden){
							$button = 'btn_finish';
							?>
							<div class="col-md-6 text-center">
							<?=Html::a('<span class="ladda-label">Finish</span>',[''], ['id' => $button, 'class' => 'btn btn-success ladda-button', 'data-style' => 'zoom-in'])?>
							</div>
						<?php }else{
							$button = 'btn_siguiente';
							?>
						<div class="col-md-6 text-center">
							<?=Html::submitButton('<span class="ladda-label">Next</span>', ['id' => $button, 'class' => 'btn btn-success ladda-button', 'data-style' => 'zoom-in'])?>
							</div>
						
						<?php }?>	
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
// 				swal('Wait', 'To proceed select the best answer from the given options');
// 				boton.stop();
// 				return false;	
// 			}			
// 		});

		$(window).bind('pageshow', function(event) {
    if (event.originalEvent.persisted) {
        window.location.reload() 
    }
});
		
	$('#form_preg').submit(function(){
		var boton = Ladda.create(document.getElementById('".$button."'));
		boton.start();
			
		if($('input.js_radio_preg').is(':checked')){
			return true;	
		}else{
			swal('Wait', 'In order to proceed you must select the best answer from the given options.');
			boton.stop();
			return false;	
		}	
	});
		
	$('#btn_anterior').on('click', function(e){
		
		var boton = Ladda.create(this);
		boton.start();
		
	});	
	
	$('#btn_finish').on('click', function(e){
		e.preventDefault();
// 		var boton = Ladda.create(this);
// 		boton.start();

		swal({
  title: 'Before you finish',
  text: 'You will not be able to recover this module',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#54d967',
  //cancelButtonColor: '#DD6B55',
  confirmButtonText: 'I\'am ok with my answers',
  cancelButtonText: 'Wait let me go back',
  closeOnConfirm: false,
  closeOnCancel: true
},
function(isConfirm){
  if (isConfirm) {
    $('#form_preg').submit();
  } else {
    
  }
});
		
	});		
		
", View::POS_END );
?>

