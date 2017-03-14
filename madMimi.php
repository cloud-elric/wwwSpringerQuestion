<?php
require('MadMimi.class.php');
$mimi = new MadMimi('humberto@2gom.com.mx', 'eadc1b012973cd02f1b38722f9839baa');
$options = array(
		'promotion_name' => 'Test Promotion',
		'recipients' => 'Nicholas Young <humberto@2gom.com.mx>',
		'subject' => 'Testing the Mailer API',
		'from' => 'Humberto antonio <humberto@2gom.com.mx>'
);
$html_body = "<html><head><title>My title</title></head>
<body>Body content[[tracking_beacon]]</body></html>";
$mimi->SendHTML($options, $html_body);