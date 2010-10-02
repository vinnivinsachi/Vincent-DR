<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Contains the DB_QueryTool_Result class
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
 * @package    DB_QueryTool
 * @author     Wolfram Kriesing <wk@visionp.de>
 * @author     Paolo Panto <wk@visionp.de>
 * @author     Lorenzo Alberton <l dot alberton at quipo dot it>
 * @copyright  2003-2006 Wolfram Kriesing, Paolo Panto, Lorenzo Alberton
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version    CVS: $Id: Result.php,v 1.10 2006/05/01 15:47:27 quipo Exp $
 * @link       http://pear.php.net/package/DB_QueryTool
 */

/**
 * DB_QueryTool_Result class
 *
 * This result actually contains the 'data' itself, the number of rows
 * returned and some additional info
 * using ZE2 you can also get retrieve data from the result doing the following:
 * <DB_QueryTool_Common-instance>->getAll()->getCount()
 * or
 * <DB_QueryTool_Common-instance>->getAll()->getData()
 *
 * @category   Database
 * @package    DB_QueryTool
 * @author     Wolfram Kriesing <wk@visionp.de>
 * @author     Paolo Panto <wk@visionp.de>
 * @author     Lorenzo Alberton <l dot alberton at quipo dot it>
 * @copyright  2003-2006 Wolfram Kriesing, Paolo Panto, Lorenzo Alberton
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link       http://pear.php.net/package/DB_QueryTool
 */
class DB_QueryTool_Result
{
    // {{{ class vars

    /**
     * @var array
     */
    var $_data = array();

    /**
     * @var array
     */
    var $_dataKeys = array();

    /**
     * @var integer
     */
    var $_count = 0;

    /**
     * the counter for the methods getFirst, getNext
     * @var array
     */
    var $_counter = null;

    // }}}
    // {{{ DB_QueryTool_Result()

    /**
     * create a new instance of result with the data returned by the query
     *
     * @version    2002/07/11
     * @access     public
     * @author     Wolfram Kriesing <wolfram@kriesing.de>
     * @param      array   the data returned by the result
     */
    function DB_QueryTool_Result($data)
    {
        if (!count($data)) {
            $this->_count = 0;
        } else {
            list($firstElement) = $data;
            if (is_array($firstElement)) { // is the array a collection of rows?
                $this->_count = sizeof($data);
            } else {
                if (sizeof($data) > 0) {
                    $this->_count = 1;
                } else {
                    $this->_count = 0;
                }
            }
        }
        $this->_data = $data;
    }

    // }}}
    // {{{ numRows

	/**
	 * return the number of rows returned. This is an alias for getCount().
	 *
	 * @access    public
	 * @return    integer
	 */
	function numRows()
	{
	    return $this->_count;
	}

	// }}}
    // {{{ getCount()

    /**
     * return the number of rows returned
     *
     * @version    2002/07/11
     * @access     public
     * @author     Wolfram Kriesing <wolfram@kriesing.de>
     * @return integer the number of rows returned
     */
    function getCount()
    {
        return $this->_count;
    }

    // }}}
    // {{{ getData()

    /**
     * get all the data returned
     *
     * @version    2002/07/11
     * @access     public
     * @author     Wolfram Kriesing <wolfram@kriesing.de>
     * @param      string $key
     * @return mixed array or PEAR_Error
     */
    function getData($key=null)
    {
        if (is_null($key)) {
            return $this->_data;
        }
        if ($this->_data[$key]) {
            return $this->_data[$key];
        }
        return new PEAR_Error("there is no element with the key '$key'!");
    }

    // }}}
    // {{{ getFirst()

    /**
     * get the first result set
     * we are not using next, current, and reset, since those ignore keys
     * which are empty or 0
     *
     * @version    2002/07/11
     * @access     public
     * @author     Wolfram Kriesing <wolfram@kriesing.de>
     * @return mixed
     */
    function getFirst()
    {
        if ($this->getCount() > 0) {
            $this->_dataKeys = array_keys($this->_data);
            $this->_counter = 0;
            return $this->_data[$this->_dataKeys[$this->_counter]];
        }
        return new PEAR_Error('There are no elements!');
    }

    // }}}
    // {{{ getNext()

    /**
     * Get next result set. If getFirst() has never been called before,
     * it calls that method.
     * @return mixed
     * @access public
     */
    function getNext()
    {
        if (!$this->initDone()) {
    		return $this->getFirst();
    	}
        if ($this->hasMore()) {
            $this->_counter++;
            return $this->_data[$this->_dataKeys[$this->_counter]];
        }
        return new PEAR_Error('there are no more elements!');
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
        if ($this->_counter+1 < $this->getCount()) {
            return true;
        }
        return false;
    }

    // }}}
	// {{{ fetchRow

	/**
	 * This function emulates PEAR::DB fetchRow() method.
	 * With this method, DB_QueryTool can transparently replace PEAR_DB
	 *
	 * @todo implement fetchmode support?
	 * @access    public
	 * @return    void
	 */
	function fetchRow()
	{
		$arr = $this->getNext();
    	if (!PEAR::isError($arr)) {
    	   return $arr;
    	}
    	return false;
	}

    // }}}
	// {{{ initDone

	/**
	 * Helper method. Check if $this->_dataKeys has been initialized
	 *
	 * @return boolean
	 * @access private
	 */
	function initDone()
	{
	    return (
	        isset($this->_dataKeys) &&
            is_array($this->_dataKeys) &&
            count($this->_dataKeys)
        );
	}

	// }}}

    #TODO
    #function getPrevious()
    #function getLast()

}
?>