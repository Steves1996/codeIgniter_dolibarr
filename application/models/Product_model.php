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

    function getProduct()
    {
        $product = array();
        $this->db->select('*');
        $this->db->from('product');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $product = $query->result();
        }
        return $product;
    }

    function getOneProduct($id)
    {
        $this->db->where('id', $id);
        $query =  $this->db->get('product');
        return $query->row();
    }

    function updateProduct($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('product', $data);
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }

    function deleteProduct($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('product');
        if ($this->db->affected_rows() >= 0) {
            return true;
        } else {
            return false;
        }
    }
}
