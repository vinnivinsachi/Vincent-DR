<?php

/**
* 
* DB_Table is a database API and data type SQL abstraction class.
* 
* DB_Table provides database API abstraction, data type abstraction,
* automated SELECT, INSERT, and UPDATE queries, automated table
* creation, automated validation of inserted/updated column values,
* and automated creation of QuickForm elements based on the column
* definitions.
* 
* @category DB
* 
* @package DB_Table
*
* @author Paul M. Jones <pmjones@php.net>
* @author Mark Wiesemann <wiesemann@php.net>
* 
* @license http://www.gnu.org/copyleft/lesser.html LGPL
* 
* @version $Id: Table.php,v 1.69 2006/11/09 20:56:30 wiesemann Exp $
*
*/

/**
* Error code at instantiation time when the first parameter to the
* constructor is not a PEAR DB object.
*/
define('DB_TABLE_ERR_NOT_DB_OBJECT',    -1);

/**
* Error code at instantiation time when the PEAR DB/MDB2 $phptype is not
* supported by DB_Table.
*/
define('DB_TABLE_ERR_PHPTYPE',          -2);

/**
* Error code when you call select() or selectResult() and the first
* parameter does not match any of the $this->sql keys.
*/
define('DB_TABLE_ERR_SQL_UNDEF',        -3);

/**
* Error code when you try to insert data to a column that is not in the
* $this->col array.
*/
define('DB_TABLE_ERR_INS_COL_NOMAP',    -4);

/**
* Error code when you try to insert data, and that data does not have a
* column marked as 'require' in the $this->col array.
*/
define('DB_TABLE_ERR_INS_COL_REQUIRED', -5);

/**
* Error code when auto-validation fails on data to be inserted.
*/
define('DB_TABLE_ERR_INS_DATA_INVALID', -6);

/**
* Error code when you try to update data to a column that is not in the
* $this->col array.
*/
define('DB_TABLE_ERR_UPD_COL_NOMAP',    -7);

/**
* Error code when you try to update data, and that data does not have a
* column marked as 'require' in the $this->col array.
*/
define('DB_TABLE_ERR_UPD_COL_REQUIRED', -8);

/**
* Error code when auto-validation fails on update data.
*/
define('DB_TABLE_ERR_UPD_DATA_INVALID', -9);

/**
* Error code when you use a create() flag that is not recognized (must
* be 'safe', 'drop', 'verify' or boolean false.
*/
define('DB_TABLE_ERR_CREATE_FLAG',      -10);

/**
* Error code at create() time when you define an index in $this->idx
* that has no columns.
*/
define('DB_TABLE_ERR_IDX_NO_COLS',      -11);

/**
* Error code at create() time when you define an index in $this->idx
* that refers to a column that does not exist in the $this->col array.
*/
define('DB_TABLE_ERR_IDX_COL_UNDEF',    -12);

/**
* Error code at create() time when you define a $this->idx index type
* that is not recognized (must be 'normal' or 'unique').
*/
define('DB_TABLE_ERR_IDX_TYPE',         -13);

/**
* Error code at create() time when you have an error in a 'char' or
* 'varchar' definition in $this->col (usually because 'size' is wrong).
*/
define('DB_TABLE_ERR_DECLARE_STRING',   -14);

/**
* Error code at create() time when you have an error in a 'decimal'
* definition (usually becuase the 'size' or 'scope' are wrong).
*/
define('DB_TABLE_ERR_DECLARE_DECIMAL',  -15);

/**
* Error code at create() time when you define a column in $this->col
* with an unrecognized 'type'.
*/
define('DB_TABLE_ERR_DECLARE_TYPE',     -16);

/**
* Error code at validation time when a column in $this->col has an
* unrecognized 'type'.
*/
define('DB_TABLE_ERR_VALIDATE_TYPE',    -17);

/**
* Error code at create() time when you define a column in $this->col
* with an invalid column name (usually because it's a reserved keyword).
*/
define('DB_TABLE_ERR_DECLARE_COLNAME',  -18);

/**
* Error code at create() time when you define an index in $this->idx
* with an invalid index name (usually because it's a reserved keyword).
*/
define('DB_TABLE_ERR_DECLARE_IDXNAME',  -19);

/**
* Error code at create() time when you define an index in $this->idx
* that refers to a CLOB column.
*/
define('DB_TABLE_ERR_IDX_COL_CLOB',     -20);

/**
* Error code at create() time when you define a column name that is
* more than 30 chars long (an Oracle restriction).
*/
define('DB_TABLE_ERR_DECLARE_STRLEN',   -21);

/**
* Error code at create() time when the index name ends up being more
* than 30 chars long (an Oracle restriction).
*/
define('DB_TABLE_ERR_IDX_STRLEN',       -22);

/**
* Error code at create() time when the table name is more than 30 chars
* long (an Oracle restriction).
*/
define('DB_TABLE_ERR_TABLE_STRLEN',     -23);

/**
* Error code at nextID() time when the sequence name is more than 30
* chars long (an Oracle restriction).
*/
define('DB_TABLE_ERR_SEQ_STRLEN',       -24);

/**
* Error code at verify() time when the table does not exist in the
* database.
*/
define('DB_TABLE_ERR_VER_TABLE_MISSING', -25);

/**
* Error code at verify() time when the column does not exist in the
* database table.
*/
define('DB_TABLE_ERR_VER_COLUMN_MISSING', -26);

/**
* Error code at verify() time when the column type does not match the
* type specified in the column declaration.
*/
define('DB_TABLE_ERR_VER_COLUMN_TYPE',  -27);

/**
* Error code at instantiation time when the column definition array
* does not contain at least one column.
*/
define('DB_TABLE_ERR_NO_COLS',          -28);

/**
* Error code at verify() time when an index cannot be found in the
* database table.
*/
define('DB_TABLE_ERR_VER_IDX_MISSING',   -29);

/**
* Error code at verify() time when an index does not contain all
* columns that it should contain.
*/
define('DB_TABLE_ERR_VER_IDX_COL_MISSING', -30);

/**
* Error code at instantiation time when a creation mode
* is not available for a phptype.
*/
define('DB_TABLE_ERR_CREATE_PHPTYPE', -31);

/**
* Error code at create() time when you define more than one primary key
* in $this->idx.
*/
define('DB_TABLE_ERR_DECLARE_PRIMARY', -32);

/**
* Error code at create() time when a primary key is defined in $this->idx
* and SQLite is used (SQLite does not support primary keys).
*/
define('DB_TABLE_ERR_DECLARE_PRIM_SQLITE', -33);

/**
* Error code at alter() time when altering a table field is not possible
* (e.g. because MDB2 has no support for the change or because the DBMS
* does not support the change).
*/
define('DB_TABLE_ERR_ALTER_TABLE_IMPOS', -34);

/**
* Error code at alter() time when altering a(n) index/constraint is not possible
* (e.g. because MDB2 has no support for the change or because the DBMS
* does not support the change).
*/
define('DB_TABLE_ERR_ALTER_INDEX_IMPOS', -35);

/**
* The PEAR class for errors
*/
require_once 'PEAR.php';

/**
* The Date class for recasting date and time values
*/
require_once 'DB/Table/Date.php';


