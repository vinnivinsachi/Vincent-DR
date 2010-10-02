<?php
// this class handles all the necessary functions to manage an image. 
//preinsert/postinsert/create thumbnails/get thumbsnailpath

	class DatabaseObject_Image extends DatabaseObject
	{
	
		protected $_uploadedFile;
		protected $table;
		//public static $username = NULL;
		public $product_tag;
		//public $seller_type;//this is used for the creation of folders incase a store seller have both productlisting and userproductlisting.
		public $image_table;		
		public $sizes = array();
		public function __construct($db, $image_table, $product_tag, $sizes=array()){
			
			parent::__construct($db, $image_table, 'image_id');
			echo "image table is: ".$image_table;
			echo "image product_type is: ".$product_tag;
			//$this->seller_type = $seller_type;
			echo 'seller type is: '. $this->seller_type;
			$this->product_tag = $product_tag;
			$this->image_table=$image_table;
			$this->add('filename');
			$this->add('Product_id');
			$this->add('ranking');
			$this->add('username');
			$this->add('name');
			$this->sizes = $sizes;
			$this->username = Zend_Auth::getInstance()->getIdentity()->username;
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
			$path = self::GetUploadPath($this->username, $this->product_tag);
			echo $path;
			if(!file_exists($path) || !is_dir($path))
			{
				mkdir($path, 0777, true);
				echo "path made";
			}
			
			$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where Product_id = %d', $this->_table, $this->Product_id);
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
			
			$pattern = sprintf('%s/%d.*', self::GetThumbnailPath($this->username, $this->product_tag), $this->getId());
			
			foreach(glob($pattern) as $thumbnail)
			{
				unlink($thumbnail);
			}
			
			return true; //make sure this return true becaues otherwise the database will be rolled back.
		}
		
		
		public function loadForPost($post_id, $image_id)
		{
			$post_id = (int) $post_id;
			$image_id = (int) $image_id;
			
			if($post_id<=0 ||$image_id<=0)
			{
				return false;
			}
			
			$query= sprintf( 'select %s from %s where Product_id = %d and image_id = %d', join(', ', $this->getSelectFields()), $this->_table, $post_id, $image_id);
			echo $query;
			return $this->_load($query);
		}
		
		//88888888888888888888888888888888888888888888888888888888888888888
		public static function GetUploadPath($username, $product_tag)
		{
			$config = Zend_Registry::get('config');
		
			return sprintf('%s/uploaded-files/%s/%s', $config->paths->userdata, $username, $product_tag); 
		}
		
		//88888888888888888888888888888888888888888888888888888888888888888888888888
		public static function GetThumbnailPath($username, $product_tag)
		{
			$config = Zend_Registry::get('config');
			
			return sprintf('%s/tmp/thumbnails/%s/%s', $config->paths->userdata, $username, $product_tag);
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
			$path =self::GetThumbnailPath($this->username, $this->product_tag);
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
			return $thumbPath; //this returns the paths.
		}
				
				
		public function getFullPath(){
			return sprintf('%s/%d.jpg', self::GetUploadPath($this->username, $this->product_tag), $this->getId());
		}
		
		public static function GetImagehash($id, $w=0, $h=0){
			$id = (int)$id;
			$w = (int)$w;
			$h = (int) $h;
			return 	sprintf('%d.%dx%d', $id, $w, $h);
		}
		
		public static function GetImages($db, $options=array(), $databaseColumn, $table, $product_tag) //table passed not right/
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
			$param['images']=true;
			$param['image_table']=$table;
			$param['product_tag']=$product_tag;
			$images = parent::buildMultiple($db, __CLASS__, $data, $param);
			return $images;
		}		
		
	}
?>