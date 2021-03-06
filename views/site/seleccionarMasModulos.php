<?php
use yii\helpers\Html;

$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/ver-modulos.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

echo Html::beginForm( [
		'seleccionar-mas-modulos'
], 'post', ['id'=> 'form_select_mas_modulos']);
?>
<div class="container ver-modulos">
	<div class="row">
	
		<?php
		foreach ( $modulos as $modulo ) {
			?>
			
			<div class="col-md-3">

			<div class="panel">
				<div class="panel-body">
					<div class="checkbox">
						<label style="font-size: 1.5em"> 
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
	<div class="row">
		<div class="col-md-6 col-md-offset-3 text-center form-group">
			<?=Html::submitButton('<span class="ladda-label">Save</span>', ['id' => 'btn-siguinte', 'class' => 'btn btn-success btn-block ladda-button', 'data-style' => 'zoom-in', 'disabled'=>false])?>  
		</div>
	</div>
</div>
<?php echo Html::endForm ();?>

