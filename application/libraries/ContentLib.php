<?php

class ContentLib
{
	protected $params;
	protected $table;

	public function __construct($params)
	{
		$this->params = $params;
		$this->table = "content";
	}

	public function getAll()
	{
		$dataContent = $this->params["sql"]->query("
			SELECT $this->table.*, m_categories.category
			FROM $this->table
			JOIN m_categories ON $this->table.id_m_categories = m_categories.id
		")->result_array();

		return $dataContent;
	}

	public function getOne($idContent)
	{
		$dataContent = $this->params["sql"]->query("
			SELECT $this->table.*, m_categories.category
			FROM $this->table
			JOIN m_categories ON $this->table.id_m_categories = m_categories.id
			WHERE $this->table.id = $idContent
		")->row_array();

		return $dataContent;
	}

	public function create($dataContent)
	{
		$idContent = $this->params["sql"]->create($dataContent, $this->table);
		return $idContent;
	}

	public function update($idContent, $dataContent)
	{
		return $this->params["sql"]->update(
			array("id" => $idContent),
			$dataContent,
			$this->table
		);
	}

	public function updateCounter($idContent){
		$this->params["sql"]->query(
			"UPDATE $this->table SET counter = counter + 1 WHERE id = $idContent"
		);
	}

	public function delete($idContent)
	{
		return $this->params["sql"]->delete(
			array("id" => $idContent),
			$this->table
		);
	}
}
