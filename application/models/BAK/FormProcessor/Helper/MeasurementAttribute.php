<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Helper_MeasurementAttribute extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $measurementAttribute = null;
		protected $_validateOnly = false;
		public $product;
		
		public function __construct($product)
		{
			parent::__construct();
			
			$this->db= $product->getDb();
			$this->product = $product;
			$this->measurementAttribute = new DatabaseObject_Attribute_MeasurementWithImageAttribute($this->db);
			
			
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
						$this->measurementAttribute->uploadFile($file['tmp_name']);
						$this->measurementAttribute->filename = basename($file['name']);
					}
				}
			}
					
			
			
			//echo "<br/> at after hasError";
			
			
			
			
			
			
			
			//validate the user's name
			$this->measurement_name= $this->sanitize($request->getPost('measurement_name')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->measurement_name)==0)
			{
				echo 'length is: '.strlen($this->measurement_name);
				//echo 'request measurmrent-name is: '.$request->getPost('measurement_name');
				$this->addError('measurement_name', 'Please enter the beginning measurement');
				echo 'here at measurement_name errorasdfasdf';
			}
			
			
			
			$this->beginning_measurement= $this->sanitize($request->getPost('beginning_measurement')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->beginning_measurement) ==0)
			{
				$this->addError('beginning_measurement', 'Please enter the beginning measurement');
								echo 'here at beginning_measurement error';

			}
			else
			{
				$this->measurementAttribute->beginning_measurement = $this->beginning_measurement;
			}
			
			$this->ending_measurement= $this->sanitize($request->getPost('ending_measurement')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->ending_measurement) ==0)
			{
				$this->addError('ending_measurement', 'Please enter the beginning measurement');
								echo 'here at ending_measurement error';

			}
			else
			{
				$this->measurementAttribute->ending_measurement = $this->ending_measurement;
			}
			
			$this->incremental_measurement= $this->sanitize($request->getPost('incremental_measurement')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->incremental_measurement) ==0)
			{
				$this->addError('incremental_measurement', 'Please enter the incremental_measurement');
								echo 'here at incremental_measurement error';

			}
			else
			{
				$this->measurementAttribute->incremental_measurement = $this->incremental_measurement;
			}
			
			
			$this->price_adjustment= $this->sanitize($request->getPost('price_adjustment')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->price_adjustment) ==0)
			{
				$this->addError('price_adjustment', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->measurementAttribute->price_adjustment = $this->price_adjustment;
			}
			
			
			$this->description = $request->getParam('description');
			$this->video_youtube = $request->getParam('video_youtube');
			//echo $request->getPost('clubAdmin');
			//$this->user->user_type = $request->getPost('clubAdmin');
			
			//if no erros have occured, save the user 
			if(!$this->_validateOnly && !$this->hasError())
			{
				$this->measurementAttribute->setSaveFilePath($this->product->username, $this->product->product_type, $this->product->getId(), $this->measurement_name);
				
				$this->measurementAttribute->description = $this->description;
				$this->measurementAttribute->video_youtube = $this->video_youtube;
				//this is the place to create all the neccessary thumbnails for the website.
				$this->measurementAttribute->save();
				
				if($this->measurementAttribute->filename!='')
				{
					//echo 'here at creating thumbnail';
					$thumnail1 = $this->measurementAttribute->createThumbnail(80, 0, $this->measurement_name.'Attribute');
				}else{
					//echo 'here at no file thumbnail';
				}
			}
			
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		