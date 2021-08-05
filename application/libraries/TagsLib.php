<?php

class TagsLib
{
    protected $params;
    protected $table;

    public function __construct($params)
    {
        $this->params = $params;
        $this->table = "m_tags";
    }

    public function getAll()
    {
        return $this->params["sql"]->getAll("*", $this->table)->result_array();
    }

    public function getOne($id)
    {
        return $this->params["sql"]->get("tag", "id = $id", $this->table)->row_array();
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
}
