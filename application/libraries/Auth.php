<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Authentication library
 */
class Auth {
    
    const KEY_AUTH = 'AUTH_authenticated';
    const KEY_USER_ID = 'AUTH_user_id';
    const KEY_USER_NAME = 'AUTH_user_name';

    // reference to CI object
    private $CI = NULL;

    /**
     * Authentication library construct
     */
    public function __construct() {

        // get CI object
        $this->CI = & get_instance();
        
    }
    
    /**
     * Authenticate a user
     * 
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function authenticate($user_name, $password) {
        
        // get user
        $user = $this->CI->_auth->get_user($user_name);
        
        // does the user exist?
        if ($user == NULL) return false;
        
        // hash the received password and user's salt
        $password_hash = new String(sha1($password . $user->salt));
        
        // compare stored and generated password hash
        if ($password_hash->equals($user->password_hash) == false) {
            return false;
        }
        
        $this->CI->session->set_userdata(array(
            self::KEY_AUTH => true,
            self::KEY_USER_ID => (int) $user->id,
            self::KEY_USER_NAME => $user_name
        ));
        
        // user exists
        return true;
        
    }

    /**
     * Creates a user
     * 
     * @param object $user
     * @return boolean
     */
    public function create_user($user) {
        
        // generate the salt
        $user->salt = random_string('unique');
        // hash the password and salt together
        $user->password_hash = sha1($user->password . $user->salt);
        
        // create user
        return $this->CI->_auth->create_user($user);
        
    }
    
    /**
     * Deauthenticate a user
     */
    public function deauthenticate() {
        
        $this->CI->session->unset_userdata(array(
            self::KEY_AUTH => false,
            self::KEY_USER_ID => 0,
            self::KEY_USER_NAME => ''
        ));
        
    }
    
    /**
     * Get user id
     * 
     * @return string
     */
    public function get_user_id() {
        
        return $this->CI->session->userdata(self::KEY_USER_ID);
        
    }
    
    /**
     * Get user name
     * 
     * @return string
     */
    public function get_user_name() {
        
        return $this->CI->session->userdata(self::KEY_USER_NAME);
        
    }
    
    /**
     * Check if user is authenticated
     * 
     * @return boolean
     */
    public function is_authenticated() {
        
        // get user
        $user = $this->CI->_auth->get_user($this->get_user_name());
        
        // does the user exist?
        if ($user == NULL) return false;
        
        return $this->CI->session->userdata(self::KEY_AUTH) == true;
        
    }
    
    /**
     * Enforce authentication
     * 
     * @param string $url
     */
    public function required($uri = '') {
        
        if ($this->is_authenticated() == false) {
            $this->CI->flash->danger("You must be signed in to do that.");
            if ($uri != '') {
                redirect($uri);
            }
            redirect("users/signin");
        }
        
    }

}

/* End of file Auth.php */