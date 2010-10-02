<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Contains the MDB_QueryTool_Query class
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
 * @author     Lorenzo Alberton <l dot alberton at quipo dot it>
 * @copyright  2004-2007 Lorenzo Alberton
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version    CVS: $Id: Query.php,v 1.66 2007/01/10 15:07:46 quipo Exp $
 * @link       http://pear.php.net/package/MDB_QueryTool
 */

/**
 * require the PEAR and MDB classes
 */
require_once 'PEAR.php';

/**
 * MDB_QueryTool_Query class
 *
 * This class should be extended
 *
 * @category   Database
 * @package    MDB_QueryTool
 * @author     Lorenzo Alberton <l dot alberton at quipo dot it>
 * @copyright  2004-2007 Lorenzo Alberton
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link       http://pear.php.net/package/MDB_QueryTool
 */
class MDB_QueryTool_Query
{
    // {{{ class vars

    /**
     * @var string  the name of the primary column
     */
    var $primaryCol = 'id';

    /**
     * @var string  the current table the class works on
     */
    var $table      = '';

    /**
     * @var string  the name of the sequence for this table
     */
    var $sequenceName = null;

    /**
     * @var object  the db-object, a PEAR::MDB[2] object instance
     */
    var $db = null;

    /**
     * @var string  the where condition
     * @access private
     */
    var $_where = '';

    /**
     * @var string  the order condition
     * @access private
     */
    var $_order = '';

    /**
     * @var    string  the having definition
     * @access private
     */
    var $_having = '';

    /**
     * @var array  contains the join content
     *             the key is the join type, for now we have 'default' and 'left'
     *             inside each key 'table' contains the table
     *                         key 'where' contains the where clause for the join
     * @access private
     */
    var $_join = array();

    /**
     * @var string  which column to index the result by
     * @access private
     */
    var $_index = null;

    /**
     * @var string  the group-by clause
     * @access private
     */
    var $_group = '';

    /**
     * @var array   the limit
     * @access private
     */
    var $_limit = array();

    /**
     * @var boolean     if to use the MDB_QueryTool_Result as a result or not
     * @access private
     */
    var $_resultType = 'none';

    /**
     * @var array       the metadata temporary saved
     * @access private
     */
    var $_metadata = array();

    /**
     * @var string (?)
     * @access private
     */
    var $_lastQuery = null;

    /**
     * @var string the rows that shall be selected
     * @access private
     */
    var $_select = '*';

    /**
     * @var string the rows that shall not be selected
     * @access private
     */
    var $_dontSelect = '';

    /**
     * @var array   this array saves different modes in which this class works
     *              i.e. 'raw' means no quoting before saving/updating data
     * @access private
     */
    var $options = array(
        'raw'      =>  false,
        'verbose'  =>  true,    // set this to false in a productive environment
                                // it will produce error-logs if set to true
        'useCache' =>  false,
        'logFile'  =>  false,
    );

    /**
     * this array contains information about the tables
     * those are
     * - 'name' => the real table name
     * - 'shortName' => the short name used, so that when moving the table i.e.
     *                  onto a provider's db and u have to rename the tables to
     *                  longer names this name will be relevant, i.e. when
     *                  autoJoining, i.e. a table name on your local machine is:
     *                  'user' but online it has to be 'applName_user' then the
     *                  shortName will be used to determine if a column refers to
     *                  another table, if the colName is 'user_id', it knows the
     *                  shortName 'user' refers to the table 'applName_user'
     */
    var $tableSpec = array();

    /**
     * this is the regular expression that shall be used to find a table's shortName
     * in a column name, the string found by using this regular expression will be removed
     * from the column name and it will be checked if it is a table name
     * i.e. the default '/_id$/' would find the table name 'user' from the column name 'user_id'
     *
     * @access private
     */
    var $_tableNameToShortNamePreg = '/^.*_/';

    /**
     * @var array  this array caches queries that have already been built once
     *            to reduce the execution time
     * @access private
     */
    var $_queryCache = array();

    /**
     * The object that contains the log-instance
     * @access private
     */
    var $_logObject = null;

    /**
     * Some internal data the logging needs
     * @access private
     */
    var $_logData = array();

    /**
     * MDB version
     * @access private
     */
    var $_MDBversion = 1;

    /**
     * Name of class to return when object is used
     * @access private
     */
    var $_returnclass = 'MDB_QueryTool_Result_Row';

    // }}}
    // {{{ __construct()

    /**
     * this is the constructor, as it will be implemented in ZE2 (php5)
     *
     * @param   object  db-object
     * @param   array   options array
     * @access  public
     */
/*
    function __construct($dsn=false, $options=array())
    {
        if (!isset($options['autoConnect'])) {
            $autoConnect = true;
        } else {
            $autoConnect = $options['autoConnect'];
        }
        if (isset($options['errorCallback'])) {
            $this->setErrorCallback($options['errorCallback']);
        }
        if (isset($options['errorSetCallback'])) {
            $this->setErrorSetCallback($options['errorSetCallback']);
        }
        if (isset($options['errorLogCallback'])) {
            $this->setErrorLogCallback($options['errorLogCallback']);
        }

        if ($autoConnect && $dsn) {
            $this->connect($dsn, $options);
        }

        if (is_null($this->sequenceName)) {
            $this->sequenceName = $this->table;
        }
    }
*/

    // }}}
    // {{{ MDB_QueryTool_Query()

    /**
     * @param mixed $dsn DSN string, DSN array or MDB[2] object
     * @param array $options
     * @param integer $MDBversion 1=MDB, 2=MDB2
     * @access  public
     */
    function MDB_QueryTool_Query($dsn = false, $options = array(), $MDBversion = 1)
    {
        //$this->__construct($dsn, $options);

        if (!isset($options['autoConnect'])) {
            $autoConnect = true;
        } else {
            $autoConnect = $options['autoConnect'];
            unset($options['autoConnect']);
        }
        if (isset($options['errorCallback'])) {
            $this->setErrorCallback($options['errorCallback']);
            unset($options['errorCallback']);
        }
        if (isset($options['errorSetCallback'])) {
            $this->setErrorSetCallback($options['errorSetCallback']);
            unset($options['errorSetCallback']);
        }
        if (isset($options['errorLogCallback'])) {
            $this->setErrorLogCallback($options['errorLogCallback']);
            unset($options['errorLogCallback']);
        }

        if ($autoConnect && $dsn) {
            $this->connect($dsn, $options, $MDBversion);
        }

        if (is_null($this->sequenceName)) {
            $this->sequenceName = $this->table;
        }
    }

    // }}}
    // {{{ connect()

    /**
     * use this method if you want to connect manually
     * @param mixed $dsn DSN string, DSN array or MDB[2] object
     * @param array $options
     * @param integer $MDBversion 1=MDB, 2=MDB2
     */
    function connect($dsn, $options = array(), $MDBversion = 1)
    {
        if (is_object($dsn)) {
            $res =& $dsn;
        } elseif ($MDBversion == 2) {
            require_once 'MDB2.php';
            if (!isset($options['idxname_format'])) {
                $options['idxname_format'] = '%s';
            }
            $res = &MDB2::connect($dsn, $options);
        } else {
            require_once 'MDB.php';
            $res = &MDB::connect($dsn, $options);
        }
        if (PEAR::isError($res)) {
    // FIXXME what shall we do here?
            $this->_errorLog($res->getUserInfo());
            return;
        }
        $this->setDbInstance($res);
    }

    // }}}
    // {{{ getDbInstance()

    /**
     *   @return  object MDB Object
     *   @access  public
     */
    function &getDbInstance()
    {
        return $this->db;
    }

    // }}}
    // {{{ setDbInstance()

    /**
     * Setup using an existing connection.
     * this also sets the MDB_FETCHMODE_ASSOC since this class
     * needs this to be set!
     *
     * @param object a reference to an existing DB-object
     * @return void
     */
    function setDbInstance(&$dbh)
    {
        $this->db =& $dbh;
        $this->_MDBversion = is_a($this->db, 'mdb2_driver_common') ? 2 : 1;
        if ($this->_MDBversion == 2) {
            $this->db->setFetchMode(MDB2_FETCHMODE_ASSOC);
        } else {
            $this->db->setFetchMode(MDB_FETCHMODE_ASSOC);
        }
    }

    // }}}
    // {{{ get()

    /**
     * get the data of a single entry
     * if the second parameter is only one column the result will be returned
     * directly not as an array!
     *
     *   @param   integer the id of the element to retrieve
     *   @param   string  if this is given only one row shall be returned,
     *                    directly, not an array
     *   @return  mixed   (1) an array of the retrieved data
     *                    (2) if the second parameter is given and its only one column,
     *                        only this column's data will be returned
     *                    (3) false in case of failure
     *   @access  public
     */
    function get($id, $column='')
    {
        if (is_string($id)) {
            $id = trim($id);
        }
        $column = trim($column);
        $table  = $this->table;
        $getMethod = 'getRow';
        if ($column && !strpos($column, ',')) {    // if only one column shall be selected
            $getMethod = 'getOne';
        }
        // we dont use 'setSelect' here, since this changes the setup of the class, we
        // build the query directly
        // if $column is '' then _buildSelect selects '*' anyway, so that's the same behaviour as before
        $query['select'] = $this->_buildSelect($column);
        $query['where']  = $this->_buildWhere($this->table.'.'.$this->primaryCol.'='.$this->_quote($id));
        $queryString     = $this->_buildSelectQuery($query);

        return $this->returnResult($this->execute($queryString, $getMethod));
    }

