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
// $Id: clieop.php,v 1.14 2003/01/28 14:29:52 zyprexia Exp $
/*
 Please note that public function names are partly in Dutch. This is because 
 also the clieop data strings has a dutch names. (batchvoorloopinfo, transactieinfo, etc).
 */

/**
* Main clieop class
*
* @version $Revision: 1.14 $
* @access public
* @author Dave Mertens <dmertens@zyprexia.com>
* @package Payment_Clieop
*/
class ClieopPayment extends clieop_baseobject
{
	/**
	* @var string
	* @access private
	*/
	var $_SenderIdent;

	/**
	* @var string
	* @access private
	*/
	var $_FileIdent;

	/**
	* @var string
	* @access private
	*/
	var $_TransactionType;

	/**
	* @var string
	* @access private
	*/
	var $_ClieopText;

	/**
	* @var string
	* @access private
	*/
	var $_PrincipalAccountNumber;

	/**
	* @var string
	* @access private
	*/
	var $_PrincipalName;

	/**
	* @var integer
	* @access private
	*/
	var $_BatchNumber;

	/**
	* @var integer
	* @access private
	*/
	var $_TransactionCount;

	/**
	* @var integer
	* @access private
	*/
	var $_TotalAmount;

	/**
	* @var string
	* @access private
	*/
	var $_AccountChecksum;

	/**
	* @var string
	* @access private
	*/
	var $_Description;

	/**
	* @var date (in DDMMYY format)
	* @access private
	*/
	var $_ProcessDate;

	/**
	* @var boolean
	* @access private
	*/
	var $_Test;

	/**
	* @var string
	* @access private
	*/
	var $_TransactionText;

	/**
	* Constructor for class
	* @return void
	* @access public
	*/
	function clieopPayment()
	{
		//init vars
		$this->_ProcessDate = "000000";	//process ASAP
		$this->_BatchNumber = 1;
		$this->_Test = "T";
		return 1;
	}

	/**
	* Adds a payment record to the clieop file
	* @param object paymentObject	- Instance of transactionPayment
	* @access public
	* @return void
	*/
	function addPayment($paymentObject)
	{
		//Only one type of transaction is allowed in a clieop
		if ($this->_TransactionType == $paymentObject->getPaymentType())
		{
			//transactieinfo (0100)
			$text = $this->writeTransactieInfo($paymentObject->getTransactionType(),
				$paymentObject->getAmount(),
				$paymentObject->getAccountNumberSource(),
				$paymentObject->getAccountNumberDest());
				
			// Debtor name ans city
			if (strtoupper($this->_TransactionType) == "DEBTOR")
			{
				//name of debtor (0110)
				$text .= $this->writeNaambetalerInfo($paymentObject->getName());

				//city of debtor (0113)
				$text .= $this->writeWoonplaatsbetalerInfo($paymentObject->getCity());
			}
			
			//betalings kenmerk (0150)
			$text .= $this->writeBetalingskenmerkInfo($paymentObject->getInvoiceReference());
			
			//maximum 4 description lines (0160)
			$descArray = $paymentObject->getDescription();
			while(list($id,$desc) = each($descArray))
			{	
				$text .= $this->writeOmschrijvingInfo($desc);	
			}
			
			//routine splits here into creditor and debtor
			if (strtoupper($this->_TransactionType) == "CREDITOR")
			{
					//name of creditor (0170)
					$text .= $this->writeNaambegunstigdeInfo($paymentObject->getName());
			
					//city of creditor (0173)
					$text .= $this->writeWoonplaatsbegunstigdeInfo($paymentObject->getCity());
			}
			
			//do some calculations
			$this->_NumberOfTransactions++;
			//accoutnumber checksum
			$this->_AccountChecksum += (int)$paymentObject->getAccountNumberSource() + (int)$paymentObject->getAccountNumberDest();
			$this->_TotalAmount += $paymentObject->getAmount();
		}
		$this->_TransactionText .= $text;
	}
	
