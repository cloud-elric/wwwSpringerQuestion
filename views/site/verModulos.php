<?php
use yii\helpers\Html;

foreach($modulos as $modulo){
	// usuario logueado
	$usuario = Yii::$app->user->identity;
	// numero de preguntas del modulo
	$numPreguntas = $modulo->getEntPreguntas()->count();
	
	// numero de preguntas contestadas por el usuario
	$numPreguntasContestadas = $modulo->getEntRespuestasUsuarios()->where(['id_usuario'=>$usuario->id_usuario])->count();
	
	// Impresion de datos
	echo Html::a($modulo->txt_nombre, ['ver-preguntas', 'modulo'=>$modulo->id_modulo]).'<br>';
	echo $numPreguntasContestadas.'/'.$numPreguntas.'<br><br>';
}