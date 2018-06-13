<?php

namespace app\modules\ModUsuarios\controllers;

use Yii;
use yii\web\Controller;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\modules\ModUsuarios\models\LoginForm;
use vendor\facebook\FacebookI;
use app\modules\ModUsuarios\models\Utils;
use app\modules\ModUsuarios\models\EntUsuariosActivacion;
use app\modules\ModUsuarios\models\EntUsuariosCambioPass;
use app\modules\ModUsuarios\models\EntUsuariosFacebook;
use app\models\CatCodigos;
use app\models\RelUsuariosCodigos;
/**
 * Default controller for the `musuarios` module
 */
class ManagerController extends Controller {
	public $layout = "@app/views/layouts/mainNoHeader";
	private function random_username($string) {
		$pattern = " ";
		$firstPart = strstr ( strtolower ( $string ), $pattern, true );
		$secondPart = substr ( strstr ( strtolower ( $string ), $pattern, false ), 0, 3 );
		$nrRand = rand ( 0, 100 );
		
		$username = trim ( $firstPart ) . trim ( $secondPart ) . trim ( $nrRand );
		return $username;
	}
	private function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array (); // remember to declare $pass as an array
		$alphaLength = strlen ( $alphabet ) - 1; // put the length -1 in cache
		for($i = 0; $i < 8; $i ++) {
			$n = rand ( 0, $alphaLength );
			$pass [] = $alphabet [$n];
		}
		return implode ( $pass ); // turn the array into a string
	}
	
	/**
	 * Registrar usuario en la base de datos
	 */
	public function actionSignUp() {
		$model = new EntUsuarios ( [ 
				'scenario' => 'registerInput' 
		] );
		
		if ($model->load ( Yii::$app->request->post () )) {
			$passwordGenerado = $this->randomPassword ();
			$model->password = $passwordGenerado;
			$model->id_tipo_usuario = 1;
			if ($user = $model->signup ()) {
				
				$codigo = CatCodigos::find ()->where ( [ 
						'txt_nombre' => $model->codigo 
				] )->one ();
				
				$codigo->b_usado = 1;
				$codigo->save ();

				$usuarioCodigo = new RelUsuariosCodigos();
				$usuarioCodigo->id_codigo = $codigo->id_codigo;
				$usuarioCodigo->id_usuario = $user->id_usuario;

				$usuarioCodigo->save();
				
				if (Yii::$app->params ['modUsuarios'] ['mandarCorreoActivacion']) {
					
					$activacion = new EntUsuariosActivacion ();
					$activacion->saveUsuarioActivacion ( $user->id_usuario );
					
					// Enviar correo de activación
					$utils = new Utils ();
					// Parametros para el email
					$parametrosEmail ['url'] = Yii::$app->urlManager->createAbsoluteUrl ( [ 
							'activar-cuenta/' . $activacion->txt_token 
					] );
					$parametrosEmail ['user'] = $user->getNombreCompleto ();
					$parametrosEmail ['pass'] = $passwordGenerado;
					$parametrosEmail['email']= $user->txt_email;
					
					// Envio de correo electronico
					$utils->sendEmailActivacion ( $user->txt_email, $parametrosEmail );
					return $this->redirect ( [ 
							'success-registro' 
					] );
				} else {
					
					if (Yii::$app->getUser ()->login ( $user )) {
						return $this->goHome ();
					}
				}
			}
			
			// return $this->redirect(['view', 'id' => $model->id_usuario]);
		}
		return $this->render ( 'signUp', [ 
				'model' => $model 
		] );
	}
	public function actionSuccessRegistro() {
		return $this->render ( 'successRegistro' );
	}
	public function actionSuccessSendEmailRecoveryPassword() {
		return $this->render ( 'successSendEmailRecoveryPassword' );
	}
	
	/**
	 * Crea peticion para el cambio de contraseña
	 */
	public function actionPeticionPass() {
		$model = new LoginForm ();
		$model->scenario = 'recovery';
		if ($model->load ( Yii::$app->request->post () ) && $model->validate ()) {
			
			$peticionPass = new EntUsuariosCambioPass ();
			
			$peticionPass->saveUsuarioPeticion ( $model->userEncontrado->id_usuario );
			$user = $peticionPass->idUsuario;
			
			// Enviar correo de activación
			$utils = new Utils ();
			// Parametros para el email
			$parametrosEmail ['url'] = Yii::$app->urlManager->createAbsoluteUrl ( [ 
					'cambiar-pass/' . $peticionPass->txt_token 
			] );
			$parametrosEmail ['user'] = $user->getNombreCompleto ();
			
			// Envio de correo electronico
			$utils->sendEmailRecuperarPassword ( $user->txt_email, $parametrosEmail );
			
			return $this->redirect ( [ 
					'success-send-email-recovery-password' 
			] );
		}
		return $this->render ( 'peticionPass', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Cambia la contraseña del usuario
	 *
	 * @param string $t        	
	 */
	public function actionCambiarPass($t = null) {
		$peticion = $this->findPeticionByToken ( $t );
		if (empty ( $peticion )) {
			/**
			 *
			 * @todo Poner mensaje de que la peticion ha expirado
			 */
			return $this->redirect ( [ 
					'peticion-pass' 
			] );
		}
		
		$model = new EntUsuarios ();
		$model->scenario = 'cambiarPass';
		
		// Si los campos estan correctos por POST
		if ($model->load ( Yii::$app->request->post () )) {
			$user = $peticion->idUsuario;
			$user->id_status = 2;
			$user->setPassword ( $model->password );
			$user->save ();
			
			$peticion->updateUsuarioPeticion ();
			
			return $this->redirect ( [ 
					'login' 
			] );
		}
		
		return $this->render ( 'cambiarPass', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Activa la cuenta del usuario
	 *
	 * @param string $t        	
	 */
	public function actionActivarCuenta($t = null) {
		$activacion = $this->findActivacionByToken ( $t );
		
		$usuario = $activacion->idUsuario;
		
		if ($usuario->id_status == EntUsuarios::STATUS_ACTIVED) {
			//return $this->goHome ();
		}
		
		$usuario->activarUsuario ();
		$activacion->actualizaActivacion ();
		
		if (Yii::$app->getUser ()->login ( $usuario )) {
			return $this->goHome ();
		}
	}

	
	/**
	 * Loguea al usuario
	 */
	public function actionLogin() {
		if (! Yii::$app->user->isGuest) {
			return $this->goHome ();
		}
		
		$model = new LoginForm ();
		$model->scenario = 'login';
		if ($model->load ( Yii::$app->request->post () ) && $model->login ()) {
			
			return $this->goBack ();
		}
		return $this->render ( 'login', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Callback para facebook
	 */
	public function actionCallbackFacebook() {
		$fb = new FacebookI ();
		
		// Obtenemos la respuesta de facebook
		$data = $fb->recoveryDataUserJavaScript ();
		
		// Si no existe la informacion enviada de facebook
		if (gettype ( $data ) == "string") {
			if ($data == "error" || empty ( $data )) {
				$this->redirect ( [ 
						'site/login' 
				] );
			}
		}
		
		// asi podemos obtener sus datos de los amigos
		foreach ( $data ['friendsInApp'] as $key => $value ) {
			$value->id;
			$value->name;
		}
		
		// Buscamos al usuario por email
		$existUsuario = EntUsuarios::findByEmail ( $data ['profile'] ['email'] );
		
		// Si no existe creamos su cuenta
		if (! $existUsuario) {
			$entUsuario = new EntUsuarios ();
			$entUsuario->addDataFromFaceBook ( $data );
			
			$existUsuario = $entUsuario->signup ();
		}
		
		// Buscamos si existe la cuenta de facebook en la base de datos
		$existUsuarioFacebook = EntUsuariosFacebook::getUsuarioFaceBookByIdFacebook ( $data ['profile'] ['id'] );
		
		// Si no existe
		if (! $existUsuarioFacebook) {
			$existUsuarioFacebook = new EntUsuariosFacebook ();
		}
		$existUsuarioFacebook->id_usuario = $existUsuario->id_usuario;
		$usuarioGuardado = $existUsuarioFacebook->saveDataFacebook ( $data );
		
		if (Yii::$app->getUser ()->login ( $existUsuario )) {
			return $this->goHome ();
		}
	}
	public function actionTest() {
		$utils = new Utils ();
		$utils->sendEmailActivacion ();
	}


	public function actionReenviarActivacionProblema() {
		$model = new EntUsuarios ( [ 
				'scenario' => 'registerInput' 
		] );
		if ($model->load ( Yii::$app->request->post () )) {
			
			$usuario = EntUsuarios::find ()->where ( [ 
					'txt_email' => $model->txt_email 
			] )->one ();
			
			if ($usuario) {
				$passwordGenerado = $this->randomPassword ();
				$usuario->password = $passwordGenerado;
				
				if ($usuario->save ()) {
					
					if (Yii::$app->params ['modUsuarios'] ['mandarCorreoActivacion']) {
						
						$activacion = new EntUsuariosActivacion ();
						$activacion->saveUsuarioActivacion ( $usuario->id_usuario );
						
						// Enviar correo de activación
						$utils = new Utils ();
						// Parametros para el email
						$parametrosEmail ['url'] = Yii::$app->urlManager->createAbsoluteUrl ( [ 
								'activar-cuenta/' . $activacion->txt_token 
						] );
						$parametrosEmail ['user'] = $usuario->getNombreCompleto ();
						$parametrosEmail ['pass'] = $passwordGenerado;
						$parametrosEmail['email']= $usuario->txt_email;
						
						// Envio de correo electronico
						$utils->reSendEmailActivacion ( $usuario->txt_email, $parametrosEmail );
						//$utils->reSendEmailActivacion ( "jose.kramis@springer.com", $parametrosEmail );
						$this->redirect ( [ 
								'login' 
						] );
					} else {
						
						if (Yii::$app->getUser ()->login ( $user )) {
							return $this->goHome ();
						}
					}
				}
			} else {
				$model->addError ( 'txt_email', 'Dirección de correo no registrado' );
			}
		}
		
		return $this->render ( 'reenviarActivacion', [ 
				'model' => $model 
		] );
	}


	public function actionReenviarActivacion() {
		$model = new EntUsuarios ( [ 
				'scenario' => 'registerInput' 
		] );
		if ($model->load ( Yii::$app->request->post () )) {
			
			$usuario = EntUsuarios::find ()->where ( [ 
					'txt_email' => $model->txt_email 
			] )->one ();
			
			if ($usuario) {
				$passwordGenerado = $this->randomPassword ();
				$usuario->password = $passwordGenerado;
				
				if ($usuario->save ()) {
					
					if (Yii::$app->params ['modUsuarios'] ['mandarCorreoActivacion']) {
						
						$activacion = new EntUsuariosActivacion ();
						$activacion->saveUsuarioActivacion ( $usuario->id_usuario );
						
						// Enviar correo de activación
						$utils = new Utils ();
						// Parametros para el email
						$parametrosEmail ['url'] = Yii::$app->urlManager->createAbsoluteUrl ( [ 
								'activar-cuenta/' . $activacion->txt_token 
						] );
						$parametrosEmail ['user'] = $usuario->getNombreCompleto ();
						$parametrosEmail ['pass'] = $passwordGenerado;
						$parametrosEmail['email']= $usuario->txt_email;
						
						
						// Envio de correo electronico
						$utils->sendEmailActivacion ( $usuario->txt_email, $parametrosEmail );
						$this->redirect ( [ 
								'login' 
						] );
					} else {
						
						if (Yii::$app->getUser ()->login ( $user )) {
							return $this->goHome ();
						}
					}
				}
			} else {
				$model->addError ( 'txt_email', 'Dirección de correo no registrado' );
			}
		}
		
		return $this->render ( 'reenviarActivacion', [ 
				'model' => $model 
		] );
	}
	
	/**
	 * Busca la peticion de cambio de contraseña por el token
	 * Si no se encuentra, un 404 HTTP exception sera arrojada.
	 *
	 * @param string $t        	
	 * @return EntUsuariosCambioPass
	 */
	protected function findPeticionByToken($t = null) {
		if (($model = EntUsuariosCambioPass::getPeticionByToken ( $t )) !== null) {
			
			return $model;
		}
	}
	
	/**
	 * Busca la activacion por el token
	 * Si no se encuentra, un 404 HTTP exception sera arrojada.
	 *
	 * @param string $t        	
	 * @return EntUsuariosActivacion
	 * @throws NotFoundHttpException
	 */
	protected function findActivacionByToken($t = null) {
		if (($model = EntUsuariosActivacion::getActivacionByToken ( $t )) !== null) {
			
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	
	/**
	 * Busca al usuario
	 * Si no se encuentra, un 404 HTTP exception sera arrojada.
	 *
	 * @param string $t        	
	 * @return EntUsuarios
	 * @throws NotFoundHttpException
	 */
	protected function findUsuarioById($id = null) {
		if (($model = EntUsuarios::findIdentity ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
