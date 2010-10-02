<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_Attribute_MeasurementWithImageAttribute extends DatabaseObject
	{
		protected $_uploadedFile;
		protected $table;
		public $attributeSet = false;
		
		public function __construct($db)
		{	
			parent::__construct($db, 'measurement_attribute', 'measurement_attribute_id');
			$this->add('measurement_name');
			$this->add('username');
			$this->add('product_type_table');
			$this->add('product_id');
			$this->add('beginning_measurement');
			$this->add('ending_measurement');
			$this->add('incremental_measurement');
			$this->add('price_adjustment');	
			$this->add('filename');
			$this->add('video_youtube');
			$this->add('description');
		}
		
		//this path(functionality must be called) must be set before 
		//setting :username/:product_type_table/:product_id/:acctribute_name
		//example:   tester1/pants/2/color
		public function setSaveFilePath($username, $product_type_table, $product_id, $measurement_name)
		{
			//$this->username=$username;
			$this->username = $username;
			echo 'here at image username: '.$username.'<br />';
			$this->product_type_table=$product_type_table;
			$this->product_id = $product_id;
			$this->measurement_name=$measurement_name;
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
			if($this->filename!='')
			{
				echo 'here at database filename exist';
				$path = $this->GetUploadPath();
				echo $path;
				if(!file_exists($path) || !is_dir($path))
				{
					mkdir($path, 0777, true);
					echo "path made";
				}
				
		
			/*$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where Product_id = %d', $this->_table, $this->Product_id);
			//this query returnt he next rank after the last insert of images.
			//echo $query;
			$this->ranking = $this->_db->fetchOne($query);*/
			
			}else{
				echo 'here at filename dose not exist';
			}
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
			if($this->filename!='')
			{
				echo 'filename is: '.$this->filename.'<br />';
			unlink($this->getFullPath());
			
			$pattern = sprintf('%s/%d.*', $this->GetThumbnailPath(), $this->getId());
			
			foreach(glob($pattern) as $thumbnail)
			{
				unlink($thumbnail);
			}
			}
			return true; //make sure this return true becaues otherwise the database will be rolled back.
		}
		
		
		public function loadForPost($id, $username, $product_type, $product_id){
			$select = $this->_db->select();
			$select->from($this->_table, '*')
					->where('product_type_table = ?', $product_type)
					->where('product_id = ?', $product_id)
					->where('username = ?', $username)
					->where('measurement_attribute_id = ?', $id);
			
			echo $select.'<br />';
			return $this->_load($select);
		}
		
		
		
		
		public function GetUploadPath()
		{
			$config = Zend_Registry::get('config');
			
			if($this->username != NULL)
			{
				$username= $this->username; //from loggedin user to view images of other club images. 
			}else{
				$username = Zend_Auth::getInstance()->getIdentity()->username; //from logged in people to view self images. 
			}
			
			echo sprintf('%s/uploaded-files/%s/%s/%s/MeasurementImageAttribute/%s', $config->paths->data, $username, $this->product_type_table, $this->product_id, $this->measurement_name); 
		 	return sprintf('%s/uploaded-files/%s/%s/%s/MeasurementImageAttribute/%s', $config->paths->data, $username, $this->product_type_table, $this->product_id, $this->measurement_name); 
			
		}
		
		
		public function GetThumbnailPath()
		{
			$config = Zend_Registry::get('config');
			if($this->username != NULL)
			{
				$username= $this->username; //from loggedin user to view images of other club images. 
			}
			/*elseif(!isset(Zend_Auth::getInstance()->getIdentity()->username))
			{
				$username= $_SESSION['clubUsername']; //from unlogged in people to view other club images. 
			}
			*/else{
				$username = Zend_Auth::getInstance()->getIdentity()->username; //from logged in people to view self images. 
			}
			
			echo sprintf('%s/tmp/thumbnails/%s/%s/%s/MeasurementImageAttribute/%s', $config->paths->data, $username, $this->product_type_table, $this->product_id, $this->measurement_name); 
			return sprintf('%s/tmp/thumbnails/%s/%s/%s/MeasurementImageAttribute/%s', $config->paths->data, $username, $this->product_type_table, $this->product_id, $this->measurement_name); 
		}
		
		public function createThumbnail($maxW, $maxH, $thumbType='')
		{
			$fullpath=$this->getFullPath();
			
			
			if($maxW==0 && $maxH!=0)
			{
				$filename = sprintf('%d.H%d_%s', $this->getId(), $maxH, $thumbType);
			}
			elseif($maxH==0 && $maxW!=0)
			{
				$filename = sprintf('%d.W%d_%s', $this->getId(), $maxW, $thumbType);
			}
		
			$ts=(int)filemtime($fullpath);

			$info=getImageSize($fullpath);
			
			$w = $info[0];
			$h = $info[1];
			
			$ratio = $w/$h;  // width: height ratio
			
			$maxW = min($w, $maxW);//new width can't be more than $maxW
			
			if($maxW==0) 	//check if only max height has een specified
			{
				$maxW=$w;
			}
			
			$maxH = min($h, $maxH);
			if($maxH ==0)
			{
				$maxH = $h;
			}
			
			$newW = $maxW;
			$newH = $newW/$ratio;
			if($newH >$maxH)
			{
				$newH = $maxH;
				$newW = $newH * $ratio;
			}
			
			if($w==$newW && $h ==$newH)
			{
				//no thumbnail required, just return the original path
				return $fullpath;
			}
			
			
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