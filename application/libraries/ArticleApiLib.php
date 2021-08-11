<?php
class ArticleApiLib
{
	protected $params;
	protected $table;

	public function __construct($params)
	{
		$this->params = $params;
		$this->table = "article";
	}

	public function getArticles($id, $tag)
	{
		if ($id !== null && $tag !== null) {
			$whereQuery = "
				WHERE `id_article` < '$id' AND
				`id_m_tags` = $tag
			";
		} elseif ($id !== null) {
			$whereQuery = "
				WHERE `id_article` < '$id'
			";
		} elseif ($tag !== null) {
			$whereQuery = "
				WHERE `id_m_tags` = $tag
			";
		} else {
			$whereQuery = "";
		}

		$query = "
			SELECT `article`.`id`, `article`.`title`, `article`.`description`, `article`.`thumbnail`, `article`.`link`
			FROM `$this->table`
			JOIN `article_tag` ON `article_tag`.`id_article` = `$this->table`.`id`
			$whereQuery
			GROUP BY `$this->table`.`id`
			ORDER BY `$this->table`.`id` DESC
			LIMIT 9
		";

		return $this->params["sql"]
			->query($query)
			->result_array();
	}

	public function getArticlesTags($articleId)
	{
		$query = "
			SELECT `m_tags`.`tag` 
			FROM `article_tag`
			JOIN `m_tags` ON `m_tags`.`id` = `article_tag`.`id_m_tags`
			WHERE `article_tag`.`id_article` = $articleId
		";

		$articles = $this->params["sql"]
			->query($query, $this->table)
			->result_array();

		return $articles;
	}


	public function getArticleCounter($id)
	{
		return $this->params["sql"]->get("counter", "id = $id", $this->table)->row_array();
	}

	public function updateCounter($idArticle, $dataCounterArticle)
	{
		return $this->params["sql"]->update(
			array("id" => $idArticle),
			$dataCounterArticle,
			$this->table
		);
	}
}
