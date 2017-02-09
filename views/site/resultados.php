<?php
foreach($respuestasUsuario as $respuestaUsuario){
	$pregunta = $respuestaUsuario->idPregunta;
	$respuestaCorrecta = $pregunta->getEntRespuestas()->where(['b_correcto'=>1])->one();
	$respuesta = $respuestaUsuario->idRespuesta;
	
	echo '<strong>Pregunta:</strong>'.$pregunta->txt_descripcion." ".$pregunta->txt_pregunta."<br>";
	echo '<strong>Respuesta que se dio:</strong>'.$respuesta->txt_letra.'.-'.$respuesta->txt_respuesta.'<br>';
	echo '<strong>Respuesta correcta:</strong>'.$respuestaCorrecta->txt_letra.'._'.$respuestaCorrecta->txt_respuesta.'<br>';
	echo '<strong>Justificación:</strong>'.$respuestaCorrecta->txt_justificacion.'<br>';
	echo '<strong>Lectura sugerida</strong>'.$respuestaCorrecta->txt_lectura_sugerida.'<br><br>';
}