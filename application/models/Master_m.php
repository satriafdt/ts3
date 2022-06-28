<?php
class Master_m extends CI_Model
{


    function get_client_id($id)
    {
        $query = $this->db->query("Select * from ms_client where id='$id'");
        return $query->row_array();
    }

    function Delete_client($id)
    {
        $query = "delete from ms_client where id ='$id' ";
        return $this->db->query($query);
    }

    function Edit_client($id, $dataedit)
    {
        $this->db->where('id', $id);
        return $this->db->update('ms_client', $dataedit);
    }


    function get_regional_all()
    {
        $query = "select 
        mr.id,
        mr.regional_name,
        mc.client_name,
        mr.client_id,
        mr.is_active,
        mr.create_date,
        mr.update_date,
        mr.user_update
        
        from ms_regional mr 
        left join ms_client mc  on mr.client_id  = mc.id 
        order by mc.client_name  asc";
        return $this->db->query($query);
    }

    function get_regional_id($id)
    {
        $query = $this->db->query("select 
        mr.id,
        mr.regional_name,
        mr.client_id,
        mc.client_name,
        mr.is_active,
        mr.create_date,
        mr.update_date,
        mr.user_update
        
        from ms_regional mr 
        left join ms_client mc  on mr.client_id  = mc.id  where mr.id='$id'");
        return $query->row_array();
    }


    function Edit_regional($id, $data_edit)
    {
        $this->db->where('id', $id);
        return $this->db->update('ms_regional', $data_edit);
    }

    function Delete_regional($id)
    {
        $query = "delete from ms_regional where id ='$id' ";
        return $this->db->query($query);
    }


    function get_area_all()
    {
        $query = "select 
        ma.id,
        ma.area_name,
        ma.client_id,
        ma.regional_id,
        ma.is_active,
        ma.create_date,
        ma.update_date,
        ma.user_update,
        mr.regional_name,
        mc.client_name              
        from ms_area ma 
        left join ms_regional mr on ma.regional_id  = mr.id 
        left join ms_client mc  on ma.client_id  = mc.id
        order by mc.client_name ,mr.regional_name asc";
        return $this->db->query($query);
    }

    function get_area_id($id)
    {
        $query = "select 
        ma.id,
        ma.area_name,
        ma.client_id,
        ma.regional_id,
        ma.is_active,
        ma.create_date,
        ma.update_date,
        ma.user_update,
        mr.regional_name,
        mc.client_name              
        from ms_area ma 
        left join ms_regional mr on ma.regional_id  = mr.id 
        left join ms_client mc  on ma.client_id  = mc.id
        where ma.id='$id'";
        return $this->db->query($query)->row_array();
    }



    function Delete_area($id)
    {
        $query = "delete from ms_area where id ='$id' ";
        return $this->db->query($query);
    }

    function Edit_area($id, $data_edit)
    {
        $this->db->where('id', $id);
        return $this->db->update('ms_area', $data_edit);
    }


    function get_branch_all()
    {
        $query = "select 
        mb.id,
        mb.client_id,
        mb.area_id,
        mb.branch_name,
        mb.is_active,
        mb.create_date,
        mb.update_date,
        mb.user_update,
        mc.client_name,
        ma.area_name      
        
        from ms_branch mb 
        left join ms_client mc  on mb.client_id  = mc.id 
        left join ms_area ma  on mb.area_id  = ma.id 
        order by mc.client_name , ma.area_name  asc";
        return $this->db->query($query);
    }

    function get_branch_id($id)
    {
        $query = "select 
        mb.id,
        mb.client_id,
        mb.area_id,
        mb.branch_name,
        mb.is_active,
        mb.create_date,
        mb.update_date,
        mb.user_update,
        mc.client_name,
        ma.area_name      
        
        from ms_branch mb 
        left join ms_client mc  on mb.client_id  = mc.id 
        left join ms_area ma  on mb.area_id  = ma.id 
        where mb.id='$id'";
        return $this->db->query($query)->row_array();
    }

    function Edit_branch($id, $data_edit)
    {
        $this->db->where('id', $id);
        return $this->db->update('ms_branch', $data_edit);
    }

    function Delete_branch($id)
    {
        $query = "delete from ms_branch where id ='$id' ";
        return $this->db->query($query);
    }

    function get_type_s_id($id)
    {
        $query = "select * from ms_type_service where id ='$id' ";
        return $this->db->query($query)->row_array();
    }

    function Delete_type_s($id)
    {
        $query = "delete from ms_type_service where id ='$id' ";
        return $this->db->query($query);
    }

    function Edit_Type_s($id, $data_edit)
    {
        $this->db->where('id', $id);
        return $this->db->update('ms_type_service', $data_edit);
    }
}
