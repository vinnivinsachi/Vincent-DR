<?php

	class Custom_Processor_Products_ProductListingProcessor
	{
		const PRODUCT_STATUS_DRAFT = 'UNLISTED';
		const PRODUCT_STATUS_LIVE = 'LISTED';
		const PRODUCT_FLAGGED = 'FLAGGED';
		const PRODUCT_STATUS_UNLIST = 'UNLISTED';
		
		public $product;
		public $user;
		
		public function __construct($uploader, $product){
			$this->user = $user;
		}
		
		public function saveProductBasicInfo(){
			
		}
		
		public function saveProductImages(){
			
		}
		
		public function saveProductInventory(){
			
		}
		
		public function saveProductReview(){
			
		}
		
		public function saveProductShoutouts(){
			
		}
	}
?>