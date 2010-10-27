<?php

	class AccountBalanceAndRewardPointProcessor
	{
		//tracks the reward points for the addition or deduction of reward points/balances for processing
		//all addition and deduction records must be tracked
		//at the end a settle order profile. 

		//when pending reward point/balance is deducted, 
		//it gets deducted in the available and ledger.
		//when pending reward point/balance is posted,
		//no effect on balance.
		//when pending reward point/balance is cancelled,
		//balance and ledger gets added back the amount. 

		//when pending addition reward point/balance is added,
		//Only ledger gets updated.
		//when pending addition reward points/balance is posted,
		//Balance gets updated.
		//when pending addition reward points/balance is cancelled,
		//Ledger is subtracted. 
		//private $accountBalanceSummary;
		private $accountBalanceWithdrawTracking;
		private $pendingRewardPointAndBalanceTracking;
		private $postedRewardPointAndBalanceTracking;
		public $user;
		private $db;
		private $status = array('PENDING', 'POSTED', 'CANCELLED');
		private $arrayTrackingTypaColumn = array('REWARD_ADDITION' =>'added_reward_points', 'REWARD_DEDUCTION'=>'deducted_reward_points', 'BALANCE_DEDUCTION'=>'deducted_dollar_amount', 'BALANCE_ADDITION'=>'added_dollar_amount');
		
		public function __construct($db, DatabaseObject_User $user){
			$this->db = $db;
			$this->user= $user;
			
			$this->accountBalanceWithdrawTracking = new DatabaseObject_Account_UserAccountBalanceWithdrawTracking($db);
			$this->postedRewardPointAndBalanceTracking = new DatabaseObject_Account_UserPostedRewardPointAndBalanceTracking($db);
		}
		
		public function loadRewardPointsAndBalanceForUser($params = array()){
			$this->pendingRewardPointAndBalanceTracking= new DatabaseObject_Account_UserPendingRewardPointAndBalanceTracking($this->db);
			
			return $this->pendingRewardPointAndBalanceTracking->loadAllUserRecords($this->user->getId(), $params);
		}
		
		public function updatePendingRewardPointsAndBalanceForUser($trackingType, $amount, $causedType, $causedById, $description)
		{
			echo 'here';
			$this->pendingRewardPointAndBalanceTracking= new DatabaseObject_Account_UserPendingRewardPointAndBalanceTracking($this->db);
			echo 'user id is: '.$this->user->getId();
			$this->pendingRewardPointAndBalanceTracking->user_id = $this->user->getId();
			$this->pendingRewardPointAndBalanceTracking->tracking_type=$trackingType;
			$amountColumn = $this->arrayTrackingTypaColumn[$trackingType];
			echo 'amountColumn is: '.$amountColumn;
			$this->pendingRewardPointAndBalanceTracking->$amountColumn = $amount;
			$this->pendingRewardPointAndBalanceTracking->caused_by_type=$causedType;
			$this->pendingRewardPointAndBalanceTracking->$causedType = $causedById;
			$this->pendingRewardPointAndBalanceTracking->status = 'PENDING';
			$this->pendingRewardPointAndBalanceTracking->description = $description;
			$this->user->accountBalanceSummary->$trackingType('PENDING', $amount);
			if($this->user->accountBalanceSummary->save(false)){
				$this->pendingRewardPointAndBalanceTracking->save(false);
				return $this->pendingRewardPointAndBalanceTracking->getId();
			}
		}
		
		public function postPendingRewardPointsAndBalanceForUser($pendingTrackingId){
			$this->pendingRewardPointAndBalanceTracking= new DatabaseObject_Account_UserPendingRewardPointAndBalanceTracking($this->db);
			if($this->pendingRewardPointAndBalanceTracking->loadUserPendingTrackingFromTrackingId($this->user->getId(), $pendingTrackingId)){
				echo 'loaded<br />';
				if($this->pendingRewardPointAndBalanceTracking->status=='PENDING'){
					echo 'status is pending<br />';
					$trackingType=$this->pendingRewardPointAndBalanceTracking->tracking_type;
					$amountColumn = $this->arrayTrackingTypaColumn[$trackingType];
					$amount = $this->pendingRewardPointAndBalanceTracking->$amountColumn;
					echo 'tracking type is: '.$trackingType.' with amount is: '.$amount.'<br />';
					$this->user->accountBalanceSummary->$trackingType('POSTED', $amount);
					
					//creating posted reward point and balace;
					
					if($this->user->accountBalanceSummary->save(false)){
						echo 'balance is saved<br />';
						//save posted rewardPointAndBalanceTracking into posted_reward_points_and_balance_tracking table
						
						$this->postedRewardPointAndBalanceTracking->user_id = $this->user->getId();
						$this->postedRewardPointAndBalanceTracking->user_pending_reward_point_and_balance_tracking_id = $this->pendingRewardPointAndBalanceTracking->getId();
						$this->postedRewardPointAndBalanceTracking->tracking_type=$this->pendingRewardPointAndBalanceTracking->tracking_type;
						$this->postedRewardPointAndBalanceTracking->$amountColumn=$this->pendingRewardPointAndBalanceTracking->$amountColumn;
						$this->postedRewardPointAndBalanceTracking->caused_by_type=$this->pendingRewardPointAndBalanceTracking->caused_by_type;
						$causedType = $this->pendingRewardPointAndBalanceTracking->caused_by_type;
						$this->postedRewardPointAndBalanceTracking->$causedType=$this->pendingRewardPointAndBalanceTracking->$causedType;
						
						$this->postedRewardPointAndBalanceTracking->description = $this->pendingRewardPointAndBalanceTracking->description;
						
						
						
						$this->pendingRewardPointAndBalanceTracking->status='POSTED';
						$this->pendingRewardPointAndBalanceTracking->ts_updated=date('Y-m-d G:i:s');
						echo 'time now is: '.date('Y-m-d G:i:s');
						if($this->pendingRewardPointAndBalanceTracking->save(false) && $this->postedRewardPointAndBalanceTracking->save(false)){
							echo 'pending saved to posted<br />';
							return true;	
						}else{
							//document the error 
							return false;
						}
					}
				}else{
				//document the error
				echo 'already posted';
				return false;	
				}
			}else{
				//document the error
				echo 'not even loaded';
				return false;	
			}
			//echo $this->user->getId();
			
		}
		
		//can't cancell unless the pendingTrackingId status is PENDING 
		public function cancelPendingRewardPointsAndBalanceForUser($pendingTrackingId)
		{
			//echo 'here';
			$this->pendingRewardPointAndBalanceTracking= new DatabaseObject_Account_UserPendingRewardPointAndBalanceTracking($this->db);
			if($this->pendingRewardPointAndBalanceTracking->loadUserPendingTrackingFromTrackingId($this->user->getId(), $pendingTrackingId)){
				echo 'loaded<br />';

				if($this->pendingRewardPointAndBalanceTracking->status=='PENDING'){
					echo 'status is pending<br />';

					$trackingType=$this->pendingRewardPointAndBalanceTracking->tracking_type;
					$amountColumn = $this->arrayTrackingTypaColumn[$trackingType];
					$amount = $this->pendingRewardPointAndBalanceTracking->$amountColumn;
					$this->user->accountBalanceSummary->$trackingType('CANCELLED', $amount);
					echo 'tracking type is: '.$trackingType.' with amount is: '.$amount.'<br />';

					if($this->user->accountBalanceSummary->save()){
						echo 'balance is saved<br />';
						
						$this->pendingRewardPointAndBalanceTracking->status='CANCELLED';
						$this->pendingRewardPointAndBalanceTracking->ts_updated=date('Y-m-d G:i:s');
						echo 'time now is: '.date('Y-m-d G:i:s');


						if($this->pendingRewardPointAndBalanceTracking->save()){
						echo 'pending saved to cancelled<br />';

							
						return true;	
						}else{
						//document the error 
						return false;	
						}
					}
				}else{
					echo 'can not cancel an none pending tracking';
				//document the error
				return false;	
				}
			}else{
				//document the error
				return false;	
			}
			//echo $this->user->getId();
		}
		
	}
?>