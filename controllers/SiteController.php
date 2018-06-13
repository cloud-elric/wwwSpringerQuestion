<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\CatModulos;
use app\models\EntRespuestasUsuarios;
use app\models\EntPreguntas;
use yii\db\Expression;
use app\models\CatCodigos;
use app\models\RelUsuarioModulos;
use app\models\ViewModulosPuntuaje;
use app\models\ViewScoreTotalUsuario;
use app\models\ContactUs;
use yii\web\Response;
use app\modules\ModUsuarios\models\Utils;

class SiteController extends Controller {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [ 
				'access' => [ 
						'class' => AccessControl::className (),
						'only' => [ 
								'logout',
								'ver-modulos',
								'ver-resultados',
								'ver-preguntas',
								'seleccionar-modulos'
						],
						'rules' => [ 
								[ 
										'actions' => [ 
												'logout',
												'ver-modulos',
												'ver-preguntas',
												'ver-resultados',
												'seleccionar-modulos'
										],
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								] 
						] 
				] 
		];
		// 'verbs' => [
		// 'class' => VerbFilter::className(),
		// 'actions' => [
		// 'logout' => ['post'],
		// ],
		// ],
	}
	
	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() {
		Yii::$app->user->logout ();
		
		return $this->goHome ();
	}
	
	/**
	 * Selecciona los modulos del usuario
	 */
	public function actionSeleccionarModulos(){
		$this->layout = 'mainConfig';
	$usuario = Yii::$app->user->identity;
		$relUsMod = RelUsuarioModulos::find()->where(['id_usuario'=>$usuario->id_usuario])->all();
		$modulos = array();
		
		if($relUsMod){
			return $this->redirect(['site/ver-modulos']);
		}

		if(isset($_POST['modulo'])){
// 			print_r($_POST);
// 			exit();
			foreach($_POST['modulo'] as $idModulo){		
				$mods = new RelUsuarioModulos();
				$mods->id_usuario = $usuario->id_usuario;
				$mods->id_modulo = $idModulo;
				
				$mods->save();
			}
			return $this->redirect(['site/ver-modulos']);
		}

		$modulos = ViewModulosPuntuaje::find ()->where ( [
				'b_habilitado' => 1
		] )->orderBy ( 'txt_nombre' )->all ();
		
		return $this->render ( 'seleccionarModulos', [
				'modulos' => $modulos
		] );
	}
	
	public function actionCertificate(){
		$usuario = Yii::$app->user->identity;
		
		return $this->render('certificate');
	}
	
	/**
	 * Action para mostrar todos los modulos
	 */
	public function actionVerModulos() {


		$usuario = Yii::$app->user->identity;
		$relUsMod = RelUsuarioModulos::find()->where(['id_usuario'=>$usuario->id_usuario])->all();
		$modulos = array();
		
		if(!$relUsMod){
			return $this->redirect(['site/seleccionar-modulos']);
		}
		
		foreach($relUsMod as $rel){
			$mod = CatModulos::find()->where(['id_modulo'=>$rel->id_modulo])->andWhere(['b_habilitado'=>1])->one();
			array_push($modulos, $mod);
		}

		
		$avanceUsuario = ViewScoreTotalUsuario::find()->where(['id_usuario'=>$usuario->id_usuario])->one();
		
		return $this->render ( 'verModulos', [ 
				'modulos' => $modulos,
				'avanceUsuario'=>$avanceUsuario
		] );
	}
	
	
	/**
	 * Muestra la siguiente pregunta no contestada del modulo
	 *
	 * @param unknown $modulo        	
	 * @return string
	 */
	public function actionVerPreguntas($modulo = null, $id=null) {
		
		$usuario = Yii::$app->user->identity;
		
		$moduloGet = $this->getModuloById ( $modulo );
		
		/**
		 * Si ya contesto el modulo 
		 */
		if(RelUsuarioModulos::find()->where(['b_finish'=>1, 'id_modulo'=>$moduloGet->id_modulo])->one()){
			return $this->redirect ( [ 
					'resultados',
					'id' => $moduloGet->id_modulo 
			] );
		}
		
		$preguntaAnterior = null;
		
		
		
		
		/**
		 * Obtiene la sigiente pregunta
		 * @var Ambigous <\yii\db\ActiveRecord, \app\controllers\NULL> $pregunta
		 */
		if($id){ 
			$pregunta =EntPreguntas::find()->where(['id_modulo'=>$moduloGet->id_modulo, 'id_pregunta'=>$id])->one();
			
			if (empty ( $pregunta )) {
				return $this->redirect ( [
						'ver-modulos',
						//'id' => $moduloGet->id_modulo
				] );
			}
			
			$preguntaAnterior = EntPreguntas::find()->where(['id_modulo'=>$moduloGet->id_modulo, 'num_orden'=>($pregunta->num_orden - 1)])->one();
			
		}else{
			
			$respuestasContestadas = EntRespuestasUsuarios::find()->where([
					'id_usuario' => $usuario->id_usuario,
					'id_modulo' => $moduloGet->id_modulo
			] )->select('id_pregunta');
			
			if(empty($respuestasContestadas)){
				$pregunta =EntPreguntas::find()->where(['id_modulo'=>$moduloGet->id_modulo, 'num_orden'=>1])->one();
				$preguntaAnterior = $pregunta;
			}else{
			
				$pregunta = $this->getPreguntaRandom($moduloGet->id_modulo, $respuestasContestadas);
				
				if(empty($pregunta)){
					return $this->redirect(['resultados', 'id'=>$moduloGet->id_modulo]);
				}
				
				$preguntaAnterior = EntPreguntas::find()->where(['id_modulo'=>$moduloGet->id_modulo, 'num_orden'=>($pregunta->num_orden - 1)])->one();
			}
			
		}
		
		
		$numRespuestas =  EntRespuestasUsuarios::find ()->where ( [ 
					'id_usuario' => $usuario->id_usuario,
					'id_modulo' => $moduloGet->id_modulo 
			] )->count ();
		
			$numPreguntas = EntPreguntas::find()->where(['id_modulo'=>$moduloGet->id_modulo])->count();
		
		// si se envia la respuesta
		if (isset ( $_POST ['respuesta'] )) {
			
			// Verificacion de usuario no haya contestado antes la pregunta
			$guardarRespuesta = EntRespuestasUsuarios::find ()->where ( [ 
					'id_usuario' => $usuario->id_usuario,
					'id_pregunta' => $pregunta->id_pregunta,
					'id_modulo' => $moduloGet->id_modulo 
			] )->one ();
			
			// si el usuario no ha contestado la pregunta guardaremos su respuesta
			if (empty ( $guardarRespuesta )) {
				$guardarRespuesta = new EntRespuestasUsuarios ();
				
			} else {
				// $session->setFlash('contestada', 'Ya haz respondido esta pregunta');
			}
			
			$guardarRespuesta->id_modulo = $moduloGet->id_modulo;
			$guardarRespuesta->id_pregunta = $pregunta->id_pregunta;
			$guardarRespuesta->id_usuario = $usuario->id_usuario;
			$guardarRespuesta->id_respuesta = $_POST ['respuesta'];
			
			if ($guardarRespuesta->save ()) {
				
				$nuevaPregunta = EntPreguntas::find()->where(['id_modulo'=>$moduloGet->id_modulo])->andWhere('num_orden > '.$pregunta->num_orden)->one();
				
				if(empty($nuevaPregunta)){
					return $this->redirect(['resultados', 'id'=>$moduloGet->id_modulo]);
				}
				
				return $this->redirect ( [
						'ver-preguntas',
						'modulo' => $moduloGet->id_modulo,
						'id'=>$nuevaPregunta->id_pregunta
				] );
			}
			
		}
		
		
		return $this->render ( 'pregunta', [ 
				'pregunta' => $pregunta,
				'modulo' => $moduloGet,
				'numRespuestas'=>$numRespuestas,
				'numPreguntas'=>$numPreguntas,
				'preguntaAnterior'=>$preguntaAnterior
		] );
	}
	public function actionResultados($id = null) {
		$usuario = Yii::$app->user->identity;
		
		$moduloGet = $this->getModuloById ( $id );
		
		$preguntasContestadas = EntRespuestasUsuarios::find ()->where ( [ 
				'id_usuario' => $usuario->id_usuario,
				'id_modulo' => $moduloGet->id_modulo 
		] )->select ( 'id_pregunta' );
		
		$pregunta = $this->getPreguntaRandom ( $moduloGet->id_modulo, $preguntasContestadas );
		
		if ($pregunta) {
			return $this->redirect ( [ 
					'ver-preguntas',
					'modulo' => $moduloGet->id_modulo 
			] );
		}
		
		$respuestasUsuario = EntRespuestasUsuarios::find ()->where ( [ 
				'id_usuario' => $usuario->id_usuario,
				'id_modulo' => $moduloGet->id_modulo 
		] )->all ();
		
		return $this->render ( 'resultados', [ 
				'respuestasUsuario' => $respuestasUsuario 
		] );
	}
	
	/**
	 * Obtiene una pregunta no contestada al azar
	 *
	 * @param unknown $idModulo        	
	 * @param unknown $preguntasContestadas        	
	 * @return \yii\db\ActiveRecord|NULL
	 */
	private function getPreguntaRandom($idModulo, $preguntasContestadas) {
		$pregunta = EntPreguntas::find ()->where ( [ 
				'not in',
				'id_pregunta',
				$preguntasContestadas 
		] )->andWhere ( [ 
				'id_modulo' => $idModulo 
		] )->orderBy ( 'num_orden' )->one ();
		
		return $pregunta;
	}
	
	/**
	 * Busca un post por su token
	 *
	 * @param unknown $idModulo        	
	 * @throws NotFoundHttpException
	 * @return CatModulos
	 */
	private function getModuloById($idModulo) {
		if (($modulo = CatModulos::find ()->where ( [ 
				'id_modulo' => $idModulo 
		] )->one ()) !== null) {
			return $modulo;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}

	public function actionUsuarioCertifico(){
		$usuario = Yii::$app->user->identity;
		
		if(!$usuario->b_emitio_certificado){
			$usuario->b_emitio_certificado = 1;
			$usuario->fch_certificado = Utils::getFechaActual();
			if(!$usuario->save()){
				print_r($usuario->errors);
			}
		}

	}
	
	public function actionSeleccionarMasModulos(){
	
		$usuario = Yii::$app->user->identity;
	
		if(isset($_POST['modulo'])){
			// 			print_r($_POST);
			// 			exit();
			foreach($_POST['modulo'] as $idModulo){
				$mods = new RelUsuarioModulos();
				$mods->id_usuario = $usuario->id_usuario;
				$mods->id_modulo = $idModulo;
	
				$mods->save();
			}
			return $this->redirect(['site/ver-modulos']);
		}
		$modulosFaltantes = array();
		$modUsuario = RelUsuarioModulos::find()->where(['id_usuario'=>$usuario->id_usuario])->all();
		foreach($modUsuario as $modUs){
			array_push($modulosFaltantes,$modUs->id_modulo); 
		}
		
		$modulos = ViewModulosPuntuaje::find()->where(['not in', 'id_modulo', $modulosFaltantes])->andWhere(['b_habilitado'=>1])->all();
	
		return $this->render ( 'seleccionarMasModulos', [
				'modulos' => $modulos
		] );
	}
	
	public function actionContactUs(){
		$model = new ContactUs();
		Yii::$app->response->format = Response::FORMAT_JSON;
		if($model->load(Yii::$app->request->post())){
			// the message
			$msg = "Email: ".$model->email."\nDescription:".$model->description;
			
			// send email
			mail("humberto@2gom.com.mx","Problema",$msg);
			
			return ['status'=>'success'];
		}
		
		return ['status'=>'error'];
	}
	
// 	public function actionGenerarCodigos() {
// // 		for($i = 0; $i < 800; $i ++) {
// 			$codigo = new CatCodigos ();
// 			$codigo->txt_nombre = substr ( md5 ( microtime () ), 1, 5 );
// 			$codigo->save ();
// // 		}
// 	}
}