	/**
	* Writes complete clieop file
	* @access public
	* @return string
	*/
	function writeClieop()
	{
		$text  = $this->writeBestandsvoorloopInfo($this->_SenderIdent, $this->_BatchNumber);
		$text .= $this->writeBatchvoorloopInfo($this->_PrincipalAccountNumber, $this->_BatchNumber);
		$text .= $this->writeVasteomschrijvingInfo($this->_FixedDescription);
		$text .= $this->writeOpdrachtgeverInfo($this->_ProcessDate, $this->_PrincipalName);
		$text .= $this->_TransactionText;
		$text .= $this->writeBatchsluitInfo();
		$text .= $this->writeBestandssluitInfo();
		
		//return clieop file
		return $text;
	}
	
	/**
	* property BatchNumber
	* @param integer Value	- Number of batches send to day (including this one)
	* @return string
	* @access public
	*/
	function getBatchNumber()
	{
		return $this->_BatchNumber;
	}
	function setBatchNumber($Value)
	{
		$this->_BatchNumber = $Value;
	}
	
	/**
	* property FixedDescription
	* @param string Value	- Description which will be added to each transaction payment
	* @return string
	* @access public
	*/
	function getFixedDescription()
	{
		return $this->_FixedDescription;
	}
	function setFixedDescription($Value)
	{
		$this->_FixedDescription = $Value;
	}
	
	/**
	* property SenderIdentification
	* @param string Value	- Identification of sender, free of choice
	* @return string
	* @access public
	*/
	function getSenderIdentification()
	{
		return $this->_SenderIdent;
	}
	function setSenderIdentification($Value)
	{
		$this->_SenderIdent = $Value;
	}
	
	/**
	* property PrincipalName
	* @param string Value	- Name of principal
	* @return string
	* @access public
	*/
	function getPrincipalName()
	{
		return $this->_PrincipalName;
	}
	function setPrincipalName($Value)
	{
		$this->_PrincipalName = $Value;
	}
	
	/**
	* property PrincipalAccountNumber
	* @param string Value	- Account number of principal
	* @return string
	* @access public
	*/
	function getPrincipalAccountNumber()
	{
		return $this->_PrincipalAccountNumber;
	}
	function setPrincipalAccountNumber($Value)
	{
		$this->_PrincipalAccountNumber = $Value;
	}
	
	/**
	* property TransactionType
	* @param string Value	- transaction type
	* @return string
	* @access public
	*/
	function getTransactionType()
	{
		return $this->_TransactionType;
	}
	function setTransactionType($Value)
	{
		switch($Value)
		{
			case "00":	//BETALING
				$this->_TransactionType = "CREDITOR";
				$this->_TransactionCode = "00";
				break;
			case "10":	//INCASSO
				$this->_TransactionType = "DEBTOR";
				$this->_TransactionCode = "10";
				break;
		}
	}
	
	/**
	* property Test
	* @param boolean Value	- true = test clieop, false = production clieop
	* @return string
	* @access public
	*/
	function getTest()
	{
		return $this->_Test;
	}
	function setTest($Value)
	{
		if ($Value == false)
			$this->_Test = "P";	//production clieop
		else
			$this->_Test = "T";	//test clieop
	}
		
	
	/**
	* INFOCODE: 0100
	* Writes transaction header
	* @param string transType			- Type of transaction ('0000' for betaling, '1002' for incasso)
	* @param integer amount				- Payment amount in Eurocents
	* @param string accountNumberSource	- Source bankaccount number 
	* @param string accountNumberDest	- Destination bankaccount number
	* @access private
	* @return string
	*/
	function writeTransactieInfo($transType, $amount, $accountNumberSource, $accountNumberDest)
	{
		$text  = "0100";										//infocode
		$text .= "A";											//variantcode
		$text .= $this->numFiller($transType, 4);				//transactiesoort
		$text .= $this->numFiller($amount, 12);					//Bedrag
		$text .= $this->numFiller($accountNumberSource, 10);	//Reknr betaler
		$text .= $this->numFiller($accountNumberDest, 10);		//Reknr begunstigde
		$text .= $this->filler(9);
		
		//return clieop line
		return $text;
	}
	
