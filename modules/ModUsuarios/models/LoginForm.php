<?php

namespace app\modules\ModUsuarios\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *          
 */
class LoginForm extends Model {
	public $username;
	public $password;
	public $rememberMe = true;
	public $userEncontrado;
	private $_user = false;
	
	/**
	 *
	 * @return array the validation rules.
	 */
	public function rules() {
		return [
				// username and password are both required
				[ 
						[ 
								'username',
								'password' 
						],
						'required',
						'on' => 'login' 
				],
				// username es requerido para recuperar la contraseña
				[ 
						[ 
								'username' 
						],
						'required',
						'on' => 'recovery' 
				],
				[ 
						[ 
								'username' 
						],
						'existeUsuario',
						'on' => 'recovery' 
				],
				[ 
						[ 
								'username' 
						],
						'trim' 
				],
				['username','email'],
				
				// rememberMe must be a boolean value
				[ 
						'rememberMe',
						'boolean' 
				],
				// password is validated by validatePassword()
				[ 
						'password',
						'validatePassword',
						'on' => 'login' 
				] 
		];
	}
	
	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute
	 *        	the attribute currently being validated
	 * @param array $params
	 *        	the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params) {
		if (! $this->hasErrors ()) {
			$user = $this->getUser ();
			
			if (! $user || ! $user->validatePassword ( $this->password )) {
				$this->addError ( $attribute, 'Incorrect username or password.' );
			}
		}
	}
	
	/**
	 * Valida que el usuario exista
	 */
	public function validateUsuario($attribute, $params) {
		$this->userEncontrado = $this->getUser ();
		
		if (empty($this->userEncontrado)) {
			$this->addError ( $attribute, 'No existe una cuenta asociada al corro electronico ingresado.' );
		}
	}
	
	/**
	 * Valida que el usuario exista
	 */
	public function existeUsuario($attribute, $params) {
		$this->userEncontrado = $this->getUserNoActivado ();
	
		if (empty($this->userEncontrado)) {
			$this->addError ( $attribute, 'No existe una cuenta asociada al corro electronico ingresado.' );
		}
	}
	
	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login() {
		if ($this->validate ()) {
			return Yii::$app->user->login ( $this->getUser (), $this->rememberMe ? 3600 * 24 * 30 : 0 );
		}
		return false;
	}
	
	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser() {
		if ($this->_user === false) {
			$this->_user = EntUsuarios::findByEmail ( $this->username );
			if($this->_user){
				if($this->_user->id_status==1){
					$this->addError('username', 'Su cuenta aún no ha sido activada.');
				}
			}
		}
		
		return $this->_user;
	}
	
	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUserNoActivado() {
		if ($this->_user === false) {
			$this->_user = EntUsuarios::findByEmail ( $this->username );
// 			if($this->_user){
// 				if($this->_user->id_status==1){
// 					$this->addError('username', 'Su cuenta aún no ha sido activada.');
// 				}
// 			}
		}
	
		return $this->_user;
	}
}
