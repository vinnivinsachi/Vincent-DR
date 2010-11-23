<?php

	class Custom_Processor_Images_ImageProcessor
	{
		
		public static function uploadImage($db, $images, $table, $sourceName, $sourceType, $sourceID, $options=array()){
			$imageKeys=array();
			
			foreach($images['name'] as $k=>$v){
				
				$imageKeys[]=$k;
			}
			Zend_Debug::dump($imageKeys);
			
			foreach($imageKeys as $k=>$v)
			{
					$hasImageError = false;	
					
					$file['name']=$images['name'][$v];
					$file['type']=$images['type'][$v];
					$file['tmp_name']=$images['tmp_name'][$v];
					$file['error']=$images['error'][$v];
					$file['size']=$images['size'][$v];
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
							
							/*$newImage = new DatabaseObject_Image($db, $table, $product_tag);
							//$newImage->setUsername(Zend_Auth::getInstance()->getIdentity()->username);
							$newImage->Product_id = $product_id;
							$newImage->name=$name;
							$newImage->uploadFile($file['tmp_name']);
							$newImage->filename = basename($file['name']);
							$newImage->save();
							//this is the place to create all the neccessary thumbnails for the website.
								echo 'here at creating the thumbnails -0<br />';
							$newImage->createThumbnail(150, 200, 'homeFrontFour');
								echo 'here at creating the thumbnails -1<br />';
							$newImage->createThumbnail(191, 200, 'productFirstImage');
								echo 'here at creating the thumbnails -2<br />';
							$newImage->createThumbnail(300, 350, 'productDetailImage');
								echo 'here at creating the thumbnails -3<br />';
							$newImage->createThumbnail(50, 50, 'productSmallPreview');
								echo 'here at creating the thumbnails -4<br />';*/
						}else{
							
							echo 'here at error 107';
							//$this->msg(array('error' => 'There is an error with this upload.'));
	
						}
						
					}
						
						
			}
			
			
			
		}
	}
?>