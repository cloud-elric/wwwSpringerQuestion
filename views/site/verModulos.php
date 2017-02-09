<?php
use yii\helpers\Html;

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/ver-modulos.css', [ 
		'depends' => [ 
				\app\assets\AppAsset::className () 
		] 
] );
?>

<div class="container ver-modulos">
	<div class="row">
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
				href="<?=Yii::$app->urlManager->createAbsoluteUrl ( ['site/ver-preguntas', 'modulo'=>$modulo->id_modulo] )?>">
				<div class="panel">
					<div class="panel-body">
						<h3><?=$modulo->txt_nombre?></h3>
					</div>
					<div class="panel-footer">
						<p class="text-right">
						<?=$numPreguntasContestadas . '/' . $numPreguntas?>
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