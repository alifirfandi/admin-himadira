<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Model {
    private $custom_curl;

    public function init($custom_curl) {
        $this->custom_curl = $custom_curl;
    }

    public function raw() {
        return json_decode($this->input->raw_input_stream, true);
    }

    public function res($code, $data, $message, $meta) {
        $temp = array(
            "code" => $code,
            "message" => $message
        );

        if (isset($data) || !empty($data)) $temp["data"] = $data;
        if (isset($meta) || !empty($meta)) $temp["meta"] = $meta;

        header('Content-Type: application/json');

        die(json_encode(
            $temp,
            JSON_PRETTY_PRINT
        ));
	}

	public function checkStatusFail($status)
	{
		if ($status == -1) {
			return $this->res(500, null, "Terjadi kesalahan, silahkan cek masukan anda", null);
		}
    }
    
    public function checkStatusFound($data, $title)
	{
		if ($data == null) {
			return $this->res(404, null, "Terjadi kesalahan, data $title tidak ditemukan", null);
		}
	}
}