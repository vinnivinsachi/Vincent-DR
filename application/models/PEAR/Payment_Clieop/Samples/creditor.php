<?php
/**
* Clieop CREDITOR sample
*
* $Revision: 1.2 $
*/
include_once("Payment_Clieop/clieop.php");
include_once("Payment_Clieop/clieop_transaction.php");

header("Content-type: text/plain");

$clieopFile = new ClieopPayment();

//set clieop properties
$clieopFile->setTransactionType(CLIEOP_TRANSACTIE_BETALING);	// debtor transactions
$clieopFile->setPrincipalAccountNumber("123456789");			// principal bank account number
$clieopFile->setPrincipalName("PEAR CLIEOP CLASSES");			// Name of owner of principal account number
$clieopFile->setFixedDescription("PHP: Scripting the web");		// description for all transactions
$clieopFile->setSenderIdentification("PEAR");					// Free identification
$clieopFile->setTest(true);										// Test clieop


//create creditor
$creditor = new TransactionPayment(CLIEOP_TRANSACTIE_BETALING);
$creditor->setAccountNumberSource("192837346");					// my bank account number
$creditor->setAccountNumberDest("123456789");					// principal bank account number
$creditor->setAmount(6900);										// amount in Eurocents (EUR 69.00)
$creditor->setName("Dave Mertens");								// Name of creditor (holder of source account)
$creditor->setCity("Rotterdam");								// City of creditor
$creditor->setDescription("Like we promised, your money");				// Just some info

//assign creditor record to clieop
$clieopFile->addPayment($creditor);

//Create clieop file
echo $clieopFile->writeClieop();
?>