/**
* DB_Table supports these RDBMS engines and their various native data
* types; we need these here instead of in Manager.php because the
* initial array key tells us what databases are supported.
*/
$GLOBALS['_DB_TABLE']['type'] = array(
    'fbsql' => array(
        'boolean'   => 'DECIMAL(1,0)',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR',
        'smallint'  => 'SMALLINT',
        'integer'   => 'INTEGER',
        'bigint'    => 'LONGINT',
        'decimal'   => 'DECIMAL',
        'single'    => 'REAL',
        'double'    => 'DOUBLE PRECISION',
        'clob'      => 'CLOB',
        'date'      => 'CHAR(10)',
        'time'      => 'CHAR(8)',
        'timestamp' => 'CHAR(19)'
    ),
    'ibase' => array(
        'boolean'   => 'DECIMAL(1,0)',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR',
        'smallint'  => 'SMALLINT',
        'integer'   => 'INTEGER',
        'bigint'    => 'BIGINT',
        'decimal'   => 'DECIMAL',
        'single'    => 'FLOAT',
        'double'    => 'DOUBLE PRECISION',
        'clob'      => 'BLOB SUB_TYPE 1',
        'date'      => 'DATE',
        'time'      => 'TIME',
        'timestamp' => 'TIMESTAMP'
    ),
    'mssql' => array(
        'boolean'   => 'DECIMAL(1,0)',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR',
        'smallint'  => 'SMALLINT',
        'integer'   => 'INTEGER',
        'bigint'    => 'BIGINT',
        'decimal'   => 'DECIMAL',
        'single'    => 'REAL',
        'double'    => 'FLOAT',
        'clob'      => 'TEXT',
        'date'      => 'CHAR(10)',
        'time'      => 'CHAR(8)',
        'timestamp' => 'CHAR(19)'
    ),
    'mysql' => array(
        'boolean'   => 'DECIMAL(1,0)',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR',
        'smallint'  => 'SMALLINT',
        'integer'   => 'INTEGER',
        'bigint'    => 'BIGINT',
        'decimal'   => 'DECIMAL',
        'single'    => 'FLOAT',
        'double'    => 'DOUBLE',
        'clob'      => 'LONGTEXT',
        'date'      => 'CHAR(10)',
        'time'      => 'CHAR(8)',
        'timestamp' => 'CHAR(19)'
    ),
    'mysqli' => array(
        'boolean'   => 'DECIMAL(1,0)',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR',
        'smallint'  => 'SMALLINT',
        'integer'   => 'INTEGER',
        'bigint'    => 'BIGINT',
        'decimal'   => 'DECIMAL',
        'single'    => 'FLOAT',
        'double'    => 'DOUBLE',
        'clob'      => 'LONGTEXT',
        'date'      => 'CHAR(10)',
        'time'      => 'CHAR(8)',
        'timestamp' => 'CHAR(19)'
    ),
    'oci8' => array(
        'boolean'   => 'NUMBER(1)',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR2',
        'smallint'  => 'NUMBER(6)',
        'integer'   => 'NUMBER(11)',
        'bigint'    => 'NUMBER(19)',
        'decimal'   => 'NUMBER',
        'single'    => 'REAL',
        'double'    => 'DOUBLE PRECISION',
        'clob'      => 'CLOB',
        'date'      => 'CHAR(10)',
        'time'      => 'CHAR(8)',
        'timestamp' => 'CHAR(19)'
    ),
    'pgsql' => array(
        'boolean'   => 'DECIMAL(1,0)',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR',
        'smallint'  => 'SMALLINT',
        'integer'   => 'INTEGER',
        'bigint'    => 'BIGINT',
        'decimal'   => 'DECIMAL',
        'single'    => 'REAL',
        'double'    => 'DOUBLE PRECISION',
        'clob'      => 'TEXT',
        'date'      => 'CHAR(10)',
        'time'      => 'CHAR(8)',
        'timestamp' => 'CHAR(19)'
    ),
    'sqlite' => array(
        'boolean'   => 'BOOLEAN',
        'char'      => 'CHAR',
        'varchar'   => 'VARCHAR',
        'smallint'  => 'SMALLINT',
        'integer'   => 'INTEGER',
        'bigint'    => 'BIGINT',
        'decimal'   => 'NUMERIC',
        'single'    => 'FLOAT',
        'double'    => 'DOUBLE',
        'clob'      => 'CLOB',
        'date'      => 'DATE',
        'time'      => 'TIME',
        'timestamp' => 'TIMESTAMP'
    )
);


/** 
  * US-English default error messages. If you want to internationalize, you can
  * set the translated messages via $GLOBALS['_DB_TABLE']['error']. You can also
  * use DB_Table::setErrorMessage(). Examples:
  * 
  * <code>
  * (1) $GLOBALS['_DB_TABLE]['error'] = array(DB_TABLE_ERR_PHPTYPE   => '...',
  *                                           DB_TABLE_ERR_SQL_UNDEF => '...');
  * (2) DB_Table::setErrorMessage(DB_TABLE_ERR_PHPTYPE,   '...');
  *     DB_Table::setErrorMessage(DB_TABLE_ERR_SQL_UNDEF, '...');
  * (3) DB_Table::setErrorMessage(array(DB_TABLE_ERR_PHPTYPE   => '...');
  *                                     DB_TABLE_ERR_SQL_UNDEF => '...');
  * (4) $obj =& new DB_Table();
  *     $obj->setErrorMessage(DB_TABLE_ERR_PHPTYPE,   '...');
  *     $obj->setErrorMessage(DB_TABLE_ERR_SQL_UNDEF, '...');
  * (5) $obj =& new DB_Table();
  *     $obj->setErrorMessage(array(DB_TABLE_ERR_PHPTYPE   => '...');
  *                                 DB_TABLE_ERR_SQL_UNDEF => '...');
  * </code>
  * 
  * For errors that can occur with-in the constructor call (i.e. e.g. creating
  * or altering the database table), only the code from examples (1) to (3)
  * will alter the default error messages early enough. For errors that can
  * occur later, examples (4) and (5) are also valid.
  */
$GLOBALS['_DB_TABLE']['default_error'] = array(
    DB_TABLE_ERR_NOT_DB_OBJECT       => 'First parameter must be a DB/MDB2 object',
    DB_TABLE_ERR_PHPTYPE             => 'DB/MDB2 phptype (or dbsyntax) not supported',
    DB_TABLE_ERR_SQL_UNDEF           => 'Select key not in map',
    DB_TABLE_ERR_INS_COL_NOMAP       => 'Insert column not in map',
    DB_TABLE_ERR_INS_COL_REQUIRED    => 'Insert data must be set and non-null for column',
    DB_TABLE_ERR_INS_DATA_INVALID    => 'Insert data not valid for column',
    DB_TABLE_ERR_UPD_COL_NOMAP       => 'Update column not in map',
    DB_TABLE_ERR_UPD_COL_REQUIRED    => 'Update column must be set and non-null',
    DB_TABLE_ERR_UPD_DATA_INVALID    => 'Update data not valid for column',
    DB_TABLE_ERR_CREATE_FLAG         => 'Create flag not valid',
    DB_TABLE_ERR_IDX_NO_COLS         => 'No columns for index',
    DB_TABLE_ERR_IDX_COL_UNDEF       => 'Column not in map for index',
    DB_TABLE_ERR_IDX_TYPE            => 'Type not valid for index',
    DB_TABLE_ERR_DECLARE_STRING      => 'String column declaration not valid',
    DB_TABLE_ERR_DECLARE_DECIMAL     => 'Decimal column declaration not valid',
    DB_TABLE_ERR_DECLARE_TYPE        => 'Column type not valid',
    DB_TABLE_ERR_VALIDATE_TYPE       => 'Cannot validate for unknown type on column',
    DB_TABLE_ERR_DECLARE_COLNAME     => 'Column name not valid',
    DB_TABLE_ERR_DECLARE_IDXNAME     => 'Index name not valid',
    DB_TABLE_ERR_DECLARE_TYPE        => 'Column type not valid',
    DB_TABLE_ERR_IDX_COL_CLOB        => 'CLOB column not allowed for index',
    DB_TABLE_ERR_DECLARE_STRLEN      => 'Column name too long, 30 char max',
    DB_TABLE_ERR_IDX_STRLEN          => 'Index name too long, 30 char max',
    DB_TABLE_ERR_TABLE_STRLEN        => 'Table name too long, 30 char max',
    DB_TABLE_ERR_SEQ_STRLEN          => 'Sequence name too long, 30 char max',
    DB_TABLE_ERR_VER_TABLE_MISSING   => 'Verification failed: table does not exist',
    DB_TABLE_ERR_VER_COLUMN_MISSING  => 'Verification failed: column does not exist',
    DB_TABLE_ERR_VER_COLUMN_TYPE     => 'Verification failed: wrong column type',
    DB_TABLE_ERR_NO_COLS             => 'Column definition array may not be empty',
    DB_TABLE_ERR_VER_IDX_MISSING     => 'Verification failed: index does not exist',
    DB_TABLE_ERR_VER_IDX_COL_MISSING => 'Verification failed: index does not contain all specified cols',
    DB_TABLE_ERR_CREATE_PHPTYPE      => 'Creation mode is not supported for this phptype',
    DB_TABLE_ERR_DECLARE_PRIMARY     => 'Only one primary key is allowed',
    DB_TABLE_ERR_DECLARE_PRIM_SQLITE => 'SQLite does not support primary keys',
    DB_TABLE_ERR_ALTER_TABLE_IMPOS   => 'Alter table failed: changing the field type not possible',
    DB_TABLE_ERR_ALTER_INDEX_IMPOS   => 'Alter table failed: changing the index/constraint not possible'
);

// merge default and user-defined error messages
if (!isset($GLOBALS['_DB_TABLE']['error'])) {
    $GLOBALS['_DB_TABLE']['error'] = array();
}
foreach ($GLOBALS['_DB_TABLE']['default_error'] as $code => $message) {
    if (!array_key_exists($code, $GLOBALS['_DB_TABLE']['error'])) {
        $GLOBALS['_DB_TABLE']['error'][$code] = $message;
    }
}

/**
* 
* DB_Table is a database API and data type SQL abstraction class.
* 
* DB_Table provides database API abstraction, data type abstraction,
* automated SELECT, INSERT, and UPDATE queries, automated table
* creation, automated validation of inserted/updated column values,
* and automated creation of QuickForm elemnts based on the column
* definitions.
* 
* @category DB
* 
* @package DB_Table
* 
* @author Paul M. Jones <pmjones@php.net>
* @author Mark Wiesemann <wiesemann@php.net>
* 
* @version 1.4.0
*
*/

