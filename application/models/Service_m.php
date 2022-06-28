<?php
class Service_m extends CI_Model
{
    /* START Service List */
    function selectServiceOpenByClient()
    {
        $this->db->select('service.*, assets_service.no_polisi, assets_service.merk_kendaraan, assets_service.last_service_date');
        $this->db->from('service');
        $this->db->join('assets_service', 'assets_service.id = service.asset_id', 'left');
        $this->db->where('service.status', 'Open');
        $this->db->where('assets_service.client_id',  $this->session->userdata('client_id'));
        $this->db->where('assets_service.branch_id',  $this->session->userdata('branch_id'));
        $this->db->order_by('request_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    /* END Service List */

    /* START Service Request */
    function selectServiceRequestByClient()
    {
        $this->db->select('service.*, assets_service.no_polisi, assets_service.merk_kendaraan, assets_service.last_service_date');
        $this->db->from('service');
        $this->db->join('assets_service', 'assets_service.id = service.asset_id', 'left');
        $this->db->where('service.status', 'Request');
        $this->db->where('assets_service.client_id',  $this->session->userdata('client_id'));
        $this->db->where('assets_service.branch_id',  $this->session->userdata('branch_id'));
        $this->db->order_by('request_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    /* END Service Request */

    /* START Service Process */
    function selectServicePickUpByClient()
    {
        $this->db->select('service.*, assets_service.no_polisi, assets_service.merk_kendaraan, assets_service.last_service_date');
        $this->db->from('service');
        $this->db->join('assets_service', 'assets_service.id = service.asset_id', 'left');
        $this->db->where('service.status', 'Pick Up');
        $this->db->where('assets_service.client_id',  $this->session->userdata('client_id'));
        $this->db->where('assets_service.branch_id',  $this->session->userdata('branch_id'));
        $this->db->order_by('request_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    /* END Service Process */

    /* START Invoice Process */
    function selectServiceDoneByClient()
    {
        $this->db->select('service.*, assets_service.no_polisi, assets_service.merk_kendaraan, assets_service.last_service_date');
        $this->db->from('service');
        $this->db->join('assets_service', 'assets_service.id = service.asset_id', 'left');
        $this->db->where('service.status', 'Done');
        $this->db->where('service.invoice_id', null);
        $this->db->where('assets_service.client_id',  $this->session->userdata('client_id'));
        $this->db->where('assets_service.branch_id',  $this->session->userdata('branch_id'));
        $this->db->order_by('request_date', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    /* END Invoice Process */

    /* START Service Process */
    function selectApprovalByClient($id)
    {
        $this->db->select('*');
        $this->db->from('approval');
        $this->db->where('approval_status', 'Request');
        $this->db->where('pic_id', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    /* END Service Process */

    function selectApprovalIDByServiceID($id)
    {
        $this->db->select('id');
        $this->db->from('approval');
        $this->db->where('service_id', $id);
        $query = $this->db->get();
        return $query->row()->id;
    }

    function selectAmmountByServiceID($id)
    {
        $this->db->select('amount');
        $this->db->from('approval');
        $this->db->where('service_id', $id);
        $query = $this->db->get();
        return $query->row()->amount;
    }


    function selectServiceJoinAssetsByID($id)
    {
        $this->db->select('service.*, assets_service.no_polisi, assets_service.no_rangka, assets_service.no_mesin, assets_service.tahun_kendaraan, assets_service.tipe_kendaraan, assets_service.merk_kendaraan');
        $this->db->from('service');
        $this->db->join('assets_service', 'assets_service.id = service.asset_id', 'left');
        $this->db->where('service.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function selectServiceByID($id)
    {
        $query = "SELECT * FROM assets_service WHERE id='$id'";
        return $this->db->query($query)->row_array();
    }

    function updateServiceByID($id, $dtUpdService)
    {
        $this->db->where('id', $id);
        return $this->db->update('service', $dtUpdService);
    }

    function selectAllMSTService()
    {
        $this->db->select('*');
        $this->db->from('ms_type_service');
        $this->db->order_by('type_name', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function selectServiceDetail($id)
    {
        $this->db->select('service_detail.*, ms_type_service.type_name');
        $this->db->from('service_detail');
        $this->db->join('ms_type_service', 'ms_type_service.id = service_detail.ms_ts_id', 'left');
        $this->db->where('service_id', $id);
        $this->db->order_by('service_detail.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function insertServiceDetail($data)
    {
        return $this->db->insert('service_detail', $data);
    }

    function deleteServiceDetail($id)
    {
        return $this->db->delete('service_detail', array('id' => $id));
    }

    function countServiceDetail($id)
    {
        // $query = "SELECT COUNT(id) AS qtyDetail FROM service_detail WHERE service_id = '$id' ";
        // return $this->db->query($query)->row()->qtyDetail;

        $this->db->select('id');
        $this->db->from('service_detail');
        $this->db->where('service_id', $id);
        return $this->db->count_all_results();
    }

    function createApprovalNo()
    {
        $q  = $this->db->query("SELECT MAX(RIGHT(approval_no, 4)) AS kd_max FROM approval WHERE DATE(approval_Date) = DATE(CURRENT_DATE)");
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
        return "APVNO-" . date('ymd') . $kd;
    }

    function getQtyAmmount($id)
    {
        $query = "SELECT SUM(amount) AS qtyAmount FROM service_detail WHERE service_id = $id";
        return $this->db->query($query)->row_array();
    }

    function updateApprovalByServiceID($id, $dtApproval)
    {
        $this->db->where('service_id', $id);
        return $this->db->update('approval', $dtApproval);
    }

    function selectTypeInvoice()
    {
        $this->db->select('*');
        $this->db->from('ms_type_invoice');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function createInvoicelNo()
    {
        $q  = $this->db->query("SELECT MAX(RIGHT(invoice_no, 4)) AS kd_max FROM invoice WHERE DATE(invoice_Date) = DATE(CURRENT_DATE)");
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
        return "INVNO-" . date('ymd') . $kd;
    }

    function insertInvoice($data)
    {
        return $this->db->insert('invoice', $data);
    }

    function selectInvoiceIDByServiceID($id)
    {
        $this->db->select('id');
        $this->db->from('invoice');
        $this->db->where('service_id', $id);
        $query = $this->db->get();
        return $query->row()->id;
    }

    function selectAllSparepart()
    {
        $this->db->select('*');
        $this->db->from('ms_sparepart');
        $query = $this->db->get();
        return $query->result_array();
    }

    function selectSparepartByID($id)
    {
        $this->db->select('*');
        $this->db->from('ms_sparepart');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function insertSparepart($data)
    {
        return $this->db->insert('ms_sparepart', $data);
    }
}
