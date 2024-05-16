<?php

class Product_model extends CI_Model
{
    function insertProduct($data)
    {
        $this->db->insert('product', $data);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }
}
