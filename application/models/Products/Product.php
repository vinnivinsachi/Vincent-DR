<?php

class Application_Model_Products_Product extends Custom_Model_Abstract
{
	protected $_primaryIDColumn = 'productID';
	protected $_mapperClass = 'Application_Model_Mapper_Products_ProductsMapper';
	
	
	public $productID;
	public $productUniqueID;
	public $purchaseType;
	public $productCategory;
	public $inventoryAttributeTable;
	public $productTag;
	public $productPriceRange;
	
	public $domesticShippingRate;
	public $internationalShippingRate;
	public $sellerType;
	public $sellerDisplayName;
	public $sellerName;
	public $url;
	public $name;
	public $price;
	public $onSale;
	public $salesPrice;
	public $brand;

	public $returnAllowed;
	public $flagged;
	
	public $dateCreated;
	public $status;
	public $listingType;
	public $videoYoutube;
	public $rewardPoint;
	public $backorderTime;
	public $socialUsage;
	public $competitionUsage;
	public $lastStatusChange;
	
	protected $_images = array();
	protected $_inventory = array();
	protected $_custAttributes = array();
	protected $_reviews = array();
	protected $_sellerInfo = array();
	protected $_shoutOuts = array();
}

?>