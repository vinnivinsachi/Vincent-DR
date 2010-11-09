<?php
		
		class DatabaseObject_StaticUtility extends DatabaseObject
		{
		
			static $tags=array(
			'a' =>array('href', 'target','name'),
			'img' =>array('src', 'alt'),
			'b' =>array(),
			'strong' =>array(),
			'em' =>array(),
			'i' =>array(),
			'ul' =>array(),
			'li' =>array(),
			'ol' =>array(),
			'p' =>array(),
			'br' =>array(),
			);
		
		
/*************************************************************************************
	**load stuff that gives the pagination and also the alphabetics. 
*************************************************************************************/		
		
		
		
		/*************************************************************************************
		**Load Universities
		**FOR: Registration and Location information
		**Input the database
		**Returns an array of universities
		*************************************************************************************/
			public static function loadUniversities($db)
			{
				$select = $db->select();
				
				$select->from('university', '*')
					   ->order('university_name');
				//echo $select;
				return $db->fetchAll($select);
			}
			
			public static function loadUniversityName($db, $id)
			{
				$select = $db->select();
				
				$select->from('university', 'university_name')
					  ->where('university_id = ?', $id)
					  ->order('university_name');
					 
				return $db->fetchOne($select);
			}
			
			public static function addClubNumber($db, $universityId)
			{	
				$select = $db->select();
				
				$select->from('university', 'club_number')
				       ->where('university_id = ?', $universityId);
					   
				$value = $db->fetchOne($select);
			
				$data = array(
   		 						'club_number'      => $value+1
							);

				return $db->update('university', $data, "university_id = '".$universityId."'");
				
			}
			
			
			public static function loadTypes($db)
			{
				$select = $db->select();
				
				$select->from('club_type', '*')
					   ->order('type_description');
				//echo $select;
				return $db->fetchAll($select);
			}
			
			public static function loadTypeName($db, $id)
			{
				$select = $db->select();
				
				$select->from('club_type', 'type_description')
					  ->where('type_id = ?', $id)
					  ->order('type_description');
					 
				return $db->fetchOne($select);
			}
			
			public static function addTypeClubNumber($db, $typeId)
			{	
				$select = $db->select();
				
				$select->from('club_type', 'club_number')
				       ->where('type_id = ?', $typeId);
					   
				$value = $db->fetchOne($select);
			
				$data = array(
   		 						'club_number'      => $value+1
							);
				return $db->update('club_type', $data, "type_id = '".$typeId."'");
				
			
			}
		
		/*************************************************************************************
		**SETTING OBJECT STATUS ACTION
		**FOR:  POSTS, PRODUCTS, EVENTS
		*************************************************************************************/
			public static function setObjectStatusAction(DatabaseObject &$object, $action) //database, the object, the action
			//such as publish, edit, delete.
			{
				if($action =='publish')
				{
					$object->sendLive();
					$object->save();
				}
				else if($action =='unpublish')
				{
					$object->sendBackToDraft();
					//echo "object sent back to draft";
					$object->save();
				
				}
				else if($action =='delete')
				{
					$object->delete();
				}
			}
		
		/*************************************************************************************
		**Verify product for product stat in ordermanager
		**input product id, type of product, and user ID
		**
		**
		*************************************************************************************/	
		public static function verfiyProductStat($db, $productID, $type, $userID)
		{
		
			if($type =='due')
			{
				$product = new DatabaseObject_UniversalDue($db);
				
				$databaseColumn = 'universal_dues_id';
				
			}
			elseif($type=='event')
			{
				$product = new DatabaseObject_Event($db);
				$databaseColumn = 'event_id';

				
			}
			elseif($type =='product')
			{
				$product = new DatabaseObject_Product($db);
				
				
				$databaseColumn = 'product_id';


			}
			elseif($type =='individualDue')
			{
				$product = new DatabaseObject_IndividualDue($db);
				$databaseColumn = 'individual_dues_key';

			}
			
			
			if($databaseColumn=='individual_dues_key')
			{
				$userIdColumn = 'clubAdmin_id';
			}
			else
			{
				$userIdColumn = 'user_id';
			}
			
			
			$query = sprintf('select %s from %s where '.$userIdColumn.' = %d and %s = %d', join(', ', $product->getSelectFields()), $product->_table, $userID, $databaseColumn, $productID);
			
			//echo "<br/>query is: ".$query;
			
			return $db->fetchAll($query);
				
		}
		
			
			
			
			
			
		/*************************************************************************************
		**LOAD OBJECT FOR USERS
		**FOR:  POSTS, PRODUCTS, EVENTS
		**INSERT DATABASEOBJECT HERE. 
		**RETURNS A LIST DATABASE OBJECTS. 
		**USED DIRECTLY IN CONTROLLER
		*************************************************************************************/
			public static function loadObjectForUser(DatabaseObject $object, $user_id, $object_id, $databaseColumn, $options=array())
			{
				
				$userId = (int)$user_id;
				$productId = (int)$object_id;
				
				if($options['status']='ALL')
				{
					$statusQuery = '';
				}
				else
				{
				
					$statusQuery=' and status="L" ';
				}
				
			
				
				if($userId <=0 || $productId <= 0)
				{
					return;
				}
				
				if($databaseColumn=='individual_dues_key')
				{
					$userIdColumn = 'clubAdmin_id';
				}
				else
				{
					$userIdColumn = 'user_id';
				}
				
				
				$query = sprintf('select %s from %s where '.$userIdColumn.' = %d and %s = %d'.$statusQuery.' ', join(', ', $object->getSelectFields()), $object->_table, $userId, $databaseColumn, $productId);
				
				echo "<br/>query is: ".$query;
				return $object->_load($query);
			
			}
						
		
		/*************************************************************************************
		**GENERATE UNIQUE URL
		**FOR:  POSTS, PRODUCTS, EVENTS FOR PUBLIC CLUB VIEWS
		**RETURNS UNIQUE URL STRING
		*************************************************************************************/
			public static function generateUniqueUrl($db, $table, $title, $user_id)
			{
				$url = strtolower($title);
				
				$filters = array(//replace & with 'and' for readability
				'/&+/' => 'and',
				//replace non-alphanumeric haracter with a hyphen
				'/[^a-z0-9]+/i'=>'-',
				//replace multiple hyphens iwth a single hyphen
				'/-+/' =>'-');
				
				//apply each replacement
				foreach($filters as $regex =>$replacement)
				{
					$url = preg_replace($regex, $replacement, $url);
				}
				//remove hyphens from the start and end of string
				$url = trim($url, '-');
				
				//restrict the lenght of th url
				$url = substr($url, 0, 150);
				
				//set a default value just in case
				if(strlen($url)==0)
				{
					$url = 'post';
				}
				
				//find similar URLS
				$query = sprintf("select url from %s where uploader_id=%d and url like ?",
				$table, $user_id); 
				
				$query=$db->quoteInto($query, $url.'%'); //these are zend function
				$result = $db->fetchCol($query);//these are zend function
				
				//if no matching urls then return the current url
				if(count($result)==0 || !in_array($url, $result))
				{
					return $url;
				}
				
				//generate a uniq url
				$i=2;
				do{
					$_url = $url.'-'.$i++;
				}while(in_array($_url,$result));
				
				return $_url; 
			}
			
		public static function replaceSpaceWithDash($title){
			$url = strtolower($title);
					
					$filters = array(//replace & with 'and' for readability
					'/&+/' => 'and',
					//replace non-alphanumeric haracter with a hyphen
					'/[^a-z0-9]+/i'=>'-',
					//replace multiple hyphens iwth a single hyphen
					'/-+/' =>'-');
					
					//apply each replacement
					foreach($filters as $regex =>$replacement)
					{
						$url = preg_replace($regex, $replacement, $url);
					}
					//remove hyphens from the start and end of string
				$url = trim($url, '-');	
				return $url;
		}
			//tagTable must be the name of the tabe in the database.
			
		/*************************************************************************************
		**ADDING / RECEIVING / DELETING / VERIFY CATEGORY TAGS
		**FOR:  POSTS, PRODUCTS, EVENTS
		**USED DIRECTLY IN CONTROLLER
		*************************************************************************************/
			public static function addTagsToObject($tagTable, DatabaseObject &$object, $tagArrayValue, $databaseColumn)
			{
				if(!$object->isSaved())
				{
					return;
				}
				
				if(!is_array($tagArrayValue))
				{
					$tagArrayValue = array($tagArrayValue);
				}
				
				$_tags = array();
				//cleaning the array of $tagArrayValue
				
				foreach ($tagArrayValue as $tag)
				{
					$tag = trim($tag);
					if(strlen($tag)==0)
					{
						continue;
					}
					
					$_tag[strtolower($tag)]=$tag;
				}
				
				//echo "here after foreach.<br/>";
				//now you have to check to see if there is already an exisitng tag. 
				
				//array_map applied the callback to the elements in the given array, in this case, $this->getTags().
				$existingTag = array_map('strtolower', DatabaseObject_StaticUtility::getTagsForObject($object, $tagTable, $databaseColumn));
				
				//echo "at existingTag";
				
				
				foreach($_tag as $lower=>$tag)
				{
					//echo "<br/>here at foreach loop";
					if(in_array($lower, $existingTag))
					{
						//echo "<br/>here at continue";
						continue;  //this tells the current loop to skip to the next iteration, ignoring the current one. 
					}
					
					$data = array($databaseColumn => $object->getId(), 'tag'=>$tag);
					
					$object->_db->insert($tagTable, $data);
					//echo "added";
				}	
			}
			
			//RETURNS DATABASE OBJECTS
			//USED DIRETLY IN CONTROLLER
			public static function getTagsForObject(DatabaseObject $object, $table, $databaseColumn)
			{
				if(!$object->isSaved()) //if not saved, then the tag array would be empty. 
				{
					return array();
				}
				
				$query = sprintf('select tag from %s where %s = ?', $table, $databaseColumn);
				
				$query .= ' order by tag';
				
				//echo $object->getId();				
				return $object->_db->fetchCol($query, $object->getId());
			}
				
			//THIS DELETES THE TAG
			//USED DIRECTLY IN CONTROLLER
			public static function deleteTagsForObject($tagTable, DatabaseObject &$object, $tagArrayValue, $databaseColumn)//table should be the tag table, $databaseColumn should be the "object_id" column
			{
				if(!$object->isSaved())
				{
					return;
				}
				
				if(!is_array($tagArrayValue))
				{
					$tagArrayValue = array($tagArrayValue);
				}
				
				$_tags=array();
				
				foreach($tagArrayValue as $tag)
				{
					$tag = trim($tag);
					
					if(strlen($tag)>0)
					{
						$_tags[] = $tag;
					}
					
					if(count($_tags)==0)
					{
						continue;
					}
				}
				
				$where = array($databaseColumn.'='.$object->getId(), $object->_db->quoteInto('lower(tag) in (?)', $tagArrayValue));
				
				$object->_db->delete($tagTable, $where);
			}
			
			
			//THIS RETURNS A SUMMARY OR AN ARRAY
			public static function getTagSummaryForObject($db, $user_id, $tagTable, $catTable, $objectTable, $objectStatusFilter, $innerJoinColumn, $cat='')//the database, the user_id, the object table, the respective tag table, and the status of the objects that would like to be retrieved., last cat is 1 when you want cat and tag to be together. 
			{
			
				if($cat =='')
				{
				
				$select = $db->select();
				
				$select->from(array('t'=>$tagTable), array('count(*) as count', 't.tag')) //make sure that all tagTable have the element tag
				 	   ->joinInner(array('o'=>$objectTable), 'o.'.$innerJoinColumn.'=t.'.$innerJoinColumn)
					   ->where('o.user_id = ?', $user_id)
					   ->group('t.tag');

					if($objectStatusFilter !='all')
					{
						   
						$select->where('o.status = ?', $objectStatusFilter);
					}
				}
				else
				{
				
				$select = $db->select();
				
				$select->from(array('t'=>$tagTable), array('count(*) as count', 't.tag as cat')) //make sure that all tagTable have the element tag
				 	   ->joinInner(array('o'=>$objectTable), 'o.'.$innerJoinColumn.'=t.'.$innerJoinColumn)
					   ->joinInner(array('c' =>$catTable), 'c.product_id = o.product_id')
					 
					   ->where('o.user_id = ?', $user_id)
					   ->where('c.tag = ?', $cat)
					   ->group('t.tag');
					   
					   if($objectStatusFilter !='all')
					{
						   
						$select->where('o.status = ?', $objectStatusFilter);
					}
				
				}
				
				//echo $select;
				
				$result = $db->query($select);
				$tags = $result->fetchAll();
				
				
				if($cat =='')
				{
					$summary = array();
					foreach ($tags as $tag)  //['tag'] is now added to the sumary[$_tag] array. so ($summary[$_tag]['tag'])
					{
						$_tag = strtolower($tag['tag']);
						
						//echo "_tag is: ".$_tag;
						
						if(array_key_exists($_tag, $summary))
						{
							$summary[$_tag]['count'] += $tag['count'];
						}
						else
						{
							$summary[$_tag] = $tag;
						}
					
					}
					
					return $summary;	
				}
				else
				{
					return $tags;
				}
				
				
						//in templates, $summary.tag??? or $tag.tag
			
			} 
			
			/*******************************************************************
			**HAS TAG
			**RETURNS A STRING CONTAINING THE QUERY THAT STATES THE EXISTANCE 
			**OF A TAG IN AN OBJECT
			*******************************************************************/
			
			public static function hasTag($db, $tag, $tagTable, $databaseColumn, $id)
			{
				$select = $db->select;
				
				$select->from($tagTable, 'count(*)')
				       ->where($databaseColumn.'= ?', $id)
					   ->where('lower(tag) = lower(?)', trim($tag));
					   
				//original code
				/*
				$select = $this->_db->select;
				$select->from('blog_posts_tags', 'count(*)')
					   ->where('post_id =? ', $this->getId())
					   ->where('lower(tag) = lower(?)', trim($tag));
				//*/
				
				return $select;
			}
					   
			
			
			/*******************************************************************
			**QUERIES
			**FOR EXTRACTING OBJECTS/ITEMS FROM DATABASE 
			**CAUTION: ALL TABLES AND COLUMNS AND ARRAYS MUST CONTAIN 
			**INFORMATION DIRECTLY RELATED TO TABLES AND COLUMNS AND ROWS IN 
			**THE DATABASE
			
			**RETURNS A QUERY
			*******************************************************************/
			
			public static function _GetBaseQuery($db, $options, $databaseColumn, $objectTable, $tagTable, $shortKey) 
			{
			
				$defaults = array(
						'user_id' => array(), //this is for loading with posts/events/products
						//'userID'  => array(), //this is for loading with affiliations/users/
						'from'    => '',
						'to'      => '',
						'tag'     => '',
						'status'  => '',
						'cat'     => ''
						);
				
				
				foreach ( $defaults as $k => $v)
				{
					
					$options[$k] = array_key_exists($k, $options)?$options[$k]:$v;
				}
				
				$select = $db->select();
				
				$select->from(array($shortKey=>$objectTable), array());
				
				if(strlen($options['from'])>0)
				{
					$ts = strtotime($options['from']);
					$select->where($shortKey.'.ts_created >= ?', date('Y-m-d H:i:s', $ts));
				}
				
				if(strlen($options['to'])>0)
				{
					$ts = strtotime($options['to']);
					$select->where($shortKey.'.ts_created <= ?', date('Y-m-d H:i:s', $ts));
				}
				
				
				if(count($options['user_id'])>0)
				{
					$select->where($shortKey.'.user_id in(?)', $options['user_id']);
				}

				if(strlen($options['status'])>0)
				{
					$select->where('status=?', $options['status']);
				}
				
				
				
				$options['tag'] = trim($options['tag']);
				$options['cat'] = trim($options['cat']);
				if(strlen($options['tag'])>0 && $options['tag']!="none")
				{
					$select->joinInner(array('t'=>$tagTable), 't.'.$databaseColumn.'='.$shortKey.'.'.$databaseColumn, array())
						   ->where('lower(t.tag) = lower(?)', $options['tag']);
				}
				elseif(strlen($options['cat'])>0 && $options['cat']!="none")
				{
					
					
						$select->joinInner(array('t'=>$tagTable), 't.'.$databaseColumn.'='.$shortKey.'.'.$databaseColumn, array())
							   ->where('lower(t.tag) = lower(?)', $options['cat']);
					
				}
				
				//echo $select."<br/>";
				return $select;
			}
			
			
			public static function GetMonthlySummary($db, $options, $databaseColumn, $objectTable, $tagTable, $shortKey)
			{
				if($db instanceof Zend_Db_Adapter_Pdo_Mysql)
				{
					$dateString = "date_format(".$shortKey.".ts_created, '%Y-%m')";
				}
				else
				{
					$dateString="to_char(".$shortKey.".ts_created, 'yyyy-mm')";
				}
				
				$defaults = array('offset'=>0, 'limit'=>0, 'order'=>$dateString.'desc');

				foreach($defaults as $k=>$v)
				{
					$options[$k] = array_key_exists($k, $options)?$options[$k]:$v;
				}
			
				$select = self::_GetBaseQuery($db, $options, $databaseColumn, $objectTable, $tagTable, $shortKey);
				
				$select->from(null, array($dateString. ' as month', 'count(*) as num_posts'));
				$select->where('user_id', $options['user_id']);
				$select->group($dateString);
				$select->order($options['order']);
				return $db->fetchPairs($select);

			}
			
			/*******************************************************************
			**LOAD LIVE OBJECTS, SUCH AS LIVE POSTS, PRODUCTS, EVENTS, MEMBERSHIPS
			**RETURNS A QUERY
			*******************************************************************/
			public static function loadLiveObjects($db, $user_id, $url, $table, $fields, $status)
			{
				
				$user_id = (int)$user_id;
				$url = trim($url);
				
				if($user_id<=0 || strlen($url)==0)
				{
					return false;
				}
				
				$select = $db->select();
				
				$select->from($table, $fields)
			       ->where('user_id=?', $user_id)
				   ->where('url=?', $url)
				   ->where('status=?',$status);
				
				//echo "<br/>loadlive: ".$select."<br/>";
				
				
				return $select;			
			}
			
			/*******************************************************************
			**GET TEASER FOR CONTENT STUFF
			**RETURN RESULT
			*******************************************************************/
			public static function GetTeaser($content, $length)
			{
				require_once('Smarty/plugins/modifier.truncate.php');
				return smarty_modifier_truncate(strip_tags($content), $length);
			}
			
			
			/*******************************************************************
			**IMAGES
			**FOR POSTS / PRODUCTS / EVENTS / MEMBERSHIPS
			*******************************************************************/
			public static function setImageOrder($db, $databaseColumn, $order, $image)
			{
				if(!is_array($order))
				{
					//echo "your order is not an array";
					return;
				}
				
				$newOrder = array();
				
				//echo "here at imageorder";
				foreach($order as $image_id)
				{
					//echo "image id is: ".$image_id;
					if(array_key_exists($image_id, $image))
					{
						//echo "image id is: ".$image_id;
						$newOrder[]=$image_id;
					}
					
				}
				
				$newOrder = array_unique($newOrder);
				
				if(count($newOrder) != count($image))
				{
					return;
				}
				
				$rank =1;
				
				//echo count($newOrder);
				//echo "<br/>at foreach";
				foreach($newOrder as $image_id)
				{
					//echo "<br/>before update";
					$db->update($databaseColumn, array('ranking'=>$rank), 'image_id='.$image_id);
					//echo "at update";
					$rank++;
				}
		
			}
			
			public static function setPostOrder($db, $databaseColumn, $order, $post, $tier)
			{
				if(!is_array($order))
				{
					//echo "your order is not an array";
					return;
				}
				
				$newOrder = array();
				
				//echo "here at imageorder";
				foreach($order as $post_id)
				{
					//echo "image id is: ".$image_id;
					if(array_key_exists($post_id, $post))
					{
						//echo "image id is: ".$image_id;
						$newOrder[]=$post_id;
					}
					
				}
				
				$newOrder = array_unique($newOrder);
				
				if(count($newOrder) != count($post))
				{
					return;
				}
				
				$rank =1;
				
				//echo count($newOrder);
				//echo "<br/>at foreach";
				foreach($newOrder as $post_id)
				{
					//echo "<br/>before update";
					$db->update($databaseColumn, array('ranking'=>$rank), 'post_id='.$post_id);
					//echo "at update";
					$rank++;
				}
		
			}
			
			/*******************************************************************
			**SHOPPINGCART VERFICATION
			**SHOPPINGCART ONLY
			**RETURNS TRUE IF USERNAME AND PRODUCT IS VALID, FALSE OTHERWISE
			*******************************************************************/
			
			public static function verifiyShoppingInput($db, $username, $productID, $databaseColumn, $productType)
			{
				$user = new DatabaseObject_User($db);  
				
				if(!$user->loadByUsername($username, 'clubAdmin', 'L'))  //this make sure that the user exist
				{
					echo "no such club";
					return false;
				}
				
				echo "you are at after loadbyusername";
				echo "<br/>userID is: ".$user->getID();
				if($productType == 'product')
				{
					$product = new DatabaseObject_Product($db);
				}
				elseif($productType =='event')
				{
					$product = new DatabaseObject_Event($db);
				}
				elseif($productType=='due')
				{
					$product= new DatabaseObject_UniversalDue($db);
				}
				elseif($productType=='individualDue')
				{
					$product= new DatabaseObject_IndividualDue($db);
				}
				
				if(!DatabaseObject_StaticUtility::loadObjectForUser($product, $user->getId(), $productID, $databaseColumn)) //this make sure that the product match the user. 
				{
					//echo "no such product exist";
					return false;
				}
				
				
				if(empty($_SESSION['shoppingClubID']))
				{
					return $product;
				}
				elseif( !empty($_SESSION['shoppingClubID']) && $product->user_id == $_SESSION['shoppingClubID'])
				{
				return $product;
				}
				else
				{
					return false;
				}
			}
			
			
			/*this function loads all the profile Attributes of a specific profile in the cart*/
			public static function loadCartProfileAttribute($db, $profileID)
			{
				$select = $db->select();
				$select->from('shopping_cart_profile_attribute')
				->where('profile_id = ?', $profileID);
				
				return $db->fetchAll($select);
			
			}
			
			public static function insertOrderProfileAttribute($db, $profile_id, $attribute = array())
			{
				
				$attribute['profile_id']=$profile_id;
				$db->insert('orders_profile_attribute', $attribute);
			
			}

			
			
			/* updating inventory*/
		/*	public static function addToInventoryHolder($db, $cart_id, $invID, $quantity)
			{
			
				$inv_product = new DatabaseObject_Invprofile($this->db);
				
				$inv_product->loadItem($invID);
				
				if($inv_product->quantity == 0}
				{
					return false;
				}
				else
				{
					$inv_product->quantity = $inv_product->quantity-1;
					
				}
			
			
			
			}
			*/
			/*cleans any nasty inputs*/
			public static function cleanHtml($html)
			{
				$chain = new Zend_filter();
				$chain->addFilter(new Zend_Filter_StripTags(self::$tags));
				$chain->addFilter(new Zend_Filter_StringTrim());
				$chain = new Zend_Filter_HtmlEntities();
				
				$html = $chain->filter($html);
				$html = stripslashes($html);
			
				//echo $html;
				$temp = $html;			
			while(1)
				{
					$html = preg_replace('/(<[^>]*)javascript:([^>]*>)/i', '$1$2', $html);
					
					//if nothing changed this iteration then break the loop
					if($html==$temp)
					{
						break;
					}
					
					$temp = $html;
				}
					
	
				return $html;
			}
			
			
			public static function show_php($var,$indent='&nbsp;&nbsp;',$niv='0')
			{
				$str='';
				if(is_array($var))    {
					$str.= "<b>[array][".count($var)."]</b><br />";
					foreach($var as $k=>$v)        {
						for($i=0;$i<$niv;$i++) $str.= $indent;
						$str.= "$indent<em>\"{$k}\"=></em>";
						$str.=self::show_php($v,$indent,$niv+1);
					}
				}
				else if(is_object($var)) {
			
					$str.= "<b>[objet]-class=[".get_class($var)."]-method=[";
					$arr = get_class_methods($var);
					   foreach ($arr as $method) {
						   $str .= "[function $method()]";
					   }
					$str.="]-";
					$str.="</b>";
					$str.=show_php(get_object_vars($var),$indent,$niv+1);
				}
				else {
					$str.= "<em>[".gettype($var)."]</em>=[{$var}]<br />";
				}
				return($str);
							
							
			}	
		}
?>