<?php
    abstract class Profile
    {
        const ACTION_NONE   = 0;
        const ACTION_UPDATE = 1;
        const ACTION_INSERT = 2;
        const ACTION_DELETE = 3;

        protected $_db = null;
        protected $_table = null;
        protected $_keyField = 'profile_key';
        protected $_valueField = 'profile_value';
        protected $_filters = array();
        private $_properties = array();

        public function __construct(Zend_Db_Adapter_Abstract $db, $table, array $filters = array())
        {
            $this->_db = $db;
            $this->_table = $table;
            $this->_filters = $filters;
        }

        public function load()
        {
            $query = sprintf('select %s, %s from %s',
                             $this->_keyField,
                             $this->_valueField,
                             $this->_table);
            if (count($this->_filters) > 0) { 
                $filters = array();
                foreach ($this->_filters as $k => $v)
                    $filters[] = $this->_db->quoteInto($k . ' = ?', $v);

                $query .= sprintf(' where %s', join(' and ', $filters));
            }
            $result = $this->_db->fetchPairs($query);

            foreach ($result as $k => $v) {
                $this->_properties[$k] = array('value'  => $v,
                                               'action' => self::ACTION_NONE);
            }
        }

        public function save($useTransactions = true)
        {
            if ($useTransactions)
                $this->_db->beginTransaction();

            foreach ($this->_properties as $k => $v) {
                switch ($v['action']) {
                    case self::ACTION_DELETE:
                        $where = array();
                        foreach ($this->_filters as $_k => $_v)
                            $where[] = $this->_db->quoteInto($_k . ' = ?', $_v);
                        $where[] = $this->_db->quoteInto($this->_keyField . ' = ?', $k);
                        $this->_db->delete($this->_table, $where);
                        break;

                    case self::ACTION_INSERT:
                        $values = $this->_filters;
                        $values[$this->_keyField] = $k;
                        $values[$this->_valueField] = $v['value'];
                        $this->_db->insert($this->_table, $values);
                        break;

                    case self::ACTION_UPDATE:
                        $where = array();
                        foreach ($this->_filters as $_k => $_v)
                            $where[] = $this->_db->quoteInto($_k . ' = ?', $_v);
                        $where[] = $this->_db->quoteInto($this->_keyField . ' = ?', $k);
                        $this->_db->update($this->_table, array($this->_valueField => $v['value']), $where);
                        break;

                    case self::ACTION_NONE:
                    default:
                        // do nothing
                }

                if ($v['action'] == self::ACTION_DELETE) {
                    unset($this->_properties[$k]);
                    continue;
                }
                $this->_properties[$k]['action'] = self::ACTION_NONE;
            }

            if ($useTransactions)
                $this->_db->commit();

            return true;
        }

        public function delete()
        {
            $where = array();
            foreach ($this->_filters as $k => $v)
                $where[] = $this->_db->quoteInto($k . ' = ?', $v);

            $this->_db->delete($this->_table, $where);
            $this->_properties = array();
        }

        public function __set($name, $value)
        {
            if (array_key_exists($name, $this->_properties)) {
                if (empty($value) || is_null($value) || (is_string($value) && strlen($value) == 0)) {
                    unset($this->$name);
                }
                else if ($this->_properties[$name]['value'] != $value) {
                    $this->_properties[$name]['value'] = $value;
                    $this->_properties[$name]['action'] = self::ACTION_UPDATE;
                }
            }
            else {
                $this->_properties[$name] = array('value'  => $value,
                                                  'action' => self::ACTION_INSERT);
            }

            return false;
        }

        public function __get($name)
        {
            return array_key_exists($name, $this->_properties) ? $this->_properties[$name]['value'] : null;
        }

        public function __isset($name)
        {
            return array_key_exists($name, $this->_properties) && $this->_properties[$name]['action'] != self::ACTION_DELETE;
        }

        public function __unset($name)
        {
            if (!array_key_exists($name, $this->_properties))
                return;
            $action = $this->_properties[$name]['action'];

            switch ($action)
            {
                case self::ACTION_NONE:
                case self::ACTION_UPDATE:
                    $this->_properties[$name]['action'] = self::ACTION_DELETE;
                    break;

                case self::ACTION_INSERT:
                    unset($this->_properties[$name]);
                    break;

                case self::ACTION_DELETE:
                default:
            }
        }

        public static function BuildMultiple($db, $class, $filters)
        {
            if (!class_exists($class))
                throw new Exception('Undefined class specified: ' . $class);

            $obj = new $class($db);

            if (!$obj instanceof Profile)
                throw new Exception('Class does not extend from Profile');

            $fields = array_keys($filters);
            $fields[] = $obj->_keyField;
            $fields[] = $obj->_valueField;

            $select = $db->select();
            $select->from($obj->_table, $fields);

            foreach ($filters as $field => $value) {
                $select->where($field . ' in (?)', $value);
            }

            $data = $db->fetchAll($select);

            $ret = array();

            foreach ($data as $row) {
                $key = array();
                foreach ($filters as $field => $value)
                    $key[] = $row[$field];

                $key = join(',', $key);
                if (!array_key_exists($key, $ret))
                    $ret[$key] = new $class($db);

                $k = $row[$obj->_keyField];
                $v = $row[$obj->_valueField];
                $ret[$key]->_properties[$k] = array('value'  => $v,
                                                    'action' => self::ACTION_NONE);
            }

            return $ret;
        }
    }
?>