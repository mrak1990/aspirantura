<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    'language' => 'ru',
    'preload' => array(
        'log',
        'bootstrap',
    ),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.cr0t-yiidebugtb-6ae144b.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'qwerty',
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii', // since 0.9.1
            ),
        ),
    ),
    'components' => array(
        'clientScript' => array(
            'class' => 'ext.NLSClientScript',
            'excludePattern' => '/\.tpl/i',
        ),
        'user' => array(
            'allowAutoLogin' => true,
        ),
        'db' => array(
            'connectionString' => 'pgsql:host=127.0.0.1;port=5433;dbname=aspirantura',
            'emulatePrepare' => false,
            'username' => 'aspirantura',
            'password' => 'aspirantura',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
//            'nullConversion' => PDO::NULL_EMPTY_STRING,
        ),
        'authManager' => array(
            'class' => 'MyDbAuthManager',
            'connectionID' => 'db',
            'userTable' => 'user',
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
//                array(
//                    'class' => 'CFileLogRoute',
//                    'levels' => 'error, warning',
//                ),
//                array(
//                    'class' => 'CFileLogRoute',
//                    'logFile' => 'test1.log',
//                    'categories' => 'cat1',
//                ),
                array(
                    'class' => 'CWebLogRoute',
                ),
                array(
                    'class' => 'CProfileLogRoute',
                    'levels' => 'profile',
                    'enabled' => true,
                ),
//                array(// configuration for the toolbar
//                    'class' => 'XWebDebugRouter',
//                    'config' => 'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
//                    'levels' => 'error, warning, trace, profile, info',
//                    'allowedIPs' => array('127.0.0.1', '::1', '192.168.1.54', '192\.168\.1[0-5]\.[0-9]{3}'),
//                ),
                array(
                    'class' => 'ext.shiki-yii-firephp.SFirePHPLogRoute',
//                    'levels' => 'info',
//                    'levels' => 'error, warning, info, trace',
                    'levels' => 'error, warning, info',
                ),
                // profile log route
//                array(
//                    'class' => 'ext.shiki-yii-firephp.SFirePHPProfileLogRoute',
//                    'report' => 'summary' // or "callstack"
//                ),
            ),
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'BootPager' => array(
                    'nextPageLabel' => 'Следующая &rarr;',
                    'prevPageLabel' => '&larr; Предыдущая',
//                    'maxButtonCount' => 5,
//                    'cssFile' => false,
                ),
                'CJuiDatePicker' => array(
                    'language' => 'ru',
                    'options' => array(
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                ),
            ),
        ),
    ),
// application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => array(
        'adminEmail' => 'webmaster@example.com',
        'auth' => array('spoilerMax' => 3),
    ),
);