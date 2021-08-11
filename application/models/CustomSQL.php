<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomSQL extends CI_Model {
    // Query
    function query($sql) {
        return $this->db->query($sql);
    }

    // Log
    function log($title) {
        $ipAddr = $_SERVER['REMOTE_ADDR'];
        $createdAt = date("Y-m-d H:i:s");
        $idMUsers = $_SESSION[HIMADIRA_ADMIN_AUTH]['id'];
        $this->query("
            INSERT INTO `m_logs` 
            VALUES(NULL, '$ipAddr', '$title', $idMUsers, '$createdAt')
        ");
    }

    // Get All
    function getAll($select, $table) {
        $this->db->select($select);
        return $this->db->get($table);
    }

    // Get
    function get($select, $where, $table) {
        $this->db->select($select);
        $this->db->where($where);
        return $this->db->get($table);
    }

    // Create
    function create($data, $table) {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) return $this->db->insert_id();
        return -1;
    }

    // Delete
    public function delete($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
        return ($this->db->affected_rows() > 0) ? 1 : -1;
    }

    // Update
    public function update($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
        return ($this->db->affected_rows() > 0) ? 1 : -1;
    }
}
