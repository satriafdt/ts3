<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bengkel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();

        $this->load->model('Service_m');
        $this->dtSession = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function Index()
    {
        $this->Service_Request();
    }

    public function Service_Request()
    {
        // Ambil data dari table service dengan status "Request" dan sesuai dengan client_id, regional_id, area_id, branch_id user yang login
        // pada action, ada tombol pickup untuk update status jadi "Pickup", Lalu masuk ke dashboard Service Process punya user Bengkel

        $data['title']     = 'Service Request';
        $data['user']      = $this->dtSession;
        $data['dtService'] = $this->Service_m->selectServiceRequestByClient();
        $this->load->view('bengkel/service_request', $data);
    }

    public function BengkelPickService($id = NULL)
    {
        $dtUpdService = array(
            'status'      => 'Pick Up',
            'pickup_date' => date('Y-m-d H:i:s')
        );
        $this->Service_m->updateServiceByID($id, $dtUpdService);

        $logData = [
            'username'   => $this->session->userdata('username'),
            'activities' => 'Request Service',
            'url'        => base_url('Bengkel/BengkelPickService'),
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
        redirect('Bengkel/Service_Request');
    }

    public function Service_Process()
    {
        // Ambil data dari table service dengan status "Pick Up" dan sesuai dengan client_id, regional_id, area_id, branch_id user yang login
        // pada action, ada tombol Process untuk update status jadi "Approval", Keluar Tampilan Form
        // Form untuk insert data pada detail_service dan update data pada service(request_date, finish_date, pick_date, km_kendaraan)
        // Lalu generate approval_id otomatis update di table service

        $data['title']     = 'Service Process';
        $data['user']      = $this->dtSession;
        $data['dtService'] = $this->Service_m->selectServicePickUpByClient();
        $this->load->view('bengkel/service_process', $data);
    }

    public function FormServiceProcess($id = NULL)
    {
        $data['title']           = 'Service Process';
        $data['user']            = $this->dtSession;
        $data['dtMSTS']          = $this->Service_m->selectAllMSTService();
        $data['dtServiceDetail'] = $this->Service_m->selectServiceDetail($id);
        $data['dtService']       = $this->Service_m->selectServiceJoinAssetsByID($id);
        $this->load->view('bengkel/form_service_process', $data);
    }

    public function AddServiceDetail($id = NULL)
    {
        $this->form_validation->set_rules('service_status', 'Status', 'required|trim');
        $this->form_validation->set_rules('ms_ts_id', 'Jenis Servis', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('amount', 'Biaya', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('bengkel/form_service_process');
        } else {
            $data = [
                'service_id'     => $id,
                'service_status' => $this->input->post('service_status'),
                'ms_ts_id'       => $this->input->post('ms_ts_id'),
                'description'    => $this->input->post('description'),
                'amount'         => $this->input->post('amount')
            ];
            $this->Service_m->insertServiceDetail($data);

            $logData = [
                'username'   => $this->session->userdata('username'),
                'activities' => 'Add new Assets Service',
                'url'        => base_url('Bengkel/AddServiceDetail'),
                'object'     => $data['service_id'],
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user_log_activity', $logData);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Data berhasil ditambahkan.
            </div>');
            redirect('Bengkel/FormServiceProcess/' . $id);
        }
    }

    public function DeleteServiceDetail($id = NULL, $idService)
    {
        $logData = [
            'username'   => $this->session->userdata('username'),
            'activities' => 'PIC Bengkel Delete Service Detail',
            'url'        => base_url('Bengkel/DeleteServiceDetail'),
            'object'     => $idService,
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->Service_m->deleteServiceDetail($id);
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Berhasil!</h5>
                Data Detail berhasil dihapus.
            </div>
        ');
        redirect('Bengkel/FormServiceProcess/' . $idService);
    }

    public function BengkelApprovalService($id = NULL)
    {
        $qtyDetail = $this->Service_m->countServiceDetail($id);

        if ($qtyDetail <= 0) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Gagal!</h5>
                Tambahkan Jenis Service Dahulu.
            </div>');
            redirect('Bengkel/FormServiceProcess/' . $id);
        } else {
            $this->form_validation->set_rules('nama_mekanik', 'Mekanik', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('bengkel/form_service_process');
            } else {
                // Insert Approval Tabel
                $dataApproval = [
                    'approval_no' => $this->Service_m->createApprovalNo(),
                    'service_id' => $id,
                    'asset_id' => $this->input->post('asset_id'),
                    'pic_id' => $this->input->post('pic_id'),
                    'bengkel_id' => $this->input->post('bengkel_id'),
                    'approval_status' => 'Request',
                    'approval_date' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('approval', $dataApproval);

                $data = [
                    'nama_mekanik' => $this->input->post('nama_mekanik'),
                    'km_kendaraan' => $this->input->post('km_kendaraan'),
                    'status'       => 'Approval'
                ];

                $this->Service_m->updateServiceByID($id, $data);

                $logData = [
                    'username'   => $this->session->userdata('username'),
                    'activities' => 'PIC Bengkel Input Form Service',
                    'url'        => base_url('Bengkel/BengkelDoneService'),
                    'object'     => $id,
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('user_log_activity', $logData);

                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                    Data berhasil diproses.
                </div>');
                redirect('Bengkel/Service_Process');
            }
        }
    }

    public function Invoice_Process()
    {
        // Ambil data dari table service dengan status "Done" dan invoice_id="null", sesuai dengan client_id, regional_id, area_id, branch_id user yang login
        // pada action, ada tombol Create Invoice untuk tampil data detail_service dan form input data ke table invoice (berserta upload gambar)

        $data['title']     = 'Invoice Process';
        $data['user']      = $this->dtSession;
        $data['dtService'] = $this->Service_m->selectServiceDoneByClient();
        $this->load->view('bengkel/invoice_process', $data);
    }

    public function FormInvoiceProcess($id = NULL)
    {
        $data['title']           = 'Invoice Process';
        $data['user']            = $this->dtSession;
        $data['dtTypeInv']       = $this->Service_m->selectTypeInvoice();
        $data['dtAmmount']       = $this->Service_m->selectAmmountByServiceID($id);
        $data['dtApprvID']       = $this->Service_m->selectApprovalIDByServiceID($id);
        $data['dtServiceDetail'] = $this->Service_m->selectServiceDetail($id);
        $data['dtService']       = $this->Service_m->selectServiceJoinAssetsByID($id);
        $this->load->view('bengkel/form_invoice_process', $data);
    }

    public function BengkelRequestInvoice($id = NULL)
    {
        if (empty($_FILES['img_invoice']['name'])) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Gagal!</h5>
                    Tidak ada file.
                </div>
            ');
            redirect('Bengkel/FormInvoiceProcess');
        } else {

            $invoiceNo    = $this->Service_m->createInvoicelNo();
            $data['user'] = $this->dtSession;

            if ($_FILES['img_invoice']['size'] >= 524288) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i>Gagal!</h5>
                    Ukuran file melebihi 512kb
                </div>');
                redirect('Bengkel/FormInvoiceProcess');
            } else {
                $this->load->library('upload');
                mkdir("./assets/img/invoice/" . $invoiceNo);
                $default_name                = $invoiceNo . ".jpg";
                $config_img['upload_path']   = './assets/img/invoice/' . $invoiceNo . '/';
                $config_img['allowed_types'] = 'jpg|jpeg';
                $config_img['file_name']     = $default_name;
                $config_img['overwrite']     = TRUE;
                $config_img['max_size']      = 512; /* max 512kb */
                $this->upload->initialize($config_img);
                if (($_FILES['img_invoice']['name'])) {
                    if ($this->upload->do_upload('img_invoice')) {
                        $this->upload->data();
                    }
                }

                $dtInvoice = array(
                    'invoice_no'     => $invoiceNo,
                    'service_id'     => $id,
                    'status_invoice' => 'Request',
                    'ms_ti_id'       => 1,  // dari tbl ms_type_invoice 'Bengkel to TS3'
                    'amount'         => $this->input->post('amount'), // dari tbl approval dgn service_id yg sama
                    'invoice_date'   => date('Y-m-d H:i:s'),
                    'approval_id'    => $this->input->post('approval_id'), // dari tbl approval dgn service_id yg sama
                    'img_invoice'    => $default_name,
                    'user_request'   => $data['user']['id']
                );
                $this->Service_m->insertInvoice($dtInvoice); // insert data terlebih dahulu ke tbl invoice, id nya akan digunakan di tbl approval dan service

                $dtApproval = array(
                    'invoice_id' => $this->Service_m->selectInvoiceIDByServiceID($id) // dari tbl invoice dgn service_id yg sama
                );

                $dtService = array(
                    'invoice_id' => $this->Service_m->selectInvoiceIDByServiceID($id) // dari tbl invoice dgn service_id yg sama
                );

                $this->Service_m->updateApprovalByServiceID($id, $dtApproval);
                $this->Service_m->updateServiceByID($id, $dtService);

                $logData = [
                    'username'   => $this->session->userdata('username'),
                    'activities' => 'PIC Bengkel Input Form Invoice',
                    'url'        => base_url('Bengkel/BengkelRequestInvoice'),
                    'object'     => $id,
                    'ipdevice'   => Get_ipdevice(),
                    'at_time'    => date('Y-m-d H:i:s')
                ];
                $this->db->insert('user_log_activity', $logData);

                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>Berhasil!</h5>
                    Bukti tagihan berhasil diupload.
                </div>');
                redirect('Bengkel/Invoice_Process');
            }
        }
    }

    public function Sparepart()
    {
        $data['title']       = 'Sparepart';
        $data['user']        = $this->dtSession;
        $data['dtSparepart'] = $this->Service_m->selectAllSparepart();
        $this->load->view('bengkel/sparepart', $data);
    }

    public function SparepartEdit($id = NULL)
    {
        $data['title']       = 'Sparepart';
        $data['user']        = $this->dtSession;
        $data['dtSparepart'] = $this->Service_m->selectSparepartByID($id);
        $this->load->view('bengkel/sparepart_edit', $data);
    }

    public function SparepartAdd()
    {
        $this->form_validation->set_rules('sparepart_name', 'Nama Sparepart', 'required|trim');
        $this->form_validation->set_rules('qty_type', 'Satuan', 'required|trim');
        $this->form_validation->set_rules('qty', 'Jumlah', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('bengkel/form_service_process');
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
                'url'        => base_url('Bengkel/SparepartAdd'),
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
            redirect('Bengkel/Sparepart');
        }
    }
}
