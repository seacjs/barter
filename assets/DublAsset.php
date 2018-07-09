<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DublAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/bootstrap.min.css',
//        'css/normalize.css',
//        'css/font-awesome.min.css',
//        'css/icomoon.css',
//        'css/transitions.css',
//        'css/flags.css',
//        'css/owl.carousel.css',
//        'css/prettyPhoto.css',
//        'css/jquery-ui.css',
//        'css/scrollbar.css',
//        'css/chartist.css',
//        'css/main.css',
//        'css/color.css',
//        'css/responsive.css',
    ];
    public $js = [
//        'js/vendor/modernizr-2.8.3-respond-1.4.2.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
