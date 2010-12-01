<?php

// setup
	$siteURL = 'http://173.203.121.190';


// show php errors
error_reporting(E_ALL);  
ini_set('display_startup_errors', 1);  
ini_set('display_errors', 1); 

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/models'),
    realpath(APPLICATION_PATH . '/helperProcessor'),
    get_include_path(),
)));

// define additional paths
define('SITE_URL', $siteURL);
define('SITE_ROOT', substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')));
define('CSS_DIR', SITE_ROOT.'/css');
define('IMAGES_DIR', SITE_ROOT.'/images');
define('JS_DIR', SITE_ROOT.'/js');


/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    array('config'=>array(APPLICATION_PATH.'/configs/application.ini', APPLICATION_PATH.'/configs/local_settings.ini'))
);
    
$application->bootstrap()
            ->run();