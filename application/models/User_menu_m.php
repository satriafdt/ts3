<?php
class User_menu_m extends CI_Model
{

    private $table_name  = 'user_menu';
    private $primary_key = 'id';


    function get_all()
    {
        $query = $this->db->query("SELECT * from user_menu um
        where um.title <> 'Navigation' order by um.seq_no ASC");
        return $query->result_array();
    }

    function get_menu_withoutdash()
    {
        $query = $this->db->query("SELECT * from user_menu um
        where um.title <> 'Dashboard' order by um.seq_no ASC");
        return $query;
    }

    function get_menu_withoutdash_role()
    {
        $query = $this->db->query("SELECT * from user_menu um
        where um.title <> 'Dashboard' and um.title <> 'Navigation' order by um.seq_no ASC");
        return $query;
    }


    function get_menu_by_role($id_role)
    {
        $query = $this->db->query("SELECT um.id,um.name,um.title,um.url,uam.role_id,um.icon,um.is_active from user_menu um
        left join user_access_menu uam on um.id = uam.menu_id   
        where uam.role_id='{$id_role}'  and title not in ('Dashboard','User')  order by  um.seq_no asc");
        return $query->result_array();
    }

    function Get_data($id)
    {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table_name);
        return $query->row_array();
    }

    function Delete_menu($id)
    {
        return $this->db->delete($this->table_name, array($this->primary_key => $id));
    }

    function Edit_menu($id, $data)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table_name, $data);
    }
}
