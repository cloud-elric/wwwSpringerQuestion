<?php

namespace app\controllers;

use Yii;
/* use app\models\ViewReporteUsuarios; */
use app\models\ViewReporteUsuariosSearch;
use yii\web\Controller;
/*use yii\web\NotFoundHttpException;*/
use app\models\ViewAvanceUsuario;
use app\models\ViewScoreModuloUsuario;
/* use yii\filters\VerbFilter; */
use app\models\ViewReporteUsuarios;



class ReporteController extends Controller {
	
	/* se muestra la informaci�n de los datos */
	public function actionIndex() {
		$searchModel = new ViewReporteUsuariosSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	
	
	// metodo modulos completos e incompletos
	public function actionModulosCompletados($u = null) {
		$this->layout = false;
		$modulosUsuarios = ViewScoreModuloUsuario::find ()->where ( [ 'id_usuario' => $u ] )->andWhere ( [ 'b_modulo_completado' => 1 ] )->all ();
		
		return $this->render ( 'modulosCompletados', [ 
				'modulosUsuarios' => $modulosUsuarios 
		] );
	}
	
	
	
	public function actionModulosIncompletados($i = null) {
		$this->layout = false;
		$modulosUsuarios = ViewAvanceUsuario::find ()->where ( [ 'id_usuario' => $i ] )->andWhere ( [ 'num_preguntas_faltantes' => 1 ] )->all ();
		
		return $this->render ( 'modulosIncompletados', [ 
				'modulosUsuarios' => $modulosUsuarios 
		] );
	}
	
	
	
	
	// funcion de descargar archivos en csv
	public function actionDescargarCsv() {
		
		$reporteUsuario = ViewReporteUsuarios::find ()->all ();
		
		$arrayCsv = [ ];
		$i = 0;
		
		foreach ( $reporteUsuario as $data ) {
			
			$arrayCsv [$i] ['nombreCompleto'] = $data->txt_nombre_completo;
			$arrayCsv [$i] ['modulosIncompletos'] = $data->num_modulos_incompletos;
			$arrayCsv [$i] ['modulosCompletos'] = $data->num_modulos_completos;
			$arrayCsv [$i] ['puntuacionUsuario'] = $data->num_puntuacion_usuario;
			$arrayCsv [$i] ['emitioCertificado'] = $data->b_emitio_certificado;
			$arrayCsv [$i] ['fechaCertificado'] = $data->fch_certificado;
			
			$i++;
		}
		
		
	//print_r($arrayCsv );
	//exit ();
		
		$this->downloadSendHeaders ( 'reporte.csv' );
		
		echo $this->array2Csv ( $arrayCsv );
		die();
		
	}
	
	
	
	
	private function array2Csv($array) {
		if (count ( $array ) == 0) {
			return null;
		}
		ob_start();
		$df = fopen ( "php://output", "w" );
		fputcsv ( $df, [ 
				'Nombre completo',
				'Modulos incompletos',
				'Modulos completos',
				'Puntuacion usuario',
				'Emitio certificado',
				'Fecha emisión certificado' 
		]
		 );

		foreach ( $array as $row ) {
			fputcsv ( $df, $row );
		}

		fclose ( $df );
		return ob_get_clean();
	}
	
	
	
	
	private function downloadSendHeaders($filename) {
		// disable caching
		$now = gmdate ( "D, d M Y H:i:s" );
		// header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header ( "Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate" );
		header ( "Last-Modified: {$now} GMT" );
		
		// force download
		header ( "Content-Type: application/force-download" );
		header ( "Content-Type: application/octet-stream" );
		// comentario sin sentido
		header ( "Content-Type: application/download" );
		
		// disposition / encoding on response body
		header ( "Content-Disposition: attachment;filename={$filename}" );
		header ( "Content-Transfer-Encoding: binary" );
	}
}
