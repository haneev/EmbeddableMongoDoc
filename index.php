<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/vendor/yiisoft/yii/framework/yiilite.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// register composer autoloader
$loader = require_once(dirname(__FILE__).'/vendor/autoload.php');

defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once($yii);

Yii::$classMap = $loader->getClassMap();
Yii::createWebApplication($config)->run();
