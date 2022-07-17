<?php
class Pic_m extends CI_Model
{
    /* START Service List */
    function selectServiceOpenByClient()
    {
        $this->db->select('service.*, assets_service.*');
        $this->db->from('service');
        $this->db->join('assets_service', 'assets_service.id = service.asset_id', 'left');
        $this->db->where('service.status', 'Open');
        $this->db->where('assets_service.client_id',  $this->session->userdata('client_id'));
        $this->db->where('assets_service.branch_id',  $this->session->userdata('branch_id'));
        $this->db->order_by('request_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function selectServiceByID($id)
    {
        $query = "SELECT * FROM assets_service WHERE id='$id'";
        return $this->db->query($query)->row_array();
    }

    function updateServiceByID($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('service', $data);
    }

    /* END Service List */


    /* START Assets Service */
    function selectAllAssetsServiceByClient($clientID)
    {
        $this->db->select('assets_service.*, ms_branch_client.branch_name');
        $this->db->from('assets_service');
        $this->db->join('ms_branch_client', 'ms_branch_client.id = assets_service.branch_id', 'left');
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

    function createApprovalID()
    {
        $q  = $this->db->query("SELECT MAX(RIGHT(approval_id,5)) AS kd_max FROM service WHERE request_date = CURRENT_TIMESTAMP");
        $kd = "";

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd  = sprintf("%05s", $tmp);
            }
        } else {
            $kd = "00001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('ymd') . $kd;
    }
    /* END Assets Service */

    /* START Invoice */
    function selectAllInvoice()
    {
        $query = "SELECT * FROM invoice";
        return $this->db->query($query)->result_array();
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
        $query = "SELECT * FROM ms_branch_client";
        return $this->db->query($query)->result_array();
    }
}
