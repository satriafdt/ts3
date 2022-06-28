<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pic extends CI_Controller
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
        $this->Service_List();
    }

    public function Service_List()
    {
        // Ambil data dari table service dengan status "Open" dan sesuai dengan client_id, regional_id, area_id, branch_id user yang login
        // pada action, ada tombol request untuk update status jadi "Request", Lalu masuk ke bucket Service List punya user Bengkel

        $data['title']     = 'Service List';
        $data['user']      = $this->dtSession;
        $data['dtService'] = $this->Service_m->selectServiceOpenByClient();
        // var_dump($data['dtService']);
        // die;
        $this->load->view('pic/service_list', $data);
    }

    public function PicReqServiceToBengkel($id = NULL)
    {
        // var_dump($id);
        // die;
        $dtUpdService = array(
            'status' => 'Request',
            'request_date' => date('Y-m-d H:i:s')
        );
        // var_dump($dtUpdService);
        // die;
        $this->Service_m->updateServiceByID($id, $dtUpdService);

        $logData = [
            'username'   => $this->session->userdata('username'),
            'activities' => 'Request Service',
            'url'        => base_url('Pic/PicReqServiceToBengkel'),
            'object'     => $id,
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
            Data berhasil direquest.
        </div>');
        redirect('Pic/Service_List');
    }

    public function Approval_list()
    {
        $data['title']      = 'Approval List';
        $data['user']       = $this->dtSession;
        $data['dtApproval'] = $this->Service_m->selectApprovalByClient($data['user']['id']);
        // var_dump($data['user']['id']);
        // die;
        // Ambil data dari table service dengan status "Approval" dan sesuai dengan client_id, regional_id, area_id, branch_id user yang login
        // pada action, ada tombol Approve untuk update status jadi "Done", Keluar Tampilan Form berisi notes approval di table approval
        $this->load->view('pic/approval_list', $data);
    }

    public function Detail_Approval($id = NULL)
    {
        $data['title']             = 'Approval List';
        $data['user']              = $this->dtSession;
        $data['qtyAmmountService'] = $this->Service_m->getQtyAmmount($id);
        $data['idApproval']        = $this->Service_m->selectApprovalIDByServiceID($id);
        $data['dtServiceDetail']   = $this->Service_m->selectServiceDetail($id);
        $data['dtService']         = $this->Service_m->selectServiceJoinAssetsByID($id);
        $this->load->view('pic/detail_approval', $data);
    }

    public function PicApproveApproval($id = NULL)
    {
        $data['user'] = $this->dtSession;

        $this->form_validation->set_rules('amount', 'Total', 'required|trim');
        $this->form_validation->set_rules('note_pic', 'Catatan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('pic/detail_approval');
        } else {
            $dtService = array(
                'status' => 'Done',
                'finish_date' => date('Y-m-d H:i:s'),
                'approval_id' => $this->input->post('approval_id')
            );

            $dtApproval = array(
                'approval_status' => 'Approve',
                'amount'          => $this->input->post('amount'),
                'user_approval'   => $data['user']['id'],
                'note_pic '       => $this->input->post('note_pic')
            );

            $this->Service_m->updateServiceByID($id, $dtService);
            $this->Service_m->updateApprovalByServiceID($id, $dtApproval);

            $logData = [
                'username'   => $this->session->userdata('username'),
                'activities' => 'Add new Assets Service',
                'url'        => base_url('Pic/PicApproveApproval'),
                'object'     => $id,
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user_log_activity', $logData);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                Data berhasil disetujui.
            </div>');
            redirect('Pic/Approval_list');
        }
    }
}
