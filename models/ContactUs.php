<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ContactUs extends Model
{
    public $email;
    public $description;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'description'], 'required', 'message'=>'Campo requerido'],
        		[
        		'email',
        		'trim'
        				],
        		[
        		'email', 'email', 'message'=>'Formato de correo no valido'
        				],
            // rememberMe must be a boolean value
        ];
    }

}
