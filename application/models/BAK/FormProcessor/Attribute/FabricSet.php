<?php



	class FormProcessor_Attribute_FabricSet extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		
		public $fabricSet;
		public $fabricSetParam;
		public $fabricSetName;
		public $fabricSetKey;
		public $userID;
		public $db;
		public $currentFabricSetId;
		public $attributeID;
		
		public function __construct($db, $userID)
		{
			parent::__construct();
			$this->db=$db;
			$this->fabricSet = new DatabaseObject_Attribute_FabricSet($db);
			$this->userID=$userID;
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{

			$this->fabricSetParam = $request->getParam('fabricSet');
			Zend_Debug::dump($this->fabricSetParam);
			Zend_Debug::dump($_FILES['fabricSetImage']);
			
			foreach($this->fabricSetParam as $k=>$v){
				$this->fabricSetName[]=$k;			
			}
			Zend_Debug::dump($this->fabricSetName[0]);
			foreach($this->fabricSetParam[$this->fabricSetName[0]]['name'] as $k=>$v){
				$this->fabricSetKey[]=$k;
			}
			
			Zend_Debug::dump($this->fabricSetKey);
			
			$this->fabricSet->name_of_set = $this->fabricSetName[0];
			$this->fabricSet->uploader_id = $this->userID;
			
			if(!DatabaseObject_Helper_ProductListing::confirmattributenamewithuploader($this->db, 'fabric_set', $this->userID, $this->fabricSetName[0])){
				$this->fabricSet->save();
				$this->attributeID=$this->fabricSet->getId();
				echo 'here at no error';
				return true;
			}else{
				echo 'here at errors';
				$this->addError('duplicate', 'this is a duplicate');
				return !$this->hasError();
			}
			//return true if no errors have occurred
		}
		
	}
?>		