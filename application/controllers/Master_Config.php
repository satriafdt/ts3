<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_Config extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->model('Master_m');
    }

    public function Branch_Client()
    {
        $data['title'] = 'Branch Client';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->db->get('ms_client')->result_array();
        $data['area'] = $this->db->get('ms_area')->result_array();
        $data['branch'] = $this->Master_m->get_branch_all()->result_array();

        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required|trim');
        $this->form_validation->set_rules('client_id', 'Client Name', 'required');
        $this->form_validation->set_rules('area_id', 'Area Name', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master_config/branch', $data);
            $this->load->view('templates/footer');
        } else {
            $data_branch = array(
                'client_id' => $this->input->post('client_id'),
                'area_id' => $this->input->post('area_id'),
                'branch_name' => $this->input->post('branch_name'),
                'is_active'  => $this->input->post('is_active'),
                'create_date'   => date('Y-m-d H:i:s'),
                'user_update'  => $data['user']['email']
            );
            $this->db->insert('ms_branch', $data_branch);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i> Success!</h5>
                 Data has been added.
             </div>
         ');
            redirect('Master_Config/Branch_Client');
        }
    }

    public function Branch_Edit()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->Master_m->get_branch_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data_edit = array(

            'client_id' => $this->input->post('client_id'),
            'area_id' => $this->input->post('area_id'),
            'branch_name' => $this->input->post('branch_name'),
            'is_active'  => $this->input->post('is_active'),
            'update_date'   => date('Y-m-d H:i:s'),
            'user_update'  => $data['user']['email']
        );
        $this->Master_m->Edit_branch($id, $data_edit);
        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data branch',
            'object'     => $data['branch_name'],
            'url'        => base_url('Master_Config/Branch_Edit'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Success!</h5>
                Data has been updated.
            </div>
        ');
        redirect('Master_Config/Branch_Client');
    }

    public function Branch_Delete($id)
    {
        $this->load->model('Master_m');

        $data = $this->Master_m->get_branch_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete area',
            'url'        => base_url('Master_Config/Branch_Delete'),
            'object'     => $data['branch_name'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->Master_m->Delete_branch($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>
            ');
        redirect('Master_Config/Branch_Client');
    }

    public function Client()
    {
        $data['title'] = 'Client';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->db->get('ms_client')->result_array();

        $this->form_validation->set_rules('clientname', 'Client Name', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master_config/client', $data);
            $this->load->view('templates/footer');
        } else {
            $dataclient = array(
                'client_name' => $this->input->post('clientname'),
                'is_active'  => $this->input->post('is_active'),
                'create_date'   => date('Y-m-d H:i:s'),
                'user_update'  => $data['user']['email']
            );
            $this->db->insert('ms_client', $dataclient);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i> Success!</h5>
                 Data has been added.
             </div>
         ');
            redirect('Master_Config/Client');
        }
    }

    public function Client_Edit()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->Master_m->get_client_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $dataedit = array(

            'client_name' => $this->input->post('clientname'),
            'is_active'  => $this->input->post('is_active'),
            'update_date'   => date('Y-m-d H:i:s'),
            'user_update'  => $data['user']['email']
        );
        $this->Master_m->Edit_client($id, $dataedit);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data client',
            'object'     => $data['name'],
            'url'        => base_url('Master_Config/Client_Edit'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Success!</h5>
                Data has been updated.
            </div>
        ');
        redirect('Master_Config/Client');
    }


    public function Client_Delete($id)
    {
        $this->load->model('Master_m');

        $data = $this->Master_m->get_client_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete client',
            'url'        => base_url('Master_Config/Client_Delete'),
            'object'     => $data['client_name'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->Master_m->Delete_client($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>
            ');
        redirect('Master_Config/Client');
    }


    public function Area_Client()
    {
        $data['title'] = 'Area Client';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['client'] = $this->db->get('ms_client')->result_array();
        $data['regional'] = $this->db->get('ms_regional')->result_array();
        $data['area'] = $this->Master_m->get_area_all()->result_array();

        $this->form_validation->set_rules('area_name', 'Area Name', 'required|trim');
        $this->form_validation->set_rules('client_id', 'Client Name', 'required');
        $this->form_validation->set_rules('regional_id', 'Client Name', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master_config/area', $data);
            $this->load->view('templates/footer');
        } else {
            $data_area = array(
                'client_id' => $this->input->post('client_id'),
                'regional_id' => $this->input->post('regional_id'),
                'area_name' => $this->input->post('area_name'),
                'is_active'  => $this->input->post('is_active'),
                'create_date'   => date('Y-m-d H:i:s'),
                'user_update'  => $data['user']['email']
            );
            $this->db->insert('ms_area', $data_area);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i> Success!</h5>
                 Data has been added.
             </div>
         ');
            redirect('Master_Config/Area_Client');
        }
    }

    public function Area_Edit()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->Master_m->get_area_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data_edit = array(

            'client_id' => $this->input->post('client_id'),
            'regional_id' => $this->input->post('regional_id'),
            'area_name' => $this->input->post('area_name'),
            'is_active'  => $this->input->post('is_active'),
            'update_date'   => date('Y-m-d H:i:s'),
            'user_update'  => $data['user']['email']
        );
        $this->Master_m->Edit_area($id, $data_edit);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data area',
            'object'     => $data['area_name'],
            'url'        => base_url('Master_Config/Area_Edit'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Success!</h5>
                Data has been updated.
            </div>
        ');
        redirect('Master_Config/Area_Client');
    }

    public function Area_Delete($id)
    {
        $this->load->model('Master_m');

        $data = $this->Master_m->get_area_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete area',
            'url'        => base_url('Master_Config/Area_Delete'),
            'object'     => $data['area_name'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->Master_m->Delete_area($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>
            ');
        redirect('Master_Config/Area_Client');
    }

    public function Regional_Client()
    {
        $data['title'] = 'Regional Client';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['client'] = $this->db->get('ms_client')->result_array();

        $data['regional'] = $this->Master_m->get_regional_all()->result_array();

        $this->form_validation->set_rules('regional_name', 'Regional Name', 'required|trim');
        $this->form_validation->set_rules('client_id', 'Client Name', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master_config/regional', $data);
            $this->load->view('templates/footer');
        } else {

            $data_regional = array(
                'client_id' => $this->input->post('client_id'),
                'regional_name' => $this->input->post('regional_name'),
                'is_active'  => $this->input->post('is_active'),
                'create_date'   => date('Y-m-d H:i:s'),
                'user_update'  => $data['user']['email']
            );
            $this->db->insert('ms_regional', $data_regional);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i> Success!</h5>
                 Data has been added.
             </div>
         ');
            redirect('Master_Config/Regional_Client');
        }
    }

    public function Regional_Edit()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->Master_m->get_regional_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data_edit = array(

            'regional_name' => $this->input->post('regional_name'),
            'client_id' => $this->input->post('client_id'),
            'is_active'  => $this->input->post('is_active'),
            'update_date'   => date('Y-m-d H:i:s'),
            'user_update'  => $data['user']['email']
        );
        $this->Master_m->Edit_regional($id, $data_edit);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data regional',
            'object'     => $data['regional_name'],
            'url'        => base_url('Master_Config/Regional_Edit'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Success!</h5>
                Data has been updated.
            </div>
        ');
        redirect('Master_Config/Regional_Client');
    }

    public function Regional_Delete($id)
    {
        $this->load->model('Master_m');

        $data = $this->Master_m->get_regional_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete regional',
            'url'        => base_url('Master_Config/Regional_Delete'),
            'object'     => $data['regional_name'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->Master_m->Delete_regional($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>
            ');
        redirect('Master_Config/Regional_Client');
    }

    public function Type_Service()
    {
        $data['title'] = 'Type Service';
        $data['type_s'] = $this->db->get('ms_type_service')->result_array();
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('type_name', 'Type Name', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master_config/type_service', $data);
            $this->load->view('templates/footer');
        } else {

            $data_regional = array(
                'type_name' => $this->input->post('type_name'),
                'is_active'  => $this->input->post('is_active'),
                'create_date'   => date('Y-m-d H:i:s'),
                'user_update'  => $data['user']['email']
            );
            $this->db->insert('ms_type_service', $data_regional);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i> Success!</h5>
                 Data has been added.
             </div>
         ');
            redirect('Master_Config/Type_Service');
        }
    }

    public function Type_Service_Delete($id)
    {
        $this->load->model('Master_m');

        $data = $this->Master_m->get_type_s_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete regional',
            'url'        => base_url('Master_Config/Type_Service_Delete'),
            'object'     => $data['type_name'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->Master_m->Delete_type_s($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>
            ');
        redirect('Master_Config/Type_Service');
    }



    public function Type_Service_Edit()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->Master_m->get_type_s_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data_edit = array(

            'type_name' => $this->input->post('type_name'),
            'is_active'  => $this->input->post('is_active'),
            'update_date'   => date('Y-m-d H:i:s'),
            'user_update'  => $data['user']['email']
        );
        $this->Master_m->Edit_Type_s($id, $data_edit);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data regional',
            'object'     => $data['type_name'],
            'url'        => base_url('Master_Config/Type_Service_Edit'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->set_flashdata('message', '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Success!</h5>
                Data has been updated.
            </div>
        ');
        redirect('Master_Config/Type_Service');
    }

    public function Bengkel_list()
    {
        $data['title']    = 'Bengkel List ';
        $data['user']     = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['regional'] = $this->db->get('ms_regional')->result_array();
        $data['area']     = $this->db->get('ms_area')->result_array();
        $data['branch']   = $this->db->get('ms_branch_client')->result_array();
        $data['bengkel']  = $this->Master_m->get_bengkel_all();

        $this->form_validation->set_rules('nama_bengkel', 'Bengkel', 'required|trim');
        $this->form_validation->set_rules('regional_id', 'Regional', 'required');
        $this->form_validation->set_rules('area_id', 'Area', 'required');
        $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master_config/bengkel', $data);
            $this->load->view('templates/footer');
        } else {
            $dtBengkel = array(
                'user_id'      => $data['user']['id'],
                'nama_bengkel' => $this->input->post('nama_bengkel'),
                'regional_id'  => $this->input->post('regional_id'),
                'area_id'      => $this->input->post('area_id'),
                'branch_id'    => $this->input->post('branch_id'),
                'create_date'  => date('Y-m-d H:i:s')
            );
            $this->db->insert('ms_bengkel', $dtBengkel);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Data berhasil ditambahkan.
            </div>');
            redirect('Master_Config/Bengkel_list');
        }
    }

    public function Bengkel_Edit()
    {
        $id           = $this->input->post('id', TRUE);
        $data         = $this->Master_m->get_bengkel_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data_edit = array(
            'nama_bengkel' => $this->input->post('nama_bengkel'),
            'regional_id'  => $this->input->post('regional_id'),
            'area_id'      => $this->input->post('area_id'),
            'branch_id'    => $this->input->post('branch_id'),
            'update_date'  => date('Y-m-d H:i:s'),
            'user_update'  => $data['user']['id']
        );
        $this->Master_m->Edit_bengkel($id, $data_edit);

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
        redirect('Master_Config/Bengkel_list');
    }

    public function Bengkel_Delete($id)
    {
        $this->load->model('Master_m');

        $data         = $this->Master_m->get_bengkel_id($id);
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $logData = [
            'username'   => $this->session->userdata('username'),
            'activities' => 'Delete Data Bengkel',
            'url'        => base_url('Master_Config/Bengkel_Delete'),
            'object'     => $data['nama_bengkel'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->Master_m->Delete_bengkel($id);
        $this->session->set_flashdata('message', '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-info"></i> Success!</h5>
            Data berhasil dihapus.
        </div>');
        redirect('Master_Config/Bengkel_list');
    }
}
