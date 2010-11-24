<?php

class Application_Model_Mapper_Products_ProductImagesMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_ProductImages';
	public $_modelClass = 'Application_Model_Products_ProductImage';

		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	
	
	public function save(Application_Model_Products_ProductImage $image) {
		
		//check for existing order number
		$image->imageOrder = $this->fetchOrderNumber($image);
		
		
		Zend_Debug::dump($image);
		return parent::save($image);
	} 
	
	
	public function fetchOrderNumber(Application_Model_Products_ProductImage $image){
		
			$select = $this->getDbTable()->select();
			$select->from($this->getDbTable(), "coalesce(max(imageOrder),0) + 1 as imageOrder")
			->where('sourceName = ?', $image->sourceName)
			->where('sourceTypeTitle = ?', $image->sourceTypeTitle)
			->where('sourceTypeName = ?', $image->sourceTypeName)
			->where('sourceID = ?', $image->sourceID);
			echo $select;
			$result= $this->getDbTable()->fetchAll($select);
			return $result[0]['imageOrder'];
	}	
}
?>