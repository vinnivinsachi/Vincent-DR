<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
/*
Copyright (c) 2003, Michael Bretterklieber <michael@bretterklieber.com>
All rights reserved.

Redistribution and use in source and binary forms, with or without 
modification, are permitted provided that the following conditions 
are met:

1. Redistributions of source code must retain the above copyright 
   notice, this list of conditions and the following disclaimer.
2. Redistributions in binary form must reproduce the above copyright 
   notice, this list of conditions and the following disclaimer in the 
   documentation and/or other materials provided with the distribution.
3. The names of the authors may not be used to endorse or promote products 
   derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, 
INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, 
BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY 
OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, 
EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

This code cannot simply be copied and put under the GNU Public License or 
any other GPL-like (LGPL, GPL2) License.

    $Id: SMBPasswd.php,v 1.3 2004/09/14 16:08:45 mbretter Exp $
*/

require_once 'PEAR.php';
require_once 'Crypt/CHAP.php';

/**
 * Class to manage SAMBA smbpasswd-style files
 *
 * Example 1 (modifying existing file):
 *
 * $f = new File_SMBPasswd('./smbpasswd');
 * $f->load();
 * $f->addAccount('sepp3', 12, 'MyPw');
 * $f->modAccount('sepp', '', 'MyPw');
 * $f->delAccount('karli');
 * $f->printAccounts();
 * $f->save();
 * 
 * Example 2 (creating a new file):
 *
 * $f = new File_SMBPasswd('./smbpasswdnew');
 * $f->addAccount('sepp1', 12, 'MyPw');
 * $f->addAccount('sepp3', 1000, 'MyPw');
 * $f->save();
 *
 * Example 3 (authentication):
 *
 * $f = new File_SMBPasswd('./smbpasswdnew');
 * $f->load();
 * if ($f->verifyAccount('sepp', 'MyPw')) {
 *     echo "Account valid";
 * } else {
 *     echo "Account invalid or disabled";
 * }
 *
 * @author Michael Bretterklieber <mbretter@jawa.at>
 * @access  public
 * @version 0.9.0
 * @package File_SMBPasswd
 * @category File
 */
class File_SMBPasswd extends PEAR {
    
    /**
     * Multidimensional array of accounts
     * @var array
     */
    var $accounts = array();    

    /**
     * Path to the smbpasswd file
     * @var string
     */
    var $file;

    /**
     * Class who generates the NT-Hash and LAN-Manager-Hash
     * @var object
     */
    var $cryptEngine;

    /**
     * Filehandle, of locked File
     * @var resource
     */
    var $fplock;
    
    /**
     * Constructor
     *
     * @access public
     * @param  string $file
     * @return object File_SMBPasswd
     */
    function File_SMBPasswd($file = 'smbpasswd') 
    {
        $this->file = $file;
        $this->cryptEngine = new Crypt_CHAP_MSv1;
    }     

    /**
     * Load the given smbpasswd file
     *
     * @access public
     * @return mixed   true on success, PEAR_Error on failure
     */    
    function load()
    {
        $fd = fopen($this->getFile(), 'r') ;
        if (!$fd) {
            return $this->raiseError('Could not open ' . $this->getFile() . 
                                    ' for reading.');
        }
        
        while (!feof($fd)) {
            $line = fgets($fd, 4096);
            if (preg_match('/^#|^$/', trim($line))) {
                continue;
            }
            @list($user, $userid, $lmhash, $nthash, $flags, $lct, $comment) = explode(':', $line);
            if (strlen($user)) {
                $this->accounts[$user] = array(
                    'userid'    => trim($userid),
                    'lmhash'    => trim($lmhash),
                    'nthash'    => trim($nthash),
                    'flags'     => trim($flags),
                    'lct'       => trim($lct),
                    'comment'   => trim($comment)
                    );
            }
        }
        
        fclose($fd);   
        return true; 
    }
    
    /**
     * Get the value of file property
     *
     * @access public
     * @return string  
     */
    function getFile() {
        return $this->file;
    }

    /**
     * Get the value of accounts property
     *
     * @access public
     * @return array  
     */
    function &getAccounts() {
        return $this->accounts;
    } 
    
