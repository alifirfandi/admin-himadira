<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Article extends CI_Controller {

	// Public Variable
    public $custom_curl;
	private $articleUploadDir = "assets/img/upload/article/";

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
			$this->articleUploadDir
		);

        // Init Request
        $this->request->init($this->custom_curl);

        // Load Library
        $this->load->library("ArticleLib", array(
            "sql" => $this->customSQL
        ));
        $this->load->library("ArticleTagLib", array(
            "sql" => $this->customSQL
        ));
        $this->load->library("TagsLib", array(
            "sql" => $this->customSQL
        ));

        // Check Session
        $this->session->check_login_session($this->request);
    }

	public function index()
	{
		try {
            $dataArticle = $this->articlelib->getArticles();

            foreach ($dataArticle as $index => $article) {
            	$tags = $this->articlelib->getArticlesTags($article["id"]);
            	foreach ($tags as $tag) {
            		$dataArticle[$index]["tags"][] = $tag["tag"];
            	}
            }

            return $this->request
                ->res(200, $dataArticle, "Berhasil memuat data", null);
        } catch (Exception $e) {
            // Create Log
            $this->customSQL->log("Get data article" . $e->getMessage());

            return $this->request
                ->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
        }
	}

	public function create()
	{
		try {
			$data = $this->input->post(null, TRUE);

			$thumbnailLink = base_url() . $this->articleUploadDir . "placeholder.png";

			if (isset($_FILES["thumbnail"])) {
				$thumbnail = $this->fileUpload->do_upload("thumbnail");
				$thumbnailLink = base_url() . $this->articleUploadDir . $thumbnail["file_name"];
			} 

			$articles = [
				"title" => $data["title"],
				"description" => $data["description"],
				"thumbnail" => $thumbnailLink,
				"link" => $data["link"],
				"created_at" => date("Y-m-d H:i:s"),
				"updated_at" => date("Y-m-d H:i:s"),
			];

			$data['tags'] = explode(',', $data['tags']);
	
			$idArticle = $this->articlelib->create($articles);
			$this->request->checkStatusFail($idArticle);

			foreach ($data['tags'] as $tag) {
				$idArticleTags = $this->articletaglib->create([
					'id_article' => $idArticle,
					'id_m_tags' => $tag
				]);
				$this->request->checkStatusFail($idArticleTags);
			}

			return $this->request
				->res(201, null, "Berhasil membuat data article", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Create data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}
	
	public function delete($idArticle)
	{
		try {
			$dataArticle = $this->articlelib->getOne($idArticle);
			$this->request->checkStatusFound($dataArticle, "Article");

			$isDeleted = $this->articlelib->delete($idArticle);
			$this->request->checkStatusFail($isDeleted);

			$articleThumbnail = $dataArticle['thumbnail'];
			$articleThumbnail = explode(base_url().$this->articleUploadDir, $articleThumbnail);

			if ($articleThumbnail !== "placeholder.png") {
				if (file_exists($this->articleUploadDir.$articleThumbnail[1])) {
					unlink($this->articleUploadDir . $articleThumbnail[1]);
				}
			}

			$dataTagsArticle = $this->articletaglib->getOne($idArticle);
			$this->request->checkStatusFound($dataTagsArticle, "Tag article");

			$isDeleted = $this->articletaglib->delete($idArticle);
			$this->request->checkStatusFail($isDeleted);

			return $this->request
				->res(200, null, "Berhasil menghapus article", null);
		} catch (Exception $e) {
			// Create Log
			$this->customSQL->log("Delete data article" . $e->getMessage());

			return $this->request
				->res(500, null, "Terjadi kesalahan pada sisi server : " . $e->getMessage(), null);
		}
	}

}

/* End of file Article.php */
/* Location: ./application/controllers/Article.php */
