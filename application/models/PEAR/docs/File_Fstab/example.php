<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Example use for File_Fstab
 *
 * This file contains example code for interacting with File_Fstab. It covers
 * most of the functionality offered by the package, including modifying and
 * saving fstab files.
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
 * @copyright 2004, 2005 Ian Eure
 * @license   http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version   CVS: $Revision$
 * @version   Release: @version@
 * @link      http://pear.php.net/package/File_Fstab
 */

require_once 'File/Fstab.php';

// Get an instance for the system's fstab.
$sysTab = File_Fstab::singleton('/etc/fstab');

// Get the entry for the root partition.
$rootEnt = &$sysTab->getEntryForPath('/');


// See how error handling is set.
if ($rootEnt->hasMountOption('errors')) {
    print "Error handling for / is: ".$rootEnt->mountOptions['errors']."\n";
} else {
    print "Error handling for / is undefined.\n";
}

// Change fstype for /
print "Chanking fstype for ".$rootEnt->getDeviceUUIDOrLabel()." (mounted on ".$rootEnt->getMountPoint().") to reiserfs\n";
$rootEnt->fsType = 'reiserfs';

// Create a new entry.
print "Adding entry for CD-ROM\n";
$ent = new File_Fstab_Entry;
$ent->device = '/dev/cdrom';
$ent->mountPoint = '/cdrom';
$ent->fsType = 'iso9660';
$ent->setMountOption('user');

// Add the entry
$sysTab->addEntry(&$ent);

// Write to a temp file.
print "Saving modified fstab to /tmp/newtab\n";
$res = $sysTab->save('/tmp/newtab');
if (PEAR::isError($res)) {
    die($res->getMessage()."\n");
}

?>