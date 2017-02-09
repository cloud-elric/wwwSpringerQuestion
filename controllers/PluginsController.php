<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class PluginsController extends Controller
{
	
	public function actionUploadFile(){
		
		return $this->render('uploadFile');
	}
}
