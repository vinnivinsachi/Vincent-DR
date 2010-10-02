<?php
    abstract class FormProcessor
    {
        protected $_errors = array();
        protected $_vals = array();
        private $_sanitizeChain = null;

        public function __construct()
        {

        }

        abstract function process(Zend_Controller_Request_Abstract $request); //abstract that must be implemented in child classes. 

        public function sanitize($value)
        {
            if (!$this->_sanitizeChain instanceof Zend_Filter) {
                $this->_sanitizeChain = new Zend_Filter();
                $this->_sanitizeChain->addFilter(new Zend_Filter_StringTrim())
                                     ->addFilter(new Zend_Filter_StripTags());
            }

            // filter out any line feeds / carriage returns
            $ret = preg_replace('/[\r\n]+/', ' ', $value);

            // filter using the above chain
            return $this->_sanitizeChain->filter($ret);
        }

		//addError. first element is the name of the error, the second is the content of the error. 
        public function addError($key, $val)
        {
            if (array_key_exists($key, $this->_errors)) {
                if (!is_array($this->_errors[$key]))
                    $this->_errors[$key] = array($this->_errors[$key]);

                $this->_errors[$key][] = $val;
            }
            else
                $this->_errors[$key] = $val;
        }
        
        public function removeError($key){
        	if (array_key_exists($key, $this->_errors)) {
                unset($this->_errors[$key]);
            }
        }

        public function getError($key)
        {
            if ($this->hasError($key))
                return $this->_errors[$key];

            return null;
        }

        public function getErrors()
        {
            return $this->_errors;
        }

        public function hasError($key = null)
        {
            if (strlen($key) == 0)
                return count($this->_errors) > 0;
            return array_key_exists($key, $this->_errors);
        }

        public function __set($name, $value)
        {
            $this->_vals[$name] = $value;
        }

        public function __get($name)
        {
            return array_key_exists($name, $this->_vals) ? $this->_vals[$name] : null;
        }
    }
?>