class DB_Table {
    
    
    /**
    * 
    * The PEAR DB/MDB2 object that connects to the database.
    * 
    * @access public
    * 
    * @var object
    * 
    */
    
    var $db = null;
    
    
    /**
    * 
    * The backend type
    * 
    * @access public
    * 
    * @var string
    * 
    */
    
    var $backend = null;
    
    
    /**
    * 
    * The table or view in the database to which this object binds.
    * 
    * @access public
    * 
    * @var string
    * 
    */
    
    var $table = null;
    
    
    /**
    * 
    * Associative array of column definitions.
    * 
    * @access public
    * 
    * @var array
    * 
    */
    
    var $col = array();
    
    
    /**
    * 
    * Associative array of index definitions.
    * 
    * @access public
    * 
    * @var array
    * 
    */
    
    var $idx = array();
    
    
    /**
    * 
    * Baseline SELECT maps for select(), selectResult(), selectCount().
    * 
    * @access public
    * 
    * @var array
    * 
    */
    
    var $sql = array();
    
    
    /**
    * 
    * Whether or not to automatically validate data at insert-time.
    * 
    * @access private
    * 
    * @var bool
    * 
    */
    
    var $_valid_insert = true;
    
    
    /**
    * 
    * Whether or not to automatically validate data at update-time.
    * 
    * @access private
    * 
    * @var bool
    * 
    */
    
    var $_valid_update = true;
    
    
    /**
    * 
    * When calling select() and selectResult(), use this fetch mode (usually
    * a DB_FETCHMODE_* constant).  If null, uses whatever is set in the $db
    * PEAR DB/MDB2 object.
    * 
    * @access public
    * 
    * @var int
    * 
    */
    
    var $fetchmode = null;
    
    
    /**
    * 
    * When fetchmode is DB_FETCHMODE_OBJECT, use this class for each
    * returned row.  If null, uses whatever is set in the $db
    * PEAR DB/MDB2 object.
    * 
    * @access public
    * 
    * @var string
    * 
    */
    
    var $fetchmode_object_class = null;
    
    
    /**
    * 
    * If there is an error on instantiation, this captures that error.
    *
    * This property is used only for errors encountered in the constructor
    * at instantiation time.  To check if there was an instantiation error...
    *
    * <code>
    * $obj =& new DB_Table();
    * if ($obj->error) {
    *     // ... error handling code here ...
    * }
    * </code>
    * 
    * @var object PEAR_Error
    * 
    */
    
    var $error = null;


    /**
    * 
    * Whether or not to automatically recast data at insert- and update-time.
    * 
    * @access private
    * 
    * @var bool
    * 
    */
    
    var $_auto_recast = true;
    
    
    /**
    * 
    * Specialized version of throwError() modeled on PEAR_Error.
    * 
    * Throws a PEAR_Error with a DB_Table error message based on a
    * DB_Table constant error code.
    * 
    * @static
    * 
    * @access public
    * 
    * @param string $code A DB_Table error code constant.
    * 
    * @param string $extra Extra text for the error (in addition to the 
    * regular error message).
    * 
    * @return object PEAR_Error
    * 
    */
    
    function &throwError($code, $extra = null)
    {
        // get the error message text based on the error code
        $text = $GLOBALS['_DB_TABLE']['error'][$code];
        
        // add any additional error text
        if ($extra) {
            $text .= ' ' . $extra;
        }
        
        // done!
        $error = PEAR::throwError($text, $code);
        return $error;
    }
    
    
    /**
    * 
    * Constructor.
    * 
    * If there is an error on instantiation, $this->error will be 
    * populated with the PEAR_Error.
    * 
    * @access public
    * 
    * @param object &$db A PEAR DB/MDB2 object.
    * 
    * @param string $table The table name to connect to in the database.
    * 
    * @param mixed $create The automatic table creation mode to pursue:
    * - boolean false to not attempt creation
    * - 'safe' to create the table only if it does not exist
    * - 'drop' to drop any existing table with the same name and re-create it
    * - 'verify' to check whether the table exists, whether all the columns
    *   exist, whether the columns have the right type, and whether the indexes
    *   exist and have the right type
    * - 'alter' does the same as 'safe' if the table does not exist; if it
    *   exists, a verification for columns existence, the column types, the
    *   indexes existence, and the indexes types will be performed and the
    *   table schema will be modified if needed
    * 
    * @return object DB_Table
    * 
    */
    
    function DB_Table(&$db, $table, $create = false)
    {
        // is the first argument a DB/MDB2 object?
        $this->backend = null;
        if (is_subclass_of($db, 'db_common')) {
            $this->backend = 'db';
        } elseif (is_subclass_of($db, 'mdb2_driver_common')) {
            $this->backend = 'mdb2';
        }

        if (is_null($this->backend)) {
            $this->error =& DB_Table::throwError(DB_TABLE_ERR_NOT_DB_OBJECT);
            return;
        }
        
        // array with column definition may not be empty        
        if (! isset($this->col) || is_null($this->col) ||
                (is_array($this->col) && count($this->col) === 0)) {
            $this->error =& DB_Table::throwError(DB_TABLE_ERR_NO_COLS);
            return;
        }

        // set the class properties
        $this->db =& $db;
        $this->table = $table;
        
        // is the RDBMS supported?
        list($phptype, $dbsyntax) = DB_Table::getPHPTypeAndDBSyntax($db);
        if (! DB_Table::supported($phptype, $dbsyntax)) {
            $this->error =& DB_Table::throwError(
                DB_TABLE_ERR_PHPTYPE,
                "({$db->phptype})"
            );
            return;
        }

        // load MDB2_Extended module
        if ($this->backend == 'mdb2') {
            $this->db->loadModule('Extended', null, false);
        }

        // should we attempt table creation?
        if ($create) {

            if ($this->backend == 'mdb2') {
                $this->db->loadModule('Manager');
            }

            // check whether the chosen mode is supported
            list($phptype,) = DB_Table::getPHPTypeAndDBSyntax($this->db);
            $mode_supported = DB_Table::modeSupported($create, $phptype);
            if (PEAR::isError($mode_supported)) {
                $this->error =& $mode_supported;
                return;
            }
            if (!$mode_supported) {
                $this->error =& $this->throwError(
                    DB_TABLE_ERR_CREATE_PHPTYPE,
                    "('$create', '$phptype')"
                );
                return;
            }

            include_once 'DB/Table/Manager.php';

            switch ($create) {

                case 'alter':
                    $result = $this->alter();
                    break;

                case 'drop':
                case 'safe':
                    $result = $this->create($create);
                    break;

                case 'verify':
                    $result = $this->verify();
                    break;
            }
            
            if (PEAR::isError($result)) {
                // problem creating/altering/verifing the table
                $this->error =& $result;
                return;
            }
        }
    }
    
    
    /**
    * 
    * Is a particular RDBMS supported by DB_Table?
    * 
    * @static
    * 
    * @access public
    * 
    * @param string $phptype The RDBMS type for PHP.
    * 
    * @param string $dbsyntax The chosen database syntax.
    * 
    * @return bool True if supported, false if not.
    * 
    */
    
    function supported($phptype, $dbsyntax = '')
    {
        // only Firebird is supported, not its ancestor Interbase
        if ($phptype == 'ibase' && $dbsyntax != 'firebird') {
            return false;
        }
        $supported = array_keys($GLOBALS['_DB_TABLE']['type']);
        return in_array(strtolower($phptype), $supported);
    }


    /**
    * 
    * Is a creation mode supported for a RDBMS by DB_Table?
    * 
    * @access public
    * 
    * @param string $mode The chosen creation mode.
    * 
    * @param string $phptype The RDBMS type for PHP.
    * 
    * @return bool|object True if supported, false if not, or a PEAR_Error
    * if an unknown mode is specified.
    * 
    */
    
    function modeSupported($mode, $phptype)
    {
        // check phptype for validity
        $supported = array_keys($GLOBALS['_DB_TABLE']['type']);
        if (!in_array(strtolower($phptype), $supported)) {
            return false;
        }

        switch ($mode) {
            case 'drop':
            case 'safe':
                // supported for all RDBMS
                return true;

            case 'alter':
            case 'verify':
                // not supported for fbsql and mssql (yet)
                switch ($phptype) {
                    case 'fbsql':
                    case 'mssql':
                        return false;
                    default:
                        return true;
                }

            default:
                // unknown creation mode
                return $this->throwError(
                    DB_TABLE_ERR_CREATE_FLAG,
                    "('$mode')"
                );
        }
    }


    /**
    * 
    * Detect values of 'phptype' and 'dbsyntax' keys of DSN.
    * 
    * @static
    * 
    * @access public
    * 
    * @param object &$db A PEAR DB/MDB2 object.
    * 
    * @return array Values of 'phptype' and 'dbsyntax' keys of DSN.
    * 
    */

