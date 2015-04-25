<?php

// change the following paths if necessary
$yii = dirname(__FILE__).'/../../vendor/yiisoft/yii/framework/yiilite.php';
$config = dirname(__FILE__).'/../../protected/config/main.php';

// register composer autoloader
require_once(dirname(__FILE__).'/../../vendor/autoload.php');
require_once($yii);

Yii::import('system.test.*');

require_once(dirname(__FILE__).'/MongoFixtures.php');
require_once(dirname(__FILE__).'/MongoTestCase.php');

Yii::createWebApplication($config);

