<?php

	class DatabaseObject_Helper_ImageUpload extends DatabaseObject
	{
		public static function uploadImage($images, $db, $table, $product_tag, $product_id, $name, $options=array())
		{
		//Zend_Debug::dump($v);
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
					//$file = $image;
					switch($file['error'])
					{
						case UPLOAD_ERR_OK:
							//echo "upload okay";
							break;
						case UPLOAD_ERR_FORM_SIZE:
							//$this->messenger->addMessage('The uploaded file is too large');
							break;
						case UPLOAD_ERR_PARTIAL:
							//$this->messenger->addMessage('The uploaded file was too large');
							break;
						case UPLOAD_ERR_NO_FILE:
							//$this->messenger->addMessage('No file was uploaded');
						    $hasImageError = true;
							break;
						case UPLOAD_ERR_NO_TMP_DIR:
							//$this->messenger->addMessage('Temporary folder not found');
							$hasImageError = true;
							break;
						case UPLOAD_ERR_CANT_WRITE:
							//$this->messenger->addMessage('Unable to write file');
							$hasImageError = true;
							break;
						case UPLOAD_ERR_EXTENSION:
							//$this->messenger->addMessage('Invalid file extension');
							$hasImageError = true;
							break;
						default:
							$hasImageError=true;
							//$this->messenger->addMessage('Unkonw error code');
					}
					
					if(!$hasImageError){
						//start the process of imaging.
						$hasImageInfoError=false;
						$info = getImageSize($file['tmp_name']);
						if(!$info)
						{
							$this->messenger->addMessage('Uploaded file was not an image');
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
								$hasImageInfoError=true;
								$this->messenger->addMessage('type', 'Invalid image type uploaded');
						} 
						
						if(!$hasImageInfoError){
							$newImage = new DatabaseObject_Image($db, $table, $product_tag);
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
								echo 'here at creating the thumbnails -4<br />';
						}else{
							
							
						}
					}
			}
			
		}

		/*all must be good for customSet before uploadAttributeImage can be /**
		 * @param $details the file names to set
		 * @param $name is the name of the 
		 * @param $table is the name of the type of attributes, the bare_field_name to set
		 */
		public static function uploadAttributeImage($details, $customSetParam, $db, $table, $name, $attributeID, $uploader_username){
			$imageKeys=array();
			
			foreach($details['name'] as $k=>$v){
				
				$imageKeys[]=$k;
			}
			Zend_Debug::dump($imageKeys);
			
			foreach($imageKeys as $k=>$v)
			{
				$hasImageError = false;	
				
				$price_offset = $customSetParam[$name]['price'][$v];
				$detail_name = $customSetParam[$name]['name'][$v];
				$file['name']=$details['name'][$v];
				$file['type']=$details['type'][$v];
				$file['tmp_name']=$details['tmp_name'][$v];
				$file['error']=$details['error'][$v];
				$file['size']=$details['size'][$v];
				//$file = $image;
				switch($file['error'])
				{
					case UPLOAD_ERR_OK:
						//echo "upload okay";
						break;
					case UPLOAD_ERR_FORM_SIZE:
						//$this->messenger->addMessage('The uploaded file is too large');
						break;
					case UPLOAD_ERR_PARTIAL:
						//$this->messenger->addMessage('The uploaded file was too large');
						break;
					case UPLOAD_ERR_NO_FILE:
						//$this->messenger->addMessage('No file was uploaded');
					    $hasImageError = true;
						break;
					case UPLOAD_ERR_NO_TMP_DIR:
						//$this->messenger->addMessage('Temporary folder not found');
						$hasImageError = true;
						break;
					case UPLOAD_ERR_CANT_WRITE:
						//$this->messenger->addMessage('Unable to write file');
						$hasImageError = true;
						break;
					case UPLOAD_ERR_EXTENSION:
						//$this->messenger->addMessage('Invalid file extension');
						$hasImageError = true;
						break;
					default:
						$hasImageError=true;
						//$this->messenger->addMessage('Unkonw error code');
				}
				
				if(!$hasImageError){
					//start the process of imaging.
					$hasImageInfoError=false;
					$info = getImageSize($file['tmp_name']);
					if(!$info)
					{
						$this->messenger->addMessage('Uploaded file was not an image');
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
							$hasImageInfoError=true;
							$this->messenger->addMessage('type', 'Invalid image type uploaded');
					} 
					
					if(!$hasImageInfoError){
						$newImage = new DatabaseObject_Attribute_CustomAttributeDetails($db, $table); 
						echo 'table is: '.$table.'<br/>';
						echo 'name is: '.$name.'<br/>';
						$newImage->setSaveFilePath($uploader_username, $table, $name);
						$newImage->details_name = $detail_name;
						$newImage->price_offset = $price_offset; 
						$newImage->image_name = $file['name'];
						//$newImage->setUsername(Zend_Auth::getInstance()->getIdentity()->username);
						$newImage->set_id = $attributeID;
						$newImage->uploadFile($file['tmp_name']);
						$newImage->filename = basename($file['name']);
						$newImage->save();
						//this is the place to create all the neccessary thumbnails for the website.
							echo 'here at creating the thumbnails -0<br />';
						/*$newImage->createThumbnail(150, 200, 'homeFrontFour');
							echo 'here at creating the thumbnails -1<br />';*/
						//$newImage->createThumbnail(300, 350, 'productDetailImage');
						$newImage->createThumbnail(30,30,'miniDetailImage');
						$newImage->createThumbnail(50,70,'smallDetailImage');
							echo 'here at creating the thumbnails -3<br />';
						/*$newImage->createThumbnail(200, 200, 'productFirstImage');
							echo 'here at creating the thumbnails -2<br />';
						
						$newImage->createThumbnail(30, 200, 'productSmallPreview');
							echo 'here at creating the thumbnails -4<br />';*/
					}else{	
						$newImage = new DatabaseObject_Attribute_CustomAttributeDetails($db, $table); 
						echo 'table is: '.$table.'<br/>';
						echo 'name is: '.$name.'<br/>';
						$newImage->setSaveFilePath($uploader_username, $table, $name);
						$newImage->details_name = $detail_name;
						$newImage->price_offset = $price_offset; 
						$newImage->image_name = $file['name'];
						//$newImage->setUsername(Zend_Auth::getInstance()->getIdentity()->username);
						$newImage->set_id = $attributeID;
						$newImage->save();
					}
				}else{
						$newImage = new DatabaseObject_Attribute_CustomAttributeDetails($db, $table); 
						echo 'table is: '.$table.'<br/>';
						echo 'name is: '.$name.'<br/>';
						$newImage->setSaveFilePath($uploader_username, $table, $name);
						$newImage->details_name = $detail_name;
						$newImage->price_offset = $price_offset; 
						$newImage->image_name = $file['name'];
						//$newImage->setUsername(Zend_Auth::getInstance()->getIdentity()->username);
						$newImage->set_id = $attributeID;
						$newImage->save();
				}
			}
		}
		
		public static function removeProductAndInventoryImage($db, $fatherTable, $imagetable, $product_tag, $imageID, $postID, $userID){
			if($product_tag=='inventory'){
				$okayBool=DatabaseObject_Helper_InventoryManager::verifyInventoryItemForUser($db,$postID,$userID);
			}else{
				$okayBool=DatabaseObject_Helper_ProductListing::confirmproductforuploader($db, $fatherTable, $userID, $postID);
			}
			if($okayBool){
				$image = new DatabaseObject_Image($db, $imagetable, $product_tag);
				if($image->loadForPost($postID, $imageID)){
					echo 'here at load image';
					if($image->delete()){
						echo 'here at delete image';
						return true;
					}else{
						return false;
					}
				}else{
					echo 'image not loaded';
				}
			}else{
				echo 'You have no permission to perform this action';
				return false;
			}
		}
		
		public static function loadImagesForItem($db, $table, $id){
			$select = $db->select();
			$select->from($table, '*')
			->where('product_id =?',$id);
			return $db->fetchAll($select);
		}
		
	}
?>