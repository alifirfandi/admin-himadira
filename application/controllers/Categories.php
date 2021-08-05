<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
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
        $this->load->library("CategoriesLib", array(
            "sql" => $this->customSQL
        ));

        // Check Session
        $this->session->check_login_session($this->request);
    }

    public function index()
    {
        try {
            $dataCategories = $this->categorieslib->getAll();

            return $this->request
                ->res(200, $dataCategories, "Berhasil memuat data", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Get data categories" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function getCategory($id)
    {
        try {
            $dataCategory = $this->categorieslib->getOne($id);

            return $this->request
                ->res(200, $dataCategory, "Berhasil memuat data", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Get data category" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function createCategory()
    {
        try {
            $req = $this->input->post("raw", TRUE);
            $req = json_decode($req, TRUE);

            if (!empty($req["category"])) {
                $data = [
                    "category" => $req["category"],
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ];

                $isCreated = $this->categorieslib->create($data);

                $this->request->checkStatusFail($isCreated);

                return $this->request
                    ->res(200, null, "Berhasil menambah data", null);
            }

            return $this->request
                ->res(400, null, "Harap isi semua form", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Create data categories: " . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function updateCategory()
    {
        try {
            $req = $this->input->post("raw", TRUE);
            $req = json_decode($req, TRUE);

            if (!empty($req["category"])) {
                $data = [
                    "category" => $req["category"],
                    "updated_at" => date("Y-m-d H:i:s"),
                ];

                $isUpdated = $this->categorieslib->update($req["category_id"], $data);
                $this->request->checkStatusFail($isUpdated);

                return $this->request
                    ->res(200, null, "Berhasil mengubah data", null);
            }
            return $this->request
                ->res(400, null, "Harap isi semua form", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Update data categories: " . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    // public function deleteCategories()
    // {
    //     try {
    //         $req = $this->input->post("raw", TRUE);
    //         $req = json_decode($req, TRUE);

    //         $isDeleted = $this->categorieslib->deleteCategories($req["categories_id"]);

    //         $this->request->checkStatusFail($isDeleted);

    //         return $this->request
    //             ->res(200, null, "Berhasil menghapus data", null);
    //     } catch (Exception $e) {
    //         // Create Log
    //         $this->customSQL->log("Delete data categories: " . $e->getMessage());

    //         return $this->request
    //             ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
    //     }
    // }
}
