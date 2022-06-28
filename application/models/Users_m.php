<?php
class Users_m extends CI_Model
{

    private $primary_key = 'id';
    private $table_name  = 'users';


    /* FOR USER SESSION DATA */
    function get_session($email)
    {
        $this->db->select('users.username, users.name, users.email, users.password, users.img_user, users.id_role, users.id_client, users.regional_id, users.area_id, users.branch_id, users.is_active, user_roles.role, ms_client.client_name,users.change_password');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.id_role', 'left');
        $this->db->join('ms_client', 'ms_client.id = users.id_client', 'left');
        $this->db->where('users.username', $email);
        $this->db->or_where('users.email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_user_profile($username)
    {
        $this->db->select('*, user_roles.role');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id = users.id_role', 'left');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_all_users()
    {
        $query = $this->db->query("Select 
                                    u.id,
                                    u.name,
                                    u.email,
                                    ur.role,
                                    u.created_at,
                                    u.is_active,
                                    u.branch_id
                                    from users u  
                                    left join user_roles ur on u.id_role  = ur.id 
                                    where id_role not in ('1') Order by name asc");
        return $query->result_array();
    }

    function get_roles()
    {
        $query = $this->db->query("Select 
                                   *
                                    from user_roles ur
                                    where ur.id not in ('1','2') Order by id asc");
        return $query->result_array();
    }

    function get_user_id($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return
            $query->row_array();
    }

    function Delete_user($id)
    {
        $query = "delete from users where id ='$id' ";
        return $this->db->query($query);
    }

    function Edit_user($iduser, $datauseredit)
    {
        $this->db->where('id', $iduser);
        return $this->db->update('users', $datauseredit);
    }

    function get_data_user($id)
    {
        $query = $this->db->query("select * from users where id ='$id' ");
        return $query->result_array();
    }

    function get_data_profile($email)
    {
        $query = $this->db->query("Select 
        u.id,
        u.name,
        u.email,
        ur.role,
        u.created_at,
        u.is_active,
        u.img_user,
        u.branch_id,
        DATE(u.created_at) as created_at
        from users u  
        left join user_roles ur on u.id_role  = ur.id 
        where u.email='$email' ");
        return $query->row_array();
    }
}
