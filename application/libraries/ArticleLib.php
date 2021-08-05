<?php
class ArticleLib
{
	protected $params;
	protected $table;

	public function __construct($params)
	{
		$this->params = $params;
		$this->table = "article";
	}

	public function getArticles()
	{
		$query = "
			SELECT `article`.`id`, `article`.`title`, `article`.`description`, `article`.`thumbnail`, `article`.`link`, `article`.`counter`
			FROM `article`
			ORDER BY `article`.`created_at` DESC
		";

		$articles = $this->params["sql"]
			->query($query, $this->table)
			->result_array();

		return $articles;
	}

	public function getArticlesTags($articleId)
	{
		$query = "
			SELECT `m_tags`.`tag` 
			FROM `article_tag`
			JOIN `m_tags` ON `m_tags`.`id` = `article_tag`.`id_m_tags`
			WHERE `article_tag`.`id_article` = '$articleId'
		";

		$articles = $this->params["sql"]
			->query($query, $this->table)
			->result_array();

		return $articles;
	}

	public function getOne($id)
	{
		return $this->params["sql"]->get("thumbnail", "id = $id", $this->table)->row_array();
	}

	public function create($dataCategory)
	{
		$idCategory = $this->params["sql"]->create($dataCategory, $this->table);
		return $idCategory;
	}

	public function update($idCategory, $dataCategory)
	{
		return $this->params["sql"]->update(
			array("id" => $idCategory),
			$dataCategory,
			$this->table
		);
	}

	public function delete($idArticle)
	{
		return $this->params["sql"]->delete(
			array("id" => $idArticle),
			$this->table
		);
	}
}
