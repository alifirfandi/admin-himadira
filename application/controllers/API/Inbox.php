<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Inbox extends CI_Controller {

	private $custom_curl;

	public function __construct()
	{
		parent::__construct();
		
		header("Access-Control-Allow-Origin: *");
	
		// Load Model
		$this->load->model("customSQL");
		$this->load->model("request");

		// Init Request
		$this->request->init($this->custom_curl);

		// Load Library
		$this->load->library("InboxApiLib", array(
			"sql" => $this->customSQL
		));
	}

	public function index()
	{
		try {
            $name = $this->input->post("name", TRUE);
            $email = $this->input->post("email", TRUE);
            $subject = $this->input->post("subject", TRUE);
            $message = $this->input->post("message", TRUE);

            if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
                $data = [
                    "name" => $name,
                    "email" => $email,
                    "subject" => $subject,
                    "message" => $message,
                    "is_read" => 0,
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ];

                $isCreated = $this->inboxapilib->create($data);

                $this->request->checkStatusFail($isCreated);

                return $this->request
                    ->res(200, null, "Berhasil menambah data", null);
            }
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Get data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}
}