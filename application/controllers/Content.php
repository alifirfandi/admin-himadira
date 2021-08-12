<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Content extends CI_Controller
{
    // Public Variable
    public $custom_curl;
    private $contentUploadDir = "assets/img/upload/content/";

    public function __construct()
    {
        parent::__construct();

        // Load Model
        $this->load->model("customSQL");
        $this->load->model("request");

        // Load Helper
        $this->session = new Session_helper();
        $this->custom_curl = new Mycurl_helper("");
        $this->fileUpload = new Upload_file_helper(
            array(
                "file_type" => array(
                    "png",
                    "jpg",
                    "jpeg"
                ),
            ),
            $this->contentUploadDir
        );

        // Init Request
        $this->request->init($this->custom_curl);

        // Load Library
        $this->load->library("ContentLib", array(
            "sql" => $this->customSQL
        ));
        $this->load->library("ContentImagesLib", array(
            "sql" => $this->customSQL
        ));

        // Check Session
        $this->session->check_login_session($this->request);
    }

    public function index()
    {
        try {
            $dataContent = $this->contentlib->getAll();

            return $this->request
                ->res(200, $dataContent, "Berhasil memuat data konten", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Get data content" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function getContent($id)
    {
        try {
            $dataContent = $this->contentlib->getOne($id);
            $this->request->checkStatusFound($dataContent, "Konten");
            $dataContent['photo'] = $this->contentimageslib->getContentPhoto($id);

            return $this->request
                ->res(200, $dataContent, "Berhasil memuat data", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Get data content" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function createContent()
    {
        try {
            $title = $this->input->post("title", TRUE);
            $category = $this->input->post("category", TRUE);
            $link = $this->input->post("link", TRUE);
            $description = $this->input->post("description");

            if (!$_FILES["cover"]['name']) {
                return $this->request
                    ->res(400, null, "Harap isi semua form", null);
            }

            if (!empty($title) && !empty($category) && !empty($link) && !empty($description)) {
                $uploadFile = $this->fileUpload->do_upload("cover");

                if ($uploadFile["status"]) {
                    $data = [
                        "title" => $title,
                        "description" => $description,
                        "id_m_categories" => $category,
                        "link" => $link,
                        "thumbnail" => str_replace(FCPATH, "", $uploadFile["file_location"]),
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s"),
                    ];

                    $isCreated = $this->contentlib->create($data);
                    $this->request->checkStatusFail($isCreated);

                    return $this->request
                        ->res(200, $isCreated, "Berhasil menambah data konten", null);
                }

                return $this->request
                    ->res(500, null, "Terjadi kesalahan saat mengunggah gambar", null);
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

    public function editContent($id)
    {
        try {
            $title = $this->input->post("title", TRUE);
            $category = $this->input->post("category", TRUE);
            $link = $this->input->post("link", TRUE);
            $description = $this->input->post("description");

            if (!empty($title) && !empty($category) && !empty($link) && !empty($description)) {
                if (empty($_FILES["cover"])) {
                    $data = [
                        "title" => $title,
                        "description" => $description,
                        "id_m_categories" => $category,
                        "link" => $link,
                        "updated_at" => date("Y-m-d H:i:s"),
                    ];

                    $isUpdated = $this->contentlib->update($id, $data);
                    $this->request->checkStatusFail($isUpdated);

                    return $this->request
                        ->res(200, null, "Berhasil mengubah data konten", null);
                }

                $uploadFile = $this->fileUpload->do_upload("cover");

                if ($uploadFile["status"]) {
                    $data = [
                        "thumbnail" => str_replace(FCPATH, "", $uploadFile["file_location"]),
                    ];

                    $isUpdated = $this->contentlib->update($id, $data);
                    $this->request->checkStatusFail($isUpdated);

                    return $this->request
                        ->res(200, null, "Berhasil mengubah data konten", null);
                }

                return $this->request
                    ->res(500, null, "Terjadi kesalahan saat mengunggah gambar", null);
            }

            return $this->request
                ->res(400, null, "Harap isi semua form", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Update data content: " . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function deleteContent($id)
    {
        try {
            $dataContent = $this->contentlib->getOne($id);
            $this->request->checkStatusFound($dataContent, "Konten");

            $isDeleted = $this->contentlib->delete($id);
            $this->request->checkStatusFail($isDeleted);

            return $this->request
                ->res(200, null, "Berhasil menghapus data konten", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Delete data content" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function insertPhoto($idContent)
    {
        try {
            if (!$_FILES["photo"]['name']) {
                return $this->request
                    ->res(400, null, "Harap isi semua form", null);
            }

            $uploadFile = $this->fileUpload->do_upload("photo");

            if ($uploadFile["status"]) {
                $data = [
                    "label" => $uploadFile["file_name"],
                    "uri" => str_replace(FCPATH, "", $uploadFile["file_location"]),
                    "id_content" => $idContent,
                    "created_at" => date("Y-m-d H:i:s"),
                ];

                $isCreated = $this->contentimageslib->create($data);
                $this->request->checkStatusFail($isCreated);

                return $this->request
                    ->res(200, null, "Berhasil menambah foto konten", null);
            }

            return $this->request
                ->res(500, null, "Terjadi kesalahan saat mengunggah gambar", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Create data categories: " . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }

    public function deletePhoto($idPhoto)
    {
        try {
            $dataPhoto = $this->contentimageslib->getOne($idPhoto);
            $this->request->checkStatusFound($dataPhoto, "Foto Konten");

            $isDeleted = $this->contentimageslib->delete($idPhoto);
            $this->request->checkStatusFail($isDeleted);

            return $this->request
                ->res(200, null, "Berhasil menghapus data foto konten", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Delete data photo content" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
    }
}
