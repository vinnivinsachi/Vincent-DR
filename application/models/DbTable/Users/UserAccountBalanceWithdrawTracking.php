<?php

class Application_Model_DbTable_Users_UserAccountBalanceWithdrawTracking extends Zend_Db_Table_Abstract
{
    protected $_name = 'userAccountBalanceWithdrawTracking';
	protected $_primary = 'userAccountBalanceWithdrawTrackingID';
	public $uniqueIDColumn = 'userAccountBalanceWithdrawTrackingUniqueID';

}
?>