    /**
     * Adds an account, with pre-encrypted passwords
     *
     * @param $user new username
     * @param $userid new userid
     * @param $lmhash LAN-Manager-Hash
     * @param $nthash NT-Hash 
     * @param $comment Comment
     * @param $flags Account-flags (see man 5 smbpasswd)
     *
     * @return mixed returns PEAR_Error, if the user already exists
     * @access public
     */
    function addAccountEncrypted($user, $userid, $lmhash = '', $nthash = '', $comment = '', $flags = '[U          ]') 
    {
        if (empty($lmhash)) $lmhash = str_repeat('X', 32);
        if (empty($nthash)) $nthash = str_repeat('X', 32);
                
        if (!isset($this->accounts[$user])) {
            $this->accounts[$user] = array(
                'userid'    => trim($userid),
                'lmhash'    => trim($lmhash),
                'nthash'    => trim($nthash),
                'flags'     => trim($flags),
                'lct'       => sprintf('LCT-%08s', strtoupper(dechex(time()))),
                'comment'   => trim($comment)
                );
            
            return true;
        } else {
            return $this->raiseError( "Couldn't add user '$user', because the user already exists!");
        }
    }

    /**
     * Adds an account
     *
     * @param $user new username
     * @param $userid new userid
     * @param $pass Plaintext password
     * @param $comment Comment
     * @param $flags Account-flags (see man 5 smbpasswd)
     *
     * @return mixed returns PEAR_Error, if the user already exists
     * @access public
     */
    function addAccount($user, $userid, $pass, $comment = '', $flags = '[U          ]') 
    {
        if (empty($pass)) {
            return $this->addAccountEncrypted($user, $userid, '', '', $comment, $flags) ;
        } else {
            return $this->addAccountEncrypted(
                        $user, 
                        $userid, 
                        strtoupper(bin2hex($this->cryptEngine->lmPasswordHash($pass))),
                        strtoupper(bin2hex($this->cryptEngine->ntPasswordHash($pass))), 
                        $comment,
                        $flags);
        }
                        
    }

    /**
     * Adds a user-account
     *
     * @param $user new username
     * @param $userid new userid
     * @param $pass Plaintext password
     * @param $comment Comment
     *
     * @return mixed returns PEAR_Error, if the user already exists
     * @access public
     */
    function addUser($user, $userid, $pass, $comment = '')
    {
        return $this->addAccount($user, $userid, $pass, $comment, '[U          ]');
    }

    /**
     * Adds a machine-account
     *
     * @param $machine new username
     * @param $userid new userid
     * @param $comment Comment
     *
     * @return mixed returns PEAR_Error, if the user already exists
     * @access public
     */
    function addMachine($machine, $userid, $comment = '')
    {
        return $this->addAccount($machine . '$', $userid, $machine, $comment, '[W          ]');
    }
    
    /**
     * Modifies an account with the pre-encrypted Hashes
     *
     * @param $user new username
     * @param $userid new userid
     * @param $lmhash LAN-Manager-Hash
     * @param $nthash NT-Hash 
     * @param $comment Comment
     * @param $flags Account-flags (see man 5 smbpasswd)
     *
     * @return mixed returns PEAR_Error, if the user doesen't exists
     * @access public
     */
    function modAccountEncrypted($user, $userid = '', $lmhash = '', $nthash = '', $comment = '', $flags = '') 
    {
        $account = $this->accounts[$user];
        if (is_array($account)) {
            if ($userid === '') $userid   = $account['userid'];
            if (empty($lmhash)) $lmhash   = $account['lmhash'];
            if (empty($nthash)) $nthash   = $account['nthash'];
            if (empty($flags))  $flags    = $account['flags'];
            if (empty($comment)) $comment = $account['comment'];

            $this->accounts[$user] = array(
                'userid'    => trim($userid),
                'lmhash'    => trim($lmhash),
                'nthash'    => trim($nthash),
                'flags'     => trim($flags),
                'lct'       => sprintf('LCT-%08s', strtoupper(dechex(time()))),
                'comment'   => trim($comment)
                );
            
            return true;
        } else {
            return $this->raiseError( "Couldn't modify user '$user', because the user doesn't exists!") ;
        }
    }
    
    /**
     * Modifies an account with given plaintext password
     *
     * @param $user new username
     * @param $userid new userid
     * @param $pass Plaintext password
     * @param $comment Comment
     * @param $flags Account-flags (see man 5 smbpasswd)
     *
     * @return mixed returns PEAR_Error, if the user doesen't exists
     * @access public
     */
    function modAccount($user, $userid = '', $pass = '', $comment = '', $flags = '') 
    {
        if (empty($pass)) {
            return $this->modAccountEncrypted($user, $userid, '', '', $comment, $flags) ;
        } else {
            return $this->modAccountEncrypted(
                        $user, 
                        $userid, 
                        strtoupper(bin2hex($this->cryptEngine->lmPasswordHash($pass))),
                        strtoupper(bin2hex($this->cryptEngine->ntPasswordHash($pass))), 
                        $comment, 
                        $flags);
        }
    }

