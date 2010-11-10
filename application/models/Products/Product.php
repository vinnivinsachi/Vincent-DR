<?php

class Application_Model_Products_Product extends Custom_Model_Abstract
{
	public $productID;
	public $purchaseType;
	public $productCategory;
	public $inventoryAttributeTable;
	public $productType;
	public $productTag;
	public $productPriceRange;
	
	public $domesticShippingRate;
	public $internationalShippingRate;
	public $uploaderID;
	public $uploaderUsername;
	public $uploaderNetwork;
	public $uploaderEmail;
	public $url;
	public $name;
	public $price;
	public $onSale;
	public $salesPrice;
	public $brand;
	public $inventoryReference;
	public $uniqueIdentifierForJS;
	public $returnAllowed;
	public $flagged;
	
	public $dateCreated;
	public $status;
	public $listingType;
	public $new;
	public $videoYoutube;
	public $rewardPoint;
	public $backorderTime;
	public $socialUsage;
	public $competitionUsage;
	public $lastStatusChange;
}

