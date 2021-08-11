<?php

class ContentImagesLib
{
	protected $params;
	protected $table;

	public function __construct($params)
	{
		$this->params = $params;
		$this->table = "content_images";
	}

	public function getContentPhoto($idContent)
	{
		$dataPhoto = $this->params["sql"]->query("
			SELECT label, uri
			FROM $this->table
            WHERE id_content = $idContent
		")->result_array();

		return $dataPhoto;
	}

	public function getOne($id)
    {
        return $this->params["sql"]->get("label", "id = $id", $this->table)->row_array();
    }

	public function create($dataPhoto)
	{
		$idPhoto = $this->params["sql"]->create($dataPhoto, $this->table);
		return $idPhoto;
	}

	public function delete($idContentImage)
	{
		return $this->params["sql"]->delete(
			array("id" => $idContentImage),
			$this->table
		);
	}
}
