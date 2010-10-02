<?php
// this class handles all the necessary functions to manage an image. 
//preinsert/postinsert/create thumbnails/get thumbsnailpath


	class DatabaseObject_Image extends DatabaseObject
	{
	
		protected $_uploadedFile;
		protected $databaseColumn;
		protected $table;
		public static $username = NULL;
		protected $categoryType;
		
		public function __construct($db)
		{
			if($_SESSION['categoryType'] == 'post')
			{
			$this->databaseColumn ='post_id';
			$this->table = 'blog_posts_images';
			parent::__construct($db, 'blog_posts_images', 'image_id');
			}
			if($_SESSION['categoryType'] == 'product')
			{
			$this->databaseColumn ='product_id';
			$this->table = 'products_images';
			parent::__construct($db, 'products_images', 'image_id');
			}
			
			if($_SESSION['categoryType'] == 'clubImage')
			{
			$this->databaseColumn = 'user_id';
			$this->table = 'users_profiles_images';
			parent::__construct($db, 'users_profiles_images', 'image_id');
			}
			
			if($_SESSION['categoryType']=='event')
			{
			$this->databaseColumn = 'event_id';
			$this->table = 'events_images';
			parent::__construct($db, 'events_images', 'image_id');
			}
			
			if($_SESSION['categoryType']=='universalDueImage')
			{
			$this->databaseColumn = 'universal_dues_id';
			$this->table = 'universal_dues_images';
			parent::__construct($db, 'universal_dues_images', 'image_id');
			}
			
			
			
			$this->add('filename');
			$this->add($this->databaseColumn);
			$this->add('ranking');
			//$this->add('username');
			//echo $this->username;
			
			//echo $this->_table."<br/>";
			//echo $this->databaseColumn."<br/>";
		}
		
		public function setUsername($username)
		{
			self::$username = $username;
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
			$path = self::GetUploadPath();
			echo $path;
			if(!file_exists($path) || !is_dir($path))
			{
				mkdir($path, 0777, true);
				echo "path made";
			}
			
			/*if(!is_writable($path))
			{
				//mkdir($path, 0777);
				throw new Exception('unable to write to upload path '.$path);
			}*/
			
			//now determine the ranking of the new image
			if($_SESSION['categoryType'] == 'post')
			{
				$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where '.$this->databaseColumn.' = %d', $this->_table, $this->post_id);
			}
			elseif($_SESSION['categoryType'] == 'product')
			{
				$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where '.$this->databaseColumn.' = %d', $this->_table, $this->product_id);
			}
			elseif($_SESSION['categoryType'] == 'clubImage')
			{
				$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where '.$this->databaseColumn.' = %d', $this->_table, $this->user_id);
				//the 13 use to be user_id;
			}
			elseif($_SESSION['categoryType']=='event')
			{
				$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where '.$this->databaseColumn.' = %d', $this->_table, $this->event_id);
			}
			elseif($_SESSION['categoryType']=='universalDueImage')
			{
				$query = sprintf('select coalesce(max(ranking),0) + 1 from %s where '.$this->databaseColumn.' = %d', $this->_table, $this->universal_dues_id);
			}

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
			
			$pattern = sprintf('%s/%d.*', self::GetThumbnailPath(), $this->getId());
			
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
			
			$query= sprintf( 'select %s from %s where '.$this->databaseColumn.' = %d and image_id = %d', join(', ', $this->getSelectFields()), $this->_table, $post_id, $image_id);
			
			return $this->_load($query);
		}
		
		
		
		
		public static function GetUploadPath()
		{
			$config = Zend_Registry::get('config');
			//this is an error!!! when the person is logged in, the image can be displayed, when the person loggs out, the image is not available to the public. please fix this accordingly with, get the owner of the image without getting it throw sign ins. !!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			if(self::$username != NULL)
			{
				$username= self::$username; //from loggedin user to view images of other club images. 
			}
			elseif(!isset(Zend_Auth::getInstance()->getIdentity()->username))
			{
				$username= $_SESSION['clubUsername']; //from unlogged in people to view other club images. 
			}
			else
			{
				$username = Zend_Auth::getInstance()->getIdentity()->username; //from logged in people to view self images. 
			}
			//the path here must also be dynamically generated. 

			return sprintf('%s/uploaded-files/%s/%s', $config->paths->data, 'uofmballroom', $_SESSION['categoryType']); //$cofig->paths->data returns c:/xampp/htdocs/phpweb20/data 
		}
		
		
		public static function GetThumbnailPath()
		{
			$config = Zend_Registry::get('config');
			
			
			if(self::$username != NULL)
			{
				$username= self::$username; //from loggedin user to view images of other club images. 
			}
			elseif(!isset(Zend_Auth::getInstance()->getIdentity()->username))
			{
				$username= $_SESSION['clubUsername']; //from unlogged in people to view other club images. 
			}
			else
			{
				$username = Zend_Auth::getInstance()->getIdentity()->username; //from logged in people to view self images. 
			}
			
			return sprintf('%s/tmp/thumbnails/%s/%s', $config->paths->data, 'uofmballroom', $_SESSION['categoryType']);
			
		}
		
		public function createThumbnail($maxW, $maxH)
		{
			$fullpath=$this->getFullPath();
		
			$ts=(int)filemtime($fullpath);
			//$ts = (int)filemtime($fullpath);
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
			$filename = sprintf('%d.%dx%d.%d', $this->getId(), $newW, $newH,$ts);
			
			//autocreate the directory for storing thumbnails
			$path =self::GetThumbnailPath();
			
			//echo $path;
			
			if(!file_exists($path))
			{
			
				//echo "here at make path";
				mkdir($path, 0777, true);
			}
			
			if(!is_writable($path))
			{
			//echo $path;
				throw new Exception('Unable to write to thumbnail dir: '.$path);
			}
			
			//determin the full path for the new thumbnail
			$thumbPath = sprintf('%s/%s', $path, $filename);
			//echo $thumbPath;
			
			if(!file_exists($thumbPath))
			{
				//read the image into GD
				
				$im = @$infunc($fullpath);
				if(!$im)
				{
					throw new Exception('Unable to read image file');
				}
				//create the output image
				
				//create the output image
				$thumb = ImageCreateTrueColor($newW, $newH); //creating a new image of new hight
				
				//now resample the origianl image to the new image 
				ImageCopyResampled($thumb, $im, 0,0,0,0, $newW, $newH, $w, $h); //converting the image to the new image.
				
				$outfunc($thumb, $thumbPath);  //this writes (the image and the location)
			}
				
			if(!file_exists($thumbPath))
			{
				throw new Exception('Unkonw error occurred creating thumbnail');
			}
			
			if(!is_readable($thumbPath))
			{
				throw new Exception('Unable to read thumbnail');
			}
			
			return $thumbPath; //this returns the paths.
		}
				
				
		public function getFullPath()
		{
			return sprintf('%s/%d', self::GetUploadPath(), $this->getId());
		}
		
		
		public static function GetImagehash($id, $w, $h)
		{
			$id = (int)$id;
			$w = (int)$w;
			$h = (int) $h;
			
			return md5(sprintf('%s,%s,%s', $id, $w, $h));
		}
		
		public static function GetImages($db, $options=array(), $databaseColumn, $table) //table passed not right/
		{
			//initialize the otions
			$defaults = array($databaseColumn =>array());
			
			foreach ($defaults as $k=>$v)
			{
				$options[$k] = array_key_exists($k, $options)?$options[$k]:$v;
			}
			
			$select = $db->select();
			$select->from(array('i'=>$table), array('i.*'));
			
			//filter results on specified post ids (if any)
			if(count($options[$databaseColumn])>0)
			{
				$select->where('i.'.$databaseColumn.' in (?)', $options[$databaseColumn]);
			}
			
			if(!empty($options['limit']))
			{
				$select->limit($options['limit']);
			}
			else
			{
				//$select->limit(12);
			}
			
			
			$select->order('i.ranking');
			
			//echo $select;
			
			//echo "<br/>".$select;
			//fetch post data from database
			$data = $db->fetchAll($select); 
			
			//echo "image data is : ".count($data);
			
			//trun data into array of DtabaseObject_blogpostImge objects
			$images = parent::buildMultiple($db, __CLASS__, $data);
			
			//echo "image: ".count($images);
			return $images;
		}		
		
	}
?>