<?php
	class FormProcessor_Image extends FormProcessor
	{
		protected $product;
		public $image;
		
		public function __construct($db, $table, $product_tag, $product_id)
		{
			parent::__construct();
			
			//$this->product = $object;
			
			$this->image = new DatabaseObject_Image($db, $table, $product_tag);
			
			$this->image->Product_id = $product_id;
			
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
				$this->image->uploadFile($file['tmp_name']);
				$this->image->filename = basename($file['name']);
				$this->image->save();
				//this is the place to create all the neccessary thumbnails for the website.
					echo 'here at creating the thumbnails -0<br />';
				$this->image->createThumbnail(150, 200, 'homeFrontFour');
					echo 'here at creating the thumbnails -1<br />';
				$this->image->createThumbnail(200, 200, 'productFirstImage');
					echo 'here at creating the thumbnails -2<br />';
				$this->image->createThumbnail(300, 0, 'productDetailImage');
					echo 'here at creating the thumbnails -3<br />';
				$this->image->createThumbnail(30, 200, 'productSmallPreview');
					echo 'here at creating the thumbnails -4<br />';
				//$this->image->createThumbnail(0,0,'defaultPic');
			}
			
			return !$this->hasError();
		}
	}
?>