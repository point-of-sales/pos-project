<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

const PATH_SEPARATOR = '/';

return array(
    'behaviors'=>array(
        'onBeginRequest'=>array(
            'class'=>'application.components.CPOSRequireLogin',
        )
    ),

	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Point Of Sales System',
    'theme'=>'asia',
    'language'=>'vi',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.quanlyphanquyen.*',
        'application.modules.quanlyphanquyen.components.*',
        'ext.phpexcel.Classes.PHPExcel',
        'ext.giix-components.*', // giix components
        'ext.eexcelview.*',
        'ext.ebreadcrumbs.*',
        'ext.custom-validator.*',
        'ext.custom-widgets.*'    //custom widgets


	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths' => array(
                                'ext.giix-core', // giix generators
                        ),
		),

        'defaultController'=>'site',

        'quanlychinhanh'=>array(
            'defaultController'=>'danhsach',
        ),

        'quanlynhanvien'=>array(
            'defaultController'=>'danhsach',
        ),
        
        'quanlybanhang'=>array(
            'defaultController'=>'danhsach',
        ),

        'quanlysanpham'=>array(
            'defaultController'=>'danhsach',
        ),

        'quanlynhacungcap'=>array(
            'defaultController'=>'danhsach',
        ),

        'quanlykhachhang'=>array(
            'defaultController'=>'danhsach',
        ),
        
        'quanlykhachhang'=>array(
            'defaultController'=>'danhsach',
        ),

        'quanlynhapxuat'=>array(
            'defaultController'=>'danhsach',
        ),
        'quanlykhuyenmai'=>array(
            'defaultController'=>'danhsach',
        ),
        'quanlybaocao'=>array(
            'defaultController'=>'baocao',
        ),
        'quanlyphanquyen'=>array(
            'superuserName'=>'QuanLyHeThong', // Name of the role with super user privileges.
            'authenticatedName'=>'Authenticated', // Name of the authenticated user role.
            'userClass'=>'NhanVien',
            'userIdColumn'=>'id', // Name of the user id column in the database.
            'userNameColumn'=>'ma_nhan_vien', // Name of the user name column in the database.
            'enableBizRule'=>true, // Whether to enable authorization item business rules.
            'enableBizRuleData'=>false, // Whether to enable data for business rules.
            'displayDescription'=>true, // Whether to use item description instead of name.
            'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
            'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.
            'install'=>true, // Whether to install rights.
            'baseUrl'=>'/quanlyphanquyen', // Base URL for Rights. Change if module is nested.
            'layout'=>'/quanlyphanquyen.views.layouts.main', // Layout to use for displaying Rights.
            'appLayout'=>'webroot.themes.asia.views.layouts.main', // Application layout.
            'cssFile'=>'rights.css', // Style sheet file to use for Rights.
            'debug'=>false, // Whether to enable debug mode.
        ),

        'quanlycauhinh'=>array(

        ),
                    
	),


	// application components
	'components'=>array(
        /*'session'=>array(

        ),*/
        'CPOSSessionManager'=>array(
            'class'=>'CPOSSessionManager',
            'autoStart'=>true,
        ),



		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'class'=>'RWebUser',
            'autoUpdateFlash' => false, // add this line to disable the flash counter

        ),
        'authManager'=>array(
            'class'=>'RDbAuthManager',
        ),
        // Yii Booster config
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
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
	
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=pos_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',

            'enableProfiling'=>true,   // config to show log database
            'enableParamLogging'=>true,
        ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        /*
		'log'=>array(

			'class'=>'CLogRouter',
			'routes'=>array(
            
				array(
                    'class'=>'CWebLogRoute',
					//'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
					'levels'=>'error, warning',

					//'levels'=>'error, warning',
				),
                
				// uncomment the following to show log messages on web pages

				/*array(
                    'class'=>'CWebLogRoute',
                    'categories'=>'system.db.CDbCommand',
                    'showInFireBug'=>true,
				),

			),
		),*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',

	),


);