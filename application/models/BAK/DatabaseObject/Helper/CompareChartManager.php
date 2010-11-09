<?php

	class DatabaseObject_Helper_CompareChartManager extends DatabaseObject
	{
		
		public static function mergeCompareChart($db, $userID, $compareChart){
			foreach ($compareChart as $k=>$v){
				foreach($v as $key=>$value){
					
					$select=$db->select();
					$select->from('user_compare_list')
					->where('product_id=?',$value)
					->where('user_id = ?', $userID)
					->where('product_table=?',$k);
					$product = $db->fetchAll($select);
					if(count($product)==0){
						$data = array('user_id'=>$userID, 
									  'product_id'=>$value,
									  'product_table'=>$k,							
						);
						$db->insert('user_compare_list', $data);
					}
				}
			}
		}
		
		public static function retrieveCompareChart($db, $userID){
			$select=$db->select();
			$select->from('user_compare_list')
			->where('user_id =?', $userID);
			echo $select.'<br/>';
			$list = $db->fetchAll($select);
			$compareChart=array();
			foreach($list as $k=>$v){
				$compareChart[$v['product_table']][$v['product_id']]=$v['product_id'];
			}
			return $compareChart;
		}
		
		public static function removeCompareChartItem($db, $userID, $param=array()){
			//echo 'here';
			$where = array("user_id = '$userID'", "product_id = '".$param['id']."'", "product_table='".$param['product']."'");
			//Zend_Debug::dump($where);
			$db->delete('user_compare_list', $where);
		}
	}
?>