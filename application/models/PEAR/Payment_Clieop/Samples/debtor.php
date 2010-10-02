<?php
/**
* Clieop DEBTOR sample
*
* $Revision: 1.4 $
*/
include_once("Payment_Clieop/clieop.php");
include_once("Payment_Clieop/clieop_transaction.php");

header("Content-type: text/plain");

$clieopFile = new ClieopPayment();

//set clieop properties
$clieopFile->setTransactionType(CLIEOP_TRANSACTIE_INCASSO);		// debtor transactions
$clieopFile->setPrincipalAccountNumber("123456789");			// principal bank account number
$clieopFile->setPrincipalName("PEAR CLIEOP CLASSES");			// Name of owner of principal account number
$clieopFile->setFixedDescription("PHP: Scripting the web");		// description for all transactions
$clieopFile->setSenderIdentification("PEAR");					// Free identification
$clieopFile->setTest(true);										// Test clieop


//create debtor
$debtor = new TransactionPayment(CLIEOP_TRANSACTIE_INCASSO);
$debtor->setAccountNumberSource("192837346");					// my bank account number
$debtor->setAccountNumberDest("123456789");						// principal bank account number
$debtor->setAmount(12995);										// amount in Eurocents (EUR 129.95)
$debtor->setName("Dave Mertens");								// Name of debtor (holder of source account)
$debtor->setCity("Rotterdam");									// City of debtor
$debtor->setDescription("Ordernumber: 8042");					// Just some info
$debtor->setDescription("Customernumber: 17863");				// about the transaction

//assign debtor record to clieop
$clieopFile->addPayment($debtor);

//Create clieop file
echo $clieopFile->writeClieop();
?>