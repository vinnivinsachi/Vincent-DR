<?php
class Application_Model_DbTable_Products_ProductInventoryProfile extends Zend_Db_Table_Abstract
{
    protected $_name = 'productInventoryProfiles';
	protected $_primary = 'profileInventoryProfilesID';
	public $associatedObjectIDColumn = 'productInventoryID';

}
?>