    function getPHPTypeAndDBSyntax(&$db) {
        $phptype = '';
        $dbsyntax = '';
        if (is_subclass_of($db, 'db_common')) {
            $phptype = $db->phptype;
            $dbsyntax = $db->dbsyntax;
        } elseif (is_subclass_of($db, 'mdb2_driver_common')) {
            $dsn = MDB2::parseDSN($db->getDSN());
            $phptype = $dsn['phptype'];
            $dbsyntax = $dsn['dbsyntax'];
        }
        return array($phptype, $dbsyntax);
    }


    /**
    * 
    * Overwrite one or more error messages, e.g. to internationalize them.
    * 
    * @access public
    * 
    * @param mixed $code If string, the error message with code $code will
    * be overwritten by $message. If array, the error messages with code
    * of each array key will be overwritten by the key's value.
    * 
    * @param string $message Only used if $key is not an array.
    *
    * @return void
    * 
    */

    function setErrorMessage($code, $message = null) {
        if (is_array($code)) {
            foreach ($code as $single_code => $single_message) {
                $GLOBALS['_DB_TABLE']['error'][$single_code] = $single_message;
            }
        } else {
            $GLOBALS['_DB_TABLE']['error'][$code] = $message;
        }
    }


    /**
    * 
    * Returns all or part of the $this->col property array.
    * 
    * @access public
    * 
    * @param mixed $col If null, returns the $this->col property array
    * as it is.  If string, returns that column name from the $this->col
    * array. If an array, returns those columns named as the array
    * values from the $this->col array as an array.
    *
    * @return mixed All or part of the $this->col property array, or
    * boolean false if no matching column names are found.
    * 
    */
    
    function getColumns($col = null)
    {
        // by default, return all column definitions
        if (is_null($col)) {
            return $this->col;
        }
        
        // if the param is a string, only return the column definition
        // named by the that string
        if (is_string($col)) {
            if (isset($this->col[$col])) {
                return $this->col[$col];
            } else {
                return false;
            }
        }
        
        // if the param is a sequential array of column names,
        // return only those columns named in that array
        if (is_array($col)) {
            $set = array();
            foreach ($col as $name) {
                $set[$name] = $this->getColumns($name);
            }
            
            if (count($set) == 0) {
                return false;
            } else {
                return $set;
            }
        }
        
        // param was not null, string, or array
        return false;
    }
    
    
    /**
    * 
    * Returns all or part of the $this->idx property array.
    * 
    * @access public
    * 
    * @param string $col If specified, returns only this index key
    * from the $this->col property array.
    * 
    * @return array All or part of the $this->idx property array.
    * 
    */
    
    function getIndexes($idx = null)
    {
        // by default, return all index definitions
        if (is_null($idx)) {
            return $this->idx;
        }
        
        // if the param is a string, only return the index definition
        // named by the that string
        if (is_string($idx)) {
            if (isset($this->idx[$idx])) {
                return $this->idx[$idx];
            } else {
                return false;
            }
        }
        
        // if the param is a sequential array of index names,
        // return only those indexes named in that array
        if (is_array($idx)) {
            $set = array();
            foreach ($idx as $name) {
                $set[$name] = $this->getIndexes($name);
            }
            
            if (count($set) == 0) {
                return false;
            } else {
                return $set;
            }
        }
        
        // param was not null, string, or array
        return false;
    }
    
    
    /**
    *
    * Selects rows from the table using one of the DB/MDB2 get*() methods.
    * 
    * @access public
    * 
    * @param string $sqlkey The name of the SQL SELECT to use from the
    * $this->sql property array.
    * 
    * @param string $filter Ad-hoc SQL snippet to AND with the default
    * SELECT WHERE clause.
    * 
    * @param string $order Ad-hoc SQL snippet to override the default
    * SELECT ORDER BY clause.
    * 
    * @param int $start The row number to start listing from in the
    * result set.
    * 
    * @param int $count The number of rows to list in the result set.
    *
    * @param array $params Parameters to use in placeholder substitutions (if
    * any).
    * 
    * @return mixed An array of records from the table (if anything but
    * 'getOne'), a single value (if 'getOne'), or a PEAR_Error object.
    *
    * @see DB::getAll()
    * 
    * @see MDB2::getAll()
    *
    * @see DB::getAssoc()
    * 
    * @see MDB2::getAssoc()
    *
    * @see DB::getCol()
    * 
    * @see MDB2::getCol()
    *
    * @see DB::getOne()
    *
    * @see MDB2::getOne()
    * 
    * @see DB::getRow()
    * 
    * @see MDB2::getRow()
    *
    * @see DB_Table::_swapModes()
    *
    */
    
    function select($sqlkey, $filter = null, $order = null,
        $start = null, $count = null, $params = array())
    {
        // build the base command
        $sql = $this->buildSQL($sqlkey, $filter, $order, $start, $count);
        if (PEAR::isError($sql)) {
            return $sql;
        }
        
        // set the get*() method name
        if (isset($this->sql[$sqlkey]['get'])) {
            $method = ucwords(strtolower(trim($this->sql[$sqlkey]['get'])));
            $method = "get$method";
        } else {
            $method = 'getAll';
        }
        
        // DB_Table assumes you are using a shared PEAR DB/MDB2 object. Other
        // scripts using the same object probably expect its fetchmode
        // not to change, unless they change it themselves.  Thus, to
        // provide friendly mode-swapping, we will restore these modes
        // afterwards.
        $restore_mode = $this->db->fetchmode;
        if ($this->backend == 'mdb2') {
            $restore_class = $this->db->getOption('fetch_class');
        } else {
            $restore_class = $this->db->fetchmode_object_class;
        }
        // swap modes
        $fetchmode = $this->fetchmode;
        $fetchmode_object_class = $this->fetchmode_object_class;
        if (isset($this->sql[$sqlkey]['fetchmode'])) {
            $fetchmode = $this->sql[$sqlkey]['fetchmode'];
        }
        if (isset($this->sql[$sqlkey]['fetchmode_object_class'])) {
            $fetchmode_object_class = $this->sql[$sqlkey]['fetchmode_object_class'];
        }
        $this->_swapModes($fetchmode, $fetchmode_object_class);

        // make sure params is an array
        if (! is_null($params)) {
            $params = (array) $params;
        }
        
        // get the result
        if ($this->backend == 'mdb2') {
            $result = $this->db->extended->$method($sql, null, $params);
        } else {
            switch ($method) {

                case 'getCol':
                    $result = $this->db->$method($sql, 0, $params);
                    break;

                case 'getAssoc':
                    $result = $this->db->$method($sql, false, $params);
                    break;

                default:
                    $result = $this->db->$method($sql, $params);
                    break;

            }
        }
            
        // swap modes back
        $this->_swapModes($restore_mode, $restore_class);
        
        // return the result
        return $result;
    }
    
    
    /**
    *
    * Selects rows from the table as a DB_Result/MDB2_Result_* object.
    * 
    * @access public
    * 
    * @param string $sqlkey The name of the SQL SELECT to use from the
    * $this->sql property array.
    * 
    * @param string $filter Ad-hoc SQL snippet to add to the default
    * SELECT WHERE clause.
    * 
    * @param string $order Ad-hoc SQL snippet to override the default
    * SELECT ORDER BY clause.
    * 
    * @param int $start The record number to start listing from in the
    * result set.
    * 
    * @param int $count The number of records to list in the result set.
    * 
    * @param array $params Parameters to use in placeholder substitutions (if
    * any).
    * 
    * @return mixed A PEAR_Error on failure, or a DB_Result/MDB2_Result_*
    * object on success.
    *
    * @see DB_Table::_swapModes()
    *
    */
    
