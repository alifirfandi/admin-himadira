<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Content extends CI_Controller {

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
		$this->load->library("ContentApiLib", array(
			"sql" => $this->customSQL
		));
		$this->load->library("ContentLib", array(
			"sql" => $this->customSQL
		));
		$this->load->library("CategoriesLib", array(
			"sql" => $this->customSQL
		));
		$this->load->library("ContentImagesLib", array(
			"sql" => $this->customSQL
		));
	}

	public function index()
	{
		try {
			$content = $this->contentapilib->getLastContentByCategory();

			return $this->request
				->res(200, $content, "Berhasil memuat data", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Get data content" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}

	public function getAutoContentCategory(){
		try {
			$content = [];
			$categories = $this->categorieslib->getAll();

			foreach ($categories as $category) {
				$contentRaw['id'] = $category['id'];
				$contentRaw['category'] = $category['category'];
				$contentRaw['content'] = $this->contentapilib->getListContentByCategory($category['id']);
				array_push($content, $contentRaw);
			}

			return $this->request
				->res(200, $content, "Berhasil memuat data", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Get data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}

	public function getContent(){
		$cat = $this->input->get('category', TRUE) ?: "";
		$search = $this->input->get('search', TRUE) ?: "";
		$page = $this->input->get('page', TRUE) ?: 1;

		try {
			$content = $this->contentapilib->getWithCondition($cat, $search, $page);

			return $this->request
				->res(200, $content, "Berhasil memuat data", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Get data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}

	public function getDetailContent($idContent){
		try {
			$this->contentlib->updateCounter($idContent);
			$res = [];
			$getContent = $this->contentapilib->getDetail($idContent);
			$suggestContent = $this->contentapilib->getRandomContentByCategory($getContent['id_m_categories']);

			while(count($suggestContent) == 0)
				$suggestContent = $this->contentapilib->getRandomContentByCategory($getContent['id_m_categories']);

			$res['content'] = $getContent;
			$res['content']['images'] = $this->contentimageslib->getContentPhoto($idContent);
			$res['suggest'] = $suggestContent;

			return $this->request
				->res(200, $res, "Berhasil memuat data", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Get data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}
}