<?php 
use app\models\ContactUs;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
?>

 <style>
.container-contact-us {
	position: fixed;
	bottom: 0;
}

.modal form {
	margin: 0 auto;
}
</style>
	<div class="col-md-3 col-md-offset-9 container-contact-us">
		<button class="btn btn-default btn-block" data-toggle="modal"
			data-target="#contact-us-modal">Contact us</button>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="contact-us-modal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Contact us</h4>
				</div>
					<?php
					$contact = new ContactUs ();
					$form = ActiveForm::begin ( [ 
							'id' => 'form-contact-us' 
					] );
					?>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">



							<div class="form-group">
      <?=$form->field($contact, 'email')->textInput(['class'=>'form-control'])?>
      </div>
							<div class="form-group">
      <?=$form->field($contact, 'description')->textarea(['class'=>'form-control'])->label('Have a problem ? Briefly describe the issue and we’ll get to you soon.')?>
      </div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="js-submit-contact-us" type="submit" class="btn btn-primary js-send-contact-us ladda-button" data-style='zoom-in'><span class="ladda-label">Contact us</span></button>
				</div>
				  <?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
	 