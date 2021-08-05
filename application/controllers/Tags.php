<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tags extends CI_Controller
{
    // Public Variable
    public $custom_curl;

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

        // Load Library
        $this->load->library("TagsLib", array(
            "sql" => $this->customSQL
        ));

        // Check Session
        $this->session->check_login_session($this->request);
    }

    public function index()
    {
        try {
            $dataTags = $this->tagslib->getAll();

            return $this->request
                ->res(200, $dataTags, "Berhasil memuat data", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Get data tags" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function getTag($id)
    {
        try {
            $dataTag = $this->tagslib->getOne($id);

            return $this->request
                ->res(200, $dataTag, "Berhasil memuat data", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Get data tag" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function createTag()
    {
        try {
            $req = $this->input->post("raw", TRUE);
            $req = json_decode($req, TRUE);

            if (!empty($req["tag"])) {
                $data = [
                    "tag" => $req["tag"],
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ];

                $isCreated = $this->tagslib->create($data);

                $this->request->checkStatusFail($isCreated);

                return $this->request
                    ->res(200, null, "Berhasil menambah data", null);
            }

            return $this->request
                ->res(400, null, "Harap isi semua form", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Create data tag: " . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function updateTag()
    {
        try {
            $req = $this->input->post("raw", TRUE);
            $req = json_decode($req, TRUE);

            if (!empty($req["tag"])) {
                $data = [
                    "tag" => $req["tag"],
                    "updated_at" => date("Y-m-d H:i:s"),
                ];

                $isUpdated = $this->tagslib->update($req["tag_id"], $data);
                $this->request->checkStatusFail($isUpdated);

                return $this->request
                    ->res(200, null, "Berhasil mengubah data", null);
            }
            return $this->request
                ->res(400, null, "Harap isi semua form", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Update data tag: " . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }
}