    function selectResult($sqlkey, $filter = null, $order = null, 
        $start = null, $count = null, $params = array())
    {
        // build the base command
        $sql = $this->buildSQL($sqlkey, $filter, $order, $start, $count);
        if (PEAR::isError($sql)) {
            return $sql;
        }
        
        // DB_Table assumes you are using a shared PEAR DB/MDB2 object.  Other
        // scripts using the same object probably expect its fetchmode
        // not to change, unless they change it themselves.  Thus, to
        // provide friendly mode-swapping, we will restore these modes
        // afterwards.
        $restore_mode = $this->db->fetchmode;
        if ($this->backend == 'mdb2') {
            $restore_class = $this->db->getOption('fetch_class');
        } else {
            $restore_class = $this->db->fetchmode_object_class;
        }
        
        // swap modes
        $fetchmode = $this->fetchmode;
        $fetchmode_object_class = $this->fetchmode_object_class;
        if (isset($this->sql[$sqlkey]['fetchmode'])) {
            $fetchmode = $this->sql[$sqlkey]['fetchmode'];
        }
        if (isset($this->sql[$sqlkey]['fetchmode_object_class'])) {
            $fetchmode_object_class = $this->sql[$sqlkey]['fetchmode_object_class'];
        }
        $this->_swapModes($fetchmode, $fetchmode_object_class);
        
        // make sure params is an array
        if (! is_null($params)) {
            $params = (array) $params;
        }
     
        // get the result
        if ($this->backend == 'mdb2') {
            $stmt =& $this->db->prepare($sql);
            $result =& $stmt->execute($params);
        } else {
            $result =& $this->db->query($sql, $params);
        }
        
        // swap modes back
        $this->_swapModes($restore_mode, $restore_class);
        
        // return the result
        return $result;
    }
    
    
    /**
    *
    * Counts the number of rows which will be returned by a query.
    *
    * This function works identically to {@link select()}, but it
    * returns the number of rows returned by a query instead of the
    * query results themselves.
    *
    * This makes using DB_Table with Pager easier, since you can pass the
    * return value of this to Pager as totalItems, then select only the
    * rows you need to display on a page.
    *
    * @author Ian Eure <ian@php.net>
    * 
    * @access public
    * 
    * @param string $sqlkey The name of the SQL SELECT to use from the
    * $this->sql property array.
    * 
    * @param string $filter Ad-hoc SQL snippet to AND with the default
    * SELECT WHERE clause.
    * 
    * @param string $order Ad-hoc SQL snippet to override the default
    * SELECT ORDER BY clause.
    * 
    * @param int $start The row number to start listing from in the
    * result set.
    * 
    * @param int $count The number of rows to list in the result set.
    * 
    * @param array $params Parameters to use in placeholder substitutions (if
    * any).
    * 
    * @return mixed An integer number of records from the table, or a
    * PEAR_Error object.
    *
    * @see DB_Table::select()
    *
    */
    
    function selectCount($sqlkey, $filter = null, $order = null,
        $start = null, $count = null, $params = array())
    {
        // does the SQL SELECT key exist?
        $tmp = array_keys($this->sql);
        if (! in_array($sqlkey, $tmp)) {
            return $this->throwError(
                DB_TABLE_ERR_SQL_UNDEF,
                "('$sqlkey')"
            );
        }
        
        // create a SQL key name for this count-query
        $count_key = '__count_' . $sqlkey;
        
        // has a count-query for the SQL key already been created?
        if (! isset($this->sql[$count_key])) {
            
            // we've not asked for a count on this query yet.
            // get the elements of the query ...
            $count_sql = $this->sql[$sqlkey];
            
            // is a count-field set for the query?
            if (! isset($count_sql['count']) ||
                trim($count_sql['count']) == '') {
                $count_sql['count'] = '*';
            }
            
            // replace the SELECT fields with a COUNT() command
            $count_sql['select'] = "COUNT({$count_sql['count']})";
            
            // replace the 'get' key so we only get the one result item
            $count_sql['get'] = 'one';
            
            // create the new count-query in the $sql array
            $this->sql[$count_key] = $count_sql;
        }
        
        // retrieve the count results
        return $this->select($count_key, $filter, $order, $start, $count,
            $params);
    }
    
    
    /**
    * 
    * Changes the $this->db PEAR DB/MDB2 object fetchmode and
    * fetchmode_object_class.
    * 
    * Because DB_Table objects tend to use the same PEAR DB/MDB2 object, it
    * may sometimes be useful to have one object return results in one
    * mode, and have another object return results in a different mode. 
    * This method allows us to switch DB/MDB2 fetch modes on the fly.
    * 
    * @access private
    * 
    * @param string $new_mode A DB_FETCHMODE_* constant.  If null,
    * defaults to whatever the DB/MDB2 object is currently using.
    * 
    * @param string $new_class The object class to use for results when
    * the $db object is in DB_FETCHMODE_OBJECT fetch mode.  If null,
    * defaults to whatever the the DB/MDB2 object is currently using.
    * 
    * @return void
    * 
    */
    
    function _swapModes($new_mode, $new_class)
    {
        // get the old (current) mode and class
        $old_mode = $this->db->fetchmode;
        if ($this->backend == 'mdb2') {
            $old_class = $this->db->getOption('fetch_class');
        } else {
            $old_class = $this->db->fetchmode_object_class;
        }
        
        // don't need to swap anything if the new modes are both
        // null or if the old and new modes already match.
        if ((is_null($new_mode) && is_null($new_class)) ||
            ($old_mode == $new_mode && $old_class == $new_class)) {
            return;
        }
        
        // set the default new mode
        if (is_null($new_mode)) {
            $new_mode = $old_mode;
        }
        
        // set the default new class
        if (is_null($new_class)) {
            $new_class = $old_class;
        }
        
        // swap modes
        $this->db->setFetchMode($new_mode, $new_class);
    }
    
    
    /**
    * 
    * Builds the SQL command from a specified $this->sql element.
    * 
    * @access public
    * 
    * @param string $sqlkey The $this->sql key to use as the basis for the
    * SQL query string.
    * 
    * @param string $filter A filter to add to the WHERE clause of the
    * defined SELECT in $this->sql.
    * 
    * @param string $order An ORDER clause to override the defined order
    * in $this->sql.
    * 
    * @param int $start The row number to start listing from in the
    * result set.
    * 
    * @param int $count The number of rows to list in the result set.
    * 
    * @return mixed A PEAR_Error on failure, or an SQL command string on
    * success.
    * 
    */
    
    function buildSQL($sqlkey, $filter = null, $order = null,
        $start = null, $count = null)
    {
        // does the SQL SELECT key exist?
        if (is_null($this->sql)) {
            $this->sql = array();
        }
        $tmp = array_keys($this->sql);
        if (! in_array($sqlkey, $tmp)) {
            return $this->throwError(
                DB_TABLE_ERR_SQL_UNDEF,
                "('$sqlkey')"
            );
        }
        
        // the SQL clause parts and their default values
        $part = array(
            'select' => '*',
            'from'   => $this->table,
            'join'   => null,
            'where'  => null,
            'group'  => null,
            'having' => null,
            'order'  => null
        );
        
        // loop through each possible clause
        foreach ($part as $key => $val) {
            if (! isset($this->sql[$sqlkey][$key])) {
                continue;
            } else {
                $part[$key] = $this->sql[$sqlkey][$key];
            }
        }
        
        // add the filter to the WHERE part
        if ($filter) {
            if (! $part['where']) {
                $part['where'] .= $filter;
            } else {
                $part['where'] .= " AND ($filter)";
            }
        }
        
        // override the ORDER part
        if ($order) {
            $part['order'] = $order;
        }
        
        // build up the command string form the parts
        $cmd = '';
        foreach ($part as $key => $val) {
            
            // if the part value has not been set, skip it
            if (! $val) {
                continue;
            }
            
            switch ($key) {
            
            case 'join':
                $cmd .= " $val\n";
                break;
                
            case 'group':
            case 'order':
                $cmd .= strtoupper($key) . " BY $val\n";
                break;
                
            default:
                $cmd .= strtoupper($key) . " $val\n";
                break;
            
            }
        }
        
        // add LIMIT if requested
        if (! is_null($start) && ! is_null($count)) {
            if ($this->backend == 'mdb2') {
                $this->db->setLimit($count, $start);
            } else {
                $cmd = $this->db->modifyLimitQuery(
                    $cmd, $start, $count);
            }
        }
        
        return $cmd;
    }
    
    
    /**
    *
    * Inserts a single table row after validating through validInsert().
    * 
    * @access public
    * 
    * @param array $data An associative array of key-value pairs where
    * the key is the column name and the value is the column value.  This
    * is the data that will be inserted into the table.  Data is checked
    * against the column data type for validity.
    * 
    * @return mixed Void on success, a PEAR_Error object on failure.
    *
    * @see validInsert()
    * 
    * @see DB::autoExecute()
    * 
    * @see MDB2::autoExecute()
    * 
    */
        
    function insert($data)
    {
        // forcibly recast the data elements to their proper types?
        if ($this->_auto_recast) {
            $this->recast($data);
        }
        
        // validate the data if auto-validation is turned on
        if ($this->_valid_insert) {
            $result = $this->validInsert($data);
            if (PEAR::isError($result)) {
                return $result;
            }
        }
        if ($this->backend == 'mdb2') {
            $result = $this->db->extended->autoExecute($this->table, $data,
                MDB2_AUTOQUERY_INSERT);
        } else {
            $result = $this->db->autoExecute($this->table, $data,
                DB_AUTOQUERY_INSERT);
        }
        return $result;
    }
    
    
    /**
    * 
    * Turns on (or off) automatic validation of inserted data.
    * 
    * @access public
    * 
    * @param bool $flag True to turn on auto-validation, false to turn it off.
    * 
    * @return void
    * 
    */
    
