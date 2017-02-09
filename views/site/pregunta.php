<?php
use yii\helpers\Html;

echo $pregunta->txt_descripcion . '<br>';
echo $pregunta->txt_pregunta . '<br><br>';

echo Html::beginForm ( [ 
		'ver-preguntas',
		'modulo' => $modulo->id_modulo 
], 'post');
foreach ( $pregunta->entRespuestas as $respuesta ) {
	echo Html::radio ( 'respuesta', false, [ 
			'value' => $respuesta->id_respuesta 
	] ) . $respuesta->txt_letra . ".-" . $respuesta->txt_respuesta . "<br><br>";
}

echo Html::submitButton('Siguiente'); 

echo Html::endForm ();