    // }}}
    // {{{ getMultiple()

    /**
     * gets the data of the given ids
     *
     * @param   array   this is an array of ids to retrieve
     * @param   string  the column to search in for
     * @return  mixed   an array of the retrieved data, or false in case of failure
     *                  when failing an error is set in $this->_error
     * @access  public
     */
    function getMultiple($ids, $column='')
    {
        $col = $this->primaryCol;
        if ($column) {
            $col = $column;
        }
// FIXXME if $ids has no table.col syntax and we are using joins, the table better be put in front!!!
        $ids = $this->_quoteArray($ids);

        $query['where'] = $this->_buildWhere($col.' IN ('.implode(',', $ids).')');
        $queryString    = $this->_buildSelectQuery($query);

        return $this->returnResult($this->execute($queryString));
    }

    // }}}
    // {{{ getOne()

    /**
     * get the first value of the first row
     *
     * @access     public
     * @return     mixed   (1) a scalar value in case of success
     *                     (2) false in case of failure
     */
    function getOne()
    {
        $queryString = $this->getQueryString();
        return $this->execute($queryString, 'queryOne');
    }

    // }}}
    // {{{ getAll()

    /**
     * get all entries from the DB
     * for sorting use setOrder!!!, the last 2 parameters are deprecated
     *
     * @param   int     to start from
     * @param   int     the number of rows to show
     * @param   string  the MDB-method to use, i dont know if we should leave this param here ...
     * @return  mixed   an array of the retrieved data, or false in case of failure
     *                  when failing an error is set in $this->_error
     * @access  public
     */
    function getAll($from=0, $count=0, $method='getAll')
    {
        $query = array();
        if ($count) {
            $query = array('limit' => array($from, $count));
        }
        return $this->returnResult($this->execute($this->_buildSelectQuery($query), $method));
    }

    // }}}
    // {{{ getCol()

    /**
     * this method only returns one column, so the result will be a one dimensional array
     * this does also mean that using setSelect() should be set to *one* column, the one you want to
     * have returned a most common use case for this could be:
     *     $table->setSelect('id');
     *     $ids = $table->getCol();
     * OR
     *     $ids = $table->getCol('id');
     * so ids will be an array with all the id's
     *
     * @param   string  the column that shall be retrieved
     * @param   int     to start from
     * @param   int     the number of rows to show
     * @return  mixed   an array of the retrieved data, or false in case of failure
     *                  when failing an error is set in $this->_error
     * @access  public
     */
    function getCol($column=null, $from=0, $count=0)
    {
        $query = array();
        if (!is_null($column)) {
            // by using _buildSelect() I can be sure that the table name will not be ambiguous
            // i.e. in a join, where all the joined tables have a col 'id'
            // _buildSelect() will put the proper table name in front in case there is none
            $query['select'] = $this->_buildSelect(trim($column));
        }
        if ($count) {
            $query['limit'] = array($from, $count);
        }
        $res = $this->returnResult($this->execute($this->_buildSelectQuery($query), 'getCol'));
        return ($res === false) ? array() : $res;
    }

    // }}}
    // {{{ getCount()

    /**
     * get the number of entries
     *
     * @return  mixed   an array of the retrieved data, or false in case of failure
     *                  when failing an error is set in $this->_error
     * @access  public
     */
    function getCount()
    {
/* the following query works on mysql
SELECT count(DISTINCT image.id) FROM image2tree
RIGHT JOIN image ON image.id = image2tree.image_id
the reason why this is needed - i just wanted to get the number of rows that do exist if the result is grouped by image.id
the following query is what i tried first, but that returns the number of rows that have been grouped together
for each image.id
SELECT count(*) FROM image2tree
RIGHT JOIN image ON image.id = image2tree.image_id GROUP BY image.id

so that's why we do the following, i am not sure if that is standard SQL and absolutley correct!!!
*/

//FIXXME see comment above if this is absolutely correct!!!
        if ($group = $this->_buildGroup()) {
            $query['select'] = 'COUNT(DISTINCT '.$group.')';
            $query['group']  = '';
        } else {
            $query['select'] = 'COUNT(*)';
        }

        $query['order'] = '';   // order is not of importance and might freak up the special group-handling up there, since the order-col is not be known
/*# FIXXME use the following line, but watch out, then it has to be used in every method, or this
# value will be used always, simply try calling getCount and getAll afterwards, getAll will return the count :-)
# if getAll doesn't use setSelect!!!
*/
        //$this->setSelect('count(*)');
        $queryString = $this->_buildSelectQuery($query, true);
        return($res=$this->execute($queryString, 'getOne')) ? $res : 0;
    }

    // }}}
    // {{{ getDefaultValues()

    /**
     * return an empty element where all the array elements do already exist
     * corresponding to the columns in the DB
     *
     * @return  array   an empty, or pre-initialized element
     * @access  public
     */
    function getDefaultValues()
    {
        $ret = array();
        // here we read all the columns from the DB and initialize them
        // with '' to prevent PHP-warnings in case we use error_reporting=E_ALL
        foreach ($this->metadata() as $aCol => $x) {
            $ret[$aCol] = '';
        }
        return $ret;
    }

    // }}}
    // {{{ getEmptyElement()

    /**
     * this is just for BC
     * @deprecated
     */
    function getEmptyElement()
    {
        $this->getDefaultValues();
    }

    // }}}
    // {{{ getQueryString()

    /**
     * Render the current query and return it as a string.
     *
     * @return string the current query
     */
    function getQueryString()
    {
        $ret = $this->_buildSelectQuery();
        if (is_string($ret)) {
            $ret = trim($ret);
        }
        return $ret;
    }

    // }}}
    // {{{ _floatToStringNoLocale()

    /**
     * If a double number was "localized", restore its decimal separator to "."
     * @see http://pear.php.net/bugs/bug.php?id=3021
     * @param float
     * @access private
     */
    function _floatToStringNoLocale($float)
    {
        $precision = strlen($float) - strlen(intval($float));
        if ($precision) {
            --$precision; // don't count decimal seperator
        }
        return number_format($float, $precision, '.', '');
    }

    // }}}
    // {{{ _localeSafeImplode()

    /**
     * New "implode()" implementation to bypass float locale formatting:
     * the SQL decimal separator is and must be ".".  Always.
     * @param string $glue
     * @param array $array
     * @access private
     */
    function _localeSafeImplode($glue, $array)
    {
        $str = '';
        foreach ($array as $value) {
            if (!empty($str)) {
                $str .= $glue;
            }
            $str .= is_double($value) ? $this->_floatToStringNoLocale($value) : $value;
        }
        return $str;
    }

    // }}}
    // {{{ save()

    /**
     * save data, calls either update or add
     * if the primaryCol is given in the data this method knows that the
     * data passed to it are meant to be updated (call 'update'), otherwise it will
     * call the method 'add'.
     * If you dont like this behaviour simply stick with the methods 'add'
     * and 'update' and ignore this one here.
     * This method is very useful when you have validation checks that have to
     * be done for both adding and updating, then you can simply overwrite this
     * method and do the checks in here, and both cases will be validated first.
     *
     * @param   array   contains the new data that shall be saved in the DB
     * @return  mixed   the data returned by either add or update-method
     * @access  public
     */
    function save($data)
    {
        if (isset($data[$this->primaryCol]) && $data[$this->primaryCol]) {
            return $this->update($data);
        }
        return $this->add($data);
    }

    // }}}
    // {{{ update()

    /**
     * update the member data of a data set
     *
     * @param   array   contains the new data that shall be saved in the DB
     *                  the id has to be given in the field with the key 'ID'
     * @return  mixed   true on success, or false otherwise
     * @access  public
     */
    function update($newData)
    {
        $query = array();
        // do only set the 'where' part in $query, if a primary column is given
        // if not the default 'where' clause is used
        if (isset($newData[$this->primaryCol])) {
            //$this->_errorSet('Error updating the new member.');
            //return false;
            $query['where'] = $this->db->quoteIdentifier($this->primaryCol).'='.$this->_quote($newData[$this->primaryCol]);
        }

        $newData = $this->_checkColumns($newData, 'update');
        $values = array();
        foreach ($newData as $key => $aData) {   // quote the data
            //$values[] = "{$this->table}.$key=" . $this->_quote($aData);
            $values[] = $this->db->quoteIdentifier($key) . '=' . $this->_quote($aData);
        }

        $query['set'] = $this->_localeSafeImplode(',', $values);
        $updateString = $this->_buildUpdateQuery($query);
        return $this->execute($updateString, 'query') ? true : false;
    }

    // }}}
    // {{{ add()

