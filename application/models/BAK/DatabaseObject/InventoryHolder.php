<?php

		class DatabaseObject_InventoryHolder extends DatabaseObject
		{

			public function __construct($db)
			{
				parent::__construct($db, 'invholder', 'invholder_id');
				
				
				$this->add('cart_id');
				$this->add('inv_id');
				$this->add('quantity');
				$this->add('ts_updated', time(), self::TYPE_TIMESTAMP);
			}
			
			protected function preUpdate()
			{
	
				$this->ts_updated = time();
				return true;
			}
			
			
			public function addToInventoryHolder($cart_id, $inv_id, $quantity)
			{
				$select= $this->_db->select();
				
				$select->from('invholder', '*')
				->where('cart_id = ?', $cart_id)
				->where('inv_id = ?', $inv_id);
				
				
				//echo "select is: ".$select;
				
			
				if($this->_load($select))
				{
					$invprofile = new DatabaseObject_Invprofile($this->_db);
					$invprofile->loadItem($inv_id);
					if($invprofile->quantity !=0)
					{
						$invprofile->quantity = $invprofile->quantity-1;
						$invprofile->save();
					}
					$this->quantity = $this->quantity + $quantity;
					$this->save();
					return true;
				}
				else
				{
					
					$invprofile = new DatabaseObject_Invprofile($this->_db);
					$invprofile->loadItem($inv_id);
					if($invprofile->quantity !=0)
					{
						$invprofile->quantity = $invprofile->quantity-1;
						$invprofile->save();
					}
					$this->cart_id = $cart_id;
					$this->inv_id = $inv_id;
					$this->quantity = $quantity;
					$this->save();
					return true;
				}
			}
			
			public function deleteToInventoryProfile($cart_id, $inv_id, $quantity)
			{
				
				$select= $this->_db->select();
				
				$select->from('invholder', '*')
				->where('cart_id = ?', $cart_id)
				->where('inv_id = ?', $inv_id);
				
				//echo "select is: ".$select;
				if($this->_load($select))
				{
/*					echo "here at load successful";
*/					$invProfile= new DatabaseObject_Invprofile($this->_db);
			
					$invProfile->loadItem($inv_id);
					
					$invProfile->quantity = $invProfile->quantity+$quantity;
					
					$invProfile->save();
					
					$this->quantity = $this->quantity-1;
					
					if($this->quantity==0)
					{	
						$this->delete();
					}
					else
					{
						$this->save();
					}
					return true;
				}
				else
				{
/*					echo "here at load unsuccesfull";
*/					return false;
				}
				
			}
			
		}

?>