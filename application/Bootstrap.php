<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	// initialize autoloading
	public function _initAutoload() {
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->setFallbackAutoloader(true);
	}
	
	// let Zend handle the sessions for all requests
	public function _initSession() {
		Zend_Session::start();
	}
	
	protected function _initPaths()
	{	
		// get stuff from .ini files
			$config = new Zend_Config($this->getOptions());
			
		// define global constants
			define('SITE_ROOT', substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')));
			
			define('SITE_URL', $config->paths->siteURL);
			define('CSS_DIR', SITE_ROOT.$config->paths->public->cssDir);
			define('IMAGES_DIR', SITE_ROOT.$config->paths->public->imagesDir);
			define('JS_DIR', SITE_ROOT.$config->paths->public->jsDir);
			define('USERDATA_DIR', SITE_ROOT.$config->paths->public->userdataDir);
			define('DEFAULT_LAYOUT', $config->layouts->default);
			define('POPUP_LAYOUT', $config->layouts->popup);
	}
	
	// An external library for connecting Smarty to Zend
	public function _initNaneau() {
		/** Naneau_View_Smarty */
		require_once 'Naneau/View/Smarty.php';
		
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView(new Naneau_View_Smarty(array(
		'compileDir' => APPLICATION_PATH.'/../tmp/templates_c')
		));
		
		$viewRenderer->setViewSuffix('tpl'); //make it search for .tpl files 
		
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer); //add it to the action helper broker	
		
	}
	
	public function _initRoutes(){
		$controller=Zend_Controller_Front::getInstance();
		
		
		//store routes
		$route = new Zend_Controller_Router_Route('store/profile/:storeName/*', array('controller'=>'store', 'action'=>'profile'));
		$controller->getRouter()->addRoute('storeProfile', $route);
		
		//productlisting routes
		$route = new Zend_Controller_Router_Route('productlisting/uploadbuynowproduct/store/:storeName/*', array('controller'=>'productlisting', 'action'=>'uploadbuynowproduct'));
		$controller->getRouter()->addRoute('uploadbuynowfromstore', $route);
		
		$route = new Zend_Controller_Router_Route('productlisting/uploadbuynowproduct/member', array('controller'=>'productlisting', 'action'=>'uploadbuynowproduct'));
		$controller->getRouter()->addRoute('uploadbuynowfrommember', $route);
		
		$route = new Zend_Controller_Router_Route('productlisting/editbuynowproduct/store/:storeName/*', array('controller'=>'productlisting', 'action'=>'editbuynowproduct'));
		$controller->getRouter()->addRoute('editbuynowfromstore', $route);
		
		$route = new Zend_Controller_Router_Route('productlisting/editbuynowproduct/member/*', array('controller'=>'productlisting', 'action'=>'editbuynowproduct'));
		$controller->getRouter()->addRoute('editbuynowfrommember', $route);
		
		
		
		
		
		//$route = new Zend_Controller_Router_Route('productlisting/:sellertype/*', array('controller'=>'productlisting', 'action'=>'index'));
		//$controller->getRouter()->addRoute('memberproductlisting', $route);
		
		
		//$controller->getRouter()->addRoute('productlisting', $route);
	}
	// Vincent's stuff
	public function _initAll() {
		
		//setting db in the registry making it a static constant object.
		
		//define('PRODUCT_CONFIG',$productConfig);
		//echo implode($productConfig['purchase_type']);
		//$productConfig['purchase_type']=array('buy_now','customize');
		//echo get_include_path();
		
		//$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/settings.ini', 'development');
		
		
		//$logger = new Zend_Log(new Zend_Log_Writer_Null());
		
		/*try{*/
		
//			$writer=new EmailLogger('vedancewear@gmail.com');
//			$writer->addFilter(new Zend_Log_Filter_Priority(Zend_Log::WARN));
//			$logger->addWriter($writer);
		
		//create the applicatin logger
//		$logger->addWriter( new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/debug.log'));
//		
//		$writer->setEmail($config->loggin->email);
//			$writer->addFilter(new Zend_Log_Filter_Priority(Zend_Log::CRIT));
//			$logger->addWriter($writer);
		
//		Zend_Registry::set('logger', $logger);
		
		//$logger->crit('test message');
		
//		$orderLog = new Zend_log(new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/order.log'));
//		Zend_Registry::set('orderLog', $orderLog);
			
		/** Zend_Application */
		//require_once 'Zend/Application.php';
		
		// Create application, bootstrap, and run
		
		
		//set the settings in registry as config
		//Zend_Registry::set('config', $config);
		
		//configure database stuff given from the setttings.ini
//		$params = array('host'     => 'localhost',
//						'username' => 'root',
//						'password' => 'V1NCENTIOU$$',
//						'dbname'   => 'dancerialto');
//		
		// get database variables from local configuration file (specific to local testing environment)
//		$localConfigFile = 'local_settings.ini';
//		if(file_exists(APPLICATION_PATH.'/configs/'.$localConfigFile)) {
//			$localConfig = new Zend_Config_Ini(APPLICATION_PATH.'/configs/'.$localConfigFile, 'development');
//			$params = array_merge($params, $localConfig->db->toArray());	
//		}
		
		
		//I guess combining the type of sql with the informatin in params
		//$db = Zend_Db::factory("pdo_mysql", $params);
		
		//$db->getConnection();
		//echo "you have good db!";
		
		//setting the information in $db as db statically I think. 
		//Zend_Registry::set('db', $db);
		
		
//		$auth = Zend_Auth::getInstance();
//		$auth->setStorage(new Zend_Auth_Storage_Session());
//		
//		$controller=Zend_Controller_Front::getInstance();
//		
//		$controller->throwExceptions(true); 
//		
//		$controller->setControllerDirectory(APPLICATION_PATH.'/controllers');
		
		//storing the $auth object in the application registry suing Zend_Reistry. 
//		$controller->registerPlugin(new CustomControllerAclManager($auth));
		
		
		//setup the view renderer
//		$vr = new Zend_Controller_Action_Helper_ViewRenderer();
//		$vr->setView(new Templater());
//		$vr->setViewSuffix('tpl');
//		Zend_Controller_Action_HelperBroker::addHelper($vr);
		 
		
		//$controller->dispatch();
		/*} catch(Exception $ex){
		
			$logger->emerg($ex->getMessage());
			
			echo $ex->getMessage();
			header('location: /staticError.html'); 
			exit;
		
		}*/

	}

}

