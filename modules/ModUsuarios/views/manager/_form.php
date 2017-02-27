<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\EntUsuarios */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.form-group .form-group{
text-align: left;
}
</style>

    <?php $form = ActiveForm::begin(['id' => 'sign-form',]); ?>
    
	<div class="form-group">
	    <?= $form->field($model, 'txt_username')->textInput(['maxlength' => true, 'placeholder'=>'Firts name (aparecerá en el certificado)'])->label() ?>
	</div>
	
	<div class="form-group">
	    <?= $form->field($model, 'txt_apellido_paterno')->textInput(['maxlength' => true, 'placeholder'=>'Last name (aparecerá en el certificado)'])->label() ?>
	</div>
	
	<!-- <div class="form-group">
	    <?php $form->field($model, 'txt_apellido_materno')->textInput(['maxlength' => true, 'placeholder'=>'Apellido materno'])->label() ?>
	</div> -->
	
	<div class="form-group">
	    <?= $form->field($model, 'txt_email')->textInput(['maxlength' => true, 'placeholder'=>'Email'])->label() ?>
    </div>
    
    <div class="form-group">
	    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true, 'placeholder'=>'Activation code'])->label('Código') ?>
	    <p>Please use the activation code provided on the card that came with you books.</p>
    </div>
    
    <?php $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    $form->field($model, 'repeatPassword')->passwordInput(['maxlength' => true]); 
    $model->aceptarTerminos = false;
    ?>
