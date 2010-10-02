<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Main File_Fstab file
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  File Formats
 * @package   File_Fstab
 * @author    Ian Eure <ieure@php.net>
 * @copyright (c) 2004, 2005 Ian Eure
 * @license   http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version   Release: 2.0.2
 * @version   CVS:     $Revision: 1.11 $
 * @link      http://pear.php.net/package/File_Fstab
 */

require_once 'PEAR.php';
require_once 'File/Fstab/Entry.php';

/**
 * These defines enumerate the possible error types
 */
define('FILE_FSTAB_ERROR_NOENT', -1);
define('FILE_FSTAB_PERMISSION_DENIED', -2);
define('FILE_FSTAB_WRONG_CLASS', -3);

/**
 * Class to read, write, and manipulate fstab files
 *
 * @category  File Formats
 * @package   File_Fstab
 * @author    Ian Eure <ieure@php.net>
 * @copyright (c) 2004, 2005 Ian Eure
 * @license   http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version   Release: 2.0.2
 * @version   CVS:     $Revision: 1.11 $
 * @link      http://pear.php.net/package/File_Fstab
 */
class File_Fstab {
    /**
     * Array of fstab entries
     *
     * @var array
     */
    var $entries = array();

    /**
     * Class options.
     *
     * @var array
     */
    var $options = array();

    /**
     * Default options
     *
     * @var array
     * @access private
     */
    var $_defaultOptions = array(
        'entryClass' => "File_Fstab_Entry",
        'file' => "/etc/fstab",
        'fieldSeperator' => "\t"
    );

    /**
     * Has the fstab been parsed?
     *
     * @var boolean
     * @access private
     */
    var $_isLoaded = false;

    /**
     * Constructor
     *
     * @param   array  $options  Associative array of options to set
     * @return  void
     */
    function File_Fstab($options = false)
    {
        $this->setOptions($options);
        if ($this->options['file']) {
            $this->load();
        }
    }

    /**
     * Return a single instance to handle a fstab file
     *
     * @param   string  $fstab  Path to the fstab file
     * @return  object  File_Fstab instance
     */
    function &singleton($fstab)
    {
        static $instances;
        if (!isset($instances)) {
            $instances = array();
        }

        if (!isset($instances[$fstab])) {
            $instances[$fstab] = &new File_Fstab(array('file' => $fstab));
        }

        return $instances[$fstab];
    }

    /**
     * Parse fstab file
     *
     * @return  void
     * @since   1.0.1
     */
    function load()
    {
        $fp = fopen($this->options['file'], 'r');
        while ($line = fgets($fp, 1024)) {

            // Strip comments & trim whitespace
            $line = trim(ereg_replace('#.*$', '', $line));

            // Ignore blank lines
            if (!strlen($line)) {
                continue;
            }

            $class = $this->options['entryClass'];
            $this->entries[] = new $class($line);

        }

        $this->_isLoaded = true;
    }

    /**
     * Update entries
     *
     * This will dump all the entries and re-parse the fstab. There's probably
     * a better way of doing this, like forcing the extant entries to re-parse,
     * and adding/removing entries as needed, but I don't feel like doing that
     * right now.
     *
     * @return  void
     */
    function update()
    {
        unset($this->entries);
        $this->load();
    }

    /**
     * Get a File_Fstab_Entry object for a path
     *
     * @param   string  $path  Mount point
     * @return  mixed   File_Fstab_Entry instance on success, PEAR_Error otherwise
     */
    function &getEntryForPath($path)
    {
        foreach ($this->entries as $key => $entry) {
            if ($entry->mountPoint == $path) {
                // Foreach makes copies - make sure we return a reference
                return $this->entries[$key];
            }
        }
        return PEAR::raiseError("No entry for path \"{$path}\"", FILE_FSTAB_ERROR_NOENT);
    }

