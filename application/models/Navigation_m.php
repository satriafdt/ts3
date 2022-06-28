<?php
class Navigation_m extends CI_Model
{



    function Get_data($id)
    {

        $query = "SELECT * FROM user_roles where id='$id'";

        return $this->db->query($query)->row_array();
    }

    function Edit_role($id, $dataedit)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_roles', $dataedit);
    }

    function Delete_role($id)
    {
        return $this->db->delete('user_roles', array('id' => $id));
    }
}