	/**
	* INFOCODE: 0150
	* Writes invoice reference clieop line
	* @param string invoiceReference	- Reference of invoice
	* @access private
	* @return string
	*/
	function  writeBetalingskenmerkInfo($invoiceReference)
	{
		$text  = "0150";									//infocode
		$text .= "A";										//variantcode
		$text .= $this->alfaFiller($invoiceReference, 16);	//betalings kenmerk
		$text .= $this->filler(29);
		
		//return clieop line
		if (strlen($invoiceReference) > 0) return $text;	//only return string if there's really a value
	}	

	/**
	* INFOCODE: 0160
	* Writes an description for the clieop file
	* @param string description	- Description of payment (Can be called maximum 4 times!)
	* @access private
	* @return string
	*/
	function writeOmschrijvingInfo($description)
	{
		$text  = "0160";									//infocode
		$text .= "A";										//variantcode
		$text .= $this->alfaFiller($description, 32);		//omschrijving van post
		$text .= $this->filler(13);
		
		//return clieop line
		return $text;
	}
	
	/**
	* INFOCODE: 0170
	* Write the creditor name record 
	* @param string name 	- Name of creditor
	* @access private
	* @return string
	*/
	function writeNaambegunstigdeInfo($name)
	{
		$text  = "0170";									//infocode
		$text .= "B";										//variantcode
		$text .= $this->alfaFiller($name, 35);				//naam begunstigde
		$text .= $this->filler(10);
		
		//reurn clieop line
		return $text;
	}

	/**
	* INFOCODE: 0173
	* Write the creditor city record 
	* @param string city 	- City of creditor
	* @access private
	* @return string
	*/
	function writeWoonplaatsbegunstigdeInfo($city)
	{
		$text  = "0173";									//infocode
		$text .= "B";										//variantcode
		$text .= $this->alfaFiller($city, 35);				//woonplaats begunstigde
		$text .= $this->filler(10);
		
		//reurn clieop line
		return $text;
	}
	/**
	* INFOCODE: 0110
	* Write the debtor name record 
	* @param string name 	- Name of debtor
	* @access private
	* @return string
	*/
	function writeNaambetalerInfo($name)
	{
		$text  = "0110";									//infocode
		$text .= "B";										//variantcode
		$text .= $this->alfaFiller($name, 35);				//naam betaler
		$text .= $this->filler(10);
		
		//reurn clieop line
		return $text;
	}

	/**
	* INFOCODE: 0113
	* Write the debtor city record 
	* @param string city 	- City of debtor
	* @access private
	* @return string
	*/
	function writeWoonplaatsbetalerInfo($city)
	{
		$text  = "0113";									//infocode
		$text .= "B";										//variantcode
		$text .= $this->alfaFiller($city, 35);				//woonplaats betaler
		$text .= $this->filler(10);
		
		//reurn clieop line
		return $text;
	}
	
	/**
	* INFOCODE: 0001
	* Write clieop header 
	* @param string identifier	- 5 char sender identification (free of choice)
	* @param integer batchCount	- Numbers of clieop batches send today + 1
	* @access private
	* @return string
	*/
	function writeBestandsvoorloopInfo($identifier, $batchCount)
	{
		$text  = "0001";										//infocode
		$text .= "A";											//variantcode
		$text .= date("dmy");									//aanmaak datum
		$text .= "CLIEOP03";									//bestands naam
		$text .= $this->alfaFiller($identifier, 5);				//afzender identificatie
		$text .= date("d") . $this->numFiller($batchCount, 2);	//bestands identificatie 
		$text .= "1";											//duplicaat code
		$text .= $this->filler(21);	
		
		//return cliep line
		return $text;
	}
	
	/**
	* INFOCODE: 9999
	* Write clieop footer 
	* @access private
	* @return string
	*/
	function writeBestandssluitInfo()
	{
		$text  = "9999";									//infocode
		$text .= "A";										//variantcode
		$text .= $this->filler(45);
		
		//return cleip line
		return $text;
	}
	
