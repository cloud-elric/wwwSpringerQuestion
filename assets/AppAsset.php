<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //css/site.css',
    	'css/site.min.css',
        'webAssets/css/site.css',
    	'webAssets/plugins/ladda-bootstrap/dist/ladda-themeless.min.css',
    	'webAssets/css/sweetalert.css',
    	'//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
    ];
    public $js = [
    	'webAssets/plugins/ladda-bootstrap/dist/spin.min.js',
    	'webAssets/plugins/ladda-bootstrap/dist/ladda.min.js',
    	'webAssets/js/sweetalert.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
