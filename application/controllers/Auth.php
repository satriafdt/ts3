<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Users_m');
        date_default_timezone_set('Asia/Jakarta');
    }


    public function Index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'TS3 Indonesia';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {

            $this->_login();
        }
    }






    private function _login()
    {
        $email = $this->input->post('email');
        $password   = $this->input->post('password');
        $user       = $this->Users_m->get_session($email);



        // Jika data user ada
        if ($user) {
            // Jika data user aktif
            if ($user['is_active'] == '1') {
                // Match password user
                if (password_verify($password, $user['password'])) {

                    $logData = [
                        'username' => $user['username'],
                        'activities' => 'Login to App',
                        'object'     => $user['username'],
                        'url'        => base_url('Auth/Login'),
                        'ipdevice'   => Get_ipdevice(),
                        'at_time'    => date('Y-m-d H:i:s')
                    ];


                    $this->db->insert('user_log_activity', $logData);

                    $sessionData = [
                        'name'         => $user['name'],
                        'username'      => $user['username'],
                        'img_user'     => $user['img_user'],
                        'email'        => $user['email'],
                        'id_role'      => $user['id_role'],
                        'id'           => $user['id'],
                        'regional_id'  => $user['regional_id'],
                        'area_id'      => $user['area_id'],
                        'branch_id'    => $user['branch_id'],
                        'client_id'    => $user['id_client'],
                        'client'        => $user['client'],
                        'is_login'      => TRUE,
                        'change_password' => $user['change_password']
                    ];
                    $this->session->set_userdata($sessionData);

                    if ($sessionData['change_password'] == '0') {
                        redirect('Auth/Update_Password');
                    }



                    if ($sessionData['id_role'] == '1') {

                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('Dashboard_SAdmin');
                    } elseif ($sessionData['id_role'] == '3') {

                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('Dashboard_Admin');
                    } elseif ($sessionData['id_role'] == '4') {

                        $this->session->set_flashdata('wlcmsg', '
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                                You are logged in as ' . $user['role'] . ' now.
                            </div>
                        ');
                        redirect('Dashboard_Admin_Client');
                    } elseif ($sessionData['id_role'] == '5') {

                        $this->session->set_flashdata('wlcmsg', '
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                                You are logged in as ' . $user['role'] . ' now.
                            </div>
                        ');
                        redirect('Dashboard_Pic');
                    } elseif ($sessionData['id_role'] == '6') {

                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('Dashboard_Bengkel');
                    } else {
                        $this->session->set_flashdata('wlcmsg', '
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Welcome!</h5>
                            You are logged in as ' . $user['role'] . ' now.
                        </div>
                    ');
                        redirect('Dashboard_User');
                    }
                } else {
                    $this->session->set_flashdata('message', '
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Sorry!</h5>
                            Wrong password!
                        </div>
                    ');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Sorry!</h5>
                        Your account has not been activated.
                    </div>
                ');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sorry!</h5>
                    Your account is not registered.
                </div>
            ');
            redirect('Auth');
        }
    }

    public function Registration()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This Email has alreready Registered!'
        ]);
        $this->form_validation->set_rules('id_client', 'Client', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Dont Match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $data['client'] =  $this->db->get('ms_client')->result_array();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'TS3 User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {


            $userNameRandom = $this->input->post('name', true);
            $userNameRandom2 = strtoupper(substr($userNameRandom, 0, 4)) . date('Hs');
            $email = htmlspecialchars($this->input->post('email', true));
            $data = [
                'username'      => $userNameRandom2,
                'name'      => htmlspecialchars($this->input->post('name', true)),
                'email'     => htmlspecialchars($this->input->post('email', true)),
                'img_user'     => 'default.jpg',
                'password'  => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'id_role'   => 2,
                'is_active' => 1,
                'id_client'   => $this->input->post('id_client', true),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_create' => time()
            ];

            $this->db->insert('users', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Thank You!</h5>
            Your account has been Created. Please Login
            </div>');
            redirect('Auth');
        }
    }

    public function Forgot_password()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgotpassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');

            $user = $this->db->get_where('users', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {

                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_create' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Thank You!</h5>
                    Please Check your Email To Reset Password.!
                </div>');
                redirect('Auth');
            } else {

                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sorry!</h5>
                    Email is not Registered or Activated.!
                </div>');
                redirect('Auth/Forgot_Password');
            }
        }
    }



    public function Logout()
    {

        $data['usrProfile']  = $this->Users_m->get_user_profile($this->session->userdata('username'));


        $username = $data['usrProfile']['username'];

        $logData = [
            'username' => $username,
            'activities' => 'Logout from App',
            'object'     => $username,
            'url'        => base_url('Auth/Logout'),
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);

        $this->session->unset_userdata('name');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('img_user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('client');
        $this->session->unset_userdata('is_login');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Thank You!</h5>
                You have been logged.
            </div>
        ');
        redirect('Home');
    }

    public function Blocked()
    {
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sorry!</h5>
                    Please login first!
                </div>
            ');
            redirect('Auth');
        }

        $data['title'] = "Access Forbidden";
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('auth/blocked', $data);
    }


    private function _sendEmail($token, $type)
    {

        $config = [
            'protocol'         => 'smtp',
            'smtp_host'         => 'ssl://smtp.googlemail.com',
            'smtp_user'         => 'belifeindonesia@gmail.com',
            'smtp_pass'         => 'Belife!23',
            'smtp_port'         => 465,
            'mailtype'         => 'html',
            'charset'         => 'utf-8',
            'smtp_timeout'     => '7',
            'newline'         => "\r\n"

        ];


        $email = $this->input->post('email');
        $this->email->initialize($config);

        $this->email->from('belifeindonesia@gmail.com', 'TS3 Indonesia');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('
                <b>Dear Rekan TS3 Indonesia</b><br>
                <br>
                    Akun Anda Sedang di Verifikasi oleh admin, mohon untuk ditunggu.
                    Status Akun akan di informasikan kembali.
                <br> <br>
                Best Regards<br>
                TS3 indonesia<br>
                <br>
                <img src=" ' . base_url('assets/img/1.svg') . '"   width="190" height="40"  class="img-fluid" >
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
                ' . $email . ' User Anda Sedang Di Verikasi Admin,Mohon untuk Menunggu.!</div>');
                redirect('Auth');
            }
        } else if ($type == 'forgot') {

            $this->email->subject('Reset Password');
            $this->email->message('
                <b>Dear Rekan TS3 Indonesia</b><br>
                <br>
                Silakan Klik Link Untuk Mereset Password : <a class="btn btn-info" href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"  >Reset Password</a><br>
                <br>
                Best Regards<br>
                TS3 indonesia<br>
                <br>
                <img src=" ' . base_url('assets/img/1.svg') . '"   width="190" height="40"  class="img-fluid" >
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
                <h5><i class="icon fas fa-check"></i> Thank You!</h5>
                ' . $email . ' Please Check your Email To Reset Password.!</div>');
                redirect('Auth');
            }
        }
    }


    public function Verify()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');


        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                if (time() - $user_token['date_create'] < (60 * 60 * 24)) {

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('users');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                               ' . $email . 'Anda Berhasil Registrasi, Silakaan menunggu verifikasi dari admin..!</div>');
                    redirect('auth');
                } else {

                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                Account Activation failed ! Token Expired</div>');
                    redirect('auth');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Account Activation failed ! Token Invalid </div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Account Activation failed ! Wrong Email </div>');
            redirect('auth');
        }
    }


    public function Reset_password()
    {



        $email = $this->input->get('email');
        $token = $this->input->get('token');


        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {


                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                    Reset Password Failed.! Wrong Token.</div>');
                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Reset Password Failed.! Wrong Email.</div>');
            redirect('auth');
        }
    }



    public function ChangePassword()
    {

        if (!$this->session->userdata('reset_email')) {

            redirect('auth');
        }


        $this->form_validation->set_rules('password1', 'Passsword', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Passsword', 'required|trim|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/changepassword');
            $this->load->view('templates/auth_footer');
        } else {

            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                       Password Success Update, Please Login .!</div>');
            redirect('auth');
        }
    }


    public function Update_Password()
    {

        if (!$this->session->userdata('email')) {

            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Passsword', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Passsword', 'required|trim|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update Password';
            $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/update_password', $data);
            $this->load->view('templates/auth_footer');
        } else {

            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $email = $this->session->userdata('email');
            $this->db->set('change_password', 1);
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->unset_userdata('email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                       Password Success Update, Please Login .!</div>');
            redirect('auth');
        }
    }
}
