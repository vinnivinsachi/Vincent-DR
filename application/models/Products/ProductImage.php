<?php

class Application_Model_Products_ProductImage extends Custom_Model_Abstract
{
	public $productImageID;
	public $sourceName;
	public $sourceTypeTitle;
	public $sourceTypeName;
	public $sourceID;
	public $filename;
	public $imageOrder;
	public $flagged = 0;
	public $dateCreated;
	
	protected $mapperClass = 'Application_Model_Mapper_Products_ProductImagesMapper';
}

?>