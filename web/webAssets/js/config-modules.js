$(document).ready(function(){
	var minScore = 15;
	
	$("#js-instrucciones").html('<strong>- The minimum amount of certification points required for the certificate should be greater than or equal to '+ minScore +' points</strong>');
	
	$("#btn-siguinte").on('click', function(e){
		e.preventDefault();
		
		var l = Ladda.create(this);
	 	l.start();
	 	
	 	var scoreSelected = 0;
		$('input:checked').each(function(index){
			scoreSelected+= $(this).data('score');
		});
		
	 	
//	 	if($('input:checked').length > 0 ){
//	 		$('form').submit();
//	 	}else{
//	 		swal('Wait', 'You need to select at least one option.', 'warning');
//	 	}
	 	if(scoreSelected>=minScore){
	 		$('form').submit();
	 	}else{
	 		swal('Wait', 'The total of the minimum score must be greater than or equal to '+minScore, 'warning');
	 	}
	 	
	 	l.stop();
	 	
	});
});

var numScore = 0;
$('.js_checkbox_modulos').on('click', function(){
	if($(this).is(':checked')){
		numScore += $(this).data('score');
		toastr["info"]("Min score: 15", "Selected: "+numScore);
	}else{
		numScore -= $(this).data('score');
		toastr["info"]("Min score: 15", "Selected: "+numScore);
	}
	console.log(numScore);
	
	if(numScore >= 15){
		$(':input[type="submit"]').prop('disabled', false);
		toastr["success"]("Puedes seguir", "Score minino completado");
	}else{
		$(':input[type="submit"]').prop('disabled', true);
	}
});
