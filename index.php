<?php
//setting error selection
error_reporting(E_ALL);  
ini_set('display_startup_errors', 1);  
ini_set('display_errors', 1); 
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),realpath(APPLICATION_PATH . '/models'), realpath(APPLICATION_PATH . '/helperProcessor')
    //get_include_path()
)));

// Define path to site root from server root
define('SITE_ROOT', str_replace('/index.php', '', $_SERVER['PHP_SELF']));
define('CSS_DIR', SITE_ROOT.'/public/resources/css');
define('IMAGES_DIR', SITE_ROOT.'/public/resources/images');
define('JS_DIR', SITE_ROOT.'/public/resources/js');


require_once "Zend/Loader/Autoloader.php"; 
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);


//define('PRODUCT_CONFIG',$productConfig);
//echo implode($productConfig['purchase_type']);
//$productConfig['purchase_type']=array('buy_now','customize');
//echo get_include_path();

$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/settings.ini', 'development');


$logger = new Zend_Log(new Zend_Log_Writer_Null());

/*try{*/

	$writer=new EmailLogger('vedancewear@gmail.com');
	$writer->addFilter(new Zend_Log_Filter_Priority(Zend_Log::WARN));
	$logger->addWriter($writer);

//create the applicatin logger
$logger->addWriter( new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/debug.log'));

$writer->setEmail($config->loggin->email);
	$writer->addFilter(new Zend_Log_Filter_Priority(Zend_Log::CRIT));
	$logger->addWriter($writer);

Zend_Registry::set('logger', $logger);

//$logger->crit('test message');

$orderLog = new Zend_log(new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/order.log'));
Zend_Registry::set('orderLog', $orderLog);
	
/** Zend_Application */
//require_once 'Zend/Application.php';

// Create application, bootstrap, and run


//set the settings in registry as config
Zend_Registry::set('config', $config);

//configure database stuff given from the setttings.ini
$params = array('host'     => 'localhost',
				'username' => 'root',
				'password' => 'V1NCENTIOU$$',
				'dbname'   => 'dancerialto');

// get database variables from local configuration file (specific to local testing environment)
$localConfigFile = 'local_settings.ini';
if(file_exists(APPLICATION_PATH.'/configs/'.$localConfigFile)) {
	$localConfig = new Zend_Config_Ini(APPLICATION_PATH.'/configs/'.$localConfigFile, 'development');
	$params = array_merge($params, $localConfig->db->toArray());	
}


//I guess combining the type of sql with the informatin in params
$db = Zend_Db::factory("pdo_mysql", $params);

$db->getConnection();
//echo "you have good db!";

//setting the information in $db as db statically I think. 
Zend_Registry::set('db', $db);


$auth = Zend_Auth::getInstance();
$auth->setStorage(new Zend_Auth_Storage_Session());

$controller=Zend_Controller_Front::getInstance();

$controller->throwExceptions(true); 

$controller->setControllerDirectory(APPLICATION_PATH.'/controllers');

//storing the $auth object in the application registry suing Zend_Reistry. 
$controller->registerPlugin(new CustomControllerAclManager($auth));


//setup the view renderer
$vr = new Zend_Controller_Action_Helper_ViewRenderer();
$vr->setView(new Templater());
$vr->setViewSuffix('tpl');
Zend_Controller_Action_HelperBroker::addHelper($vr);
 

$controller->dispatch();
/*} catch(Exception $ex){

	$logger->emerg($ex->getMessage());
	
	echo $ex->getMessage();
	header('location: /staticError.html'); 
	exit;

}*/
?>