<?php

	//user DatabaseObject_ImageAttribute
	//Contructed with a DatabaseObject
	class FormProcessor_Helper_ImageAttribute extends FormProcessor
	{
		protected $product;
		public $image;
		
		public function __construct(DatabaseObject $object)
		{
			parent::__construct();
			
			$this->product = $object;
			
			$this->image = new DatabaseObject_Attribute_ImageAttribute($this->product->getDb());
			
			//Zend_Debug::dump($this->product);
			//echo 'imageattribvute productusername'. $this->product->username.'<br />';//$this->image->Product_id = $this->product->getId();
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
		
			if(!isset($_FILES['image']) || !is_array($_FILES['image'])){
				$this->addError('image', 'Invalid upload data');
				return false;
			}
		
			$file = $_FILES['image'];
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
					$this->addError('image', 'No file was uploaded');
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
			
			//echo "<br/> at after hasError";
			
			$info = getImageSize($file['tmp_name']);
			if(!$info)
			{
				$this->addError('type', 'Uploaded file was not an image');
				return false;
			}
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
					return fase;
			}
			
			//if no errors hav eoccurred save the image
			if(!$this->hasError())
			{
				$attribute_name = $request->getParam('attribute_name');

				$image_name = DatabaseObject_StaticUtility::replaceSpaceWithDash($request->getParam('image_name'));
				$price_adjustment=$request->getParam('price_adjustment');
				$this->image->setSaveFilePath($this->product->username, $this->product->product_type, $this->product->getId(), $attribute_name);
				
				echo $this->product->username;
				$this->image->image_name=$image_name;
				echo '<br />image product type table is: '.$this->image->product_type_table.'<br />';
				echo '<br />Product username is: '.$this->product->username.'<br />';
				$this->image->price_adjustment=$price_adjustment;
				$this->image->uploadFile($file['tmp_name']);
				$this->image->filename = basename($file['name']);
				
				$this->image->save();
				//this is the place to create all the neccessary thumbnails for the website.
				$this->image->createThumbnail(80, 0, $attribute_name.'Attribute_'.$image_name);
				$this->image->createThumbnail(150, 0, $attribute_name.'Attribute_'.$image_name);
			}
			
			return !$this->hasError();
		}
	}
?>