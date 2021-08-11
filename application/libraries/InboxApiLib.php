<?php
class InboxApiLib
{
    protected $params;
    protected $table;

    public function __construct($params)
    {
        $this->params = $params;
        $this->table = "m_inbox";
    }

    public function create($dataInbox)
    {
        $idInbox = $this->params["sql"]->create($dataInbox, $this->table);
        return $idInbox;
    }
}
