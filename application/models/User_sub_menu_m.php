<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_sub_menu_m extends CI_Model
{

    private $table_name  = 'user_sub_menu';
    private $primary_key = 'id';


    function get_all()
    {
        $this->db->select('user_sub_menu.*, user_menu.name as titleMenu');
        $this->db->from($this->table_name);
        $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id', 'left');
        $query = $this->db->get();
        return $query;
    }

    /* FOR SIDEBAR VIEW */
    function get_submenu_by_menu($id)
    {
        $query = $this->db->query("SELECT * FROM user_sub_menu WHERE user_sub_menu.menu_id = '{$id}' AND user_sub_menu.is_active = '1'  Order by id asc");
        return $query->result_array();
    }

    function count_all()
    {
        return $this->db->count_all($this->table_name);
    }

    function insert($data)
    {
        return $this->db->insert($this->table_name, $data);
    }

    function Edit_SubMenu($id, $dataedit)
    {
        $this->db->where($this->primary_key, $id);

        return $this->db->update($this->table_name, $dataedit);
    }

    function Delete_Submenu($id)
    {
        return $this->db->delete($this->table_name, array($this->primary_key => $id));
    }
}
