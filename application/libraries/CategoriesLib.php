<?php

class CategoriesLib
{
    protected $params;
    protected $table;

    public function __construct($params)
    {
        $this->params = $params;
        $this->table = "m_categories";
    }

    public function getAll()
    {
        return $this->params["sql"]->getAll("*", $this->table)->result_array();
    }

    public function getOne($id)
    {
        return $this->params["sql"]->get("category", "id = $id", $this->table)->row_array();
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

    public function updateUsersPassword($idUsers, $passwordUsers)
    {
        return $this->params["sql"]->update(
            array("id" => $idUsers),
            $passwordUsers,
            $this->table
        );
    }

    public function deleteUsers($idUsers)
    {
        return $this->params["sql"]->delete(
            array("id" => $idUsers),
            $this->table
        );
    }
}
