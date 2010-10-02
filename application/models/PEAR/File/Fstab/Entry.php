<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * This file contains the class for an entry in a fstab file
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
 * @version   CVS:     $Revision: 1.7 $
 * @link      http://pear.php.net/package/File_Fstab
 */


/**
 * These defines enumerate the possible types of device entries in the fstab
 */
define('FILE_FSTAB_ENTRY_DEVTYPE_BLOCKDEV', 1);
define('FILE_FSTAB_ENTRY_DEVTYPE_UUID', 2);
define('FILE_FSTAB_ENTRY_DEVTYPE_LABEL', 3);


/**
 * A single entry in a fstab file
 *
 * @category  File Formats
 * @package   File_Fstab
 * @author    Ian Eure <ieure@php.net>
 * @copyright (c) 2004, 2005 Ian Eure
 * @license   http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version   Release: 2.0.2
 * @version   CVS:     $Revision: 1.7 $
 * @link      http://pear.php.net/package/File_Fstab
 */
class File_Fstab_Entry {
    /**
     * Raw line from fstab
     *
     * @var string
     */
    var $entry;

    /**
     * Block device
     *
     * Only one of $device, $uuid, or $label will be set, based on what's in the
     * fstab entry.
     *
     * @var string
     */
    var $device = '/dev/null';

    /**
     * Device UUID
     *
     * Only one of $device, $uuid, or $label will be set, based on what's in the
     * fstab entry.
     *
     * @var string
     */
    var $uuid;

    /**
     * Device label
     *
     * Only one of $device, $uuid, or $label will be set, based on what's in the
     * fstab entry.
     *
     * @var string
     */
    var $label;

    /**
     * Device mount point
     *
     * @var string
     */
    var $mountPoint = '/mnt';

    /**
     * Device filesystem type
     *
     * @var string
     */
    var $fsType = 'auto';

    /**
     * Mount options
     *
     * @var array
     */
    var $mountOptions = array(
            'defaults' => "defaults"
    );

    /**
     * Device dump frequency
     *
     * @var int
     */
    var $dumpFrequency = 0;

    /**
     * Device fsck pass number
     *
     * @var int
     */
    var $fsckPassNo = 0;

    /**
     * Have we parsed the entry?
     *
     * @var boolean
     * @access private
     */
    var $_haveParsed = false;


    /**
     * Constructor
     *
     * @param   string  $entry  Single entry from fstab file
     * @return  void
     */
    function File_Fstab_Entry($entry = false)
    {
        if ($entry) {
            $this->setEntry($entry);
            $this->parse();
        }
    }

    /**
     * Set block device
     *
     * Only one of device, uuid, or label may be set; setting this will un-set
     * any valies in the other variables.
     *
     * @since   2.0.0beta1
     * @param   string   $device  Value to set
     * @return  mixed    boolean true on success, PEAR_Error otherwise
     */
    function setDevice($device)
    {
        $this->device = $device;
        unset($this->uuid, $this->label);
        return true;
    }

    /**
     * Get block device
     *
     * @since   2.0.0beta1
     * @return  string
     */
    function getDevice()
    {
        return $this->device;
    }

    /**
     * Set UUID
     *
     * Only one of device, uuid, or label may be set; setting this will un-set
     * any valies in the other variables.
     *
     * @since   2.0.0beta1
     * @param   string   $uuid  Value to set
     * @return  mixed    boolean true on success, PEAR_Error otherwise
     */
    function setUUID($uuid)
    {
        $this->uuid = $uuid;
        unset($this->device, $this->label);
        return true;
    }

    /**
     * Get UUID
     *
     * @since   2.0.0beta1
     * @return  string
     */
    function getUUID()
    {
        return $this->uuid;
    }

    /**
     * Set device label
     *
     * Only one of device, uuid, or label may be set; setting this will un-set
     * any valies in the other variables.
     *
     * @since   2.0.0beta1
     * @param   string  $label  Value to set
     * @return  mixed   boolean true on success, PEAR_Error otherwise
     */
    function setLabel($label)
    {
        $this->label = $label;
        unset($this->device, $this->uuid);
        return true;
    }

    /**
     * Get device label
     *
     * @since   2.0.0beta1
     * @return  string
     */
    function getLabel()
    {
        return $this->label;
    }

    /**
     * Set mount point
     *
     * @since   2.0.0beta1
     * @param   string  $dir  Value to set
     * @return  mixed   boolean true on success, PEAR_Error otherwise
     */
    function setMountPoint($dir)
    {
        $this->mountPoint = $dir;
        return true;
    }

    /**
     * Get mount point
     *
     * @since   2.0.0beta1
     * @return  string
     */
    function getMountPoint()
    {
        return $this->mountPoint;
    }

    /**
     * Set filesystem type
     *
     * @since   2.0.0beta1
     * @param   string  $type  Value to set
     * @return  mixed   boolean true on success, PEAR_Error otherwise
     */
    function setFsType($type)
    {
        $this->fsType = $type;
        return true;
    }

    /**
     * Get filesystem type
     *
     * @since   2.0.0beta1
     * @return  string
     */
    function getFsType()
    {
        return $this->fsType;
    }

    /**
     * Set filesystem dump frequency
     *
     * @since   2.0.0beta1
     * @param   int    $type  Value to set
     * @return  mixed  boolean true on success, PEAR_Error otherwise
     */
    function setDumpFrequency($freq)
    {
        $this->dumpFrequency = $freq;
        return true;
    }

    /**
     * Get filesystem dump frequency
     *
     * @since   2.0.0beta1
     * @return  int
     */
    function getDumpFrequency()
    {
        return $this->dumpFrequency;
    }