    function autoValidInsert($flag = true)
    {
        if ($flag) {
            $this->_valid_insert = true;
        } else {
            $this->_valid_insert = false;
        }
    }
    
    
    /**
    *
    * Validates an array for insertion into the table.
    * 
    * @access public
    * 
    * @param array $data An associative array of key-value pairs where
    * the key is the column name and the value is the column value.  This
    * is the data that will be inserted into the table.  Data is checked
    * against the column data type for validity.
    * 
    * @return mixed Boolean true on success, a PEAR_Error object on
    * failure.
    *
    * @see insert()
    * 
    */
        
    function validInsert(&$data)
    {
        // loop through the data, and disallow insertion of unmapped
        // columns
        foreach ($data as $col => $val) {
            if (! isset($this->col[$col])) {
                return $this->throwError(
                    DB_TABLE_ERR_INS_COL_NOMAP,
                    "('$col')"
                );
            }
        }
        
        // loop through each column mapping, and check the data to be
        // inserted into it against the column data type. we loop through
        // column mappings instead of the insert data to make sure that
        // all necessary columns are being inserted.
        foreach ($this->col as $col => $val) {
            
            // is the value allowed to be null?
            if (isset($val['require']) &&
                $val['require'] == true &&
                (! isset($data[$col]) || is_null($data[$col]))) {
                return $this->throwError(
                    DB_TABLE_ERR_INS_COL_REQUIRED,
                    "'$col'"
                );
            }
            
            // does the value to be inserted match the column data type?
            if (isset($data[$col]) &&
                ! $this->isValid($data[$col], $col)) {
                return $this->throwError(
                    DB_TABLE_ERR_INS_DATA_INVALID,
                    "'$col' ('$data[$col]')"
                );
            }
        }
        
        return true;
    }
    
    
    /**
    *
    * Updates table row(s) matching a custom WHERE clause, after checking
    * against validUpdate().
    * 
    * @access public
    * 
    * @param array $data An associative array of key-value pairs where
    * the key is the column name and the value is the column value.  These
    * are the columns that will be updated with new values.
    * 
    * @param string $where An SQL WHERE clause limiting which records
    * are to be updated.
    * 
    * @return mixed Void on success, a PEAR_Error object on failure.
    *
    * @see validUpdate()
    *
    * @see DB::autoExecute()
    * 
    * @see MDB2::autoExecute()
    * 
    */
    
    function update($data, $where)
    {
        // forcibly recast the data elements to their proper types?
        if ($this->_auto_recast) {
            $this->recast($data);
        }
        
        // validate the data if auto-validation is turned on
        if ($this->_valid_update) {
            $result = $this->validUpdate($data);
            if (PEAR::isError($result)) {
                return $result;
            }
        }
        
        if ($this->backend == 'mdb2') {
            $result = $this->db->extended->autoExecute($this->table, $data,
                MDB2_AUTOQUERY_UPDATE, $where);
        } else {
            $result = $this->db->autoExecute($this->table, $data,
                DB_AUTOQUERY_UPDATE, $where);
        }
        return $result;

    }
    
    
    /**
    * 
    * Turns on (or off) automatic validation of updated data.
    * 
    * @access public
    * 
    * @param bool $flag True to turn on auto-validation, false to turn it off.
    * 
    * @return void
    * 
    */
    
    function autoValidUpdate($flag = true)
    {
        if ($flag) {
            $this->_valid_update = true;
        } else {
            $this->_valid_update = false;
        }
    }
    
    
    /**
    *
    * Validates an array for updating the table.
    * 
    * @access public
    * 
    * @param array $data An associative array of key-value pairs where
    * the key is the column name and the value is the column value.  This
    * is the data that will be inserted into the table.  Data is checked
    * against the column data type for validity.
    * 
    * @return mixed Boolean true on success, a PEAR_Error object on
    * failure.
    *
    * @see update()
    * 
    */
        
    function validUpdate(&$data)
    {
        // loop through each data element, and check the
        // data to be updated against the column data type.
        foreach ($data as $col => $val) {
            
            // does the column exist?
            if (! isset($this->col[$col])) {
                return $this->throwError(
                    DB_TABLE_ERR_UPD_COL_NOMAP,
                    "('$col')"
                );
            }
            
            // the column definition
            $defn = $this->col[$col];
            
            // is it allowed to be null?
            if (isset($defn['require']) &&
                $defn['require'] == true &&
                isset($data[$col]) &&
                is_null($data[$col])) {
                return $this->throwError(
                    DB_TABLE_ERR_UPD_COL_REQUIRED,
                    $col
                );
            }
            
            // does the value to be inserted match the column data type?
            if (! $this->isValid($data[$col], $col)) {
                return $this->throwError(
                    DB_TABLE_ERR_UPD_DATA_INVALID,
                    "$col ('$data[$col]')"
                );
            }
        }
        
        return true;
    }
    
    
    /**
    *
    * Deletes table rows matching a custom WHERE clause.
    * 
    * @access public
    * 
    * @param string $where The WHERE clause for the delete command.
    *
    * @return mixed Void on success or a PEAR_Error object on failure.
    *
    * @see DB::query()
    * 
    * @see MDB2::exec()
    * 
    */
    
    function delete($where)
    {
        if ($this->backend == 'mdb2') {
            $result = $this->db->exec("DELETE FROM $this->table WHERE $where");
        } else {
            $result = $this->db->query("DELETE FROM $this->table WHERE $where");
        }
        return $result;
    }
    
    
    /**
    *
    * Generates a sequence value; sequence name defaults to the table name.
    * 
    * @access public
    * 
    * @param string $seq_name The sequence name; defaults to table_id.
    * 
    * @return integer The next value in the sequence.
    *
    * @see DB::nextID()
    * 
    * @see MDB2::nextID()
    *
    */
    
    function nextID($seq_name = null)
    {
        if (is_null($seq_name)) {
            $seq_name = "{$this->table}";
        } else {
            $seq_name = "{$this->table}_{$seq_name}";
        }
        
        // the maximum length is 30, but PEAR DB/MDB2 will add "_seq" to the
        // name, so the max length here is less 4 chars. we have to
        // check here because the sequence will be created automatically
        // by PEAR DB/MDB2, which will not check for length on its own.
        if (strlen($seq_name) > 26) {
            return DB_Table::throwError(
                DB_TABLE_ERR_SEQ_STRLEN,
                " ('$seq_name')"
            );
            
        }
        return $this->db->nextId($seq_name);
    }
    
    
    /**
    * 
    * Escapes and enquotes a value for use in an SQL query.
    * 
    * Helps makes user input safe against SQL injection attack.
    * 
    * @access public
    * 
    * @return string The value with quotes escaped, and inside single quotes.
    * 
    * @see DB_Common::quoteSmart()
    * 
    * @see MDB2::quote()
    * 
    */
    
    function quote($val)
    {
        if ($this->backend == 'mdb2') {
            $val = $this->db->quote($val);
        } else {
            $val = $this->db->quoteSmart($val);
        }
        return $val;
    }
    
    
    /**
    * 
    * Returns a blank row array based on the column map.
    * 
    * The array keys are the column names, and all values are set to null.
    * 
    * @access public
    * 
    * @return array An associative array where the key is column name
    * and the value is null.
    * 
    */
    
    function getBlankRow()
    {
        $row = array();
        
        foreach ($this->col as $key => $val) {
            $row[$key] = null;
        }
        
        $this->recast($row);
        
        return $row;
    }
    
    
    /**
    * 
    * Turns on (or off) automatic recasting of insert and update data.
    * 
    * @access public
    * 
    * @param bool $flag True to autmatically recast insert and update data,
    * false to not do so.
    *
    * @return void
    * 
    */
    
    function autoRecast($flag = true)
    {
        if ($flag) {
            $this->_auto_recast = true;
        } else {
            $this->_auto_recast = false;
        }
    }
    
    
    /**
    * 
    * Forces array elements to the proper types for their columns.
    * 
    * This will not valiate the data, and will forcibly change the data
    * to match the recast-type.
    * 
    * The date, time, and timestamp recasting has special logic for
    * arrays coming from an HTML_QuickForm object so that the arrays
    * are converted into properly-formatted strings.
    * 
    * @todo If a column key holds an array of values (say from a multiple
    * select) then this method will not work properly; it will recast the
    * value to the string 'Array'.  Is this bad?
    * 
    * @access public
    * 
    * @param array &$data The data array to re-cast.
    *
    * @return void
    * 
    */
    
