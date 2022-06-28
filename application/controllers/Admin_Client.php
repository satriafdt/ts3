<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Client extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Admin_Client_m');
        $this->dtSession = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function Assets_Service()
    {
        $data['title']      = 'Assets Service';
        $data['user']       = $this->dtSession;
        $data['dtRegional'] = $this->Admin_Client_m->selectAllRegional();
        $data['dtArea']     = $this->Admin_Client_m->selectAllArea();
        $data['dtBranch']   = $this->Admin_Client_m->selectAllBranch();
        $data['dtAssets']   = $this->Admin_Client_m->selectAllAssetsServiceByClient($data['user']['id_client']);

        /* START ADD DATA PROCESS */
        $this->form_validation->set_rules('regional_id', 'Regional', 'required|trim');
        $this->form_validation->set_rules('area_id', 'Area', 'required|trim');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required|trim');
        $this->form_validation->set_rules('no_polisi', 'No Polisi', 'required|trim|is_unique[assets_service.no_polisi]', ['is_unique' => 'No Polisi has already added.']);
        $this->form_validation->set_rules('no_rangka', 'No Rangka', 'required|trim');
        $this->form_validation->set_rules('no_mesin', 'No Mesin', 'required|trim');
        $this->form_validation->set_rules('tahun_kendaraan', 'Tahun Kendaraan', 'required|trim');
        $this->form_validation->set_rules('tipe_kendaraan', 'Tipe Kendaraan', 'required|trim');
        $this->form_validation->set_rules('merk_kendaraan', 'Merk Kendaraan', 'required|trim');
        $this->form_validation->set_rules('last_service_date', 'Tanggal Service Terakhir', 'required|trim');
        // $this->form_validation->set_rules('last_bengkel_service', 'Bengkel Service', 'required|trim');
        $this->form_validation->set_rules('last_km', 'Km Terakhir', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin_client/assets_service', $data);
        } else {
            $data = [
                'client_id'            => $data['user']['id_client'],
                'regional_id'          => $this->input->post('regional_id'),
                'area_id'              => $this->input->post('area_id'),
                'branch_id'            => $this->input->post('branch_id'),
                'no_polisi'            => $this->input->post('no_polisi'),
                'no_rangka'            => $this->input->post('no_rangka'),
                'no_mesin'             => $this->input->post('no_mesin'),
                'tahun_kendaraan'      => $this->input->post('tahun_kendaraan'),
                'tipe_kendaraan'       => $this->input->post('tipe_kendaraan'),
                'merk_kendaraan'       => $this->input->post('merk_kendaraan'),
                'last_service_date'    => date('Y-m-d H:i:s', strtotime($this->input->post('last_service_date'))),
                // 'last_bengkel_service' => $this->input->post('last_bengkel_service'),
                'last_km'              => $this->input->post('last_km'),
                'date_post'            => date('Y-m-d H:i:s')
            ];
            $this->Admin_Client_m->insertAssetsService($data);

            $logData = [
                'username'   => $this->session->userdata('username'),
                'activities' => 'Add new Assets Service',
                'url'        => base_url('Admin_Client/Assets_Service'),
                'object'     => $data['title'],
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user_log_activity', $logData);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Data has been added.
            </div>');
            redirect('Admin_Client/Assets_Service');
        }
        /* END ADD DATA PROCESS */
    }

    public function AdminReqToServiceAssets($id = NULL)
    {
        $data['user']          = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['AService'] = $this->db->get_where('assets_service', ['id' => $id])->row_array();


        // Process Req Service Secara Manual (Seharusnya jika waktu service terakhir sudah 2 bulan dari waktu sekarang, maka secara otomatis akan berjalan)
        $dtAssetService    = $this->Admin_Client_m->selectAssetsServiceByID($id);
        $dtUser            = $this->dtSession;

        // 1. Update Data (date_update, user_update) dari Table assets_service
        $dtUpdAssetService = array(
            'date_update' => date('Y-m-d H:i:s'),
            'user_update' => $dtUser['id']
        );
        $this->Admin_Client_m->updateAssetsService($id, $dtUpdAssetService);

        // 2. Insert Data dari Tabel assets_service ke Tabel service
        $dtService         = array(
            'asset_id'      => $id,
            'pic_id'        => $this->Admin_Client_m->getPICID($data['AService']['client_id'], $data['AService']['regional_id'], $data['AService']['area_id'], $data['AService']['branch_id']),
            'bengkel_id'    => $this->Admin_Client_m->getBengkelID($data['AService']['client_id'], $data['AService']['regional_id'], $data['AService']['area_id'], $data['AService']['branch_id']),
            'status'        => 'Open',
            'schedule_date' => date('Y-m-d H:i:s'),
            'service_no'    => $this->Admin_Client_m->createServiceNo(),
            'km_kendaraan'  => $dtAssetService['last_km']
        );
        $this->Admin_Client_m->interfaceToService($dtService);

        $logData = [
            'username'   => $this->session->userdata('username'),
            'activities' => 'Request Service',
            'url'        => base_url('Admin_Client/AdminReqToServiceAssets'),
            'object'     => $id,
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            Data berhasil diproses.
        </div>');
        redirect('Admin_Client/Assets_Service');
    }

    public function Invoice()
    {
        $data['title']      = 'Invoice';
        $data['user']       = $this->dtSession;
        $data['dtInvoices'] = $this->Admin_Client_m->selectInvoiceTS3ToClient(); // Ambil data dari table invoice dengan type_id (TS3 to Client)
        $this->load->view('admin_client/invoice', $data);
    }
}
