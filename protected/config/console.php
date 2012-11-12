<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    // application components
    'import' => array(
        'application.models.*',
        'application.components.*',
        'components' => array(
            'db' => array(
                'connectionString' => 'pgsql:host=127.0.0.1;port=5433;dbname=aspirantura',
                'emulatePrepare' => false,
                'username' => 'aspirantura',
                'password' => 'aspirantura',
                'charset' => 'utf8',
//            'enableProfiling' => true,
//            'enableParamLogging' => true,
//            'nullConversion' => PDO::NULL_EMPTY_STRING,
            ),
            // uncomment the following to use a MySQL database
            /*
            'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=testdrive',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ),
            */
        ),
    );