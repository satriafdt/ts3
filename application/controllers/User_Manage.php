<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_Manage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->model('Users_m');
    }


    public function User_List()
    {

        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['users'] = $this->Users_m->get_all_users();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user_manage/user_list', $data);
        $this->load->view('templates/footer');
    }

    public function Add_user()
    {

        $data['title'] = 'Add User';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->Users_m->get_roles();
        $data['branch'] = $this->db->get('ms_branch')->result_array();
        $data['area'] = $this->db->get('ms_area')->result_array();
        $data['regional'] = $this->db->get('ms_regional')->result_array();
        $data['client'] = $this->db->get('ms_client')->result_array();


        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This Email has alreready Registered!'
        ]);
        $this->form_validation->set_rules('client_id', 'Client', 'required');
        $this->form_validation->set_rules('id_role', 'Role', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user_manage/add_user', $data);
            $this->load->view('templates/footer');
        } else {
            $userNameRandom = $this->input->post('name', true);
            $userNameRandom2 = strtoupper(substr($userNameRandom, 0, 4)) . date('Hs');
            $emailuser = htmlspecialchars($this->input->post('email', true));
            $datauser = array(
                'username'      => $userNameRandom2,
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'img_user'     => 'default.jpg',
                'password'  => password_hash('TS3IDN', PASSWORD_DEFAULT),
                'id_role' => $this->input->post('id_role'),
                'is_active'  => $this->input->post('is_active'),
                'id_client' => $this->input->post('client_id'),
                'regional_id' => $this->input->post('regional_id'),
                'area_id' => $this->input->post('area_id'),
                'branch_id' => $this->input->post('branch_id'),                'created_at'   => date('Y-m-d H:i:s'),
                'change_password'  => 0
            );

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $emailuser,
                'token' => $token,
                'date_create' => time()
            ];

            $this->db->insert('user_token', $user_token);

            //Non acive dulu send ke email belum ketemu solusinya
            // $this->_Sendemail($token, 'add_user', $emailuser);
            $this->db->insert('users', $datauser);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Thank You!</h5>
            User Sudah Berhasil Di Buat,dan Sudah Di kirm Ke Email User.!
            </div>');
            redirect('User_Manage/Add_user');
        }
    }


    public function Update_user()
    {
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $iduser = $this->input->post('id');
        $datauseredit = array(
            'id_role' => $this->input->post('id_role'),
            'regional_id' => $this->input->post('regional_id'),
            'area_id' => $this->input->post('area_id'),
            'branch_id' => $this->input->post('branch_id'),                'updated_at'   => date('Y-m-d H:i:s')
        );
        $this->Users_m->Edit_user($iduser, $datauseredit);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data user',
            'object'     => $data['id'],
            'url'        => base_url('User_Manage/Edit_user'),
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
        redirect('User_Manage/User_List');
    }



    public function Edit_user($id)
    {

        $data['title'] = 'Edit User';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data['userdata'] = $this->Users_m->get_data_user($id);
        $data['role'] = $this->Users_m->get_roles();
        $data['branch'] = $this->db->get('ms_branch')->result_array();
        $data['area'] = $this->db->get('ms_area')->result_array();
        $data['regional'] = $this->db->get('ms_regional')->result_array();
        $data['client'] = $this->db->get('ms_client')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user_manage/edit_user', $data);
        $this->load->view('templates/footer');
    }

    public function Delete_user($id)
    {


        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data = $this->Users_m->get_user_id($id);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete user',
            'url'        => base_url('User_Manage/Delete_user'),
            'object'     => $data['username'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->Users_m->Delete_user($id);
        $this->session->set_flashdata('message', '
        <div class="alert alert-danger alert-dismissible">
             <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h5><i class="icon fas fa-info"></i> Success!</h5>
             Data has been Deleted.
         </div>
     ');
        redirect('User_Manage/User_List');
    }

    private function _Sendemail($token, $type, $emailuser)
    {
        $config = [
            'protocol'         => 'smtp',
            'smtp_host'         => 'ssl://smtp.googlemail.com',
            'smtp_user'         => 'ts3.idn@gmail.com',
            'smtp_pass'         => 'TS3IDN!23',
            'smtp_port'         => 465,
            'mailtype'          => 'html',
            'charset'           => 'utf-8',
            'newline'           => '\r\n'

        ];

        $psw = $this->db->get_where('ms_general', ['name' => 'Default Password'])->row_array();



        $this->email->initialize($config);
        $this->email->from('belifeindonesia@gmail.com', 'TS3 Indonesia');
        $this->email->to($this->input->post('email'));

        if ($type == 'add_user') {
            $this->email->subject('Account Verification');
            $this->email->message('
                <b>Dear Rekan TS3 Indonesia</b><br>
                <br>
                   Akun Anda Sudah Aktiv Silakan Login Ke 
                   Dan Mengganti Paaword Anda.

                   Username : ' . $emailuser . '
                   Password : ' . $psw['value'] . '


                <br> <br>
                Best Regards<br>
                TS3 indonesia<br>
                <br>
                <img src=" ' . base_url('assets/image/1.png') . '"   width="190" height="40"  class="img-fluid" >
                <hr><b> 
                PT TS3 Indonesia<br>
                XXXXXXXXXXXXXXXXXXXXXXXXX</b>
                ');



            if ($this->email->send()) {

                return true;
            } else {
                echo $this->email->print_debugger();
                die;

                $this->session->set_flashdata('message', '       <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>Thank You!</h5>
                ' . $emailuser . ' User Sudah Berhasil Di Buat,dan Sudah Di kirm Ke Email User.!</div>');
                redirect('User_Manage/Add_user');
            }
        }
    }
}
