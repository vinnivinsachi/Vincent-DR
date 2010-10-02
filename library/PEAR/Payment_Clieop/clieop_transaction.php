<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Dave Mertens <dmertens@zyprexia.com>                        |
// +----------------------------------------------------------------------+
//
// $Id: clieop_transaction.php,v 1.7 2003/01/04 11:56:14 mj Exp $

//Define some constants for easy programming  ;-)

/**
* Constant for debtor transactions
* @const CLIEOP_TRANSACTIE_INCASSO Clieop transaction code for debtor transactions
*/
define( "CLIEOP_TRANSACTIE_INCASSO", "10" );	//Incasso transaction type (debtor)

/**
* Constant for creditor transactions
* @const CLIEOP_TRANSACTIE_BETALING Clieop transaction code for creditor transactions
*/
define( "CLIEOP_TRANSACTIE_BETALING", "00" ); 	//betaling transaction type (creditor)

/**
* Data holder for payment post
*
* Please note that some function names are partly in Dutch. Clieop03 is
* a Dutch banking standard and they have chosen to use Dutch line descriptions
*
* The TransactionPayment class is a data-holder for the main clieop class.
*
* @version $Revision: 1.7 $
* @access public
* @package Payment_Clieop
* @author Dave Mertens <dmertens@zyprexia.com>
*/
class TransactionPayment
{
	/**
	* @var string
	* @access private
	* @values 0000 (creditor) or 1002 (Debtor)
	*/
	var $_TransactionType;

	/**
	* @var numeric string
	* @access private
	* @values CREDITOR or DEBTOR
	*/
	var $_TransactionName;

	/**
	* @var integer
	* @access private
	*/
	var $_Amount;

	/**
	* @var string
	* @access private
	*/
	var $_AccountNumberSource;

	/**
	* @var string
	* @access private
	*/
	var $_AccountNumberDest;

	/**
	* @var string
	* @access private
	*/
	var $_InvoiceReference;

	/**
	* @var string
	* @access private
	*/
	var $_Type;

	/**
	* @var string
	* @access private
	*/
	var $_Name;

	/**
	* @var string
	* @access private
	*/
	var $_City;

	/**
	* @var string
	* @access private
	*/
	var $_Desciption;
	
	/**
	* Constructor for class
	* @param string transactionType		- constant CLIEOP_TRANSACTIE_INCASSO or CLIEOP_TRANSACTIE_BETALING
	* @return void
	* @access public
	*/
	function TransactionPayment($transactionType)
	{
		$this->_Description = array();
		if ($transactionType == "00")
		{
			//creditor payment
			$this->_TransactionType = "0000";
			$this->_TransactionName = "CREDITOR";
		}
		else
		{
			//debtor payment
			$this->_TransactionType = "1002";
			$this->_TransactionName = "DEBTOR";
		}
	}
	
	/**
	* Fetch payment type
	* @return string
	* @access public
	*/
	function getPaymentType()
	{
		return $this->_TransactionName;	//return type of class
	}
	
	/**
	* return transaction type
	* @return string
	* @access public
	*/
	function getTransactionType()
	{
		return $this->_TransactionType;	//return special transaction type
	}

	/**
	* Property amount (in Eurocents)
	* @param integer Value	- Payment amount in euro cents (Rounded on 2 digits)
	* @return integer
	* @access public
	*/
	function getAmount()
	{
		return $this->_Amount;
	}
	function setAmount($Value)
	{
		$this->_Amount = $Value;	
	}
	
	/**
	* property AccountNumberSource
	* @param string Value	- Source bank account number (Max 10 tokens)
	* @return string
	* @access public
	*/
	function getAccountNumberSource()
	{
		return $this->_AccountNumberSource;
	}
	function setAccountNumberSource($Value)
	{
		$this->_AccountNumberSource = $Value;
	}
	
	/**
	* property AccountNumberDest
	* @param string Value	- Destination bankaccount number
	* @return string
	* @access public
	*/
	function getAccountNumberDest()
	{
		return $this->_AccountNumberDest;
	}
	function setAccountNumberDest($Value)
	{
		$this->_AccountNumberDest = $Value;
	}
	
	/**
	* property InvoiceReference 
	* @param string Value	- Invoice reference (Max 16 tokens)
	* @return string
	* @access public
	*/
	function getInvoiceReference()
	{
		return $this->_InvoiceReference;
	}
	function setInvoiceReference($Value)
	{
		$this->_InvoiceReference = $Value;
	}
	
	/**
	* property Name
	* @param string Value	- Name of creditor or debtor
	* @return string
	* @access public
	*/
	function getName()
	{
		return $this->_Name;
	}
	function setName($Value)
	{
		$this->_Name = $Value;
	}
	
	/**
	* property City
	* @param string Value	- City of creditor or debtor
	* @return string
	* @access public
	*/
	
	function getCity()
	{
		return $this->_City;
	}
	function setCity($Value)
	{
		$this->_City = $Value;
	}
	
	/**
	* property Description
	* @param string Value	- Description for payment (Maximum 4 description lines)
	* @return array
	* @access public
	*/
	function getDescription()
	{
		//return description array
		return $this->_Description;	
	}
	function setDescription($Value)
	{
		//only 4 descriptions are allowed for a payment post
		if (sizeof($this->_Description) < 5)
		{
			$this->_Description[] = $Value;
		}
	}
}


?>