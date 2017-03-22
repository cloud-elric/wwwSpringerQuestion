<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewReporteUsuariosSearch*/
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reporte por Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
 <h1><?= Html::encode($this->title) ?></h1>
 

 
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'txt_nombre_completo',
       
        		
        		[
        		'attribute' => 'num_modulos_incompletos',
        		'format' => 'raw',
        		'value' => function($data){
        		return Html::a($data->num_modulos_incompletos,
        				[
        						'reporte/modulos-incompletados',
        						'i' => $data->id_usuario
        				],['class' => 'esto-es-una-clase']);
        		}
        		],
        		
      
        		[
        		'attribute' => 'num_modulos_completos',
        		'format' => 'raw',
        		'value' => function($data){
        		   return Html::a($data-> num_modulos_completos,
        		   		[
        			      'reporte/modulos-completados',
        				   'u' => $data->id_usuario
        				],['class' => 'esto-es-una-clase']);
        				}
        				],
        				
        				
            'num_puntuacion_usuario',
            
        		[
        		'attribute' => 'b_emitio_certificado',
        		'format' => 'raw',
        		'value' => function($data){
        		return $data->b_emitio_certificado ? 'Sí' : 'No';
        		}
        		],
              
        ],
    ]); ?>

    </div>