    /**
     * This is an alias for modAccount
     *
     * @see File_SMBPasswd::modAccount
     */
    function modUser($user, $userid = '', $pass = '', $comment = '', $flags = '') 
    {
       return $this->modAccount($user, $userid, $pass, $comment, $flags);
    }

    /**
     * Deletes an account
     *
     * @param $user username
     *
     * @return mixed returns PEAR_Error, if the user doesn't exists
     * @access public	
     */
    function delAccount($name) 
    {
        if (isset($this->accounts[$name])) {
            unset($this->accounts[$name]);
            return true;
        } else {
            return $this->raiseError( "Couldn't delete account '$name', because the account doesn't exists!") ; 
        }
    }   

    /**
     * This is an alias for delAccount
     *
     * @see File_SMBPasswd::delAccount
     */
    function delUser($user) 
    {
       return $this->delAccount($user);
    }

    
    /**
     * Verifies a user's password
     * Prefer NT-Hash instead of weak LAN-Manager-Hash
     *
     * @param $user username
     * @param $nthash NT-Hash in hex
     * @param $lmhash LAN-Manager-Hash in hex
     *
     * @return boolean true if password is ok
     * @access public		
     */
    function verifyAccountEncrypted($user, $nthash, $lmhash = '') 
    {
        $account = $this->accounts[$user];
        if (is_array($account)) {
            
            // checking wether account is disabled
            if (preg_match('/D/', $account['flags'])) {
                return false;
            }
            if (!empty($lmhash)) {
                return $account['lmhash'] == strtoupper($lmhash);
            } else {
                return $account['nthash'] == strtoupper($nthash);
            }
        }
        return false;
    }

    /**
     * Verifies an account with the given plaintext password
     *
     * @param $user username
     * @param $pass The plaintext password
     *
     * @return boolean true if password is ok
     * @access public		
     */
    function verifyAccount($user, $pass) 
    {
        return $this->verifyAccountEncrypted(
                        $user, 
                        strtoupper(bin2hex($this->cryptEngine->ntPasswordHash($pass))), 
                        strtoupper(bin2hex($this->cryptEngine->lmPasswordHash($pass))));
    }

    /**
     * Locks the given file
     *
     * @return mixed PEAR_Error, true on succes
     * @access public
     */
    function lock() 
    {
        if (!is_resource($this->fplock)) {
            $this->fplock = @fopen($this->getFile(), 'w');
        }

        if (!is_resource($this->fplock)) {
            return $this->raiseError('Could not open ' . $this->getFile() . 
                                    ' for writing.');
        }

        if (!flock($this->fplock, LOCK_EX)) {
            return $this->raiseError('Could not open lock file ' . $this->getFile());
        }

        return true;
    }

    /**
     * Unlocks the given file
     *
     * @return mixed PEAR_Error, true on succes
     * @access public
     */
    function unlock() 
    {
        if (is_resource($this->fplock)) {
            if (!flock($this->fplock, LOCK_UN)) {
                return $this->raiseError('Could not open unlock file ' . $this->getFile());
            }
        }

        return true;
    }

    /**
     * Writes changes to smbpasswd file and locks, unlocks and closes it
     *
     * @param $file Filename
     *
     * @return mixed returns PEAR_Error, if the file is not writeable
     * @access public
     */
    function save($file = '') 
    {
        if (!empty($file)) {
            $this->file = $file;
        }

        $ret = $this->lock();
        if ($ret !== true) {
            return $ret;
        }
        
        foreach ($this->accounts as $user => $userdata) {
            fputs($this->fplock, sprintf("%s:%s:%s:%s:%s:%s:%s\n", 
                    $user, 
                    $userdata['userid'], 
                    $userdata['lmhash'], 
                    $userdata['nthash'], 
                    $userdata['flags'],
                    $userdata['lct'],
                    $userdata['comment']));
        }

        $this->unlock();
        fclose($this->fplock);
        return true;
    }    
    
    /**
     * Print all accounts from smbpasswd file
     *
     * @access public
     * @return void
     */
    function printAccounts() {
        foreach ($this->accounts as $user => $userdata) {
            printf("%s:%s:%s:%s:%s:%s:%s\n", 
                $user, 
                $userdata['userid'], 
                $userdata['lmhash'], 
                $userdata['nthash'], 
                $userdata['flags'],
                $userdata['lct'],
                $userdata['comment']);
        }
    }

}
?>
