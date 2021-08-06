<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends CI_Controller {

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
		$this->load->library("ArticleApiLib", array(
			"sql" => $this->customSQL
		));
		$this->load->library("TagsLib", array(
			"sql" => $this->customSQL
		));
	}

	public function index()
	{
		try {
			$id = $this->input->get('id', TRUE);
			$tag = $this->input->get('tag', TRUE);

			$articles = $this->articleapilib->getArticles($id, $tag);
			
			foreach ($articles as $index => $article) {
				$articleTags = $this->articleapilib->getArticlesTags($article["id"]);
				foreach ($articleTags as $data) {
					$articles[$index]["tags"][] = $data["tag"];
				}
			}

			return $this->request
				->res(200, $articles, "Berhasil memuat data", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Get data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}

	public function getArticlesTags()
	{
		try {
			$dataTags = $this->tagslib->getAll();

			return $this->request
				->res(200, $dataTags, "Berhasil memuat data", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Get data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}
}

/* End of file Article.php */
