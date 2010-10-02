<?php



	class FormProcessor_Attribute_CustomAttribute extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		
		public $fabricSet;
		public $customSetParam;
		public $customSetName;
		public $customSetKey;
		public $userID;
		public $db;
		public $currentCustomSetId;
		public $attributeID;
		public $table;
		public $paramSet;
		
		/*table is the table of the attribute
		 * in this case, the table can either be fabric_set or custom_attribute
		 */
		public function __construct($db, $table, $userID)
		{
			parent::__construct();
			$this->db=$db;
			$this->customSet = new DatabaseObject_Attribute_CustomAttribute($db, $table);
			$this->userID=$userID;
			$this->table = $table;
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		public function load($id){
			if($this->customSet->load($id)){
				return true;
			}else{
				return false;
			}
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{

			$this->customSetParam = $request->getParam('attributeSet');
			//Zend_Debug::dump($this->customSetParam);
			//Zend_Debug::dump($_FILES['customAttributeDetailImage']);
			
			foreach($this->customSetParam as $k=>$v){
				$this->customSetName[]=$k;			
			}
			Zend_Debug::dump($this->customSetName[0]);
			foreach($this->customSetParam[$this->customSetName[0]]['name'] as $k=>$v){
				$this->customSetKey[]=$k;
			}
			
			Zend_Debug::dump($this->customSetKey);
			
			$this->customSet->name_of_set = $this->customSetName[0];
			$this->customSet->uploader_id = $this->userID;
			
			//echo $this->table;
			//echo $this->userID;
			//echo $this->customSetName[0];
			if(!DatabaseObject_Helper_ManageAttribute::confirmattributenamewithuploader($this->db, $this->table, $this->userID, $this->customSetName[0])){
				$this->customSet->save();
				$this->attributeID=$this->customSet->getId();
				//echo 'here at no error';
				return true;
			}else{
				//echo 'here at errors';
				echo 'duplicate, there is an error';
				$this->addError('duplicate', 'this is a duplicate');
				return !$this->hasError();
			}
			//return true if no errors have occurred
		}
		
	}
?>		