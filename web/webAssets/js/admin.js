/**
 * 
 */
$(document).ready(function(){
	
	$('.ver-modulo-completos').on('click', function(e){

	    e.preventDefault();/*quitar habilidad*/
	    var loader =$("#contenedor-loader").html();
	    $('#contenedor-modulos-completos').html(loader);//muestra el cargador
	    $("#modal-modulos-completos").modal('show');//muestra la barra para mostrar la información directamente de la misma pagina
	   /* alert("Esta es una Alerta");*/
	    console.log("depurando");
	    
 /*metodo JQuery*/
	    /*imprime el id del usuario*/
	    var elemento = $(this);//almacenar elemento
	    var idUsuario = $(this).data('usuario');
	    
	    /*peticion ajax*/
	    $.ajax({
	    	url:'modulos-completados',
	    	data:{u:idUsuario},
	    	success:function(respuesta){
	    		$('#contenedor-modulos-completos').html(respuesta);
	    	}
	    })
	
	    
    });//fin del query ver-modulos-completos
	
	

	$('.ver-modulo-incompletos').on('click', function(e){
		
	
		e.preventDefault();
		var loader =$("#contenedor-loader").html();
		$('#contenedor-modulos-incompletos').html(loader);
		$("#modal-modulos-incompletos").modal('show');
		
		var elemento = $(this);
		var idUsuario = $(this).data('usuario');
		
		$.ajax({
			url:'modulos-incompletados',
			data:{i:idUsuario},
			success:function(respuesta){
				$('#contenedor-modulos-incompletos').html(respuesta);
			}
		})
		
		
	   });

	
 });


