<?php

	class DatabaseObject_Helper_UtilityManager extends DatabaseObject
	{
		public static function setTagMenuForProductListing($tags){
			$menuBar['WOMEN']=array();
			$menuBar['MEN']=array();
			$menuBar['JEWELRY']=array();
			$menuBar['ACCESSORIES']=array();
			foreach($tags as $k=>$v){
				switch ($v['product_tag']){
					case 'Ladies latin shoes':
						$menuBar['WOMEN']['Shoes'][]='Ladies latin shoes';
						break;
					case 'Ladies standard shoes':
						$menuBar['WOMEN']['Shoes'][]='Ladies standard shoes';
						break;
					case 'Ladies practice shoes':
						$menuBar['WOMEN']['Shoes'][]='Ladies practice shoes';
						break;
					case 'Latin competition dress':
						$menuBar['WOMEN']['Dresses'][]=	'Latin competition dress';
						break;
					case 'Standard competition dress':
						$menuBar['WOMEN']['Dresses'][]='Standard competition dress';
						break;
					case 'Social and practice dress':
						$menuBar['WOMEN']['Dresses'][]='Social and practice dress';
						break;
					case 'Latin skirt':
						$menuBar['WOMEN']['Skirts'][]='Latin skirt';
						break;
					case 'Standard skirt':
						$menuBar['WOMEN']['Skirts'][]='Standard skirt';
						break;
					case 'Ladies top':
						$menuBar['WOMEN']['Tops'][]='Ladies top';
						break;
					case 'Men latin shoes':
						$menuBar['MEN']['Shoes'][]='Men latin shoes';
						break;
					case 'Men standard shoes':
						$menuBar['MEN']['Shoes'][]='Men standard shoes';
						break;
					case 'Men practice shoes':
						$menuBar['MEN']['Shoes'][]=	'Men practice shoes';
						break;
					case 'Suit':
						$menuBar['MEN']['Sets'][]='Suit';
						break;
					case 'Tailsuit':
						$menuBar['MEN']['Sets'][]='Tailsuit';
						break;
					case 'Costume':
						$menuBar['MEN']['Sets'][]='Costume';
						break;
					case 'Shirt':
						$menuBar['MEN']['Shirts']='Shirt';
						break;
					case 'Pants':
						$menuBar['MEN']['Pants']='Pants';
						break;
					case 'Vest':
						$menuBar['MEN']['Vests']='Vest';
						break;
					case 'Jacket':
						$menuBar['MEN']['Jackets']='Jacket';
						break;
					case 'Jewelry set':
						$menuBar['JEWELRY'][]='Jewelry set';
						break;
					case 'Earring':
						$menuBar['JEWELRY'][]='Earring';
						break;
					case 'Necklace':
						$menuBar['JEWELRY'][]='Necklace';
						break;
					case 'Bracelet':
						$menuBar['JEWELRY'][]='Bracelet';
						break;
					case 'Brooch':
						$menuBar['JEWELRY'][]='Brooche';
						break;
					case 'Shoe brush':
						$menuBar['ACCESSORIES'][]='Shoe brush';
						break;
					case 'Heel protector':
						$menuBar['ACCESSORIES'][]='Heel protector';
						break;
					case 'Sole':
						$menuBar['ACCESSORIES'][]='Sole';
						break;
					case 'Bag':
						$menuBar['ACCESSORIES'][]='Bag';
						break;
					case 'Robe':
						$menuBar['ACCESSORIES'][]='Robe';
						break;
					case 'Belt':
						$menuBar['ACCESSORIES'][]='Belt';
						break;
				}
			}
			return $menuBar;
		}
		
	public static function setTagMenuForOrders($orders){
			$menuBar['UNSHIPPED']=array();
			$menuBar['SHIPPED']=array();
			$menuBar['DELIVERED']=array();
			$menuBar['WAITING FOR COMPLETION']=array();
			$menuBar['RETURNED']=array();
			$menuBar['RETURN DELIVERED']=array();
			$menuBar['RETURN COMPLETED']=array();
			$menuBar['COMPLETED AND FUND TRANSFERED']=array();
			foreach($tags as $k=>$v){
				switch ($v['product_tag']){
					case 'Ladies latin shoes':
						$menuBar['WOMEN']['Shoes'][]='Ladies latin shoes';
						break;
					case 'Ladies standard shoes':
						$menuBar['WOMEN']['Shoes'][]='Ladies standard shoes';
						break;
					case 'Ladies practice shoes':
						$menuBar['WOMEN']['Shoes'][]='Ladies practice shoes';
						break;
					case 'Latin competition dress':
						$menuBar['WOMEN']['Dresses'][]=	'Latin competition dress';
						break;
					case 'Standard competition dress':
						$menuBar['WOMEN']['Dresses'][]='Standard competition dress';
						break;
					case 'Social and practice dress':
						$menuBar['WOMEN']['Dresses'][]='Social and practice dress';
						break;
					case 'Latin skirt':
						$menuBar['WOMEN']['Skirts'][]='Latin skirt';
						break;
					case 'Standard skirt':
						$menuBar['WOMEN']['Skirts'][]='Standard skirt';
						break;
					case 'Ladies top':
						$menuBar['WOMEN']['Tops'][]='Ladies top';
						break;
					case 'Men latin shoes':
						$menuBar['MEN']['Shoes'][]='Men latin shoes';
						break;
					case 'Men standard shoes':
						$menuBar['MEN']['Shoes'][]='Men standard shoes';
						break;
					case 'Men practice shoes':
						$menuBar['MEN']['Shoes'][]=	'Men practice shoes';
						break;
					case 'Suit':
						$menuBar['MEN']['Sets'][]='Suit';
						break;
					case 'Tailsuit':
						$menuBar['MEN']['Sets'][]='Tailsuit';
						break;
					case 'Costume':
						$menuBar['MEN']['Sets'][]='Costume';
						break;
					case 'Shirt':
						$menuBar['MEN']['Shirts']='Shirt';
						break;
					case 'Pants':
						$menuBar['MEN']['Pants']='Pants';
						break;
					case 'Vest':
						$menuBar['MEN']['Vests']='Vest';
						break;
					case 'Jacket':
						$menuBar['MEN']['Jackets']='Jacket';
						break;
					case 'Jewelry set':
						$menuBar['JEWELRY'][]='Jewelry set';
						break;
					case 'Earring':
						$menuBar['JEWELRY'][]='Earring';
						break;
					case 'Necklace':
						$menuBar['JEWELRY'][]='Necklace';
						break;
					case 'Bracelet':
						$menuBar['JEWELRY'][]='Bracelet';
						break;
					case 'Brooch':
						$menuBar['JEWELRY'][]='Brooche';
						break;
					case 'Shoe brush':
						$menuBar['ACCESSORIES'][]='Shoe brush';
						break;
					case 'Heel protector':
						$menuBar['ACCESSORIES'][]='Heel protector';
						break;
					case 'Sole':
						$menuBar['ACCESSORIES'][]='Sole';
						break;
					case 'Bag':
						$menuBar['ACCESSORIES'][]='Bag';
						break;
					case 'Robe':
						$menuBar['ACCESSORIES'][]='Robe';
						break;
					case 'Belt':
						$menuBar['ACCESSORIES'][]='Belt';
						break;
				}
			}
			return $menuBar;
		}
		
		
	}
?>