    /**
     * Set filesystem fsck pass number
     *
     * @since   2.0.0beta1
     * @param   int    $type  Value to set
     * @return  mixed  boolean true on success, PEAR_Error otherwise
     */
    function setFsckPassNo($pass)
    {
        $this->fsckPassNo = $pass;
        return true;
    }

    /**
     * Get filesystem fsck pass number
     *
     * @since   2.0.0beta1
     * @return  int
     */
    function getFsckPassNo()
    {
        return $this->fsckPassNo;
    }

    /**
     * Set an entry
     *
     * @param   string  $entry  Single entry from fstab file
     * @return  void
     */
    function setEntry($entry)
    {
        $this->entry = $entry;
        $this->_haveParsed = false;
    }

    /**
     * Parse fstab entry
     *
     * @param   string  $entry  Line from fstab to parse
     * @return  mixed   true on success, PEAR_Error on failure
     */
    function parse()
    {
        if ($this->_haveParsed || !strlen($this->entry)) {
            return true;
        }

        // Sanitize.
        $this->_cleanup();

        // It might be a good idea to allow specifying a custom whitespace
        // character list.
        $sections = split("\ +|\t+", $this->entry);
        if (count($sections) != 6) {
            return PEAR::raiseError("Invalid entry format");
        }

        list($device, $this->mountPoint, $this->fsType, $options, $this->dumpFrequency, $this->fsckPassNo) = $sections;

        // Device, UUID, or Label?
        switch (substr($device, 0, 4)) {
            case 'UUID':
                list($null, $this->uuid) = explode('=', $device);
                break;

            case 'LABE':
                list($null, $this->label) = explode('=', $device);
                break;

            default:
                $this->device = $device;
        }

        $this->_parseMountOptions($options);

        $this->_haveParsed = true;
        return true;
    }

    /**
     * Clean up prior to parsing
     *
     * @access  private
     * @return  void
     */
    function _cleanup()
    {
        $this->mountOptions = array();
        unset($this->device, $this->uuid, $this->label, $this->mountPoint,
              $this->fsType, $this->dumpFrequency, $this->fsckPassNo);
    }

    /**
     * Parse fstab options
     *
     * @param $options string Mount options from fstab
     *
     * @return  void
     * @access  protected
     */
    function _parseMountOptions($options)
    {
        foreach (explode(',', $options) as $option) {
            if (strstr($option, '=')) {
                $tmp = explode('=', $option);
                list($name, $value) = $tmp;
            } else {
                $name = $option;
                $value = $option;
            }
            $this->mountOptions[$name] = $value;
        }
    }

    /**
     * Reconstruct fstab options from $mountOptions
     *
     * @return  string     fstab mount options
     * @access  protected
     */
    function _makeMountOptions()
    {
        // Copy.
        foreach ($this->mountOptions as $option => $value) {
            if ($option == $value) {
                $opts[] = $option;
            } else {
                $opts[] = $option.'='.$value;
            }
        }
        return implode(',', $opts);
    }

    /**
     * Get the fstab entry
     *
     * This rebuilds the entry from the class variables.
     *
     * @return  string  The fstab entry
     */
    function getEntry($seperator)
    {
        $entry = array(
            $this->_getDeviceEntry(),
            $this->getMountPoint(),
            $this->getFsType(),
            $this->_makeMountOptions(),
            $this->getDumpFrequency(),
            $this->getFsckPassNo()
        );
        return implode($entry, $seperator);
    }

    /**
     * Get device, or uuid, or label
     *
     * @return  string  Device/UUID/LABEL
     */
    function getDeviceUUIDOrLabel()
    {
        if ($this->device) {
            return $this->getDevice();
        } else if ($this->uuid) {
            return $this->getUUID();
        } else if($this->label) {
            return $this->getLabel();
        }
    }

    /**
     * Get device entry for building fstab
     *
     * This is like getDeviceUUIDOrLabel(), but we prefix the actual value
     * with the necessary string for it to work in the fstab.
     *
     * @return  string     Device/UUID/LABEL
     * @access  protected
     */
    function _getDeviceEntry()
    {
        switch ($this->getDeviceType()) {
            case FILE_FSTAB_ENTRY_DEVTYPE_UUID:
                $prefix = 'UUID=';
                break;

            case FILE_FSTAB_ENTRY_DEVTYPE_LABEL:
                $prefix = 'LABEL=';
                break;

            default:
                $prefix = '';
        }
        return $prefix.$this->getDeviceUUIDOrLabel();
    }

    /**
     * Get device type
     *
     * @return  int  One of FILE_FSTAB_ENTRY_DEVTYPE_BLOCKDEV, _UUID, or _LABEL
     */
    function getDeviceType()
    {
        if ($this->device) {
            return FILE_FSTAB_ENTRY_DEVTYPE_BLOCKDEV;
        } else if ($this->uuid) {
            return FILE_FSTAB_ENTRY_DEVTYPE_UUID;
        } else if ($this->label) {
            return FILE_FSTAB_ENTRY_DEVTYPE_LABEL;
        }
    }

    /**
     * Is an option set?
     *
     * @param   string   $option  Option name
     * @return  boolean
     */
    function hasMountOption($option)
    {
        return @array_key_exists($option, $this->mountOptions);
    }

    /**
     * Get a mount option
     *
     * @param   string   $which Option to get
     * @return  string   Mount option
     */
    function getMountOption($which)
    {
        if (!$this->hasMountOption($which)) {
            return false;
        }
        return $this->mountOptions[$which];
    }

    /**
     * Set a mount option
     *
     * @param   string  $name Option to set
     * @param   string  $value Value to give option, or blank if option takes no args
     * @return  void
     */
    function setMountOption($name, $value = false)
    {
        if (!$value) {
            $value = $name;
        }
        $this->mountOptions[$name] = $value;
    }
}
?>