<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: David Sklar <sklar@sklar.com>                               |
// +----------------------------------------------------------------------+
//
// $Id: SHM.php,v 1.2 2003/01/15 22:00:36 sklar Exp $
//

/**
 * This class implements a user-space stream that reads/writes shared
 * memory. It requires the shmop extension for shared memory access.
 *
 * Sample Usage:
 *
 * require_once('Stream/SHM.php');
 * stream_register_wrapper('shm','Stream_SHM') or die("can't register shm");
 * $shm = fopen('shm://0xabcd:12000','c');
 * fwrite($shm, 'One Two Three Four');
 * fseek($shm,4,SEEK_SET);
 * $two = fread($shm,3); // $two is "Two"
 * fclose($shm);
 *
 * Specify the key of the shared memory segment in decimal or hexadecimal
 * after the "shm://" and then optionally, a colon and the size of the
 * shared memory segment. If you don't specify a size, the segment size
 * defaults to 16384 bytes.
 *
 * Allowable modes are "a", "c", "w", and "n". For what those modes 
 * mean, see:
 * --> http://www.php.net/manual/en/function.shmop-open.php
 *
 *
 * @author David Sklar <sklar@sklar.com>
 * @version 1.0
 * @package Stream::SHM
 */
class Stream_SHM {

    /**
     * position
     * 
     * @var  string stream position in the shared memory segment
     */
    var $pos = 0;

    /**
     * shared memory segment key
     *
     * @var  integer key (for shmop_open()) of the segment
     */
    var $shm_key;

    /**
     * shared memory segment size
     *
     * @var  integer size of the shared memory segment (default: 16k)
     */
    var $size = 16384;

    /**
     * shared memory segment handle
     * @var resource handle to the segment for the shmop_*() functions
     */
    var $shm;

    /**
     * Stream opener
     *
     * @param string  $path         URL-style path to the segment
     * @param string  $mode         mode to open the segment with
     * @param integer $options      stream options
     * @param string  &$opened_path (not used)
     * @return boolean              Stream opened sucessfully?
     */
    function stream_open($path, $mode, $options, &$opened_path)
    {
        $url = parse_url($path);
        $this->shm_key = $url['host'];
        if ((! intval($this->shm_key)) && (! preg_match('/^0x[0-9a-f]+$/i',
                                                        $this->shm_key))) {
            if ($options & STREAM_REPORT_ERRORS) {
                trigger_error("Stream_SHM::stream_open: $this->shm_key is not a valid shm key.",E_USER_ERROR);
            }
            return false;
        }
        if (intval($url['port'])) {
            $this->size = intval($url['port']);
        }
        if (($mode != 'a') && ($mode != 'c') && 
            ($mode != 'w') && ($mode != 'n')) {
            if ($options & STREAM_REPORT_ERRORS) {
                trigger_error("Stream_SHM::stream_open: $mode is not a valid mode (must be one of: a c n w)",E_USER_ERROR);
            }
            return false;
        }
        if (! ($this->shm = shmop_open($this->shm_key,$mode,0600,$this->size))) {
            if ($options & STREAM_REPORT_ERRORS) {
                trigger_error('Stream_SHM::stream_open: shmop_open() failed');
            }
            return false;
        }
        $this->size = shmop_size($this->shm);
        return true;
    }
    /**
     * Stream closer
     *
     */
    function stream_close()
    {
        shmop_close($this->shm);
    }


    /**
     * Read from stream
     *
     * @param integer $count How many bytes to read from the stream
     * @return string        Data read from the stream
     */
    function stream_read($count)
    {
        // Don't read past the end of the stream
        if ($count + $this->pos > $this->size) {
            $count = $this->size - $this->pos;
        }
        $data = shmop_read($this->shm,$this->pos,$count);
        $this->pos += strlen($data);
        return $data;
    }

    /**
     * Write to stream
     *
     * @param  mixed   $data Data to write to the stream
     * @return integer       Bytes actually written to the stream
     */
    function stream_write($data)
    {
        $count = shmop_write($this->shm,$data,$this->pos);
        $this->pos += $count;
        return $count;
    }

    /**
     * Check stream end-of-file
     *
     * @return boolean Is the stream position at the end of the stream?
     */
    function stream_eof()
    {
        return ($this->pos == ($this->size - 1));
    }

    /**
     * Get stream position
     *
     * @return integer The current position in the stream
     */
    function stream_tell()
    {
        return $this->pos;
    }
    /**
     * Adjust current position in the stream
     *
     * @param  integer $offset How many bytes to move the position
     * @param  integer $whence Where to start counting from
     * @return boolean         Was the position adjustment successful?
     */
    function stream_seek($offset,$whence)
    {
        switch ($whence) {
        case SEEK_SET:
            if (($offset >= 0) && ($offset < $this->size)) {
                $this->pos = $offset;
                return true;
            } else {
                return false;
            }
            break;
        case SEEK_CUR:
            if (($offset >= 0) && (($this->pos + $offset) < $this->size)) {
                $this->pos += $offset;
                return true;
            } else {
                return false;
            }
            break;
        case SEEK_END:
            if (($this->size + $offset) >= 0) {
                $this->pos = $this->size + $offset;
                return true;
            } else {
                return false;
            }
            break;
        default:
            return false;
        }
    }

    /**
     * Flush data to the stream
     *
     * @return boolean Data is always flushed when writing with shmop_write()
     */
    function stream_flush()
    {
        return true;
    }
}
?>