<div class="">
 <?= $form->field($model, 'aceptarTerminos')->checkbox(['class'=>'js-aceptar-terminos'])?>
 </div>
 
    <div class="form-group">
        <?= Html::submitButton('<span class="ladda-label">'.($model->isNewRecord ? 'Sign in' : 'Actualizar').'</span>', ['id'=>'submit-button','data-style'=>'zoom-in', 'class' =>($model->isNewRecord ? 'btn btn-success btn-block btn-lg margin-top-40' : 'btn btn-primary btn-block btn-lg margin-top-40'). ' ladda-button']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
<?php 
$this->registerJs ( "
$('body').on(
		'beforeSubmit',
		'#sign-form',
		function() {
		
		var button = document.getElementById('submit-button');
			var l = Ladda.create(button);
		 	l.start();
		
		if(!$('.js-aceptar-terminos').prop('checked')){
			swal('Wait', 'You must agree to read the privacy notice', 'warning');
			l.stop();
		return false;
		}
		
		
		
			var form = $(this);
			// return false if form still have some validation errors
			if (form.find('.has-error').length) {
				return false;
			}
			//$('#js-editar-submit').attr('value', 'editar');
			
		
		});
		
$(document).ready(function(){
	$('.js-aceptar-terminos').on('click', function(e){
		
		if(!$(this).prop('checked')){
			$('.js-aceptar-terminos').prop('checked', false);
		}else{
		$('#myModal').modal('show')
			e.preventDefault();
		}
	});
		
		$('#js-aceptar-aviso').on('click',function(){
			$('.js-aceptar-terminos').prop('checked', true);
		$('#myModal').modal('hide');
			
		});
		
})	
", View::POS_END );
?>


</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Aviso de privacidad</h4>
      </div>
      <div class="modal-body text-left">
      <p>AVISO DE PRIVACIDAD INTEGRAL
I. RESPONSABLE DE LA PROTECCIÓN DE SUS DATOS PERSONALES.
I. Springer Science + Business Media México, S.A. de C.V. (en los sucesivo Springer México), con domicilio en Insurgentes Sur No. 1886, Piso 10, Colonia Florida, Álvaro Obregón, C.P. 01030, Ciudad de México, es responsable de sus Datos Personales de conformidad con lo establecido en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (en lo sucesivo la Ley), y la normatividad aplicable aunado a las políticas de Springer México. Respecto de lo anterior, Springer México hace de su conocimiento el presente Aviso de Privacidad.
II. DATOS PERSONALES.
Para lograr las finalidades que se mencionan más adelante podemos solicitar las siguientes categorías de Datos Personales: (i) datos de identificación; (ii) datos de contacto; (iii) datos académicos; (iv) datos patrimoniales o financieros; (v) datos laborales; y (vi) datos de beneficiarios. También recabamos fotografías, imágenes, videos y documentos que soporten los Datos Personales anteriores.
III. DATOS SENSIBLES O DE MENORES DE EDAD.
En algunos casos, exclusivamente para cumplir los términos y condiciones de la relación jurídica que exista o llegara a existir con usted y/o porque sean necesarias para proporcionar nuestros productos o para la adecuada prestación de nuestros servicios, utilizaremos los siguientes datos personales considerados como sensibles: si cuenta con capacidades diferentes. En estos casos, requeriremos de su consentimiento expreso para el tratamiento de sus Datos Personales. Asimismo podemos recibir Datos Personales cuyos titulares sean menores de edad los cuales sólo serán tratados con el consentimiento expreso de los padres o tutores.
IV. FINALIDADES.
Le informamos que los Datos Personales recabados por Springer México de manera personal, directa o indirecta, serán utilizados para las siguientes FINALIDADES PRINCIPALES:
 Identificación y contacto;
 Investigación y desarrollo en materia editorial;
 Proveer los productos o servicios solicitados por los clientes de Springer México;
 Brindarle información sobre nuestros productos y servicios;
 Brindar capacitación y prestar servicios relacionados con nuestros productos;
 Venta y entrega de productos impresos y electrónicos, incluida la administración de plataformas electrónicas para investigadores, médicos, líderes de la industria médica y farmacéutica, estudiantes y docentes;
 Brindar atención y soporte técnico a los usuarios de nuestros productos, incluyendo plataformas digitales;
 Individualización de cuentas para facilitar el uso de plataformas digitales;
 Consultar antecedentes crediticios y solvencia económica de clientes y/o proveedores;
 Para conocer antecedentes laborales y/o académicos;
 Proteger la seguridad e integridad de las personas dentro de nuestras instalaciones;
 Atender aclaraciones y quejas; y
 Cumplir con las obligaciones legales, contables, regulatorias y contractuales a cargo de Springer México, incluso las posteriores a la terminación de la relación jurídica de que se trate.
De manera adicional, utilizamos los Datos Personales para las siguientes FINALIDADES NO ESENCIALES:
 Brindarle Información sobre los lugares en los que puede adquirir nuestros productos y/o servicios y proporcionar datos de contacto de las personas que venden nuestros productos;
 Comunicarle información sobre promociones, novedades y eventos relacionados con nuestros productos y servicios;
2
 Para fines de Mercadotecnia, incluyendo, tecnologías de la información, investigación, operación, administración y comercialización;
 Evaluar la calidad de nuestros productos y servicios;
 Conocer el perfil y las necesidades de nuestros consumidores; y
 Realizar estudios de hábitos de consumo y de mercado.
V. CONSENTIMIENTO
Por favor considere que cuando sea aplicable, si usted no manifiesta su oposición para que sus datos personales sean tratados en los términos señalados en el presente aviso, se entenderá que ha otorgado su consentimiento para ello.
VI. MECANISMOS PARA QUE MANIFIESTE SU NEGATIVA AL TRATAMIENTO PARA LAS FINALIDADES NO ESENCIALES.
Le recordamos que si no nos proporciona sus datos de manera personal o directa usted cuenta con un plazo de 5 (cinco) días hábiles para manifestar que no desea que sus Datos Personales sean tratados para las finalidades que no son necesarias ni dieron origen a la relación jurídica con usted.
Puede ejercer este derecho mediante una solicitud presentada en nuestro domicilio
Su solicitud será atendida de acuerdo a lo establecido en el apartado VIII de Derechos ARCO de este Aviso.
Si requiere información sobre los requisitos para ejercer éste derecho o tiene alguna duda por favor escríbanos al correo electrónico privacidadmacmillan@grupomacmillan.com
VII. TRANSFERENCIA DE DATOS PERSONALES.
Para cumplir con las finalidades descritas en este Aviso, sus Datos Personales pueden ser transferidos y tratados dentro y fuera del país, a las personas y con las finalidades que a continuación se describen:
 Las empresas controladoras, subsidiarias o afiliadas de Springer México en México o en el extranjero, terceros proveedores de servicios en México o en el extranjero para la prestación y mantenimiento de plataformas electrónicas y recibir servicios de selección y/o reclutamiento de personal;
 Las empresas controladoras, subsidiarias o afiliadas de Springer México en México o en el extranjero, terceros proveedores de servicios o autoridades y entidades de la administración pública federales o locales, en México o en el extranjero, para el cumplimiento de las obligaciones legales, contables, regulatorias o contractuales a cargo de Springer México o de cualquiera de sus empresas controladoras, subsidiarias o afiliadas en México o en el extranjero aún después de la terminación de dicha relación;
 Instituciones de crédito para cumplir los términos y condiciones de la relación de servicios o en general de la relación jurídica que exista o llegara a existir con usted y con las obligaciones posteriores a su terminación;
 Springer México también podrá revelar sus Datos Personales cuando esté obligada por alguna disposición legal o en cumplimiento de alguna resolución judicial;
 Terceros en México o en el extranjero derivado de una restructuración corporativa, incluyendo la fusión, consolidación, venta, liquidación o transferencia de activos de Springer México respetando las finalidades previstas en este aviso; y
 Terceros en México o en el extranjero con fines de mercadotecnia: tecnologías de la información, investigación, operación, administración y comercialización.
Las transferencias que se refieren a finalidades de mercadotecnia y las finalidades no esenciales requieren de su consentimiento.
3
VIII. DERECHOS DE ACCESO, RECTIFICACIÓN, CANCELACIÓN Y OPOSICIÓN (ARCO), REVOCACIÓN DEL CONSENTIMIENTO Y LIMITACIÓN DEL USO O DIVULGACIÓN DE LOS DATOS PERSONALES.
Usted tiene derecho a: acceder a sus Datos Personales que poseemos y a los detalles del tratamiento de los mismos; a rectificarlos en caso de ser inexactos o incompletos; cancelarlos; u oponerse al tratamiento de los mismos (Derechos ARCO); revocar su consentimiento para el tratamiento de sus Datos Personales o bien, limitar el uso o divulgación de sus Datos Personales.
MEDIOS
Para ejercer cualquiera de los derechos mencionados anteriormente usted o su representante legal deberán presentar una solicitud de ejercicio de derechos ARCO en el domicilio de Springer México señalado al inicio del presente Aviso, de Lunes a Jueves, en un horario de 9:00 a 14:00 y de 15:30 a 17:00 horas, Viernes de 9:00 a 14:00 horas
DE LA SOLICITUD
Su solicitud deberá contener al menos la siguiente información: (i) Clave Única de Registro de Población (ii) nombre completo del titular de los Datos Personales; (iii) domicilio; (iv) correo electrónico o cualquier medio que usted designe para oír y recibir notificaciones; (v) identificación oficial vigente o, en su caso, copia certificada del instrumento legal con el que se acredite la personalidad del representante legal del titular de los Datos Personales y copia de la identificación del representante; (v) la explicación clara y precisa de los Datos Personales a los que se refiere su solicitud y el derecho que desea ejercer; (vi) cualquier otro elemento o documento que facilite la localización de sus Datos Personales (tales como el lugar y la fecha en la que proporcionó sus Datos Personales, la relación que tiene con Springer México o el motivo por el cual proporcionó sus Datos Personales), y (vii) en el caso de rectificación de Datos Personales se deberán indicar las modificaciones a realizarse y aportar la documentación legal que acredite fehacientemente la petición.
PROCEDIMIENTO
Para tener por presentada su solicitud y con el fin de proteger los Datos Personales, en todos los casos de solicitud de ejercicio de derechos ARCO, se requiere que acredite su identidad personalmente cuando actúe en nombre propio o la personalidad de su representante o apoderado legal, en nuestras oficinas ubicadas en Insurgentes Sur No. 1886, Piso 10 Colonia Florida, Álvaro Obregón, C.P. 01030, Ciudad de México, de Lunes a Jueves, en un horario de 9:00 a 14:00 y de 15:30 a 17:00 horas, Viernes de 9:00 a 14:00 horas.
La solicitud se tendrá por recibida una vez acreditada la identidad o personalidad, mediante el Acuse de Presentación y será atendida dentro del plazo de 20 días permitido por la Ley. Le informaremos sobre la procedencia de la misma a través del correo electrónico o el medio que nos haya proporcionado para recibir notificaciones. En caso de requerir información adicional, la misma le será requerida dentro de un plazo de 5 días a partir de que su solicitud se tenga por presentada, es decir, una vez acreditada la identidad del titular o personalidad del representante. Tome en cuenta que la Ley prevé algunos casos en que los términos pueden ampliarse.
La identidad de los titulares se acredita mediante la presentación del original de una identificación oficial: credencial para votar, pasaporte o cédula profesional; para el caso de los extranjeros documento migratorio vigente; y la del representante con el original de su identificación oficial y el documento original o copia certificada del documento que lo acredite como representante. Los documentos originales serán devueltos una vez cotejados con la copia proporcionada.
El acceso a sus Datos Personales se le proporcionará en un formato impreso o electrónico, según sea aplicable a cada caso o en el medio que en su caso Springer México y usted acuerden.
4
IX. COOKIES Y WEB BEACONS.
Nuestro sitio de internet www.springer.com utiliza tecnologías de cookies y web beacons que combinados permiten obtener de manera automática y simultánea mientras usted navega en nuestro sitio, Datos Personales e información de su comportamiento o sus preferencias. Si usted desea restringir o eliminar las cookies y los web beacons de nuestros sitios, por favor elija la opción adecuada en la configuración de su navegador de Internet. La función de Ayuda le indicará cómo hacerlo. Por favor considere que no permitir o eliminar el uso de las cookies puede impedir que utilice nuestro sitio con todas sus funciones.
X. CONTACTO.
Para conocer más sobre cómo puede ejercer los derechos descritos o si tiene alguna duda sobre el procedimiento para ejercer dichos derechos o sobre cómo limitar el uso o divulgación de sus Datos Personales, por favor contacte a nuestro Encargado del Área de Protección de Datos Personales a través de los siguientes medios:
 Por correo electrónico a: privacidadmacmillan@grupomacmillan.com
 Por teléfono al: (+52) 55-54-82-2200 extensiones 2712, 2713, y 2714.
XI. MODIFICACIONES AL AVISO DE PRIVACIDAD.
Springer México puede modificar el presente Aviso de Privacidad. Dichas modificaciones estarán disponibles de forma física en las oficinas de Springer México.
Fecha de Actualización</p>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" id="js-aceptar-aviso">Acepto</button>
      </div>
    </div>
  </div>
</div>