<?php
class Admin_Client_m extends CI_Model
{
    /* START Assets Service */
    function selectAllAssetsServiceByClient($clientID)
    {
        $this->db->select('assets_service.*, ms_branch.branch_name');
        $this->db->from('assets_service');
        $this->db->join('ms_branch', 'ms_branch.id = assets_service.branch_id', 'left');
        $this->db->where('assets_service.client_id', $clientID);
        $this->db->where('assets_service.client_id', $clientID);
        $this->db->order_by('date_post', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function selectAssetsServiceByID($id)
    {
        $query = "SELECT * FROM assets_service WHERE id='$id'";
        return $this->db->query($query)->row_array();
    }

    function insertAssetsService($data)
    {
        return $this->db->insert('assets_service', $data);
    }

    function updateAssetsService($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('assets_service', $data);
    }

    function deleteAssetsService($id)
    {
        return $this->db->delete('assets_service', array('id' => $id));
    }

    function interfaceToService($data)
    {
        return $this->db->insert('service', $data);
    }

    function createServiceNo()
    {
        $q  = $this->db->query("SELECT MAX(RIGHT(service_no, 4)) AS kd_max FROM service WHERE DATE(request_Date) = DATE(CURRENT_DATE)");
        $kd = "";

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd  = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        // return date('ymd') . $kd;
        return "SRVNO-" . date('ymd') . $kd;

        // $q = $this->db->query("select MAX(RIGHT(contract_no,4)) as contract_no  from contract
        // where convert(date,date_post,103) = convert(date,getdate(),103) ");
        // $kd = "";
        // if ($q->num_rows() > 0) {
        //     foreach ($q->result() as $k) {
        //         $tmp = ((int)$k->contract_no) + 1;
        //         $kd = sprintf("%04s", $tmp);
        //     }
        // } else {
        //     $kd = "0001";
        // }
        // date_default_timezone_set('Asia/Jakarta');
        // $date = date("ymd");
    }

    function getPICID($idClient, $idRegional, $idArea, $idBranch)
    {
        $query = "SELECT id FROM users WHERE id_role = 5 AND id_client = '$idClient' AND regional_id = '$idRegional' AND area_id = '$idArea' AND branch_id = '$idBranch'";
        return $this->db->query($query)->row()->id;
    }

    function getBengkelID($idClient, $idRegional, $idArea, $idBranch)
    {
        $query = "SELECT id FROM users WHERE id_role = 6 AND id_client = '$idClient' AND regional_id = '$idRegional' AND area_id = '$idArea' AND branch_id = '$idBranch'";
        return $this->db->query($query)->row()->id;
    }
    /* END Assets Service */

    /* START Invoice */
    function selectAllInvoice()
    {
        $query = "SELECT * FROM invoice";
        return $this->db->query($query)->result_array();
    }

    function selectInvoiceTS3ToClient()
    {
        $this->db->select('invoice.*, ms_type_invoice.type_invoice_name');
        $this->db->from('invoice');
        $this->db->join('ms_type_invoice', 'ms_type_invoice.id = invoice.ms_ti_id', 'left');
        $this->db->where('invoice.ms_ti_id', 2);
        $this->db->order_by('invoice.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function selectInvoiceByID($id)
    {
        $query = "SELECT * FROM invoice WHERE id='$id'";
        return $this->db->query($query)->row_array();
    }

    function insertInvoice($data)
    {
        return $this->db->insert('invoice', $data);
    }

    function updateInvoice($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('invoice', $data);
    }

    function deleteInvoice($id)
    {
        return $this->db->delete('invoice', array('id' => $id));
    }
    /* END Invoice */

    /* ----------- */

    function selectAllRegional()
    {
        $query = "SELECT * FROM ms_regional";
        return $this->db->query($query)->result_array();
    }

    function selectAllArea()
    {
        $query = "SELECT * FROM ms_area";
        return $this->db->query($query)->result_array();
    }

    function selectAllBranch()
    {
        $query = "SELECT * FROM ms_branch";
        return $this->db->query($query)->result_array();
    }
}
