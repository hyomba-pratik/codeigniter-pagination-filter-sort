<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class World_model extends CI_Model {

	function get_city($limit, $start, $st = "", $orderField, $orderDirection)
    {
        
        $query = $this->db->or_like('Name', $st)->or_like('CountryCode', $st)->or_like('District', $st)->limit($limit, $start)->order_by($orderField, $orderDirection)->get('city');
        return $query->result();
        
    }

    function count_city($limit, $start, $st = "", $orderField, $orderDirection)
    {
        
        $query = $this->db->or_like('Name', $st)->or_like('CountryCode', $st)->or_like('District', $st)->order_by($orderField, $orderDirection)->get('city');
        return $query->num_rows();
    }

}