	/**
	* INFOCODE: 0010
	* Write clieop batchvoorloopinfo
	* @param string principalAccountNumber	- Account number of principal
	* @param integer batchCount				- Number of batches send this month (including this one) 
	* @access private
	* @return string
	*/
	function writeBatchvoorloopInfo($principalAccountNumber, $batchCount)
	{	
		$text  = "0010";										//infocode
		$text .= "B";											//variantcode
		$text .= $this->numFiller($this->_TransactionCode, 2);	//transactiegroep (00 = betaling, 10 = incasso)
		$text .= $this->numFiller($principalAccountNumber, 10);	//rekening nummer opdrachtgever
		$text .= $this->numFiller($batchCount, 4);				//batch volgnummer
		$text .= "EUR";											//aanlevering muntsoort
		$text .= $this->filler(26);
		
		//return clieop line
		return $text;
	}
	
	/**
	* INFOCODE: 0020
	* Write clieop batchvoorloopinfo
	* @access string description	- Fixed description for all payments
	* @access private
	* @return string
	*/
	function writeVasteomschrijvingInfo($description)
	{
		$text  = "0020";										//infocode
		$text .= "A";											//variantcode
		$text .= $this->alfaFiller($description, 32);			//vaste omschrijving
		$text .= $this->filler(13);
		
		//return clieop line
		if (strlen($description) > 0) return $text;				//only return string if there is REALLY a description
	}

	/**
	* INFOCODE: 0030
	* Write opdrachtegever clieop line
	* @param date processDate		- Process date in DDMMYY-format
	* @param string principalName	- Name of pricipal
	* @access private
	* @return string
	*/
	function writeOpdrachtgeverInfo($processDate, $principalName)
	{
		$text  = "0030";										//infocode
		$text .= "B";											//variantcode
		$text .= "1";											//NAWcode
		$text .= $this->numFiller($processdate, 6);				//verwerkings datum
		$text .= $this->alfaFiller($principalName, 35);			//naam opdracht gever
		$text .= $this->_Test;									//TESTcode (T = Test, P = Productie)
		$text .= $this->filler(2);
		
		//return clieop line
		return $text;
	}
	
	/**
	* INFOCODE: 9990
	* Write clieop batchsluitinfo
	* @access private
	* @return string
	*/
	function writeBatchsluitInfo()
	{
		$text  = "9990";											//infocode
		$text .= "A";												//variantcode
		$text .= $this->numFiller($this->_TotalAmount, 18);			//Totaalbedrag clieop
		$text .= $this->numFiller($this->_AccountChecksum, 10);		//checksum van rekeningnummers
		$text .= $this->numFiller($this->_NumberOfTransactions, 7);	//Aantal transactie posten
		$text .= $this->filler(10);
		
		//return clieop line
		return $text;
	}
}


/**
*	master object for clieop objects
*
* @version $Revision: 1.14 $
* @access private
* @author Dave Mertens <dmertens@zyprexia.com>
* @package Payment_Clieop
*/
class clieop_baseobject
{

	/**
	* Alfa numeric filler
	* @param string text	- Text which needs to filled up
	* @param integer length	- The length of the required text
	* @return string
	* @access public
	*/
	function alfaFiller($text, $length)
	{
		//how many spaces do we need?
		$alfaLength = abs($length - strlen($text));
		
		//return string with spaces on right side
		return substr($text . str_repeat(" ", $alfaLength), 0, $length);
	}
	
	/**
	* Numeric filler
	* @param string number	- number which needs to filled up (Will be converted to a string)
	* @param integer length	- The length of the required number
	* @return string
	* @access public
	*/
	function numFiller($number, $length)
	{
		//how many zeros do we need
		settype($number, "string");		//We need to be sure that number is a string. 001 will otherwise be parsed as 1
		$numberLength = abs($length - strlen($number));
		
		//return original number woth zeros on the left
		return substr(str_repeat("0", $numberLength) . $number, -$length);
	}
	
	/**
	* filler
	* @param integer length	- How many filler spaces do we need
	* @return string
	* @access public
	*/
	function filler($Length)
	{
		return str_repeat(" ", $Length) . "\n";
	}
}

?>