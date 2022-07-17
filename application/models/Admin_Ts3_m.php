<?php
class Admin_Ts3_m extends CI_Model
{


    function Get_allDataService()
    {

        $query = "SELECT 
        s.id,
        s.service_no,
        s.status,
        as2.no_polisi,
        as2.last_bengkel_service,
        s.request_date
        from service s
        left join assets_service as2  on s.asset_id = as2.id";

        return $this->db->query($query);
    }


    function Get_allDataContact()
    {

        $query = "select * from contact_us where reply is null";

        return $this->db->query($query);
    }

    function get_all_SPK()
    {
        $this->db->select('*');
        $this->db->from('spk');
        $this->db->order_by('uniqueid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
