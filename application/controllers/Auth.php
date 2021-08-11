<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // Public Variable
    public $session, $custom_curl;

    public function __construct()
    {
        parent::__construct();

        // Load Model
        $this->load->model("customSQL");
        $this->load->model("request");

        // Load Helper
        $this->session = new Session_helper();
        $this->custom_curl = new Mycurl_helper("");

        // Init Request
        $this->request->init($this->custom_curl);
    }
    
    // Do Sign In
    public function signIn()
    {
        $req = $this->input->post("raw", TRUE) ?: "";
        $req = json_decode($req, TRUE);

        // Check Request
        if (!isset($req["email"]) || empty($req["email"]) || 
            !isset($req["password"]) || empty($req["password"])) {
            return $this->request
            ->res(400, null, "Parameter tidak benar, cek kembali", null);
        }

        try {
            // Check Valid Data
            $email = $req["email"];

            $tempUser = $this->customSQL->query("
                SELECT m_users.id, `password`, `full_name`, `role`
                FROM `m_users`
                WHERE `email` = '$email'
            ")->result_array();

            if (count($tempUser) == 1) {
                $tempUser = $tempUser[0];
                // Check password
                if(password_verify($req["password"], $tempUser['password'])){
                    // Set Auth
                    $this->set_auth($tempUser);

                    // Create Log
                    $this->customSQL->log("id_m_users " . $tempUser['id'] . " Berhasil Login");

                    // Response Success
                    return $this->request
                    ->res(200, $tempUser, $tempUser["full_name"] . " Berhasil login", null);
                }
            }

            return $this->request
            ->res(401, null, "Akun tidak ditemukan", null);

        } catch (Exception $e) {
            return $this->request
            ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    // Set Session Auth
    public function set_auth($data) {
        if (!empty($data)) {
            $this->session->add_session(HIMADIRA_ADMIN_AUTH, $data);
        }
    }

    // Do Logout
    public function do_logout() {
        $this->session->remove_session(HIMADIRA_ADMIN_AUTH);
        $this->session->destroy_session();
        
        redirect(base_url("AuthCheck/login"));
    }
}
