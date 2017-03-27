<?php
use yii\helpers\Html;

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/ver-modulos.css', [ 
		'depends' => [ 
				\app\assets\AppAsset::className () 
		] 
] );

$this->registerJsFile ( '@web/webAssets/js/config-modules.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

$this->registerCssFile ( '@web/webAssets/css/toastr.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

$this->registerJsFile ( '@web/webAssets/js/toastr.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

	echo Html::beginForm( [ 
		'seleccionar-modulos'
], 'post', ['id'=> 'form_select_modulo']);
?>
<div class="container ver-modulos">
	<div class="row">

		<div class="col-md-9">
			<div class="alert alert-info" role="alert" id="js-instrucciones">
				
			</div>
		</div>
		<div class="col-md-3">
		<?=Html::submitButton('<span class="ladda-label">Save configuration</span>', ['id' => 'btn-siguinte', 'class' => 'btn btn-success btn-block ladda-button', 'style'=>'padding:15px', 'data-style' => 'zoom-in', 'disabled'=>true])?>
		</div>
	</div>	
	<div class="row">
		<?php
		foreach ( $modulos as $modulo ) {
			?>
			
			<div class="col-md-3">

			<div class="panel">
				<div class="panel-body">
					<div class="checkbox">
						<label style="font-size: 1.2em"> 
						<input class="js_checkbox_modulos" data-score="<?=$modulo->num_puntuacion?>" id="check-<?=$modulo->id_modulo?>" type="checkbox" name="modulo[]" value="<?=$modulo->id_modulo?>"> 
						<span class="cr"><i class="cr-icon fa fa-check"></i></span>
						</label>
					</div>
					
					<label for="check-<?=$modulo->id_modulo?>" >
							<h6 class="text-center"><?=$modulo->txt_nombre?></h6>
						</label>
					
				</div>
				<div class="panel-footer">
					<p>Maximum certification points: <strong><?=round($modulo->num_puntuacion, 2, PHP_ROUND_HALF_DOWN)?></strong></p>
				</div>
			</div>

		</div>
		<?php
		}
		?>
		</div>
	
<!-- 	<div class="row"> -->
<!-- 		<div class="col-md-6 col-md-offset-3 text-center form-group"> -->
			  
<!-- 		</div> -->
<!-- 	</div> -->
</div>
<?php echo Html::endForm ();?>

