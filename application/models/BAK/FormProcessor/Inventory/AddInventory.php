<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Inventory_AddInventory extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $inventoryProduct = null;
		protected $_validateOnly = false;
		public $user;
		
		public function __construct($db, $userID)
		{
			parent::__construct();
			$this->db= $db;
			$this->inventoryProduct = new DatabaseObject_Inventory_Product($db);
			$this->userID = $userID;
			
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			//$this->product_id = $request->getPost('id');
			foreach($request->getPost() as $key=>$value){
				echo 'key: '.$key.' value: '.$value.'<br/>';
				$v = $this->sanitize($value);
				
				if(substr($key,0,4)=='sys_' && $key!='generalImages' && $key!='id'){
					$this->$key = $v;
					$this->inventoryProduct->$key = $v;
				}elseif($key!='generalImages' && $key!='id'){
					$this->inventoryProduct->profile->$key = $v;
				}else{
					$this->$key=$value;
				}
			}
			
			$this->inventoryProduct->product_id = $request->getPost('id');
			$this->inventoryProduct->uploader_id = $this->userID;
						
			if(!$this->_validateOnly && !$this->hasError())
			{
				$this->inventoryProduct->save();
			}
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		