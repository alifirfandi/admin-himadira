<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_helper {
    public function __construct() {
        $status = session_status();
        if($status == PHP_SESSION_NONE){
            //There is no active session
            session_start();
        }
    }

    // Check Session
    public function check_session($session_name='foo') {
        return isset($_SESSION[$session_name]);
	}

	//Check Login Session
	public function check_login_session($request)
	{
		if (!$this->check_session(HIMADIRA_ADMIN_AUTH))
			return $request->res(401, null, "Sesi kadaluarsa, lakukan login untuk memperbarui sesi", null);
	}

    // Add Session
    public function add_session($session_name, $session_value=array()) {
        $_SESSION[$session_name] = $session_value;
    }

    // Get Session
    public function get_session($session_name) {
        return $_SESSION[$session_name];
    }

    // Update Session
    public function set_session($session_name, $key, $value) {
        return $_SESSION[$session_name][$key] = $value;
    }

    // Remove Session
    public function remove_session($session_name) {
        unset($_SESSION[$session_name]);
    }

    // Destroy Session
    public function destroy_session() {
        session_destroy();
    }
}