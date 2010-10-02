<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Contains the MDB_QueryTool_Result_Row and MDB_QueryTool_Result_Object classes
 *
 * PHP versions 4 and 5
 *
 * LICENSE: Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR "AS IS" AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE FREEBSD PROJECT OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
 * THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   Database
 * @package    MDB_QueryTool
 * @author     Roman Dostovalov, Com-tec-so S.A.<roman.dostovalov@ctco.lv>
 * @copyright  2004-2006 Roman Dostovalov
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version    CVS: $Id: Object.php,v 1.9 2006/12/18 23:05:21 hugoki Exp $
 * @link       http://pear.php.net/package/MDB_QueryTool
 */

/**
 * Include parent class
 */
require_once 'MDB/QueryTool/Result.php';

/**
 * MDB_QueryTool_Result_Row class
 *
 * @category   Database
 * @package    MDB_QueryTool
 * @author     Roman Dostovalov, Com-tec-so S.A.<roman.dostovalov@ctco.lv>
 * @copyright  2004-2006 Roman Dostovalov
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link       http://pear.php.net/package/MDB_QueryTool
 */
class MDB_QueryTool_Result_Row
{
    //There is a problem when the table has a column named as these vars
    var $_qt_instance;
    var $_keyarray = array();

    // {{{ constructor

    /**
     * create object properties from the array
     * @param array
     * @param MDB_QueryTool instance
     */
    function MDB_QueryTool_Result_Row($arr, &$qt)
    {
        foreach ($arr as $key => $value) {
            //Ignore keys beginning with '_'
            if (substr($key,0,1) != '_') {
                $this->$key        = $value;
                $this->_keyarray[] = $key;
            }
        }
        $this->_qt_instance = $qt;
    }
    
    // }}}
    // {{{ save
    
    /**
     * save data, calls either update or add
     * @return  mixed   the data returned by either add or update-method
     */
    function save()
    {
        $newData = array();
        foreach ($this->_keyarray as $key) {
            if ( ($this->$key != '') || ($key != $this->_qt_instance->primaryCol) ) {
                $newData[$key] = $this->$key;
            }
        }
        $id = $this->_qt_instance->save($newData);
        //Check if it has been a new entity
        $primaryCol = $this->_qt_instance->primaryCol;
        if ($this->$primaryCol == '') {
            $this->$primaryCol = $id;
        }
        return $id;
    }
    
    // }}}
    // {{{ remove
    
    /**
     * Removes the entity
     * @return  boolean   the data returned by remove-method
     */
    function remove()
    {
        $newData = array();
        foreach ($this->_keyarray as $key) {
            if ( ($this->$key != '') || ($key != $this->_qt_instance->primaryCol) ) {
                $newData[$key] = $this->$key;
            }
        }
        return $this->_qt_instance->remove($newData);
    }
    
    // }}}
}

// -----------------------------------------------------------------------------

/**
 * MDB_QueryTool_Result_Object class
 *
 * @category   Database
 * @package    MDB_QueryTool
 * @author     Roman Dostovalov, Com-tec-so S.A.<roman.dostovalov@ctco.lv>
 * @copyright  2004-2006 Roman Dostovalov
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @link       http://pear.php.net/package/MDB_QueryTool
 */
class MDB_QueryTool_Result_Object extends MDB_QueryTool_Result
{
    var $_qt_instance;

    // {{{ constructor
    
    /**
     * Constructor
     * @param MDB[2]_Result
     * @param MDB_QueryTool instance
     */
    function MDB_QueryTool_Result_Object($result, $qt)
    {
        $this->_qt_instance = $qt;
        $this->MDB_QueryTool_Result($result);
    }

    // }}}
    // {{{ fetchRow

    /**
     * This function emulates PEAR::MDB fetchRow() method
     * With this function MDB_QueryTool can transparently replace PEAR::MDB
     *
     * @todo implement fetchmode support?
     * @access public
     * @return void
     */
    function fetchRow()
    {
        $arr = parent::getNext();
        if (is_scalar($arr)) {
            return $arr;
        }
        if (!PEAR::isError($arr)) {
            //$row = new MDB_QueryTool_Result_Row($arr, $this->_qt_instance);
            $row = $this->_getEntity($arr);
            return $row;
        }
        return false;
    }

    // }}}
    // {{{ getNext

    /**
     * Alias for fetchRow()
     *
     * @return void
     * @access public
     */
    function getNext()
    {
        return $this->fetchRow();
    }

    // }}}
    // {{{ getFirst()

    /**
     * get the first result set
     *
     * @return mixed
     * @access    public
     */
    function getFirst()
    {
        $arr = parent::getFirst();
        if (is_scalar($arr)) {
            return $arr;
        }
        if (!PEAR::isError($arr)) {
            //$row = new MDB_QueryTool_Result_Row($arr, $this->_qt_instance);
            $row = $this->_getEntity($arr);
            return $row;
        }
        return false;
    }

    // }}}
    // {{{ hasMore()

    /**
     * check if there are other rows
     *
     * @return boolean
     * @access public
     */
    function hasMore()
    {
        return parent::hasMore();
    }

    // }}}
    // {{{ _getEntity()

    /**
     * Returns an entity as object
     * @param array $arr Data of the entity
     * @return object
     * @access private
     */
    function _getEntity($arr)
    {
        $classname = $this->_qt_instance->_returnclass;
        $row       = new $classname($arr, $this->_qt_instance);
        return $row;
    }

    // }}}
    // {{{ newEntity()

    /**
     * Returns a new entity as object
     * @return object
     * @access private
     */
    function newEntity()
    {
        $classname = $this->_qt_instance->_returnclass;
        $data      = array();
        foreach ($this->_qt_instance->metadata() as $key=>$val) {
            $data[$key] = '';
        }
        $row = new $classname($data, $this->_qt_instance);
        return $row;
    }

    // }}}
}
?>