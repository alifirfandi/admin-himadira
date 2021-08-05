<?php

class ArticleTagLib
{
	protected $params;
	protected $table;

	public function __construct($params)
	{
		$this->params = $params;
		$this->table = "article_tag";
	}

	public function getOne($idArticle)
	{
		return $this->params["sql"]->get("id", "id_article = $idArticle", $this->table)->row_array();
	}

	public function create($dataCategory)
	{
		$idCategory = $this->params["sql"]->create($dataCategory, $this->table);
		return $idCategory;
	}
	
	public function delete($idArticle)
	{
		return $this->params["sql"]->delete(
			array("id_article" => $idArticle),
			$this->table
		);
	}
}
