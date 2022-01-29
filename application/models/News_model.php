<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function getNews(){
        $query = $this->db->get('news');
        return $query->result();
    }

    public function setNews($data){
        $this->db->insert('news', $data);
    }
    
    public function updateNews($data){
        $this->db->where('id', $data['id']);
        $this->db->update('news', $data);
    }

    public function deleteNews($id){
        $this->db->where('id', $id);
        $this->db->delete('news');
    }

    public function getAllNews($offset, $limit){
        $this->db->limit($offset, $limit);
        $query = $this->db->get('news');
        return $query->result();
    }
    public function getAllNewsCount(){
        $query = $this->db->get('news');
        return $query->num_rows();
    }

    public function searchNews($search){
        $this->db->like('title', $search);
        $this->db->or_like('text', $search);
        $query = $this->db->get('news');
        return $query->result();
    }
}