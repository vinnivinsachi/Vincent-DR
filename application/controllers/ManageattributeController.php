<?php
	/*Manage attribute controller 
	********/
	
	class ManageattributeController extends CustomControllerAction
	{
		
		
		public function init()
		{
			parent::init();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->breadcrumbs->addStep('Manage product attributes', $this->getUrl(null, 'productlisting'));
		}
		
		public function preDispatch(){
			parent::preDispatch();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->request = $this->getRequest();
			//must have id and product type. otherwise redirect!XXXXXXXXXXXXXXXXXXXXXxx
			
		}
	
		public function indexAction()
		{
		}
		
		public function editproductattributeAction(){
			//assigning default product attriutes like shoes selections
			//composite color attriubutes and custome attributes.
			$param['product_id'] = $this->request->getParam('id');
			if($param['product_id']==''){
				$param['product_id']=0;
			}
			$measurement=array();
			$i=0;
			while($i<50){
				$measurement[]=$i;
				$i++;
			}
			
			$allowedProduct=DatabaseObject_Helper_ProductListing::confirmproductforuploader($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $param['product_id']);
			
			Zend_Debug::dump($allowedProduct);
			if(count($allowedProduct)==1 && $allowedProduct[0]['purchase_type']=='Customizable'){
								
				$fp = new FormProcessor_ProductAttribute($this->db, $this->signedInUserSessionInfoHolder->generalInfo, $allowedProduct[0]);
				
				foreach($this->productConfig['custom_attribute_detail_table'] as $k=>$v){
					echo $v;
					$fp->$v = DatabaseObject_Helper_ManageAttribute::retrieveAvailableAttributeForUser($this->db,$v,$this->signedInUserSessionInfoHolder->generalInfo->userID);
					//Zend_Debug::dump($fp);
				}
				
				if($this->request->isPost()){
					echo 'here at post<br />';
					if($fp->process($this->request)){
					}
				}
				
				if($allowedProduct[0]['inventory_attribute_table']=='shoes'){
					
				}
				
				$fp->existingFabricSet = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, 'fabric_set', $param['product_id']);
				//Zend_Debug::dump($fp->existingFabricSet);
				$fp->existingAttributeSet = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, 'custom_attribute', $param['product_id']);
				
				$fp->systemColorAndShoesAttributes = DatabaseObject_Helper_ManageAttribute::retrieveProductColorAndShoeAttribute($this->db, $allowedProduct[0]['inventory_attribute_table'], $param['product_id']);
				Zend_Debug::dump($fp->systemColorAndShoesAttributes);
				
				$this->view->product = $allowedProduct;
				$this->view->attributePartial='_'.$allowedProduct[0]['inventory_attribute_table'].'Attribute.tpl';
				$this->view->measurement=$measurement;
				//$this->view->systemColors=$this->productConfig['attribute_categories_details']['color'];
				$this->view->fp = $fp;
				$this->view->productID=$param['product_id'];
				//$this->view->inventory_attribute_table = $allowedProduct[0]['inventory_attribute_table'];
			}else{
				$this->messenger->addMessage("We are sorry, but this product's attribute can not be edited because it is a 'BUY NOW' product");
				$this->_redirect('index/error');
			}
		}
		
		//upload custom attributes and color attributes
		public function uploadattributeAction(){
			//action= 1 = new //action= 2 = add //action= 3 = delete //action= 0 =view
			$action = $this->request->getParam('actioncall');
			//echo 'action is '.$action;
			if(!isset($action)||($action<0)&&($action>3)||!is_numeric($action)){
				echo 'invalid action';
				//invalid action.
			}elseif ($action==1){
				//1 new.
				//need the action, paramSet
				echo 'action 1';
				$table =$this->request->getParam('paramSet');
				$table_details=$table.'_details';
				
				//$paramSet = 'fabricSet';
				Zend_Debug::dump($_FILES);
			
				//addition of new attributes. 
				$fp = new FormProcessor_Attribute_CustomAttribute($this->db, $table, $this->signedInUserSessionInfoHolder->generalInfo->userID);
				if($this->request->isPost()){
					echo 'here at post<br />';
					if($fp->process($this->request)){
						echo 'it is processed';
						Zend_Debug::dump($_FILES);
						//Zend_Debug::dump($v);
						//echo 'product name is: '.$fp->product->name;
						echo 'the name of customeSetName is: '.$fp->customSetName[0];
						DatabaseObject_Helper_ImageUpload::uploadAttributeImage($_FILES['customAttributeDetailImage'], $fp->customSetParam, $this->db, $table_details, $fp->customSetName[0], $fp->attributeID, $this->signedInUserSessionInfoHolder->generalInfo->username);
						//redirect back to product listing/where they came from. 
						//$this->_redirect("/manageattribute/uploadattribute?actioncall=0&paramSet=$table&id=$fp->attributeID");
						$this->messenger->addMessage('Attribute set has been added');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}else{
						echo "it is not processed."; 
						$this->messenger->addMessage('it is not processed, there is a duplicate');
						$this->_redirect($_SERVER['HTTP_REFERER']);
						//add message and redirect back to product listing where they came from. 
					}
				}	
			}elseif ($action==2){
				//add
				//need id of attribute_table
				//need the paramSet
				$id =$this->request->getParam('id');
				if(isset($id)||(($id>0)&&is_numeric($id))){
					//load attribute
					$table = $this->request->getParam('paramSet');
					$table_details = $table.'_details';
					//check fabric id is valid
					$fabricSet = DatabaseObject_Helper_ManageAttribute::confirmattributeidwithuploader($this->db, $table, $this->signedInUserSessionInfoHolder->generalInfo->userID, $id);
					if(count($fabricSet)==1){
						$fp = new FormProcessor_Attribute_CustomAttribute($this->db, $table, $this->signedInUserSessionInfoHolder->generalInfo->userID);
						//load load id for attributeSet
						if($fp->load($id)){
							//if uploaded
							if($this->request->isPost()){
							
							//process image upload
							$customSetParam=$this->request->getParam('attributeSet');
							//upload attribute details for image upload;
							DatabaseObject_Helper_ImageUpload::uploadAttributeImage($_FILES['customAttributeDetailImage'], $customSetParam, $this->db, $table_details, $fp->customSet->name_of_set, $fp->customSet->getId(), $this->signedInUserSessionInfoHolder->generalInfo->username);
							echo 'finished upload';
							$this->_redirect("/manageattribute/uploadattribute?actioncall=0&paramSet=$table&id=$id");
							$this->_redirect($_SERVER['HTTP_REFERER']);
							}
						}
						//$this->view->attribute = $attribute;
					}else{
						$this->messenger->addMessage('sorry you do not have permission to edit this attribute');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}
					//edit existing attribute status 
				}
			}elseif ($action==3){
				//3 delete
				//need id of attribute_detail id
				//need paramSet_detail list
				echo 'action is 3';
				if($this->request->isPost())
				{
					$ids = $this->request->getParam('image_id');
					//$attribute_name = $this->request->getParam('attribute_name');
					$table = $this->request->getParam('paramSet');
					$table_details = $table.'_details';
					Zend_Debug::dump($ids);
					
					if(isset($ids)||count($ids)>0){
						foreach($ids as $k=>$v){
							$image = new DatabaseObject_Attribute_CustomAttributeDetails($this->db, $table_details); 
							if($image->loadForPost($this->signedInUserSessionInfoHolder->generalInfo->username,$v)){
								$attributeSetTmp = DatabaseObject_Helper_ManageAttribute::receiveAttributeSetFromId($this->db, $table, $image->set_id);
								Zend_Debug::dump($attributeSetTmp);
								$image->setSaveFilePath($this->signedInUserSessionInfoHolder->generalInfo->username,$table_details,$attributeSetTmp[0]['name_of_set']);//this has to be set for every operation that usesthe get thumbnail path. 
								$image->delete(); 
							}
						}
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}else{
						$this->messenger->addMessage('You must select an attribute to delete');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}elseif($action==0){
				//view details
				echo 'action is 0';
				$id =$this->request->getParam('id');
				if(isset($id)||(($id>0)&&is_numeric($id))){
				
					$table = $this->request->getParam('paramSet');
					$attributeSet = DatabaseObject_Helper_ManageAttribute::confirmattributeidwithuploader($this->db, $table, $this->signedInUserSessionInfoHolder->generalInfo->userID, $id);
					if(count($attributeSet)==1){
						Zend_Debug::dump($attributeSet);
						echo 'here at exisitng attribute';
						$attribute = DatabaseObject_Helper_ManageAttribute::loadAttributeIdDetail($this->db, $table, $id);
						Zend_Debug::dump($attribute);
						$this->view->attribute = $attribute;
					}else{
						//$this->messenger->addMessage('sorry you do not have permission to edit this attribute');
						echo 'can not load this attribute';
					}
				}else{
					
					echo 'you must provide an specific id';
				}
			}
			//only new fabric sets will be generated 	
		}
		
		public function addattributetoproductAction(){
			$addedAttributes=$this->request->getPost('addAttributeSet');
			//Zend_Debug::dump($attributes);
			$attributeType= $this->request->getPost('attributeType');
			$productID = $this->request->getPost('ID');
			if(in_array($attributeType, $this->productConfig['custom_attribute_detail_table'])){
				foreach($addedAttributes as $k=>$v){
					//echo $v;
					if(DatabaseObject_Helper_ManageAttribute::confirmattributeidwithuploader($this->db,$attributeType,$this->signedInUserSessionInfoHolder->generalInfo->userID, $v) && DatabaseObject_Helper_ProductListing::confirmproductforuploader($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $productID)){
						//proceed to add product attribute sets	
						//echo 'here at good product id and attribute id';
						DatabaseObject_Helper_ManageAttribute::addAttributeToProduct($this->db, $attributeType, $productID, $v);
					}
				}
				$json = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, $attributeType, $productID);
				//Zend_Debug::dump($productExistingAttribute);
				$this->sendJson($json);
				
			}
		}
		
		public function removeattributefromproductAction(){
		$removeAttributes=$this->request->getPost('removeProductAttributeSet');
			//Zend_Debug::dump($removeAttributes);
			$attributeType= $this->request->getPost('attributeType');
			$productID = $this->request->getPost('ID');
			//check to see if id is appropirate for the user
			if(in_array($attributeType, $this->productConfig['custom_attribute_detail_table']) && DatabaseObject_Helper_ProductListing::confirmproductforuploader($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $productID)){				
				foreach($removeAttributes as $k=>$v){
					//check to see if product id and requeted deleted id match
					if(DatabaseObject_Helper_ManageAttribute::confirmproductattribute($this->db,$attributeType,$productID,$v)){
						//echo process delete
						//echo "here at delete";
						DatabaseObject_Helper_ManageAttribute::removeAttributeForProduct($this->db, $attributeType, $v);
					}
				}
			}
			$json = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, $attributeType, $productID);
			//Zend_Debug::dump($productExistingAttribute);
			$this->sendJson($json);
		}
		
		//save attribute for product such as shoe size attributes and color main themes
		public function saveproductattributeAction(){
			$productID = $this->request->getParam('id');
			Zend_Debug::dump($this->request->getParams());
			echo 'product id is: '.$productID;
			if(DatabaseObject_Helper_ProductListing::confirmproductforuploader($this->db, 'products',$this->signedInUserSessionInfoHolder->generalInfo->userID, $productID)){
				echo 'here good at product';
				$colors = $this->request->getParam('color');
				if(count($colors)==0){
					$this->messenger->addMessage('please select at least one major color categories this product belongs to.');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
				Zend_Debug::dump($colors);
				foreach($this->productConfig['attribute_categories_details']['color'] as $k=>$v){
					if(isset($colors[$v])){
						$colors[$v]=1;
						echo $v.'<br/>';
					}
					else{
						$colors[$v]=0;
					}
				}
				//Zend_Debug::dump($colors);
				
				$product =DatabaseObject_Helper_ProductDisplay::getBasicProductInfo($this->db, $productID);
				$inventory_attribute_table = $product[0]['inventory_attribute_table'];
				
				if($inventory_attribute_table=='shoes'){
					//echo 'editing shoes';
					$shoesAttribute['product_id']=$productID;
					$shoesAttribute['shoes_metric']=$this->request->getParam('shoes_metric');
					$shoesAttribute['min_size']=$this->request->getParam('min_size');
					$shoesAttribute['max_size']=$this->request->getParam('max_size');
					$shoesAttribute['size_interval']=$this->request->getParam('size_interval');
					$shoesAttribute['ts_created']=date('Y-m-d G:i:s');
					//insert shoes attribute
					DatabaseObject_Helper_ManageAttribute::insertShoeProductAttribute($this->db, 'product_shoes_attributes', $productID, $shoesAttribute);
					//insert shoes heel
					$heels = $this->request->getParam('heel');
					if(count($heels)==0){
						$this->messenger->addMessage('please select at least one heel size for this product.');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}
					Zend_Debug::dump($heels);
					foreach($this->productConfig['attribute_categories_details']['heel'] as $k=>$v){
						if(isset($heels[$v])){
							$heels[$v]=1;
							echo $v.'<br/>';
						}
						else{
							$heels[$v]=0;
						}
					}
					DatabaseObject_Helper_ManageAttribute::insertShoeHeelAttribute($this->db, 'product_shoes_heel', $productID, $heels);
				}
				
				DatabaseObject_Helper_ManageAttribute::insertProductColors($this->db, 'product_colors', $productID, $colors);
				$this->messenger->addMessage('product attribute saved');
				
				$this->_redirect('manageinventory/addinventory?id='.$productID);
			}
			
		}
		
		public function removeattributeAction(){
			$attributeType = $this->request->getParam('type');
			$attributeID = $this->request->getParam('id');
			if(DatabaseObject_Helper_ManageAttribute::confirmattributeidwithuploader($this->db, $attributeType,$this->signedInUserSessionInfoHolder->generalInfo->userID, $attributeID)){
				if(DatabaseObject_Helper_ManageAttribute::removeAttributeForUser($this->db, $attributeType, $attributeID, $this->signedInUserSessionInfoHolder->generalInfo->username)){
					$this->messenger->addMessage('Your attribute had been removed');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
		
		//work with qualified product. 
		public function imagesAction()
		{
			if($this->request->getPost('upload')){
				echo 'here at image upload<br />';
				$fp=new FormProcessor_Image($this->tempProduct, 'storeSeller');
				echo 'here at instantiating image<br />';
				if($fp->process($this->request)){
					echo 'here at process request<br />';
					//then update the session variable for it
					$this->messenger->addMessage('Image uploaded');
				}else{
					echo 'here at process error<br />';
					foreach($fp->getErrors() as $error)
					{
						$this->messenger->addMessage($error);
					}
				}
			}
			elseif($this->request->getParam('delete'))
			{
				/*$image_id = (int) $this->request->getPost('image');
				$image = new DatabaseObject_Image($this->db, $this->tempProduct->image_table, $this->tempProduct->product_tag);
				
				if($image->loadForPost($this->product_id, $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					////echo 'image at delete';
					
					if($this->request->isXmlHttpRequest()){
						$json = array('deleted' =>true, 'image_id' =>$image_id);
					}
					else{
						$this->messenger->addMessage('Image deleted');
					}
				}*/
			}
			
			/*elseif($this->request->getPost('reorder'))
			{
				$order = $request->getPost('post_images');
				$product->setImageOrder($order);
			}*/
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
		
		//must have an id and producttype
		public function addimageattributetoproductAction(){
			if($this->request->getPost('upload')){
				echo 'here at image upload<br />';
				$fp = new FormProcessor_Helper_ImageAttribute($this->tempProduct);
				echo 'here at instantiating image<br />';
				if($fp->process($this->request)){
					echo 'here at process request<br />';
					//then update the session variable for it
					$this->messenger->addMessage('Image uploaded');
				}else{
					echo 'here at process error<br />';
					foreach($fp->getErrors() as $error)
					{
						$this->messenger->addMessage($error);
					}
				}
			}
			elseif($this->request->getParam('delete'))
			{
				//echo "at delete";
				//must check availability, can not delete other people stuff.
				$image_id = (int) $this->request->getParam('image');
				//$attribute_name = $this->request->getParam('attribute_name');
				$image = new DatabaseObject_Attribute_ImageAttribute($this->db);
				/*$image->setSaveFilePath($this->tempProduct->username, $this->tempProduct->product_type, $this->tempProduct->getId(), $attribute_name);*/
				if($image->loadForPost($this->tempProduct->getId(), $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					////echo 'image at delete';
					
					/*if($request->isXmlHttpRequest()){
						$json = array('deleted' =>true, 'image_id' =>$image_id);
					}
					else{
						$this->messenger->addMessage('Image deleted');
					}*/
				}
			}
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
	}
?>