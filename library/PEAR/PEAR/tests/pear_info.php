<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Davey Shafik <davey@pixelated-dreams.com>                   |
// +----------------------------------------------------------------------+
//
// $Id: pear_info.php,v 1.5 2003/05/12 11:40:57 davey Exp $

/* May be required on slower (dial-up) connections
ini_set('default_socket_timeout',600);
ini_set('max_execution_time',600);
ini_set('max_input_time',600); */

// require the PEAR_Info file
require_once 'PEAR/Info.php';

// If you need to set a http_proxy uncomment the line below
// PEAR_Info::setProxy('your.proxy.here');

// Create PEAR_Info object
$info = new PEAR_Info();

// Display PEAR_Info output
$info->show();

?>