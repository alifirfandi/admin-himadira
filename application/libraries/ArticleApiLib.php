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
		$query = "
			SELECT `id`, `title`, `description`, `thumbnail`, `link`
			FROM `$this->table`
		";

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

		$query .= "
			WHERE `id` IN(
				SELECT `id_article`
				FROM `article_tag`
				$whereQuery
				ORDER BY `id_article` DESC
			)
			ORDER BY `id` DESC 
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
}
