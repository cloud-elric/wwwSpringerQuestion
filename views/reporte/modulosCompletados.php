<?php



/**
 vista de los datos del usuario
 */

foreach ($modulosUsuarios as $moduloUsuarios ){
	echo $moduloUsuarios->idModulo->txt_nombre;

}