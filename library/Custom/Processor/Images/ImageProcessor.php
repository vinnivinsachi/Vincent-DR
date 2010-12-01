<?php
	//can process an array of images file uploads.
	class Custom_Processor_Images_ImageProcessor
	{
		//imageModel is the name of the imageModel
		public $imageMapper;
		public $_uploadedFile;
	
		//requires the imageMapper polymorth image model
		public function __construct($imageMapper){
			$this->imageMapper = $imageMapper;
		}
		
		//example ($_File, 'usersProfileImage', 'username', 'vinzha', '3')
		//example ($_File, 'storeProfileImage', 'storeUniqueName', 'blahblah', '3')
		//example ($_File, 'productImages', 'productTag', 'mens standard shoes', '3')
		public function uploadImage($uploadedImages, $sourceName, $sourceTypeTitle, $sourceTypeName, $sourceID, $options=array()){
			$imageKeys=array();
			
			foreach($uploadedImages['name'] as $k=>$v){
				
				$imageKeys[]=$k;
			}
			
			foreach($imageKeys as $k=>$v){
					$hasImageError = false;	
					
					$file['name']=$uploadedImages['name'][$v];
					$file['type']=$uploadedImages['type'][$v];
					$file['tmp_name']=$uploadedImages['tmp_name'][$v];
					$file['error']=$uploadedImages['error'][$v];
					$file['size']=$uploadedImages['size'][$v];
					Zend_Debug::dump($file);
					
					switch($file['error'])
					{
						case UPLOAD_ERR_OK:
							//echo "upload okay";
							break;
						case UPLOAD_ERR_FORM_SIZE:
												echo 'here at error 32';
							//$this->msg(array('error' => 'The uploaded file was too large'));
							break;
						case UPLOAD_ERR_PARTIAL:
												echo 'here at error 35';
							//$this->msg(array('error' => 'The uploaded file was incomplete'));
							break;
						case UPLOAD_ERR_NO_FILE:
												echo 'here at error 38';
							//$this->msg(array('error' => 'The uploaded file was not found'));
						    $hasImageError = true;
							break;
						case UPLOAD_ERR_NO_TMP_DIR:
												echo 'here at error 42';
							//$this->msg(array('error' => 'The uploaded file did not receive a temp dir'));
							$hasImageError = true;
							break;
						case UPLOAD_ERR_CANT_WRITE:
												echo 'here at error 46';
							//$this->msg(array('error' => 'The uploaded file can not be written'));
							$hasImageError = true;
							break;
						case UPLOAD_ERR_EXTENSION:
												echo 'here at error 50';
							//$this->msg(array('error' => 'The uploaded file has an error extension'));
							$hasImageError = true;
							break;
						default:
							$hasImageError=true;
					}
					
					if(!$hasImageError){
						$info = getImageSize($file['tmp_name']);
						if(!$info)
						{
													echo 'here at error 60';
	
							//$this->msg(array('error'=>'Uploaded file was not an image'));
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
								$hasImageError=true;
								echo 'here at error 82';
								//$this->msg(array('error' => 'Invalid image type uploaded'));
						} 
						
						if(!$hasImageError){
								//process image
							echo 'here at good image process';
							
							$image = new $this->imageMapper->_modelClass;
							
							$image->sourceName = $sourceName;
							$image->sourceTypeTitle = $sourceTypeTitle;
							$image->sourceTypeName = $sourceTypeName;
							$image->sourceID = $sourceID;
							$image->filename = $file['name'];	

							//PRESAVE
							$path = self::GetUploadPath($image);
							
							if(!file_exists($path) || !is_dir($path))
							{
								mkdir($path, 0777, true);
								echo "path made";
							}else{
								
								echo 'path not made';
							}
							$id = $this->imageMapper->save($image);
							$image->_primaryID = $id;
							echo 'id is: '.$id;
							//POST SAVE
							$this->uploadFile($file['tmp_name']);
							if(strlen($this->_uploadedFile)>0)
							{
								move_uploaded_file($this->_uploadedFile, $this->getFullPath($image));
								//$this->_uploadedFile = '';
								Zend_Debug::dump($image);
								
								echo 'primaryID is: '.$image->_primaryID;
								echo $this->getFullPath($image);
								//refreshing uploaded files;
								$this->_uploadedFile='';
							
							}													
										
							//HERE AT CREATING THUMNAILS							
							echo $path;
							$this->createThumbnails($image, 150, 200, 'homeFrontFour');

						}else{	
							echo 'here at error 107';
							//$this->msg(array('error' => 'There is an error with this upload.'));
	
						}
						
					}
			}
		}
		
		public function createThumbnails($image, $maxW, $maxH, $thumbType='')
		{
			
			
			$fullpath=$this->getFullPath($image);
			
			
			$filename = sprintf('%d.W%d_H%d_%s', $image->_primaryID, $maxW, $maxH, $thumbType);
			$ts=(int)filemtime($fullpath);

			$info=getImageSize($fullpath);
			
			$w = $info[0];
			$h = $info[1];
			
			$ratio = $w/$h;  // width/height ratio
			
			$maxW = min($w, $maxW);//new width can't be more than $maxW
			
			echo 'max width is: '.$maxW.'<br />';
			echo 'max height is: '.$maxH.'<br />';
			
			if($maxW==0) 	//check if only max height has een specified
			{
				$maxW=$w;
			}
			
			//if there is no height, then it dosn't matter, but if there is a height then the image will be transformed to the smaller of the two dimensions. 
			if($maxH ==0)
			{
				$maxH = min($h, $maxH);
				$maxH = $h;
				
				$newW = $maxW;
				$newH = $newW/$ratio;
				if($newH >$maxH)
				{
					$newH = $maxH;
					$newW = $newH * $ratio;
				}
			}else{
				
				$newW = $maxW;
				$newH = $newW/$ratio;
				if($newH >$maxH)
				{
					$newH=$maxH;
					$newW = $newH*$ratio;
					if($newW >$maxW){
						$newH=$maxH;
						$newW=$maxW;
					}else{
					$newH = $maxH;
					$newW = $newH * $ratio;
					}
				}
			}
			
			echo "newH is: $newH<br />, newW is: $newW<br />";
			
			
			switch($info[2])
			{
				case IMAGETYPE_GIF:
					$infunc = 'ImageCreateFromGif';
					$outfunc = 'ImageGif';
					break;
				case IMAGETYPE_JPEG:
					$infunc = 'ImageCreateFromJpeg';
					$outfunc = 'ImageJpeg';
					break;
				case IMAGETYPE_PNG:
					$infunc = 'ImageCreateFromPng';
					$outfunc = 'ImagePng';
					break;
				
				default;
					throw new Exception('Invalid image type');
			}
			
			// create a unique filename based on the specified optins 
			//autocreate the directory for storing thumbnails
			$path =self::GetThumbnailPath($image);
			if(!file_exists($path)){
				echo "here at make path";
				mkdir($path, 0777, true);
			}
			
			if(!is_writable($path)){
				throw new Exception('Unable to write to thumbnail dir: '.$path);
			}
			
			//determin the full path for the new thumbnail
			$thumbPath = sprintf('%s/%s.jpg', $path, $filename);
			//echo 'the path the of the thumbnail is: '.$thumbPath.'<br />';
			
			if(!file_exists($thumbPath)){
				//echo 'at writing stuff<br />';
				//read the image into GD
				$im = @$infunc($fullpath);
				if(!$im){
					throw new Exception('Unable to read image file');
				}				
				//create the output image
				$thumb = ImageCreateTrueColor($newW, $newH); //creating a new image of new hight
				//now resample the origianl image to the new image 
				ImageCopyResampled($thumb, $im, 0,0,0,0, $newW, $newH, $w, $h); //converting the image to the new image.
				$outfunc($thumb, $thumbPath);  //this writes (the image and the location)
				//echo 'at finished writing stuff';	
			}
				
			if(!file_exists($thumbPath)){
				throw new Exception('Unkonw error occurred creating thumbnail');
				//echo 'no file exist<br />';
			}
			if(!is_readable($thumbPath)){
				throw new Exception('Unable to read thumbnail');
				//echo 'no file can be read<br />';
			}
			return $thumbPath; //this returns the paths.*/
		}
		
		public function uploadFile($path)
		{
			if(!file_exists($path)||!is_file($path))
			{
				//echo $path;
				throw new Exception('unable to find uploaded file');
			}
			
			if(!is_readable($path))
			{	
				//echo $path;
				throw new Exception('unable to read uploaded file');
			}
			
			$this->_uploadedFile = $path;
		}
		
		//this is the path of the uploaded file.
		public function getFullPath($image){
			//$primaryKey = $this->imageMapper->getPrimaryKey();
			return sprintf('%s/%d.jpg', self::GetUploadPath($image), $image->_primaryID);
		}
		
		public static function GetUploadPath($image)
		{
			$config = Zend_Registry::get('config');
		
			return sprintf('%s/uploaded-files/%s/%s/%s/%s', $config->paths->userdata, $image->sourceName, $image->sourceTypeTitle, $image->sourceTypeName, $image->sourceID); 
		}
		
		public static function GetThumbnailPath($image)
		{
			$config = Zend_Registry::get('config');
			
			return sprintf('%s/tmp/thumbnails/%s/%s/%s/%s', $config->paths->userdata, $image->sourceName, $image->sourceTypeTitle, $image->sourceTypeName, $image->sourceID);
		}
		
		
		
		
	}
?>