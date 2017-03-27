<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
			
			
<?php
foreach ( $modulosUsuarios as $moduloUsuarios ) {
	?>

<div class="row">
					<div class="col-md-6">
						<?=$moduloUsuarios->txt_nombre; ?>
					</div>
					<div class="col-md-6">
					    <?=$moduloUsuarios->num_puntuacion_usuario; ?>
					</div>

<?php } ?>

</div>


			</div>
		</div>
	</div>
</div>