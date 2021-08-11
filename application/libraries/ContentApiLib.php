<?php
class ContentApiLib
{
    protected $params;
    protected $table;

    public function __construct($params)
    {
        $this->params = $params;
        $this->table = "content";
    }

    public function getLastContentByCategory()
    {
        $query = "
            SELECT $this->table.*
            FROM $this->table
            WHERE $this->table.id IN (
                SELECT MAX(id)
                FROM $this->table
                GROUP BY id_m_categories
            )
            ORDER BY $this->table.id DESC
		";

        return $this->params["sql"]
            ->query($query)
            ->result_array();
    }

    public function getRandomContentByCategory($idCategories)
    {
        $query = "
            SELECT c1.*
            FROM $this->table c1,
            (SELECT MAX(id) * RAND() AS randid FROM $this->table) AS c2
            WHERE c1.id >= c2.randid AND c1.id_m_categories = $idCategories
            LIMIT 4
        ";

        return $this->params["sql"]
            ->query($query)
            ->result_array();
    }

    public function getDetail($idContent)
    {
        $query = "
			SELECT $this->table.*, m_categories.category
			FROM $this->table
			JOIN m_categories ON $this->table.id_m_categories = m_categories.id
			WHERE $this->table.id = $idContent
		";

        return $this->params["sql"]
            ->query($query)
            ->row_array();
    }

    public function getListContentByCategory($idCategories)
    {
        $query = "
            SELECT $this->table.*
            FROM $this->table
            WHERE $this->table.id_m_categories = $idCategories
            ORDER BY $this->table.id DESC
            LIMIT 5
        ";

        return $this->params["sql"]
            ->query($query)
            ->result_array();
    }

    public function getWithCondition($category, $search, $page)
    {
        $limit = 10;
        $limitStart = ($page - 1) * $limit;

        if ($category == "" && $search == "") {
            $query = "
                SELECT $this->table.*
                FROM $this->table
                ORDER BY $this->table.id DESC
                LIMIT $limitStart, $limit
            ";
        } else if ($category == "") {
            $query = "
                SELECT $this->table.*
                FROM $this->table
                WHERE $this->table.title LIKE '%$search%'
                ORDER BY $this->table.id DESC
                LIMIT $limitStart, $limit
            ";
        } else {
            $query = "
                SELECT $this->table.*
                FROM $this->table
                WHERE 
                    $this->table.id_m_categories = $category 
                    AND 
                    $this->table.title LIKE '%$search%'
                ORDER BY $this->table.id DESC
                LIMIT $limitStart, $limit
            ";
        }

        return $this->params["sql"]
            ->query($query)
            ->result_array();
    }
}
