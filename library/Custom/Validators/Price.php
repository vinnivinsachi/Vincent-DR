<?php
class Custom_Validators_Price extends Zend_Validate_Abstract
{
	const DIGIT = 'digit';
	const LOWER = 'lower';
	const FLOAT = 'float';


	protected $_messageTemplates = array(
		self::LOWER => "'%value%' must be at least greater than $0", 
		self::FLOAT => "'%value%' must be a valid price. Make sure you do not enter the '$' sign"
	);
	
	public function isValid($value){
		$this->_setValue($value);
 
        $isValid = true;
 		
		if (!is_float($value)) {
            $this->_error(self::FLOAT);
            return false;
        }
		
		if (!$value>0){
			$this->_error(self::LOWER);
			return false;
		}
		
        return $isValid;
	}

}
?>