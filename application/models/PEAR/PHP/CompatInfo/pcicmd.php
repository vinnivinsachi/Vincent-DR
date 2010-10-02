<?php
/**
 * Get the Compatibility info from PHP CLI
 *
 * @version    $Id: pcicmd.php,v 1.1 2006/08/27 16:29:58 farell Exp $
 * @author     Davey Shafik <davey@php.net>
 * @package    PHP_CompatInfo
 * @access     public
 */

require_once 'PHP/CompatInfo/Cli.php';

$cli = new PHP_CompatInfo_Cli();
$cli->run();
?>