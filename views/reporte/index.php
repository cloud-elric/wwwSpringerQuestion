<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewReporteUsuariosSearch*/
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reporte por Usuarios';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile ( '@web/webAssets/js/admin.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

?>

<style type="text/css">

.loader,
.loader:after {
  border-radius: 50%;
  width: 50px;
  height: 50px;
}
.loader {
  margin: 20px auto;
  font-size: 10px;
  position: relative;
  text-indent: -9999em;
  border-top: 1.1em solid rgba(0, 0, 0, 0.5);
  border-right: 1.1em solid rgba(0, 0, 0, 0.5);
  border-bottom: 1.1em solid rgba(0, 0, 0, 0.5);
  border-left: 1.1em solid #000;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation: load8 1.1s infinite linear;
  animation: load8 1.1s infinite linear;
}
@-webkit-keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes load8 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

</style>

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
        				],['class' => 'ver-modulo-incompletos', "data-usuario" =>$data->id_usuario]); //llama los datos del elemento
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
        				],['class' => 'ver-modulo-completos', "data-usuario" =>$data->id_usuario]);//llama los datos del elemento
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
    
    
    
  
  <!-- Modal -->
<div class="modal fade" id="modal-modulos-completos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      
      <div class="modal-body">
        <div id="contenedor-modulos-completos"></div>
      </div>
      

      
    </div>
  </div>
</div>


<div class="modal fade" id="modal-modulos-incompletos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
    
      
      <div class="modal-body">
        <div id="contenedor-modulos-incompletos"></div>
      </div>
      
    </div>
  </div>
</div>


    </div>
    
    
    <div id="contenedor-loader" style="display:none;"><div class="loader">Loading...</div></div>