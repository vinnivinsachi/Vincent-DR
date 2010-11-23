<?php

class Application_Model_Mapper_Products_ProductImagesMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_ProductImages';
	protected $_modelClass = 'Application_Model_Products_ProductImage';

		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	
	
	public function save(Application_Model_Products_ProductImage $image) {
		
		//check for existing order number
		$image->imageOrder = 1;
		$this->fetchOrderNumber('productImages', $image->sourceName, $image->sourceTypeTitle, $image->sourceTypeName, $image->sourceID);
		Zend_Debug::dump($image);
		//parent::save($product);
	} 
	
	public function fetchOrderNumber($imageTable, $sourceName, $sourceTypeTitle, $sourceTypeName, $sourceID){
		$query = sprintf("select coalesce(max(imageOrder),0) + 1 from %s where sourceName = '%s' and sourceTypeTitle= '%s' and sourceTypeName = '%s' and sourceID='%s'", $imageTable, $sourceName, $sourceTypeTitle, $sourceTypeName, $sourceID);
			//this query returnt he next rank after the last insert of images.
			echo $query;
			//$result = ;
			$result = $this->getDbTable()->fetchAll($query);
			$row = $result->current();
			Zend_Debug::dump($row);
			//return $this->loadByQuery($query);
	}
	
	
}
?>