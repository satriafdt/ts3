<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_ts3 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->model('Admin_Ts3_m');
        $this->load->model('Service_m');
        $this->dtSession = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    }


    public function Service_list()
    {

        $data['title'] = 'Service List';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();


        $data['dataservice'] = $this->Admin_Ts3_m->Get_allDataService()->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin_ts3/service_list', $data);
        $this->load->view('templates/footer');
    }

    public function Contact_Us()
    {

        $data['title'] = 'Contact Us';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['datacontact'] = $this->Admin_Ts3_m->Get_allDataContact()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin_ts3/contact_us', $data);
        $this->load->view('templates/footer');
    }


    public function Service_View_Detail()
    {

        $data['title'] = 'Service View';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin_ts3/service_view_detail', $data);
        $this->load->view('templates/footer');
    }

    public function Contact_Us_Reply()
    {

        $data['title'] = 'Contact Us Reply';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin_ts3/contact_us_reply', $data);
        $this->load->view('templates/footer');
    }

    public function Sparepart()
    {
        $data['title']       = 'Sparepart';
        $data['user']        = $this->dtSession;
        $data['dtSparepart'] = $this->Service_m->selectAllSparepart();
        $this->load->view('admin_ts3/sparepart', $data);
    }

    public function SparepartAdd()
    {
        $this->form_validation->set_rules('sparepart_name', 'Nama Sparepart', 'required|trim');
        $this->form_validation->set_rules('qty_type', 'Satuan', 'required|trim');
        $this->form_validation->set_rules('qty', 'Jumlah', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin_ts3/form_service_process');
        } else {
            $data['user'] = $this->dtSession;

            $data = [
                'sparepart_name' => $this->input->post('sparepart_name'),
                'bengkel_id'     => $data['user']['id'],
                'qty_type'       => $this->input->post('qty_type'),
                'qty'            => $this->input->post('qty'),
                'create_date'    => date('Y-m-d H:i:s')
            ];
            $this->Service_m->insertSparepart($data);

            $logData = [
                'username'   => $this->session->userdata('username'),
                'activities' => 'Tambah Data Sparepart',
                'url'        => base_url('Admin_ts3/SparepartAdd'),
                'object'     => $data['sparepart_name'],
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user_log_activity', $logData);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                Sparepart berhasil ditambahkan.
            </div>');
            redirect('Admin_ts3/Sparepart');
        }
    }

    public function SparepartEdit()
    {
        $id           = $this->input->post('id', TRUE);
        $data         = $this->Service_m->selectSparepartByID($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $dataPrice    = $this->Service_m->selectSpareparPricetByIDSparepart($id);

        $dtSparepart = array(
            'sparepart_name' => $this->input->post('sparepart_name'),
            'qty_type'       => $this->input->post('qty_type'),
            'qty'            => $this->input->post('qty'),
            'update_date'    => date('Y-m-d H:i:s'),
            'user_update'    => $data['user']['username']
        );
        $this->Service_m->editSparepart($id, $dtSparepart);

        if ($dataPrice['id_sparepart'] != null) {
            $dtPrice = array(
                'harga'       => $this->input->post('harga'),
                'update_date' => date('Y-m-d H:i:s'),
                'user_update' => $data['user']['username']
            );
            $this->Service_m->editSparepartPrice($id, $dtPrice);
        } else {
            $dtPrice = array(
                'id_sparepart' => $id,
                'harga'        => $this->input->post('harga'),
                'create_date'  => date('Y-m-d H:i:s'),
                'user_update'  => $data['user']['username']
            );
            $this->db->insert('ms_sparepart_price', $dtPrice);
        }

        $logData = [
            'username'   => $this->session->userdata('username'),
            'activities' => 'update data bengkel',
            'object'     => $data['nama_bengkel'],
            'url'        => base_url('Master_Config/Bengkel_Edit'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Success!</h5>
            Data berhasil diubah.
        </div>');
        redirect('Admin_ts3/Sparepart');
    }

    public function SPK_Download()
    {
        $data['title'] = 'SPK Download';
        $data['user']  = $this->dtSession;
        $data['dtSPK'] = $this->Admin_Ts3_m->get_all_SPK();
        $this->load->view('admin_ts3/SPK_Download', $data);
    }

    public function DownloadSPKReport()
    {
        $data = array(
            'title' => 'SPK_Report_',
            'report' => $this->Admin_Ts3_m->get_all_SPK()
        );
        $this->load->view('admin_ts3/SPK_Report', $data);
    }
}
