<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_Attribute_CustomAttributeDetails extends DatabaseObject
	{
		protected $_uploadedFile;
		protected $table;
		public $attributeSet = false;
		public $product_type_table;
		public $attribute_name;
		/*must set setSaveFilePath()
		 * for this whole damn thing to work!
		 */
		public function __construct($db, $table)
		{	
			parent::__construct($db, $table, 'id');
			$this->add('set_id');
			$this->add('details_name');
			$this->add('image_name');
			$this->add('filename');
			$this->add('username');
			$this->add('price_offset');
			$this->add('ranking');
		}
		
		//this path(functionality must be called) must be set before 
		
		public function setSaveFilePath($username, $customAttributeSetType, $attributeSetName)
		{
			//$this->username=$username;
			$this->username = $username;
			$this->product_type_table = $customAttributeSetType;
			
			$this->attribute_name=$attributeSetName;
			echo 'attribute_name is: '.$this->attribute_name.'<br/>';
			echo 'product_type_table is: '.$this->product_type_table.'<br/>';
			echo 'here at image username: '.$username.'<br />';
			$this->attributeSet=true;
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
		
	
		
		public function preInsert()
		{
			//first check that we can write hte upload directory
			$path = $this->GetUploadPath();
			echo $path;
			if(!file_exists($path) || !is_dir($path))
			{
				mkdir($path, 0777, true);
				echo "path made";
			}
			
		
			$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where set_id = %d', $this->_table, $this->set_id);
			//this query returnt he next rank after the last insert of images.
			//echo $query;
			$this->ranking = $this->_db->fetchOne($query);
			

			return true;
		}
		
		public function postInsert()
		{
			if(strlen($this->_uploadedFile)>0)
			{
				return move_uploaded_file($this->_uploadedFile, $this->getFullPath());
			}
			
			return false;
		}
		
		public function preDelete()
		{
			unlink($this->getFullPath());
			
			$pattern = sprintf('%s/%d.*', $this->GetThumbnailPath(), $this->getId());
			
			foreach(glob($pattern) as $thumbnail)
			{
				echo 'here at unlinking';
				unlink($thumbnail);
			}
			
			return true; //make sure this return true becaues otherwise the database will be rolled back.
		}
		
		
		public function loadForPost($upload_username, $image_id)
		{
			$username = $upload_username;
			$image_id = (int) $image_id;
			
			if($image_id<=0)
			{
				return false;
			}
			
			$query= sprintf( "select %s from %s where username = '%s' and id = %d", join(', ', $this->getSelectFields()), $this->_table, $username, $image_id);
			
			echo "<br/>$query<br/>";
			//return $this->_load($query);
		}
		
		
		
		
		public function GetUploadPath()
		{	
			$config = Zend_Registry::get('config');
			echo sprintf('%s/uploaded-files/%s/%s/%s', $config->paths->userdata, $this->username, $this->product_type_table, $this->attribute_name); 
		 	return sprintf('%s/uploaded-files/%s/%s/%s', $config->paths->userdata, $this->username, $this->product_type_table, $this->attribute_name); 
			
		}
		
		
		public function GetThumbnailPath()
		{
			$config = Zend_Registry::get('config');
			echo sprintf('%s/tmp/thumbnails/%s/%s/%s', $config->paths->userdata, $this->username, $this->product_type_table, $this->attribute_name); 
			return sprintf('%s/tmp/thumbnails/%s/%s/%s', $config->paths->userdata, $this->username, $this->product_type_table,  $this->attribute_name); 
		}
		
		public function createThumbnail($maxW, $maxH, $thumbType='')
		{
			$fullpath=$this->getFullPath();
			
			/*if($maxW==0 && $maxH!=0)
			{
				$filename = sprintf('%d.H%d_%s', $this->getId(), $maxH, $thumbType);
			}
			elseif($maxH==0 && $maxW!=0)
			{*/
				$filename = sprintf('%d.W%d_%s', $this->getId(), $maxW, $thumbType);
			//}
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
			
			
			/*if($w==$newW && $h ==$newH)
			{
				//no thumbnail required, just return the original path
				echo 'returning full path now';
				return $fullpath;
			}*/
			
			
			
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
			$path =$this->GetThumbnailPath();
			if(!file_exists($path)){
				//echo "here at make path";
				mkdir($path, 0777, true);
			}
			
			if(!is_writable($path)){
				throw new Exception('Unable to write to thumbnail dir: '.$path);
			}
			
			//determin the full path for the new thumbnail
			$thumbPath = sprintf('%s/%s.jpg', $path, $filename);
			//echo $thumbPath;
			
			if(!file_exists($thumbPath)){
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
			}
				
			if(!file_exists($thumbPath)){
				throw new Exception('Unkonw error occurred creating thumbnail');
			}
			if(!is_readable($thumbPath)){
				throw new Exception('Unable to read thumbnail');
			}
			return $thumbPath; //this returns the paths.
		}
				
				
		public function getFullPath(){
			return sprintf('%s/%d.jpg', $this->GetUploadPath(),$this->getId());
		}
		
		public static function GetImagehash($id, $w=0, $h=0){
			$id = (int)$id;
			$w = (int)$w;
			$h = (int) $h;
			return 	sprintf('%d.%dx%d', $id, $w, $h);
		}
		
		public static function GetImages($db, $options=array(), $databaseColumn, $table) //table passed not right/
		{
			//initialize the otions
			$defaults = array($databaseColumn =>array());
			
			foreach ($defaults as $k=>$v){
				$options[$k] = array_key_exists($k, $options)?$options[$k]:$v;
			}
			
			$select = $db->select();
			$select->from(array('i'=>$table), array('i.*'));
			//filter results on specified post ids (if any)
			if(count($options[$databaseColumn])>0){
				$select->where('i.'.$databaseColumn.' in (?)', $options[$databaseColumn]);
			}
			
			if(!empty($options['limit'])){
				$select->limit($options['limit']);
			}else{
				//$select->limit(12);
			}
	
			$select->order('i.ranking');
			
			echo "select is: ".$select."<br />";
			$data = $db->fetchAll($select); 
			$images = parent::buildMultiple($db, __CLASS__, $data);
			return $images;
		}
		
	}
?>