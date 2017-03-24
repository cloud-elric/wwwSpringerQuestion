<div class="row">
	<div class="col-md-6 colo-md-offset-3">
		<div class="panel">
			<div class="panel-body">

<?php
  foreach($modulosUsuarios as $moduloUsuarios){ ?>


            <div class="row">
                     <div class="col-md-12">
                         <?=$moduloUsuarios->idModulo->txt_nombre; ?>
                     </div>

<?php  } ?>

             </div>
       </div>
    </div>
  </div>
</div>