    /**
     * Get a File_Fstab_Entry object for a block device
     *
     * @param   string  $blockdev  Block device
     * @return  mixed   File_Fstab_Entry instance on success, PEAR_Error otherwise
     */
    function &getEntryForDevice($blockdev)
    {
        foreach ($this->entries as $key => $entry) {
            if ($entry->getDeviceType() == FILE_FSTAB_ENTRY_DEVTYPE_BLOCKDEV &&
                $entry->device == $blockdev) {
                // Foreach makes copies - make sure we return a reference
                return $this->entries[$key];
            }
        }
        return PEAR::raiseError("No entry for device \"{$blockdev}\"", FILE_FSTAB_ERROR_NOENT);
    }

    /**
     * Get a File_Fstab_Entry object for a UUID
     *
     * @param   string  $uuid  UUID device
     * @return  mixed   File_Fstab_Entry instance on success, PEAR_Error otherwise
     */
    function &getEntryForUUID($uuid)
    {
        foreach ($this->entries as $key => $entry) {
            if ($entry->getDeviceType() == FILE_FSTAB_ENTRY_DEVTYPE_UUID &&
                $entry->uuid == $uuid) {
                // Foreach makes copies - make sure we return a reference
                return $this->entries[$key];
            }
        }
        return PEAR::raiseError("No entry for UUID \"{$uuid}\"", FILE_FSTAB_ERROR_NOENT);
    }

    /**
     * Get a File_Fstab_Entry object for a label
     *
     * @param   string  $label  Label
     * @return  mixed   File_Fstab_Entry instance on success, PEAR_Error otherwise
     */
    function &getEntryForLabel($label)
    {
        foreach ($this->entries as $key => $entry) {
            if ($entry->getDeviceType() == FILE_FSTAB_ENTRY_DEVTYPE_LABEL &&
                $entry->label == $label) {
                // Foreach makes copies - make sure we return a reference
                return $this->entries[$key];
            }
        }
        return PEAR::raiseError("No entry for label \"{$label}\"", FILE_FSTAB_ERROR_NOENT);
    }

    /**
     * Add a new entry
     *
     * @param   object  $entry  Reference to a File_Fstab_Entry-derived class
     * @return  mixed   boolean true on success, PEAR_Error otherwise.
     */
    function addEntry(&$entry)
    {
        if (!is_a($entry, 'File_Fstab_Entry')) {
            return PEAR::raiseError("Entry must be derived from File_Fstab_Entry.",
                                    FILE_FSTAB_WRONG_CLASS);
        }

        $this->entries[] = $entry;
        return true;
    }

    /**
     * Set class options
     *
     * The allowed options are:
     *
     * - entryClass
     *     Class to use for entries in the fstab. Defaults to File_Fstab_Entry.
     *     you can use this to provide your own entry class with added
     *     functionality. This class must extend File_Fstab_Entry.
     *
     * - file
     *     File to parse. Defaults to /etc/fstab.
     *
     * - fieldSeparator
     *     Separator for fields. This only affects the output when you call
     *     {@link save()}.  This text is placed in between the elements of the
     *     fstab entry line.
     *
     * @param   array  $options  Associative array of options to set
     * @return  void
     */
    function setOptions($options = false)
    {
        if (!is_array($options)) {
            $options = array();
        }

        $this->options = array_merge($this->_defaultOptions, $options);
    }

    /**
     * Write out a modified fstab
     *
     * WARNING: This will strip comments and blank lines from the original fstab.
     *
     * @return  mixed  true on success, PEAR_Error on failure
     * @since   1.0.1
     */
    function save($output = false)
    {
        $output = $output ? $output : $this->options['file'];

        $fp = @fopen($output, 'w');
        if (!$fp) {
            return PEAR::raiseError("Can't write to {$output}",
                                    FILE_FSTAB_PERMISSION_DENIED);
        }

        foreach($this->entries as $entry) {
            fwrite($fp, $entry->getEntry($this->options['fieldSeperator'])."\n");
        }
        fclose($fp);
        return true;
    }
}
?>