    function recast(&$data)
    {
        $keys = array_keys($data);
        
        $null_if_blank = array('date', 'time', 'timestamp', 'smallint',
            'integer', 'bigint', 'decimal', 'single', 'double');
        
        foreach ($keys as $key) {
        
            if (! isset($this->col[$key])) {
                continue;
            }
            
            unset($val);
            $val =& $data[$key];
            
            // convert blanks to null for non-character field types
            $convert = in_array($this->col[$key]['type'], $null_if_blank);
            if (is_array($val)) {  // if one of the given array values is
                                   // empty, null will be the new value if
                                   // the field is not required
                $tmp_val = implode('', $val);
                foreach ($val as $array_val) {
                    if (trim((string) $array_val) == '') {
                        $tmp_val = '';
                        break;
                    }
                }
            } else {
                $tmp_val = $val;
            }
            if ($convert && trim((string) $tmp_val) == '' && (
                !isset($this->col[$key]['require']) ||
                $this->col[$key]['require'] === false
              )
            ) {
                $val = null;
            }
            
            // skip explicit NULL values
            if (is_null($val)) {
                continue;
            }
            
            // otherwise, recast to the column type
            switch ($this->col[$key]['type']) {
            
            case 'boolean':
                $val = ($val) ? 1 : 0;
                break;
                
            case 'char':
            case 'varchar':
            case 'clob':
                settype($val, 'string');
                break;
                
            case 'date':

                // smart handling of non-standard (i.e. Y-m-d) date formats,
                // this allows to use two-digit years (y) and short (M) or
                // long (F) names of months without having to recast the
                // date value yourself
                if (is_array($val)) {
                    if (isset($val['y'])) {
                        $val['Y'] = $val['y'];
                    }
                    if (isset($val['F'])) {
                        $val['m'] = $val['F'];
                    }
                    if (isset($val['M'])) {
                        $val['m'] = $val['M'];
                    }
                }

                if (is_array($val) &&
                    isset($val['Y']) &&
                    isset($val['m']) &&
                    isset($val['d'])) {
                    
                    // the date is in HTML_QuickForm format,
                    // convert into a string
                    $y = (strlen($val['Y']) < 4)
                        ? str_pad($val['Y'], 4, '0', STR_PAD_LEFT)
                        : $val['Y'];
                    
                    $m = (strlen($val['m']) < 2)
                        ? '0'.$val['m'] : $val['m'];
                        
                    $d = (strlen($val['d']) < 2)
                        ? '0'.$val['d'] : $val['d'];
                        
                    $val = "$y-$m-$d";
                    
                } else {
                
                    // convert using the Date class
                    $tmp =& new DB_Table_Date($val);
                    $val = $tmp->format('%Y-%m-%d');
                    
                }
                
                break;
            
            case 'time':
            
                if (is_array($val) &&
                    isset($val['H']) &&
                    isset($val['i']) &&
                    isset($val['s'])) {
                    
                    // the time is in HTML_QuickForm format,
                    // convert into a string
                    $h = (strlen($val['H']) < 2)
                        ? '0' . $val['H'] : $val['H'];
                    
                    $i = (strlen($val['i']) < 2)
                        ? '0' . $val['i'] : $val['i'];
                        
                    $s = (strlen($val['s']) < 2)
                        ? '0' . $val['s'] : $val['s'];
                        
                        
                    $val = "$h:$i:$s";
                    
                } else {
                    // date does not matter in this case, so
                    // pre 1970 and post 2040 are not an issue.
                    $tmp = strtotime(date('Y-m-d') . " $val");
                    $val = date('H:i:s', $tmp);
                }
                
                break;
                
            case 'timestamp':

                // smart handling of non-standard (i.e. Y-m-d) date formats,
                // this allows to use two-digit years (y) and short (M) or
                // long (F) names of months without having to recast the
                // date value yourself
                if (is_array($val)) {
                    if (isset($val['y'])) {
                        $val['Y'] = $val['y'];
                    }
                    if (isset($val['F'])) {
                        $val['m'] = $val['F'];
                    }
                    if (isset($val['M'])) {
                        $val['m'] = $val['M'];
                    }
                }

                if (is_array($val) &&
                    isset($val['Y']) &&
                    isset($val['m']) &&
                    isset($val['d']) &&
                    isset($val['H']) &&
                    isset($val['i']) &&
                    isset($val['s'])) {
                    
                    // timestamp is in HTML_QuickForm format,
                    // convert each element to a string. pad
                    // with zeroes as needed.
                
                    $y = (strlen($val['Y']) < 4)
                        ? str_pad($val['Y'], 4, '0', STR_PAD_LEFT)
                        : $val['Y'];
                    
                    $m = (strlen($val['m']) < 2)
                        ? '0'.$val['m'] : $val['m'];
                        
                    $d = (strlen($val['d']) < 2)
                        ? '0'.$val['d'] : $val['d'];
                        
                    $h = (strlen($val['H']) < 2)
                        ? '0' . $val['H'] : $val['H'];
                    
                    $i = (strlen($val['i']) < 2)
                        ? '0' . $val['i'] : $val['i'];
                        
                    $s = (strlen($val['s']) < 2)
                        ? '0' . $val['s'] : $val['s'];
                        
                    $val = "$y-$m-$d $h:$i:$s";
                    
                } else {
                    // convert using the Date class
                    $tmp =& new DB_Table_Date($val);
                    $val = $tmp->format('%Y-%m-%d %H:%M:%S');
                }
                
                break;
            
            case 'smallint':
            case 'integer':
            case 'bigint':
                settype($val, 'integer');
                break;
            
            case 'decimal':
            case 'single':
            case 'double':
                settype($val, 'float');
                break;

            }
        }
    }
    
    
    /**
    * 
    * Creates the table based on $this->col and $this->idx.
    * 
    * @access public
    * 
    * @param mixed $flag The automatic table creation mode to pursue:
    * - 'safe' to create the table only if it does not exist
    * - 'drop' to drop any existing table with the same name and re-create it
    * 
    * @return mixed Boolean false if there was no need to create the
    * table, boolean true if the attempt succeeded, or a PEAR_Error if
    * the attempt failed.
    * 
    * @see DB_Table_Manager::create()
    * 
    */
    
    function create($flag)
    {

        // are we OK to create the table?
        $ok = false;
        
        // check the create-flag
        switch ($flag) {

            case 'drop':
                // drop only if table exists
                $table_exists = DB_Table_Manager::tableExists($this->db,
                                                              $this->table);
                if (PEAR::isError($table_exists)) {
                    return $table_exists;
                }
                if ($table_exists) {
                    // forcibly drop an existing table
                    if ($this->backend == 'mdb2') {
                        $this->db->manager->dropTable($this->table);
                    } else {
                        $this->db->query("DROP TABLE {$this->table}");
                    }
                }
                $ok = true;
                break;

            case 'safe':
                // create only if table does not exist
                $table_exists = DB_Table_Manager::tableExists($this->db,
                                                              $this->table);
                if (PEAR::isError($table_exists)) {
                    return $table_exists;
                }
                // ok to create only if table does not exist
                $ok = !$table_exists;
                break;

        }

        // are we going to create the table?
        if (! $ok) {
            return false;
        }

        return DB_Table_Manager::create(
            $this->db, $this->table, $this->col, $this->idx
        );
    }
    
    
    /**
    * 
    * Alters the table based on $this->col and $this->idx.
    * 
    * @access public
    * 
    * @return mixed Boolean true if altering was successful or a PEAR_Error on
    * failure.
    *
    * @see DB_Table_Manager::alter()
    * 
    */
    
    function alter()
    {
        $create = false;
        
        // alter the table columns and indexes if the table exists
        $table_exists = DB_Table_Manager::tableExists($this->db,
                                                      $this->table);
        if (PEAR::isError($table_exists)) {
            return $table_exists;
        }
        if (!$table_exists) {
            // table does not exist => just create the table, there is
            // nothing that could be altered
            $create = true;
        }

        if ($create) {
            return DB_Table_Manager::create(
                $this->db, $this->table, $this->col, $this->idx
            );
        }

        return DB_Table_Manager::alter(
            $this->db, $this->table, $this->col, $this->idx
        );
    }
    
    
    /**
    * 
    * Verifies the table based on $this->col and $this->idx.
    * 
    * @access public
    * 
    * @return mixed Boolean true if the verification was successful, and a
    * PEAR_Error if verification failed.
    *
    * @see DB_Table_Manager::verify()
    * 
    */
    
    function verify()
    {
        return DB_Table_Manager::verify(
            $this->db, $this->table, $this->col, $this->idx
        );
    }
    
    
    /**
    * 
    * Checks if a value validates against the DB_Table data type for a
    * given column. This only checks that it matches the data type; it
    * does not do extended validation.
    * 
    * @access public
    * 
    * @param array $val A value to check against the column's DB_Table
    * data type.
    * 
    * @param array $col A column name from $this->col.
    * 
    * @return boolean True if the value validates (matches the
    * data type), false if not.
    * 
    * @see DB_Table_Valid
    * 
    */
    
