<?php

class Application_Model_Products_ProductInventory extends Custom_Model_Abstract
{
	public $productInventoryID;
	public $productID;
	public $uploaderID;
	public $sys_name;
	public $sys_metric_type;
	public $sys_shoe_size;
	public $sys_heel_height;
	public $sys_fullbody_size;
	public $sys_top_size;
	public $sys_bottom_size;
	public $sys_price;
	public $sys_video;
	public $sys_quantity;
	public $sys_description;
	public $sys_conditions;
	public $sys_color;
	public $dateCreated;
	
	//attaching an arbitrary data holder
	private $_profiles;
	//attaching an image holder 
	private $_images;
	
	public function setProfile(Application_Model_Products_ProductInventoryProfiles $profile){	
		$this->_profiles = $profile;
	}
	
	public function getProfile(){
		return $this->_profiles;
	}
	
}