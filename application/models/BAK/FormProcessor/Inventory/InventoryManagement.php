<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Inventory_InventoryManagement extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $inventoryProduct = null;
		protected $_validateOnly = false;
		public $product;
		
		public function __construct($db)
		{
			parent::__construct();
			
			$this->db= $db;
			$this->inventoryProduct = new DatabaseObject_Inventory_Product($this->db);
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			
			if(!isset($_FILES['image'])){
				echo 'here at no upload image';
								
				//$this->addError('image', 'Invalid upload data');
				//return false;
			}else{
				echo 'here at upload image';
				$file = $_FILES['image'];
				
				if(basename($file['name'])=='')
				{
				}else{
				
					switch($file['error'])
					{
						case UPLOAD_ERR_OK:
							//echo "upload okay";
							break;
						case UPLOAD_ERR_FORM_SIZE:
							//only used if max_file_size specified in fomr
						case UPLOAD_ERR_PARTIAL:
							$this->addError('image', 'The uploaded file was too large');
							break;
						case UPLOAD_ERR_NO_FILE:
							//$this->addError('image', 'No file was uploaded');
							break;
						case UPLOAD_ERR_NO_TMP_DIR:
							$this->addError('image','Temporary folder not found');
							break;
						case UPLOAD_ERR_CANT_WRITE:
							$this->addError('image', 'Unable to write file');
							break;
						case UPLOAD_ERR_EXTENSION:
							$this->addError('image', 'Invalid file extension');
							break;
						
						default:
							$this->addError('image', 'Unkonw error code');
					}
					
					if($this->hasError())
					{
						return false;
					}
					
					
					
					$info = getImageSize($file['tmp_name']);
				
					//echo $info[2];
					switch($info[2])
					{
						case IMAGETYPE_PNG:
						case IMAGETYPE_GIF:
						case IMAGETYPE_JPEG:
						case IMAGETYPE_JPG:
							break;
						
						default:
							$this->addError('type', 'Invalid image type uploaded');
							return false;
					}
					
					if(!$info)
					{
						/*$this->addError('type', 'Uploaded file was not an image');
						return false;*/
						echo 'here at form info error';
					}else{
						echo 'here at info  right';
						$this->inventoryProduct->uploadFile($file['tmp_name']);
						$this->inventoryProduct->filename = basename($file['name']);
					}
				}
			}
					
			
			
			//echo "<br/> at after hasError";
			
			$inventoryRequestArray = $request->getParams();
			
			$this->Username = $request->getParam('Username');
			unset($inventoryRequestArray['Username']);
			$this->User_id = $request->getParam('User_id');
			unset($inventoryRequestArray['User_id']);

			$this->product_id = $request->getParam('id');
			unset($inventoryRequestArray['id']);

			$this->product_type_table = $request->getParam('product');
			unset($inventoryRequestArray['product']);

			$this->inventory_name = $request->getParam('inventory_name');
			unset($inventoryRequestArray['inventory_name']);
			
			$this->quantity = $request->getParam('inventory_quantity');
			unset($inventoryRequestArray['inventory_quantity']);

			$this->price = $request->getParam('inventory_price');
			unset($inventoryRequestArray['inventory_price']);

			$this->inventoryProduct->description = $request->getParam('inventory_description');
			unset($inventoryRequestArray['inventory_description']);

			$this->inventoryProduct->video_youtube = $request->getParam('inventory_video');
			unset($inventoryRequestArray['inventory_video']);
			
			
			$inventoryProfileArray = array();

			foreach($inventoryRequestArray as $k=>$v)
			{
				if (strpos($k,'_price_adjustment')===false)
				{
					$inventoryProfileArray[$k]=$v;
				}
			}
			
			echo '<br />
<br /><br />
<br />
<br />
';

			unset($inventoryProfileArray['controller']);
			unset($inventoryProfileArray['add']);
			unset($inventoryProfileArray['image']);
			unset($inventoryProfileArray['action']);
			unset($inventoryProfileArray['module']);
			foreach($inventoryProfileArray as $k=>$v){
							echo $k.' /'.$v.'<br />';
			}
			
			

							

			
			$totalPriceAdjustment=0;
			foreach($inventoryProfileArray as $k=>$v)
			{
				if(strpos($k,'measurement')===false){
				$this->inventoryProduct->profile->$k = $v;
				$profileKeyPriceAdjustment = $k.'_'.$v.'_price_adjustment';
				$this->inventoryProduct->profile->$profileKeyPriceAdjustment=$inventoryRequestArray[$profileKeyPriceAdjustment];
				$totalPriceAdjustment = $totalPriceAdjustment + $inventoryRequestArray[$profileKeyPriceAdjustment];
				unset($inventoryProfileArray[$k]);
				}else{
				
				$measurementName = substr($k, 0, strpos($k, 'measurement'));
				$profileKeyPriceAdjustment = $measurementName.'price_adjustment';
				$this->inventoryProduct->profile->$profileKeyPriceAdjustment=$inventoryRequestArray[$profileKeyPriceAdjustment];
				$totalPriceAdjustment = $totalPriceAdjustment + $inventoryRequestArray[$profileKeyPriceAdjustment];
				$this->inventoryProduct->profile->$k = $inventoryRequestArray[$k];
				unset($inventoryProfileArray[$k]);
				}
				echo 'here at profileKeyPriceAdjustment: '.$profileKeyPriceAdjustment.'<br />';
				echo 'here at inventoryProduct profile :'.$this->inventoryProduct->profile->$profileKeyPriceAdjustment.'<br />';
			}
			
	
			
			
			echo 'total priceAjustment is: '.$totalPriceAdjustment.'<br />';
				$this->inventoryProduct->profile->totalPriceAdjustment = $totalPriceAdjustment;
	
			if(!$this->_validateOnly && !$this->hasError())
			{
				//need to get it from request;
				$this->inventoryProduct->setSaveFilePath($this->Username, $this->product_type_table, $this->product_id);
				
				$this->inventoryProduct->User_id = $this->User_id;
				$this->inventoryProduct->Username = $this->Username;
				$this->inventoryProduct->product_type_table = $this->product_type_table;
				$this->inventoryProduct->product_id = $this->product_id;
				$this->inventoryProduct->quantity = $this->quantity;
				$this->inventoryProduct->price = $this->price;
				$this->inventoryProduct->inventory_name = $this->inventory_name;
				$this->inventoryProduct->save();
				
				if($this->inventoryProduct->filename!='')
				{
					//echo 'here at creating thumbnail';
					$thumnail1 = $this->inventoryProduct->createThumbnail(80, 0, $this->measurement_name.'Attribute');
				}else{
					//echo 'here at no file thumbnail';
				}
			}
			
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		