    function isValid($val, $col)
    {
        // is the value null?
        if (is_null($val)) {
            // is the column required?
            if ($this->isRequired($col)) {
                // yes, so not valid
                return false;
            } else {
                // not required, so it's valid
                return true;
            }
        }
        
        // make sure we have the validation class
        include_once 'DB/Table/Valid.php';
        
        // validate values per the column type.  we use sqlite
        // as the single authentic list of allowed column types,
        // regardless of the actual rdbms being used.
        $map = array_keys($GLOBALS['_DB_TABLE']['type']['sqlite']);
        
        // is the column type on the map?
        if (! in_array($this->col[$col]['type'], $map)) {
            return $this->throwError(
                DB_TABLE_ERR_VALIDATE_TYPE,
                "'$col' ('{$this->col[$col]['type']}')"
            );
        }
        
        // validate for the type
        switch ($this->col[$col]['type']) {
        
        case 'char':
        case 'varchar':
            $result = DB_Table_Valid::isChar(
                $val,
                $this->col[$col]['size']
            );
            break;
        
        case 'decimal':
            $result = DB_Table_Valid::isDecimal(
                $val,
                $this->col[$col]['size'],
                $this->col[$col]['scope']
            );
            break;
            
        default:
            $result = call_user_func(
                array(
                    'DB_Table_Valid',
                    'is' . ucwords($this->col[$col]['type'])
                ),
                $val
            );
            break;

        }
        
        // have we passed the check so far, and should we
        // also check for allowed values?
        if ($result && isset($this->col[$col]['qf_vals'])) {
            $keys = array_keys($this->col[$col]['qf_vals']);
            
            $result = in_array(
                $val,
                array_keys($this->col[$col]['qf_vals'])
            );
        }
        
        return $result;
    }
    
    
    /**
    * 
    * Is a specific column required to be set and non-null?
    * 
    * @access public
    * 
    * @param mixed $column The column to check against.
    * 
    * @return boolean True if required, false if not.
    * 
    */
    
    function isRequired($column)
    {
        if (isset($this->col[$column]['require']) &&
            $this->col[$column]['require'] == true) {
            return true;
        } else {
            return false;
        }
    }
    
    
    /**
    * 
    * Creates and returns a QuickForm object based on table columns.
    *
    * @access public
    *
    * @param array $columns A sequential array of column names to use in
    * the form; if null, uses all columns.
    *
    * @param string $array_name By default, the form will use the names
    * of the columns as the names of the form elements.  If you pass
    * $array_name, the column names will become keys in an array named
    * for this parameter.
    * 
    * @param array $args An associative array of optional arguments to
    * pass to the QuickForm object.  The keys are...
    *
    * 'formName' : String, name of the form; defaults to the name of this
    * table.
    * 
    * 'method' : String, form method; defaults to 'post'.
    * 
    * 'action' : String, form action; defaults to
    * $_SERVER['REQUEST_URI'].
    * 
    * 'target' : String, form target target; defaults to '_self'
    * 
    * 'attributes' : Associative array, extra attributes for <form>
    * tag; the key is the attribute name and the value is attribute
    * value.
    * 
    * 'trackSubmit' : Boolean, whether to track if the form was
    * submitted by adding a special hidden field
    * 
    * @param string $clientValidate By default, validation will match
    * the 'qf_client' value from the column definition.  However,
    * if you set $clientValidate to true or false, this will
    * override the value from the column definition.
    *
    * @param array $formFilters An array with filter function names or
    * callbacks that will be applied to all form elements.
    *
    * @return object HTML_QuickForm
    * 
    * @see HTML_QuickForm
    * 
    * @see DB_Table_QuickForm
    * 
    */
    
    function &getForm($columns = null, $array_name = null, $args = array(),
        $clientValidate = null, $formFilters = null)
    {
        include_once 'DB/Table/QuickForm.php';
        $coldefs = $this->_getFormColDefs($columns);
        $form =& DB_Table_QuickForm::getForm($coldefs, $array_name, $args,
            $clientValidate, $formFilters);
        return $form;
    }
    
    
    /**
    * 
    * Adds elements and rules to a pre-existing HTML_QuickForm object.
    * 
    * @access public
    * 
    * @param object &$form An HTML_QuickForm object.
    * 
    * @param array $columns A sequential array of column names to use in
    * the form; if null, uses all columns.
    *
    * @param string $array_name By default, the form will use the names
    * of the columns as the names of the form elements.  If you pass
    * $array_name, the column names will become keys in an array named
    * for this parameter.
    * 
    * @return void
    * 
    * @see HTML_QuickForm
    * 
    * @see DB_Table_QuickForm
    * 
    */
    
    function addFormElements(&$form, $columns = null, $array_name = null,
        $clientValidate = null)
    {
        include_once 'DB/Table/QuickForm.php';
        $coldefs = $this->_getFormColDefs($columns);
        DB_Table_QuickForm::addElements($form, $coldefs, $array_name);
        DB_Table_QuickForm::addRules($form, $coldefs, $array_name,
            $clientValidate);
    }


    /**
    * 
    * Adds static form elements like 'header', 'static', 'submit' or 'reset' to
    * a pre-existing HTML_QuickForm object. The form elements needs to be
    * defined in a property called $frm.
    * 
    * @access public
    * 
    * @param object &$form An HTML_QuickForm object.
    * 
    * @return void
    * 
    * @see HTML_QuickForm
    * 
    * @see DB_Table_QuickForm
    * 
    */

    function addStaticFormElements(&$form)
    {
        include_once 'DB/Table/QuickForm.php';
        DB_Table_QuickForm::addStaticElements($form, $this->frm);
    }


    /**
    * 
    * Creates and returns an array of QuickForm elements based on an
    * array of DB_Table column names.
    * 
    * @access public
    * 
    * @param array $columns A sequential array of column names to use in
    * the form; if null, uses all columns.
    * 
    * @param string $array_name By default, the form will use the names
    * of the columns as the names of the form elements.  If you pass
    * $array_name, the column names will become keys in an array named
    * for this parameter.
    * 
    * @return array An array of HTML_QuickForm_Element objects.
    * 
    * @see HTML_QuickForm
    * 
    * @see DB_Table_QuickForm
    * 
    */
    
    function &getFormGroup($columns = null, $array_name = null)
    {
        include_once 'DB/Table/QuickForm.php';
        $coldefs = $this->_getFormColDefs($columns);
        $group =& DB_Table_QuickForm::getGroup($coldefs, $array_name);
        return $group;
    }
    
    
    /**
    * 
    * Creates and returns a single QuickForm element based on a DB_Table
    * column name.
    * 
    * @access public
    * 
    * @param string $column A DB_Table column name.
    * 
    * @param string $elemname The name to use for the generated QuickForm
    * element.
    * 
    * @return object HTML_QuickForm_Element
    * 
    * @see HTML_QuickForm
    * 
    * @see DB_Table_QuickForm
    * 
    */
    
    function &getFormElement($column, $elemname)
    {
        include_once 'DB/Table/QuickForm.php';
        $coldef = $this->_getFormColDefs($column);
        DB_Table_QuickForm::fixColDef($coldef[$column], $elemname);
        $element =& DB_Table_QuickForm::getElement($coldef[$column],
            $elemname);
        return $element;
    }

    /**
    * 
    * Creates and returns an array of QuickForm elements based on a DB_Table
    * column name.
    * 
    * @author Ian Eure <ieure@php.net>
    * 
    * @access public
    * 
    * @param array $cols Array of DB_Table column names
    * 
    * @param string $array_name The name to use for the generated QuickForm
    * elements.
    * 
    * @return object HTML_QuickForm_Element
    * 
    * @see HTML_QuickForm
    * 
    * @see DB_Table_QuickForm
    * 
    */
    function &getFormElements($cols, $array_name = null)
    {
        include_once 'DB/Table/QuickForm.php';
        $elements =& DB_Table_QuickForm::getElements($cols, $array_name);
        return $elements;
    }
    
    
    /**
    * 
    * Creates a column definition array suitable for DB_Table_QuickForm.
    * 
    * @access public
    * 
    * @param string|array $column_set A string column name, a sequential
    * array of columns names, or an associative array where the key is a
    * column name and the value is the default value for the generated
    * form element.  If null, uses all columns for this class.
    * 
    * @return array An array of columne defintions suitable for passing
    * to DB_Table_QuickForm.
    * 
    */
    
    function _getFormColDefs($column_set = null)
    {
        if (is_null($column_set)) {
            // no columns or columns+values; just return the $this->col
            // array.
            return $this->getColumns($column_set);
        }
        
        // check to see if the keys are sequential integers.  if so,
        // the $column_set is just a list of columns.
        settype($column_set, 'array');
        $keys = array_keys($column_set);
        $all_integer = true;
        foreach ($keys as $val) {
            if (! is_integer($val)) {
                $all_integer = false;
                break;
            }
        }
        
        if ($all_integer) {
        
            // the column_set is just a list of columns; get back the $this->col
            // array elements matching this list.
            $coldefs = $this->getColumns($column_set);
            
        } else {
            
            // the columns_set is an associative array where the key is a
            // column name and the value is the form element value.
            $coldefs = $this->getColumns($keys);
            foreach ($coldefs as $key => $val) {
                $coldefs[$key]['qf_setvalue'] = $column_set[$key];
            }
            
        }
        
        return $coldefs;
    }

}
?>
