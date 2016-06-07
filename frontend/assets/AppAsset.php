<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

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
      'css/site.css',
      'css/index.css',
      'css/master.css',
      'css/claims.css',
      'css/quotes.css',
      'css/policies.css',
      'css/quotation.css',
      'css/jquery.growl.css',
      'css/jquery.loading.css',
      'css/jquery.datetimepicker.css',
    ];
    public $js = [
      'scripts/master.js',
      'scripts/signin.js',
      'scripts/signup.js',
      'scripts/sha512.js',
      'scripts/quotation.js',
      'scripts/jquery.growl.js',
      'scripts/jquery.loading.js',
      'scripts/jquery.datetimepicker.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
