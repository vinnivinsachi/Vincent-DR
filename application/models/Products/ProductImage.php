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
	public $flagged;
	public $dateCreated;
	
	public function __construct(){
		$this->flagged = '0';
		$this->dateCreated = date('Y-m-d H:i:s');
	}
}

?>