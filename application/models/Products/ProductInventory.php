<?php

class Application_Model_Products_ProductInventory extends Custom_Model_Abstract
{
	
	protected $_primaryIDColumn = 'productInventoryID';
	protected $_mapperClass = 'Application_Model_Mapper_Products_ProductInventoriesMapper';
	
	public $productInventoryID;
	public $productID;
	public $sys_name;
	public $sys_metric_type;
	public $sys_shoe_size;
	public $sys_shoe_heel;
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
	public $dateUpdated;
}
?>