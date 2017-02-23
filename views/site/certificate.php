<?php 
$this->title = 'ASCO-SEP 5th Edition Online Self-assessment';
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
				
				<h2>Certificate for <?=Yii::$app->user->identity->txt_username?> <?=Yii::$app->user->identity->txt_apellido_paterno?></h2>
				<button class="btn btn-success">Print</button>
				</div>
			</div>
		</div>
	</div>
</div>