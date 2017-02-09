<?php
use yii\helpers\Html;

// Registro de css y javascript
$this->registerCssFile ( '@web/webAssets/css/ver-modulos.css', [ 
		'depends' => [ 
				\app\assets\AppAsset::className () 
		] 
] );
?>

<div class="container">
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
			<div>
			<?php
			// Impresion de datos
			echo Html::a ( $modulo->txt_nombre, [ 
					'ver-preguntas',
					'modulo' => $modulo->id_modulo 
			] ) . '<br>';
			echo $numPreguntasContestadas . '/' . $numPreguntas . '<br><br>';
			?>
				</div>
		</div>
		<?php
		}
		?>
	</div>
</div>