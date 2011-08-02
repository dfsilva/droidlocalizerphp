<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Droid Localizer',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456'
		),
		
	),
	
	'language'=>'pt',

	// application components
	'components'=>array(
	 	'coreMessages'=>array(
            'basePath'=>'protected/messages',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		// desenv
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=android_localizer_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		//producao
/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=diegosil_localizer',
			'emulatePrepare' => true,
			'username' => 'diegosil_diego',
			'password' => 'SD@mtzadM',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace, info, error, warning',
					'logFile' =>'android_localizer.log'
				),
				/*array(
                    'class'=>'CEmailLogRoute',
                    'levels'=>'error, warning',
                    'emails'=>'diego@diegosilva.com.br',
                ),*/
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		
		'mail' => array(
                'class' => 'application.extensions.yii-mail.YiiMail',
                'transportType' => 'smtp',
                'transportOptions' => array(
                    'host' => 'mail.diegosilva.com.br',
                    'username' => 'falecon@droidlocalizer.diegosilva.com.br',
                    'password' => 'SD@mtzadM',      
					//'port'=>'25',
            		//'encryption'=>'ssl',             
                ),
                'viewPath' => 'application.views.mail',
                'logging' => true,
                'dryRun' => false
         ),
	),

	// application-level parameters that can be accessed
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'diego@diegosilva.com.br',
	),
);