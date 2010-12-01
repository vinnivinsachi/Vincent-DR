<?php

class Application_Model_Products_ProductColor extends Custom_Model_Abstract
{
	protected $_primaryIDColumn = 'productColorID';
	protected $_mapperClass = 'Application_Model_Mapper_Products_ProductColorsMapper';
	
	public $productColorID;
	public $productID;
	public $Black;
	public $Pin_stripe;
	public $Light_tan;
	public $Dark_tan;
	public $Brown;
	public $Silver;
	public $Gold;
	public $Gray;
	public $White;
	public $Red;
	public $Pink;
	public $Orange;
	public $Yellow;
	public $Green;
	public $Cyan;
	public $Blue;
	public $Magenta;
	public $Purple;
	public $Clear;
	public $Multicolor;
	public $Monocolor;
	
	
}

?>