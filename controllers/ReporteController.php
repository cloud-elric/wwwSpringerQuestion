<?php

namespace app\controllers;

use Yii;
/*use app\models\ViewReporteUsuarios;*/
use app\models\ViewReporteUsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\ViewAvanceUsuario;
use app\models\ViewScoreModuloUsuario;
/*use yii\filters\VerbFilter;*/



class ReporteController extends Controller{


/*se muestra la información de los datos*/
	public function actionIndex(){

		$searchModel = new  ViewReporteUsuariosSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	
	
	
	/**
	vista de los datos del usuario
	 */
	public function actionView($id)
	{
		return $this->render('view', [
				'model' => $this->findModel($id),
		]);
	}
	
	


	protected function findModel($id)
	{
		if (($model = Personal::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	
	
	
	
	public function actionModulosCompletados($u=null){
		//consulta query select
		$modulosUsuarios = ViewScoreModuloUsuario::find()->where(['id_usuario' => $u])->andWhere(['b_modulo_completado' => 1]) -> all();
		 
		/*foreach ($modulosUsuarios as $moduloUsuarios ){
			echo $moduloUsuarios->idModulo->txt_nombre;
		
		}*/
		
		return $this->render('modulosCompletados', ['modulosUsuarios' => $modulosUsuarios]);
		
			
	}
	
	
	
	public function actionModulosIncompletados($i=null){
		//query select
		$modulosUsuarios = ViewAvanceUsuario::find()->where(['id_usuario' => $i])->andWhere(['num_preguntas_faltantes' => 1]) -> all();
		
		return $this->render('modulosIncompletados', ['modulosUsuarios' => $modulosUsuarios]);
	}

}