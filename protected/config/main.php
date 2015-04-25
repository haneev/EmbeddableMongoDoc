<?php
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yii relational mongodb',
    
    'preload' => array('log'),
    
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'components' => array(
        'mongodb' => array(
            'class' => 'EMongoClient',
            'server' => 'mongodb://127.0.0.1:27017',
            'db' => 'relational',
            'options' => array(
                'username' => 'relational',
                'password' => 'relational'
            ),
            'enableProfiling' => true
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
        ),
        
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CWebLogRoute',
                    'levels'=>'trace, debug, error, info'
                ),
                array(
                    'class'=>'CProfileLogRoute'
                )
            ),
        )
    ),
);
