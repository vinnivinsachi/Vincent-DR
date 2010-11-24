<?php

class Application_Model_Products_ProductImage extends Custom_Model_Abstract
{
	
	protected $_primaryIDColumn = 'productImageID';
	protected $_mapperClass = 'Application_Model_Mapper_Products_ProductImagesMapper';
	
	public $productImageID;
	public $sourceName;
	public $sourceTypeTitle;
	public $sourceTypeName;
	public $sourceID;
	public $filename;
	public $imageOrder;
	public $flagged = 0;
	public $dateCreated;
	
	
}

?>