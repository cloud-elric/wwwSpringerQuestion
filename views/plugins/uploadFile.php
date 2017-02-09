<?php
$this->registerJsFile ( '@web/webAssets/plugins/uploadFile/uploadFile.js', [ 
		'depends' => [ 
				\app\assets\AppAsset::className () 
		] 
] );

$this->registerJsFile ( '@web/webAssets/plugins/uploadFile/test.js', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

?>

<input type="file" id="test-image"/>