    /**
     * add a new member in the DB
     *
     * @param   array   contains the new data that shall be saved in the DB
     * @return  mixed   the inserted id on success, or false otherwise
     * @access  public
     */
    function add($newData)
    {
        // if no primary col is given, get next sequence value
        if (empty($newData[$this->primaryCol])) {
            if ($this->primaryCol) {
                // do only use the sequence if a primary column is given
                // otherwise the data are written as given
                $nextid_func = ($this->_MDBversion == 2) ? 'nextID' : 'nextId';
                //$id = (int)$this->db->$nextid_func($this->sequenceName);
                $id = $this->db->$nextid_func($this->sequenceName);
                $newData[$this->primaryCol] = $id;
            } else {
                // if no primary col is given return true on success
                $id = true;
            }
        } else {
            $id = $newData[$this->primaryCol];
        }

        //unset($newData[$this->primaryCol]);

        $newData = $this->_checkColumns($newData, 'add');
        $newData = $this->_quoteArray($newData);
        
        //quoting the columns
        $tmpData = array();
        foreach ($newData as $key=>$val) {
            $tmpData[$this->db->quoteIdentifier($key)] = $val;
        }
        $newData = $tmpData;
        unset($tmpData);

        $query = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            implode(', ', array_keys($newData)),
            $this->_localeSafeImplode(', ', $newData)
        );
        return $this->execute($query, 'query') ? $id : false;
    }

    // }}}
    // {{{ addMultiple()

    /**
     * adds multiple new members in the DB
     *
     * @param   array   contains an array of new data that shall be saved in the DB
     *                  the key-value pairs have to be the same for all the data!!!
     * @return  mixed   the inserted ids on success, or false otherwise
     * @access  public
     */
    function addMultiple($data)
    {
        if (!sizeof($data)) {
            return false;
        }
        $ret = true;
        // the inserted ids which will be returned or if no primaryCol is given
        // we return true by default
        $retIds = $this->primaryCol ? array() : true;
        $dbtype = $this->db->phptype;
        if ($dbtype == 'mysql') { //Optimise for MySQL
            $allData = array();                     // each row that will be inserted
            foreach ($data as $key => $aData) {
                $aData = $this->_checkColumns($aData,'add');
                $aData = $this->_quoteArray($aData);

                if (empty($aData[$this->primaryCol])) {
                    if ($this->primaryCol) {
                        // do only use the sequence if a primary column is given
                        // otherwise the data are written as given
                        $func = ($this->_MDBversion == 2) ? 'nextID' : 'nextId';
                        $retIds[] = $id = (int)$this->db->$func($this->sequenceName);
                        $aData[$this->primaryCol] = $id;
                    }
                } else {
                    $retIds[] = $aData[$this->primaryCol];
                }
                $allData[] = '('.$this->_localeSafeImplode(', ', $aData).')';
            }

            //quoting the columns
            $tmpData = array();
            foreach ($aData as $key=>$val) {
                $tmpData[$this->db->quoteIdentifier($key)] = $val;
            }
            $newData = $tmpData;
            unset($tmpData);

            $query = sprintf(
                'INSERT INTO %s (%s) VALUES %s',
                $this->table ,
                implode(', ', array_keys($aData)) ,
                $this->_localeSafeImplode(', ', $allData)
            );
            return $this->execute($query, 'query') ? $retIds : false;
        }

        //Executing for every entry the add method
        foreach ($data as $entity) {
            if ($ret) {
                $res = $this->add($entity);
                if (!$res) {
                    $ret = false;
                } else {
                    $retIds[] = $res;
                }
            }
        }
        //Setting the return value to the array with ids
        if ($ret) {
            $ret = $retIds;
        }
        return $ret;
    }

    // }}}
    // {{{ remove()

    /**
     * removes a member from the DB
     *
     * @param   mixed   integer/string - the value of the column that shall be removed
     *                  array   - multiple columns that shall be matched, the second parameter will be ignored
     * @param   string  the column to match the data against, only if $data is not an array
     * @return  boolean
     * @access  public
     */
    function remove($data, $whereCol='')
    {
        //$raw = $this->getOption('raw');

        if (is_array($data)) {
//FIXXME check $data if it only contains columns that really exist in the table
            $wheres = array();
            foreach ($data as $key => $val) {
                if (is_null($val)) {
                    $wheres[] = $this->db->quoteIdentifier($key) .' IS NULL';
                } else {
                    $wheres[] = $this->db->quoteIdentifier($key) .'='. $this->_quote($val);
                }
            }
            $whereClause = implode(' AND ', $wheres);
        } else {
            if (empty($whereCol)) {
                $whereCol = $this->primaryCol;
            }
            $whereClause = $this->db->quoteIdentifier($whereCol).'='. $this->_quote($data);
        }

        $query = 'DELETE FROM '. $this->table .' WHERE '. $whereClause;
        return $this->execute($query, 'query') ? true : false;
// i think this method should return the ID's that it removed, this way we could simply use the result
// for further actions that depend on those id ... or? make stuff easier, see ignaz::imail::remove
    }

    // }}}
    // {{{ removeAll()

    /**
     * empty a table
     *
     * @return resultSet or false on error [execute() result]
     * @access public
     */
    function removeAll()
    {
        $query = 'DELETE FROM ' . $this->table;
        return $this->execute($query, 'query') ? true : false;
    }

    // }}}
    // {{{ removeMultiple()

    /**
     * remove the datasets with the given ids
     *
     * @param  array   the ids to remove
     * @return resultSet or false on error [execute() result]
     * @access public
     */
    function removeMultiple($ids, $colName='')
    {
        if (empty($colName)) {
            $colName = $this->primaryCol;
        }
        $ids = $this->_quoteArray($ids);

        $query = sprintf(
            'DELETE FROM %s WHERE %s IN (%s)',
            $this->table,
            $colName,
            $this->_localeSafeImplode(',', $ids)
        );
        return $this->execute($query, 'query') ? true : false;
    }

    // }}}
    // {{{ removePrimary()

    /**
     * removes a member from the DB and calls the remove methods of the given objects
     * so all rows in another table that refer to this table are erased too
     *
     * @param   integer the value of the primary key
     * @param   string  the column name of the tables with the foreign keys
     * @param   object  just for convinience, so nobody forgets to call this method
     *                  with at least one object as a parameter
     * @return  boolean
     * @access  public
     */
    function removePrimary($id, $colName, $atLeastOneObject)
    {
        $argCounter = 2;    // we have 2 parameters that need to be given at least
        // func_get_arg returns false and a warning if there are no more parameters, so
        // we suppress the warning and check for false
        while ($object = @func_get_arg($argCounter++)) {
//FIXXXME let $object also simply be a table name
            if (!$object->remove($id, $colName)) {
//FIXXXME do this better
                $this->_errorSet("Error removing '$colName=$id' from table {$object->table}.");
                return false;
            }
        }

        if (!$this->remove($id)) {
            return false;
        }
        return true;
    }

    // }}}
    // {{{ setLimit()

    /**
     * sets query limits
     *
     * @param   integer $from   start index
     * @param   integer $count  number of results
     * @access  public
     */
    function setLimit($from=0, $count=0)
    {
        if ($from==0 && $count==0) {
            $this->_limit = array();
        } else {
            $this->_limit = array($from, $count);
        }
    }

    // }}}
    // {{{ getLimit()

    /**
     * gets query limits
     *
     * @return array (start index, number of results)
     * @access  public
     */
    function getLimit()
    {
        return $this->_limit;
    }

    // }}}
    // {{{ setWhere()

    /**
     * Sets the where condition which is used for the current instance
     *
     * @param   string  the where condition, this can be complete like 'X=7 AND Y=8'
     * @access  public
     */
    function setWhere($whereCondition='')
    {
        $this->_where = $whereCondition;
//FIXXME parse the where condition and replace ambigious column names, such as "name='Deutschland'" with "country.name='Deutschland'"
// then the users dont have to write that explicitly and can use the same name as in the setOrder i.e. setOrder('name,_net_name,_netPrefix_prefix');
    }

    // }}}
    // {{{ getWhere()

    /**
     * Gets the where condition which is used for the current instance
     *
     * @return  string  the where condition, this can be complete like 'X=7 AND Y=8'
     * @access  public
     */
    function getWhere()
    {
        return $this->_where;
    }

    // }}}
    // {{{ addWhere()

    /**
     * Only adds a string to the where clause
     *
     * @param   string  the where clause to add to the existing one
     * @param   string  the condition for how to concatenate the new where clause
     *                  to the existing one
     * @access  public
     */
    function addWhere($where, $condition='AND')
    {
        if ($this->getWhere()) {
            $where = $this->getWhere().' '.$condition.' '.$where;
        }
        $this->setWhere($where);
    }

    // }}}
    // {{{ addWhereSearch()

    /**
     * add a where-like clause which works like a search for the given string
     * i.e. calling it like this:
     *     $this->addWhereSearch('name', 'otto hans')
     * produces a where clause like this one
     *     UPPER(name) LIKE "%OTTO%HANS%"
     * so the search finds the given string
     *
     * @param   string  the column to search in for
     * @param   string  the string to search for
     * @param   string  the condition
     * @access  public
     */
    function addWhereSearch($column, $string, $condition='AND')
    {
        // if the column doesn't contain a tablename use the current table name
        // in case it is a defined column to prevent ambiguous rows
        if (strpos($column, '.') === false) {
            $meta = $this->metadata();
           if (isset($meta[$column])) {
                $column = $this->table .'.'. trim($column);
            }
        }

        //ibase doesn't have the LOWER() function, so using UPPER() here...
        $string = $this->_quote('%'.str_replace(' ', '%', strtoupper($string)).'%');
        $this->addWhere("UPPER($column) LIKE $string", $condition);
    }

    // }}}
    // {{{ setOrder()

    /**
     * sets the order condition which is used for the current instance
     *
     * @param   string  the where condition, this can be complete like 'X=7 AND Y=8'
     * @param   boolean sorting order (TRUE => ASC, FALSE => DESC)
     * @access  public
     */
    function setOrder($orderCondition='', $desc=false)
    {
        $this->_order = $orderCondition . ($desc ? ' DESC' : '');
    }

    // }}}
    // {{{ addOrder()

    /**
     * Add a order parameter to the query.
     *
     * @param  string  the where condition, this can be complete like 'X=7 AND Y=8'
     * @param  boolean sorting order (TRUE => ASC, FALSE => DESC)
     * @access public
     */
    function addOrder($orderCondition='', $desc=false)
    {
        $order = $orderCondition . ($desc ? ' DESC' : '');
        if ($this->_order) {
            $this->_order = $this->_order .','. $order;
        } else {
            $this->_order = $order;
        }
    }

    // }}}
    // {{{ getOrder()

    /**
     * gets the order condition which is used for the current instance
     *
     * @return  string  the order condition, this can be complete like 'ID,TIMESTAMP DESC'
     * @access  public
     */
    function getOrder()
    {
        return $this->_order;
    }

    // }}}
    // {{{ setHaving()

    /**
     * sets the having definition
     *
     * @param  string  the having definition
     * @access public
     */
    function setHaving($having='')
    {
        $this->_having = $having;
    }

    // }}}
    // {{{ getHaving()

    /**
     * gets the having definition which is used for the current instance
     *
     * @return string  the having definition
     * @access public
     */
    function getHaving()
    {
        return $this->_having;
    }

    // }}}
    // {{{ addHaving()

    /**
     * Extend the current having clause. This is very useful, when you are building
     * this clause from different places and don't want to overwrite the currently
     * set having clause, but extend it.
     *
     * @param string this is a having clause, i.e. 'column' or 'table.column' or 'MAX(column)'
     * @param string the connection string, which usually stays the default, which is ',' (a comma)
     * @access public
     */
    function addHaving($what='*', $connectString=' AND ')
    {
        if ($this->_having) {
            $this->_having = $this->_having . $connectString . $what;
        } else {
            $this->_having = $what;
        }
    }

    // }}}
    // {{{ setJoin()

    /**
     * sets a join-condition
     *
     * @param   mixed   either a string or an array that contains
     *                  the table(s) to join on the current table
     * @param   string  the where clause for the join
     * @access  public
     */
    function setJoin($table=null, $where=null, $joinType='default')
    {
//FIXXME make it possible to pass a table name as a string like this too 'user u'
// where u is the string that can be used to refer to this table in a where/order
// or whatever condition
// this way it will be possible to join tables with itself, like setJoin(array('user u', 'user u1'))
// this wouldnt work yet, but for doing so we would need to change the _build methods too!!!
// because they use getJoin('tables') and this simply returns all the tables in use
// but don't take care of the mentioned syntax

        if (is_null($table) || is_null($where)) {   // remove the join if not sufficient parameters are given
            $this->_join[$joinType] = array();
            return;
        }
/* this causes problems if we use the order-by, since it doenst know the name to order it by ... :-)
        // replace the table names with the internal name used for the join
        // this way we can also join one table multiple times if it will be implemented one day
        $this->_join[$table] = preg_replace('/'.$table.'/','j1',$where);
*/
        $this->_join[$joinType][$table] = $where;
    }

    // }}}
    // {{{ setLeftJoin()

    /**
     * if you do a left join on $this->table you will get all entries
     * from $this->table, also if there are no entries for them in the joined table
     * if both parameters are not given the left-join will be removed
     * NOTE: be sure to only use either a right or a left join
     *
     * @param   string  the table(s) to be left-joined
     * @param   string  the where clause for the join
     * @access  public
     */
    function setLeftJoin($table=null, $where=null)
    {
        $this->setJoin($table, $where, 'left');
    }

    // }}}
    // {{{ addLeftJoin()

    /**
     *
     * @param  string  the table(s) to be left-joined
     * @param  string  the where clause for the join
     * @param  string  join type
     * @access public
     */
    function addLeftJoin($table, $where, $type='left')
    {
        // init value, to prevent E_ALL-warning
        if (!isset($this->_join[$type]) || !$this->_join[$type]) {
            $this->_join[$type] = array();
        }
        $this->_join[$type][$table] = $where;
    }

    // }}}
    // {{{ setRightJoin()

    /**
     * see setLeftJoin for further explaination on what a left/right join is
     * NOTE: be sure to only use either a right or a left join
//FIXXME check if the above sentence is necessary and if sql doesnt allow the use of both
     *
     * @param   string  the table(s) to be right-joined
     * @param   string  the where clause for the join
     * @see     setLeftJoin()
     * @access  public
     */
    function setRightJoin($table=null, $where=null)
    {
        $this->setJoin($table, $where, 'right');
    }

    // }}}
    // {{{ getJoin()

    /**
     * gets the join-condition
     *
     * @access public
     * @param  string  [null|''|'table'|'tables'|'right'|'left'|'inner']
     * @return array   gets the join parameters
     */
    function getJoin($what=null)
    {
        // if the user requests all the join data or if the join is empty, return it
        if (is_null($what) || empty($this->_join)) {
            return $this->_join;
        }

        $ret = array();
        switch (strtolower($what)) {
            case 'table':
            case 'tables':
                foreach ($this->_join as $aJoin) {
                    if (count($aJoin)) {
                        $ret = array_merge($ret, array_keys($aJoin));
                    }
                }
                break;
            case 'inner':   // return inner-join data only
            case 'right':   // return right-join data only
            case 'left':    // return left join data only
            default:
                if (isset($this->_join[$what]) && count($this->_join[$what])) {
                    $ret = array_merge($ret, $this->_join[$what]);
                }
                break;
        }
        return $ret;
    }

    // }}}
    // {{{ addJoin()

    /**
     * adds a table and a where clause that shall be used for the join
     * instead of calling
     *     setJoin(array(table1,table2),'<where clause1> AND <where clause2>')
     * you can also call
     *     setJoin(table1,'<where clause1>')
     *     addJoin(table2,'<where clause2>')
     * or where it makes more sense is to build a query which is made out of a
     * left join and a standard join
     *     setLeftJoin(table1,'<where clause1>')
     *     // results in ... FROM $this->table LEFT JOIN table ON <where clause1>
     *     addJoin(table2,'<where clause2>')
     *     // results in ...  FROM $this->table,table2 LEFT JOIN table ON <where clause1> WHERE <where clause2>
     *
     * @param      string the table to be joined
     * @param      string the where clause for the join
     * @param      string the join type
     * @access  public
     */
    function addJoin($table, $where, $type='default')
    {
        if ($table == $this->table) {
            return;  //skip. Self joins are not supported.
        }
        // init value, to prevent E_ALL-warning
        if (!array_key_exists($type, $this->_join)) {
            $this->_join[$type] = array();
        }
        $this->_join[$type][$table] = $where;
    }

    // }}}
    // {{{ setTable()

    /**
     * sets the table this class is currently working on
     *
     * @param   string  the table name
     * @access  public
     */
    function setTable($table)
    {
        $this->table = $table;
    }

    // }}}
    // {{{ getTable()

    /**
     * gets the table this class is currently working on
     *
     * @return  string  the table name
     * @access  public
     */
    function getTable()
    {
        return $this->table;
    }

    // }}}
    // {{{ setGroup()

    /**
     * sets the group-by condition
     *
     * @param   string  the group condition
     * @access  public
     */
    function setGroup($group='')
    {
        $this->_group = $group;
//FIXXME parse the condition and replace ambiguous column names, such as "name='Deutschland'" with "country.name='Deutschland'"
// then the users don't have to write that explicitly and can use the same name as in the setOrder i.e. setOrder('name,_net_name,_netPrefix_prefix');
    }

    // }}}
    // {{{ getGroup()

    /**
     * gets the group condition which is used for the current instance
     *
     * @return  string  the group condition
     * @access  public
     */
    function getGroup()
    {
        return $this->_group;
    }

    // }}}
    // {{{ setSelect()

    /**
     * limit the result to return only the columns given in $what
     * @param string fields that shall be selected
     * @access public
     */
    function setSelect($what='*')
    {
        $this->_select = $what;
    }

    // }}}
    // {{{ addSelect()

    /**
     * add a string to the select part of the query
     *
     * add a string to the select-part of the query and connects it to an existing
     * string using the $connectString, which by default is a comma.
     * (SELECT xxx FROM - xxx is the select-part of a query)
     *
     * @param   string  the string that shall be added to the select-part
     * @param   string  the string to connect the new string with the existing one
     * @access  public
     */
    function addSelect($what='*', $connectString=',')
    {
        // if the select string is not empty add the string, otherwise simply set it
        if ($this->_select) {
            $this->_select = $this->_select . $connectString . $what;
        } else {
            $this->_select = $what;
        }
    }

    // }}}
    // {{{ getSelect()

    /**
     * @return  string
     * @access  public
     */
    function getSelect()
    {
        return $this->_select;
    }

    // }}}
    // {{{ setDontSelect()

    /**
     * @param   string
     * @access  public
     */
    function setDontSelect($what='')
    {
        $this->_dontSelect = $what;
    }

    // }}}
    // {{{ getDontSelect()

    /**
     * @return  string
     * @access  public
     */
    function getDontSelect()
    {
        return $this->_dontSelect;
    }

    // }}}
    // {{{ reset()

    /**
     * reset all the set* settings; with no parameter given, it resets them all.
     *
     * @param array $what
     * @access  public
     */
    function reset($what=array())
    {
        if (!sizeof($what)) {
            $what = array(
                'select',
                'dontSelect',
                'group',
                'having',
                'limit',
                'where',
                'index',
                'order',
                'join',
                'leftJoin',
                'rightJoin'
            );
        }

        foreach ($what as $aReset) {
            $this->{'set'.ucfirst($aReset)}();
        }
    }

    // }}}
    // {{{ setOption()

    /**
     * set mode the class shall work in
     * currently we have the modes:
     * 'raw'   does not quote the data before building the query
     *
     * @param   string   the mode to be set
     * @param   mixed    the value of the mode
     * @access  public
     */
    function setOption($option, $value)
    {
        $this->options[strtolower($option)] = $value;
    }

    // }}}
    // {{{ getOption()

    /**
     * @param   string name of the option to retrieve
     * @return  string value of the option
     * @access  public
     */
    function getOption($option)
    {
        return $this->options[strtolower($option)];
    }

    // }}}
    // {{{ _quoteArray()

    /**
     * quotes all the data in this array if we are not in raw mode!
     * @param array $data
     * @return array
     * @access private
     */
    function _quoteArray($data)
    {
        if (!$this->getOption('raw')) { //check added for gain in speed if $this->raw==true
            foreach ($data as $key => $val) {
                $data[$key] = $this->_quote($val);
            }
        }
        return $data;
    }

    // }}}
    // {{{ _quote()

    /**
     * quotes all the data in this array if we are not in raw mode!
     * @param mixed $data
     * @return mixed
     * @access private
     */
    function _quote($data)
    {
        if ($this->getOption('raw')) {
            return $data;
        }
        if ($this->_MDBversion == 2) {
            switch(gettype($data)) {
                case 'array':
                    return $this->_quoteArray($data);
                default:
                    return $this->db->quote($data);
            }
        } else {
            switch(gettype($data)) {
                case 'array':
                    return $this->_quoteArray($data);
                case 'boolean':
                    return $this->db->getBooleanValue($data);
                case 'double':
                    return $this->db->getFloatValue($data);
                case 'integer':
                    return $this->db->getIntegerValue($data);
                case 'string':  //if 'string' or 'unknown', quote as text
                default:
                    return $this->db->getTextValue($data);
            }
        }
    }

    // }}}
    // {{{ _checkColumns()

    /**
     * checks if the columns which are given as the array's indexes really exist
     * if not it will be unset anyway
     *
     * @param   string  the actual message, first word should always be the method name,
     *                  to build the message like this: className::methodname
     * @param   integer the line number
     * @access  public
     */
    function _checkColumns($newData, $method='unknown')
    {
        if (!$meta = $this->metadata()) {
            // if no metadata available, return data as given
            return $newData;
        }
        foreach ($newData as $colName => $x) {
            if (!isset($meta[$colName])) {
                $this->_errorLog("$method, column {$this->table}.$colName doesn't exist, value was removed before '$method'", __LINE__);
                unset($newData[$colName]);
            } else {
                // if the current column exists, check the length too, not to write content that is too long
                // prevent DB-errors here
                // do only check the data length if this field is given
                if (isset($meta[$colName]['len']) && ($meta[$colName]['len'] != -1)
                    && (($oldLength=strlen($newData[$colName])) > $meta[$colName]['len'])
                    && !is_numeric($newData[$colName])
                ) {
                    $this->_errorLog("_checkColumns, had to trim column '$colName' from $oldLength to ".
                                        $meta[$colName]['len'].' characters.',__LINE__);
                    $newData[$colName] = substr($newData[$colName],0,$meta[$colName]['len']);
                }
            }
        }
        return $newData;
    }

    // }}}
    // {{{ debug()

    /**
     * overwrite this method and i.e. print the query $string
     * to see the final query
     *
     * @param string  the query mostly
     * @access public
     */
    function debug($string) {}

    //
    //
    //  ONLY ORACLE SPECIFIC, not very nice since it is DB dependent, but we need it!!!
    //
    //

    // }}}
    // {{{ metadata()

    /**
     * !!!! query COPIED FROM db_oci8.inc - from PHPLIB !!!!
     *
     * @see db_oci8.inc - PHPLIB
     * @param string $table
     * @return resultSet or false on error
     * @access public
     */
    function metadata($table = '')
    {
        // is there an alias in the table name, then we have something like this: 'user ua'
        // cut of the alias and return the table name
        if (strpos($table, ' ') !== false) {
            $split = explode(' ', trim($table));
            $table = $split[0];
        }

        $full = false;
        if (empty($table)) {
            $table = $this->table;
        }
        // to prevent multiple selects for the same metadata
        if (isset($this->_metadata[$table])) {
            return $this->_metadata[$table];
        }
// FIXXXME use oci8 implementation of newer PEAR::DB-version
        if ($this->db->phptype == 'oci8') {
            $count = 0;
            $id    = 0;
            $res   = array();

            //# This is a RIGHT OUTER JOIN: "(+)", if you want to see, what
            //# this query results try the following:
            //// $table = new Table; $this->db = new my_DB_Sql; // you have to make
            ////                                          // your own class
            //// $table->show_results($this->db->query(see query vvvvvv))
            ////
            $res = $this->db->queryAll("SELECT T.column_name,T.table_name,T.data_type,".
                "T.data_length,T.data_precision,T.data_scale,T.nullable,".
                "T.char_col_decl_length,I.index_name".
                " FROM ALL_TAB_COLUMNS T,ALL_IND_COLUMNS I".
                " WHERE T.column_name=I.column_name (+)".
                " AND T.table_name=I.table_name (+)".
                " AND T.table_name=UPPER('$table') ORDER BY T.column_id");

            if (PEAR::isError($res)) {
                //$this->_errorSet( $res->getMessage() );
                // i think we only need to log here, since this method is never used
                // directly for the user's functionality, which means if it fails it
                // is most probably an appl error
                $this->_errorLog($res->getUserInfo($res));
                return false;
            }
            foreach ($res as $key=>$val) {
                $res[$key]['name'] = $val['COLUMN_NAME'];
            }
        } else {
            if (!is_object($this->db)) {
                return false;
            }
            if ($this->_MDBversion == 2) {
                $this->db->loadModule('Reverse');
                $res = $this->db->reverse->tableInfo($table);
            } else {
                $res = $this->db->tableInfo($table);
            }
            if (PEAR::isError($res)) {
                $this->_errorSet($res->getUserInfo());
                return false;
            }
        }

        $ret = array();
        foreach ($res as $key => $val) {
            $ret[$val['name']] = $val;
        }
        if ($this->_MDBversion == 2) {
            if ($this->db->options['portability'] & MDB2_PORTABILITY_FIX_CASE) {
                $ret = array_change_key_case($ret, $this->db->options['field_case']);
            }
        } else {
            if ($this->db->options['optimize'] == 'portability') {
                $ret = array_change_key_case($ret, CASE_LOWER);
            }
        }
        $this->_metadata[$table] = $ret;
        return $ret;
    }

    // }}}

    //
    //  methods for building the query
    //

    // {{{ _prependTableName()

    /**
     * replace 'column' by 'table.column' if the column is defined for the table
     *
     * @param string $fieldlist
     * @param string $table table name
     * @return string $fieldlist
     * @see http://pear.php.net/bugs/bug.php?id=9734
     * @access private
     */
    function _prependTableName($fieldlist, $table) {
        if (!$meta = $this->metadata($table)) {
            return $fieldlist;
        }
        $fields = explode(',', $fieldlist);
        foreach (array_keys($meta) as $column) {
            //$fieldlist = preg_replace('/(^\s*|\s+|,)'.$column.'\s*(,)?/U', "$1{$table}.$column$2", $fieldlist);
            $pattern = '/^'.$column.'\b.*/U';
            foreach (array_keys($fields) as $k) {
                $fields[$k] = trim($fields[$k]);
                if (!strpos($fields[$k], '.') && preg_match($pattern, $fields[$k])) {
                    $fields[$k] = $table.'.'.$fields[$k];
                }
            }
        }
        return implode(',', $fields);
    }

    // }}}
    // {{{ _buildFrom()

    /**
     * build the from string
     *
     * @return     string  the string added after FROM
     * @access     private
     */
    function _buildFrom()
    {
        $from = $this->table;
        $join = $this->getJoin();

        if (!$join) {  // no join set
            return $from;
        }
        // handle the standard join thingy
        if (isset($join['default']) && count($join['default'])) {
            $from .= ',' . implode(',', array_keys($join['default']));
        }

        // handle left/right/inner joins
        foreach (array('left', 'right', 'inner') as $joinType) {
            if (isset($join[$joinType]) && count($join[$joinType])) {
                foreach($join[$joinType] as $table => $condition) {
                    // replace the _TABLENAME_COLUMNNAME by TABLENAME.COLUMNNAME
                    // since oracle doesnt work with the _TABLENAME_COLUMNNAME which i think is strange
// FIXXME i think this should become deprecated since the setWhere should not be used like this: '_table_column' but 'table.column'
                    $regExp = '/_('.$table.')_([^\s]+)/';
                    $where = preg_replace($regExp, '$1.$2', $condition);

                    // add the table name before any column that has no table prefix
                    // since this might cause "unambiguous column" errors
                    if ($meta = $this->metadata()) {
                        foreach ($meta as $aCol=>$x) {
                            // this covers the LIKE,IN stuff: 'name LIKE "%you%"'  'id IN (2,3,4,5)'
                            $condition = preg_replace('/\s'.$aCol.'\s/', " {$this->table}.$aCol ", $condition);
                            // replace also the column names which are behind a '='
                            // and do this also if the aCol is at the end of the where clause
                            // that's what the $ is for
                            $condition = preg_replace('/=\s*'.$aCol.'(\s|$)/', "={$this->table}.$aCol ", $condition);
                            // replace if colName is first and possibly also if at the beginning of the where-string
                            $condition = preg_replace('/(^\s*|\s+)'.$aCol.'\s*=/', "$1{$this->table}.$aCol=", $condition);
                        }
                    }
                    $from .= ' '.strtoupper($joinType).' JOIN '.$table.' ON '.$condition;
                }
            }
        }
        return $from;
    }

    // }}}
    // {{{ getTableShortName()

    /**
     * Gets the short name for a table
     *
     * get the short name for a table, this is needed to properly build the
     * 'AS' parts in the select query
     * @param  string  the real table name
     * @return string  the table's short name
     * @access public
     */
    function getTableShortName($table)
    {
        $tableSpec = $this->getTableSpec(false);
        if (isset($tableSpec[$table]['shortName']) && $tableSpec[$table]['shortName']) {
//print "$table ... ".$tableSpec[$table]['shortName'].'<br />';
            return $tableSpec[$table]['shortName'];
        }

        $possibleTableShortName = preg_replace($this->_tableNameToShortNamePreg, '', $table);
//print "$table ... $possibleTableShortName<br />";
        return $possibleTableShortName;
    }

    // }}}
    // {{{ getTableSpec()

    /**
     * gets the tableSpec either indexed by the short name or the name
     * returns the array for the tables given as parameter or if no
     * parameter given for all tables that exist in the tableSpec
     *
     * @param  array   table names (not the short names!)
     * @param  boolean if true the table is returned indexed by the shortName
     *                 otherwise indexed by the name
     * @return array   the tableSpec indexed
     * @access public
     */
    function getTableSpec($shortNameIndexed=true, $tables=array())
    {
        $newSpec = array();
        foreach ($this->tableSpec as $aSpec) {
            if (sizeof($tables)==0 || in_array($aSpec['name'], $tables)) {
                if ($shortNameIndexed) {
                    $newSpec[$aSpec['shortName']] = $aSpec;
                } else {
                    $newSpec[$aSpec['name']] = $aSpec;
                }
            }
        }
        return $newSpec;
    }

    // }}}
    // {{{ _buildSelect()

    /**
     * build the 'SELECT <what> FROM ... 'for a select
     *
     * @param   string  if given use this string
     * @return  string  the what-clause
     * @access  private
     */
    function _buildSelect($what=null)
    {
        // what has preference, that means if what is set it is used
        // this is only because the methods like 'get' pass an individually built value, which
        // is supposed to be used, but usually it's generically build using the 'getSelect' values
        if (empty($what) && $this->getSelect()) {
            $what = $this->getSelect();
        }

        //
        // replace all the '*' by the real column names, and take care of the dontSelect-columns!
        //
        $dontSelect = $this->getDontSelect();
        $dontSelect = $dontSelect ? explode(',', $dontSelect) : array(); // make sure dontSelect is an array

        // here we will replace all the '*' and 'table.*' by all the columns that this table
        // contains. we do this so we can easily apply the 'dontSelect' values.
        // and so we can also handle queries like: 'SELECT *,count() FROM ' and 'SELECT table.*,x FROM ' too
        if (strpos($what, '*') !== false) {
            // subpattern 1 get all the table names, that are written like this: 'table.*' including '*'
            // for '*' the tablename will be ''
            preg_match_all('/([^,]*)(\.)?\*\s*(,|$)/U', $what, $res);
//print "$what ... "; print_r($res); print '<br />';
            $selectAllFromTables = array_unique($res[1]); // make the table names unique, so we do it all just once for each table
            $tables = array();
            if (in_array('', $selectAllFromTables)) { // was there a '*' ?
                // get all the tables that we need to process, depending on if joined or not
                $tables = $this->getJoin() ?
                                array_merge($this->getJoin('tables'), array($this->table)) : // get the joined tables and this->table
                                array($this->table);        // create an array with only this->table
            } else {
                $tables = $selectAllFromTables;
            }

            $cols = array();
            foreach ($tables as $aTable) {      // go thru all the tables and get all columns for each, and handle 'dontSelect'
                if ($meta = $this->metadata($aTable)) {
                    foreach ($meta as $colName => $x) {
                        // handle the dontSelect's
                        if (in_array($colName, $dontSelect) || in_array("$aTable.$colName", $dontSelect)) {
                            continue;
                        }

                        // build the AS clauses
                        // put " around them to enable use of reserved words, i.e. SELECT table.option as option FROM...
                        // and 'option' actually is a reserved word, at least in mysql
                        // but don't do this for ibase because it doesn't work!
                        if ($aTable == $this->table) {
                            if ($this->db->phptype == 'ibase') {
                                $cols[$aTable][] = $this->table. '.' .$colName . ' AS '. $colName;
                            } else {
                                $cols[$aTable][] = $this->table. '.' .$colName . ' AS '. $this->db->quoteIdentifier($colName);
                            }
                        } else {
                            if ($this->db->phptype == 'ibase') {
                                //$cols[$aTable][] = $aTable. '.' .$colName . ' AS _'. $this->getTableShortName($aTable) .'_'. $colName;
                                //with ibase, don't quote aliases,
                                //and prepend the joined table cols alias with "t_"
                                //because an alias starting with just "_" triggers
                                //an "invalid token" error
                                $cols[$aTable][] = $aTable. '.' .$colName . ' AS t_'. $this->getTableShortName($aTable) .'_'. $colName;
                            } else {
                                $cols[$aTable][] = $aTable. '.' .$colName . ' AS '. $this->db->quoteIdentifier('_'. $this->getTableShortName($aTable) .'_'. $colName);
                            }
                        }
                    }
                }
            }

            // put the extracted select back in the $what
            // that means replace 'table.*' by the i.e. 'table.id AS _table_id'
            // or if it is the table of this class replace 'table.id AS id'
            if (in_array('', $selectAllFromTables)) {
                $allCols = array();
                foreach ($cols as $aTable) {
                    $allCols[] = implode(',', $aTable);
                }
                $what = preg_replace('/(^|,)\*($|,)/', '$1'.implode(',', $allCols).'$2', $what);
                // remove all the 'table.*' since we have selected all anyway (because there was a '*' in the select)
                $what = preg_replace('/[^,]*(\.)?\*\s*(,|$)/U', '', $what);
            } else {
                foreach ($cols as $tableName => $aTable) {
                    if (is_array($aTable) && sizeof($aTable)) {
                        // replace all the 'table.*' by their select of each column
                        $what = preg_replace('/(^|,)\s*'.$tableName.'\.\*\s*($|,)/', '$1'.implode(',', $aTable).'$2', $what);
                    }
                }
            }
        }

        if ($this->getJoin()) {
            // replace all 'column' by '$this->table.column' to prevent ambiguous errors
            $metadata = $this->metadata();
            if (is_array($metadata)) {
                foreach ($metadata as $aCol => $x) {
                    // handle ',id as xid,MAX(id),id' etc.
// FIXXME do this better!!!
                    $what = preg_replace(   "/(^|,|\()(\s*)$aCol(\)|\s|,|as|$)/i",
                                            // $2 is actually just to keep the spaces, is not really
                                            // necessary, but this way the test works independent of this functionality here
                                            "$1$2{$this->table}.$aCol$3",
                                            $what);
                }
            }
            // replace all 'joinedTable.columnName' by '_joinedTable_columnName'
            // this actually only has an effect if there was no 'table.*' for 'table'
            // if that was there, then it has already been done before
            foreach ($this->getJoin('tables') as $aTable) {
                if ($meta = $this->metadata($aTable)) {
                    foreach ($meta as $aCol => $x) {
                        // dont put the 'AS' behind it if there is already one
                        if (preg_match("/$aTable.$aCol\s*as/i", $what)) {
                            continue;
                        }
                        // this covers a ' table.colName ' surrounded by spaces, and replaces it by ' table.colName AS _table_colName'
                        $what = preg_replace('/\s'.$aTable.'.'.$aCol.'\s/', " $aTable.$aCol AS _".$this->getTableShortName($aTable)."_$aCol ", $what);
                        // replace also the column names which are behind a ','
                        // and do this also if the aCol is at the end that's what the $ is for
                        $what = preg_replace('/,\s*'.$aTable.'.'.$aCol.'(,|\s|$)/', ",$aTable.$aCol AS _".$this->getTableShortName($aTable)."_$aCol$1", $what);
                        // replace if colName is first and possibly also if at the beginning of the where-string
                        $what = preg_replace('/(^\s*|\s+)'.$aTable.'.'.$aCol.'\s*,/', "$1$aTable.$aCol AS _".$this->getTableShortName($aTable)."_$aCol,", $what);
                    }
                }
            }
        }

        // quotations of columns
        $columns    = explode(',', $what);
        $identifier = substr($this->db->quoteIdentifier(''), 0, 1);
        for ($i=0; $i<sizeof($columns); $i++) {
            $column = trim($columns[$i]);
            // Uppercasing "as"
            $column = str_replace(' as ', ' AS ', $column);
            if (strpos($column, ' AS ') !== false) {
                $column = explode(' AS ', $column);
                if (strpos($column[0], '(') !== false) {
                    //do not quote function calls, COUNT(), etc.
                    $column[1] = $this->db->quoteIdentifier($column[1]);
                } elseif (strpos($column[0], '.') !== false) {
                    $column[0] = explode('.', $column[0]);
                    $column[0][1] = $this->db->quoteIdentifier($column[0][1]);
                    $column[0] = implode('.', $column[0]);
                } else {
                    $column[0] = $this->db->quoteIdentifier($column[0]);
                }
                $column = implode(' AS ', $column);
            } else {
                if (strpos($column[0], '(') !== false) {
                    //do not quote function calls, COUNT(), etc.
                } elseif (strpos($column, '.') !== false) {
                    $column = explode('.', $column);
                    $column[1] = $this->db->quoteIdentifier($column[1]);
                    $column = implode('.', $column);
                } else {
                    $column = $this->db->quoteIdentifier($column);
                }
            }
            // Clean up if a function was used in the query
            if (substr($column, -2) == ')'.$identifier) {
                $column = substr($column, 0, -2).$identifier.')';
                // Some like spaces in the function
                while (strpos($column, ' '.$identifier) !== false) {
                    $column = str_replace(' '.$identifier, $identifier.' ', $column);
                }
            }
            $columns[$i] = $column;
        }
        return implode(',', $columns);
    }

    // }}}
    // {{{ _buildWhere()

    /**
     * Build WHERE clause
     *
     * @param  string $where WHERE clause
     * @return string $where WHERE clause after processing
     * @access private
     */
    function _buildWhere($where='')
    {
        $where = trim($where);
        $originalWhere = $this->getWhere();
        if ($originalWhere) {
            if (!empty($where)) {
                $where = $originalWhere.' AND '.$where;
            } else {
                $where = $originalWhere;
            }
        }
        $where = trim($where);

        if ($join = $this->getJoin()) {     // is join set?
            // only those where conditions in the default-join have to be added here
            // left-join conditions are added behind 'ON', the '_buildJoin()' does that
            if (isset($join['default']) && count($join['default'])) {
                // we have to add this join-where clause here
                // since at least in mysql a query like: select * from tableX JOIN tableY ON ...
                // doesnt work, may be that's even SQL-standard...
                if (!empty($where)) {
                    $where = implode(' AND ', $join['default']).' AND '.$where;
                } else {
                    $where = implode(' AND ', $join['default']);
                }
            }
            // replace the _TABLENAME_COLUMNNAME by TABLENAME.COLUMNNAME
            // since oracle doesnt work with the _TABLENAME_COLUMNNAME which i think is strange
// FIXXME i think this should become deprecated since the setWhere should not be used like this: '_table_column' but 'table.column'
            $regExp = '/_('.implode('|', $this->getJoin('tables')).')_([^\s]+)/';
            $where = preg_replace($regExp, '$1.$2', $where);
            // add the table name before any column that has no table prefix
            // since this might cause "unambigious column" errors
            if ($meta = $this->metadata()) {
                foreach ($meta as $aCol => $x) {
                    // this covers the LIKE,IN stuff: 'name LIKE "%you%"'  'id IN (2,3,4,5)'
                    $where = preg_replace('/\s'.$aCol.'\s/', " {$this->table}.$aCol ", $where);
                    // replace also the column names which are behind a '='
                    // and do this also if the aCol is at the end of the where clause
                    // that's what the $ is for
                    $where = preg_replace('/([=<>])\s*'.$aCol.'(\s|$)/', "$1{$this->table}.$aCol ", $where);
                    // replace if colName is first and possibly also if at the beginning of the where-string
                    $where = preg_replace('/(^\s*|\s+)'.$aCol.'\s*([=<>])/', "$1{$this->table}.$aCol$2", $where);
                }
            }
        }
        return $where;
    }

    // }}}
    // {{{ _buildOrder()

    /**
     * Build the "ORDER BY" clause, replace 'column' by 'table.column'.
     *
     * @return string  the rendered "ORDER BY" clause
     * @access private
     */
    function _buildOrder()
    {
        return $this->_prependTableName($this->getOrder(), $this->table);
    }

    // }}}
    // {{{ _buildGroup()

    /**
     * Build the "GROUP BY" clause, replace 'column' by 'table.column'.
     *
     * @return string the rendered "GROUP BY" clause
     * @access private
     */
    function _buildGroup()
    {
        return $this->_prependTableName($this->getGroup(), $this->table);
    }

    // }}}
    // {{{ _buildHaving()

    /**
     * Build the "HAVING" clause, replace 'column' by 'table.column'.
     *
     * @return string the rendered "HAVING" clause
     * @access private
     */
    function _buildHaving()
    {
        return $this->_prependTableName($this->getHaving(), $this->table);
    }

    // }}}
    // {{{ _buildSelectQuery()

    /**
     * Build the "SELECT" query
     *
     * @param  array   this array contains the elements of the query,
     *                 indexed by their key, which are: 'select','from','where', etc.
     * @param  boolean whether this method is called via getCount() or not.
     * @return string $querystring or false on error
     * @access private
     */
    function _buildSelectQuery($query=array(), $isCalledViaGetCount = false)
    {
        $where = isset($query['where']) ? $query['where'] : $this->_buildWhere();
        if ($where) {
            $where = 'WHERE '.$where;
        }
        $order = isset($query['order']) ? $query['order'] : $this->_buildOrder();
        if ($order) {
            $order = 'ORDER BY '.$order;
        }
        $group = isset($query['group']) ? $query['group'] : $this->_buildGroup();
        if ($group) {
            $group = 'GROUP BY '.$group;
        }
        $having = isset($query['having']) ? $query['having'] : $this->_buildHaving();
        if ($having) {
            $having = 'HAVING '.$having;
        }
        $queryString = sprintf(
            'SELECT %s FROM %s %s %s %s %s',
            isset($query['select']) ? $query['select'] : $this->_buildSelect(),
            isset($query['from'])   ? $query['from']   : $this->_buildFrom(),
            $where,
            $group,
            $having,
            $order
        );
        // $query['limit'] has preference!
        $limit = isset($query['limit']) ? $query['limit'] : $this->_limit;
        if (!$isCalledViaGetCount && !empty($limit[1])) {
            // is there a count set?
            if ($this->_MDBversion == 2) {
                $func = 'setLimit';
                $error = $this->db->setLimit($limit[1], $limit[0]);
            } else {
                $func = 'setSelectedRowRange';
                $error = $this->db->setSelectedRowRange($limit[0], $limit[1]);
            }
            if (PEAR::isError($error)) {
                $this->_errorSet('MDB_QueryTool_Common::_buildSelectQuery '.$func.' failed '.$error->getMessage());
                $this->_errorLog($error->getUserInfo());
                return false;
            }
        }
        return $queryString;
    }

    // }}}
    // {{{ _buildUpdateQuery()

    /**
     * this simply builds an update query.
     *
     * @param  array   the parameter array might contain the following indexes
     *         'where'   the where clause to be added, i.e.
     *                   UPDATE table SET x=1 WHERE y=0
     *                   here the 'where' part simply would be 'y=0'
     *         'set'     the actual data to be updated
     *                   in the example above, that would be 'x=1'
     * @return string the resulting query
     * @access private
     */
    function _buildUpdateQuery($query=array())
    {
        $where = isset($query['where']) ? $query['where'] : $this->_buildWhere();
        if ($where) {
            $where = 'WHERE '.$where;
        }

        $updateString = sprintf(
            'UPDATE %s SET %s %s',
            $this->table,
            $query['set'],
            $where
        );
        return $updateString;
    }

    // }}}
    // {{{ execute()

    /**
     *
     * @param string $query
     * @param string method
     * @return resultSet or false on error
     * @access public
     */
    function execute($query=null, $method='queryAll')
    {
        $this->writeLog();
        if (is_null($query)) {
            $query = $this->_buildSelectQuery();
        }
        $this->writeLog('query built: '.$query);
// FIXXME on ORACLE this doesnt work, since we return joined columns as _TABLE_COLNAME and the _ in front
// doesnt work on oracle, add a letter before it!!!
        $this->_lastQuery = $query;

        $this->debug($query);
        $this->writeLog('start query');
        if ((substr($method, 0, 3) == 'get') && ($method != 'getAssoc')) {
            $method = 'query'.substr($method, 3);
        }
        if (PEAR::isError($res = $this->db->$method($query))) {
            $this->writeLog('end query (failed)');
            if ($this->getOption('verbose')) {
                //$this->_errorSet($this->db->errorMessage($res->getCode()));
                $this->_errorSet($res->getMessage() .'-'. $res->getUserInfo());
            } else {
                //$this->_errorLog($this->db->errorMessage($res->getCode()));
                $this->_errorLog($res->getMessage());
            }
            $this->_errorLog($res->getUserInfo(), __LINE__);
            return false;
        } else {
            $this->writeLog('end query');
        }

        return $this->_makeIndexed($res);
    }

    // }}}
    // {{{ writeLog()

    /**
     * Write events to the logfile.
     *
     * It does some additional work, like time measuring etc. to
     * see some additional info
     *
     * @param string $text
     * @access public
     */
    function writeLog($text='START')
    {
//its still really a quicky.... 'refactor' (nice word) that
        if (!isset($this->options['logfile'])) {
            return;
        }

        include_once 'Log.php';
        if (!class_exists('Log')) {
            return;
        }
        if (!$this->_logObject) {
            $this->_logObject =& Log::factory('file', $this->options['logfile']);
        }

        if ($text === 'start query' || $text === 'end query') {
            $bytesSent = $this->db->queryAll("SHOW STATUS like 'Bytes_sent'");
            $bytesSent = $bytesSent[0]['Value'];
        }
        if ($text === 'START') {
            $startTime = split(' ', microtime());
            $this->_logData['startTime'] = $startTime[1] + $startTime[0];
        }
        if ($text === 'start query') {
            $this->_logData['startBytesSent'] = $bytesSent;
            $startTime = split(' ', microtime());
            $this->_logData['startQueryTime'] = $startTime[1] + $startTime[0];
            return;
        }
        if ($text === 'end query') {
            $text .= ' result size: '.((int)$bytesSent-(int)$this->_logData['startBytesSent']).' bytes';
            $endTime = split(' ', microtime());
            $endTime = $endTime[1] + $endTime[0];
            $text .= ', took: '.(($endTime - $this->_logData['startQueryTime'])).' seconds';
        }
        if (strpos($text, 'query built') === 0) {
            $endTime = split(' ', microtime());
            $endTime = $endTime[1] + $endTime[0];
            $this->writeLog('query building took: '.(($endTime - $this->_logData['startTime'])).' seconds');
        }
        $this->_logObject->log($text);

        if (strpos($text, 'end query') === 0) {
            $endTime = split(' ', microtime());
            $endTime = $endTime[1] + $endTime[0];
            $text = 'time over all: '.(($endTime - $this->_logData['startTime'])).' seconds';
            $this->_logObject->log($text);
        }
    }

    // }}}
    // {{{ returnResult()

    /**
     * Return the chosen result type
     *
     * @param object reference
     * @return mixed [boolean, array or object]
     * @access     public
     */
    function returnResult($result)
    {
        if ($this->_resultType == 'none') {
            return $result;
        }
        if ($result === false) {
            return false;
        }
        //what about allowing other (custom) result types?
        switch (strtolower($this->_resultType)) {
            case 'object':  return new MDB_QueryTool_Result_Object($result, $this);
            case 'array':
            default:        return new MDB_QueryTool_Result($result);
        }
    }

    // }}}
    // {{{ setReturnClass()

    /**
     * Sets the name of the class to use as result object
     *
     * @param string Name of class
     * @return boolean true on success, false otherwise
     * @access public
     */
    function setReturnClass($name)
    {
        $test = new $name(array(), $this);
        if (is_a($test, 'MDB_QueryTool_Result_Row')) {
            $this->_returnclass = $name;
            return true;
        }
        return false;
    }

    // }}}
    // {{{ _makeIndexed()

    /**
     *
     * @param  mixed $data
     * @return mixed $data or array $indexedData
     * @access public
     */
    function &_makeIndexed(&$data)
    {
        // we can only return an indexed result if the result has a number of columns
        if (is_array($data) && sizeof($data) && $key=$this->getIndex()) {
            // build the string to evaluate which might be made up out of multiple indexes of a result-row
            $evalString = '$val[\''.implode('\'].\',\'.$val[\'', explode(',', $key)) .'\']';   //"

            $indexedData = array();
//FIXXME actually we also need to check ONCE if $val is an array, so to say if $data is 2-dimensional
            foreach ($data as $val) {
                eval("\$keyValue = $evalString;");  // get the actual real (string-)key (string if multiple cols are used as index)
                $indexedData[$keyValue] = $val;
            }
            unset($data);
            return $indexedData;
        }
        return $data;
    }

    // }}}
    // {{{ setIndex()

    /**
     * format the result to be indexed by $key
     * NOTE: be careful, when using this you should be aware, that if you
     * use an index which's value appears multiple times you may loose data
     * since a key cant exist multiple times!!
     * the result for a result to be indexed by a key(=columnName)
     * (i.e. 'relationtoMe') which's values are 'brother' and 'sister'
     * or alike normally returns this:
     *     $res['brother'] = array('name'=>'xxx')
     *     $res['sister'] = array('name'=>'xxx')
     * but if the column 'relationtoMe' contains multiple entries for 'brother'
     * then the returned dataset will only contain one brother, since the
     * value from the column 'relationtoMe' is used
     * and which 'brother' you get depends on a lot of things, like the sortorder,
     * how the db saves the data, and whatever else
     *
     * you can also set indexes which depend on 2 columns, simply pass the parameters like
     * 'table1.id,table2.id' it will be used as a string for indexing the result
     * and the index will be built using the 2 values given, so a possible
     * index might be '1,2' or '2108,29389' this way you can access data which
     * have 2 primary keys. Be sure to remember that the index is a string!
     *
     * @param  string $key
     * @access public
     */
    function setIndex($key=null)
    {
        if ($this->getJoin()) {  // is join set?
            // replace TABLENAME.COLUMNNAME by _TABLENAME_COLUMNNAME
            // since this is only the result-keys can be used for indexing :-)
            $regExp = '/('. implode('|', $this->getJoin('tables')) .')\.([^\s]+)/';
            $key = preg_replace($regExp, '_$1_$2', $key);

            // remove the table name if it is in front of '<$this->table>.columnname'
            // since the key doesnt contain it neither
            if ($meta = $this->metadata()) {
                foreach ($meta as $aCol => $x) {
                    $key = preg_replace('/'.$this->table.'\.'.$aCol.'/', $aCol, $key);
                }
            }
        }
        $this->_index = $key;
    }

    // }}}
    // {{{ getIndex()

    /**
     *
     * @return string index
     * @access public
     */
    function getIndex()
    {
        return $this->_index;
    }

    // }}}
    // {{{ useResult()

    /**
     * Choose the type of the returned result
     *
     * @param string $type  ['array' | 'object' | 'none']
     *        For BC reasons, $type=true is equal to 'array',
     *        $type=false is equal to 'none'
     * @access public
     */
    function useResult($type='array')
    {
        if ($type === true) {
            $type = 'array';
        } elseif ($type === false) {
            $type = 'none';
        }
        switch (strtolower($type)) {
            case 'array':
                $this->_resultType = 'array';
                require_once 'MDB/QueryTool/Result.php';
                break;
            case 'object':
                $this->_resultType = 'object';
                require_once 'MDB/QueryTool/Result/Object.php';
                break;
            default:
                $this->_resultType = 'none';
        }
    }

    // }}}
    // {{{ setErrorCallback()

    /**
     * set both callbacks
     * @param string
     * @access public
     */
    function setErrorCallback($param='')
    {
        $this->setErrorLogCallback($param);
        $this->setErrorSetCallback($param);
    }

    // }}}
    // {{{ setErrorLogCallback()

    /**
     * @param string
     */
    function setErrorLogCallback($param='')
    {
        $errorLogCallback = &PEAR::getStaticProperty('MDB_QueryTool', '_errorLogCallback');
        $errorLogCallback = $param;
    }

    // }}}
    // {{{ setErrorSetCallback()

    /**
     * @param string
     */
    function setErrorSetCallback($param='')
    {
        $errorSetCallback = &PEAR::getStaticProperty('MDB_QueryTool', '_errorSetCallback');
        $errorSetCallback = $param;
    }

    // }}}
    // {{{ _errorLog()

    /**
     * sets error log and adds additional info
     *
     * @param  string  the actual message, first word should always be the method name,
     *                 to build the message like this: className::methodname
     * @param  integer the line number
     * @access private
     */
    function _errorLog($msg, $line='unknown')
    {
        $this->_errorHandler('log', $msg, $line);
/*
        if ($this->getOption('verbose') == true) {
            $this->_errorLog( get_class($this)."::$msg ($line)");
            return;
        }
        if ($this->_errorLogCallback) {
            call_user_func( $this->_errorLogCallback , $msg );
        }
*/
    }

    // }}}
    // {{{ _errorSet()

    /**
     * @param      string
     * @param      string
     */
    function _errorSet($msg, $line='unknown')
    {
        $this->_errorHandler('set', $msg, $line);
    }

    // }}}
    // {{{ _errorHandler()

    /**
     * @param
     * @param      string
     * @param      string
     */
    function _errorHandler($logOrSet, $msg, $line='unknown')
    {
/* what did i do this for?
        if ($this->getOption('verbose') == true) {
            $this->_errorHandler($logOrSet, get_class($this)."::$msg ($line)");
            return;
        }
*/

        $msg = get_class($this)."::$msg ($line)";

        $logOrSet = ucfirst($logOrSet);
        $callback = &PEAR::getStaticProperty('MDB_QueryTool', '_error' . $logOrSet . 'Callback');
        if ($callback) {
            call_user_func($callback, $msg);
        } //else {
            // ?????
        //}
    }

    // }}}
    // {{{ newEntity()

    /**
     * Returns a new entity including an instance to QueryTool
     *
     * @return new entity
     * @access public
     */
    function newEntity()
    {
        if (strtolower($this->_resultType) == 'object') {
            $result = new MDB_QueryTool_Result_Object(array(), $this);
            return $result->newEntity();
        }
    }

    // }}}
}
?>