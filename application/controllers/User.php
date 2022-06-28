<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->library('upload');
        $this->load->model('Users_m');
    }


    public function Index()
    {

        $data['title'] = 'My Profile';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->Users_m->get_data_profile($this->session->userdata('email'));


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function Change_Password()
    {

        $data['title'] = 'Change Password';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->Users_m->get_data_profile($this->session->userdata('email'));

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/footer');
        } else {

            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong Current Password! </div>');
                redirect('User/Change_Password');
            } else {

                if ($current_password == $new_password) {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                New Password cannto be the same as Current Password! </div>');
                    redirect('User/Change_Password');
                } else {

                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);


                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('users');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Password Change! </div>');
                    redirect('User');
                }
            }
        }
    }


    public function Edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['profile'] = $this->Users_m->get_data_profile($this->session->userdata('email'));
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $upload_image = $_FILES['img_user']['name'];


            if ($upload_image) {


                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '512';
                $config_img['overwrite']     = TRUE;
                $config['upload_path'] = './assets/img/profile/';
                $this->upload->initialize($config);


                if ($this->upload->do_upload('img_user')) {

                    $old_image = $data['profile']['img_user'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('img_user', $new_image);
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       Your Image upload not Required! </div>');
                    redirect('User/Edit');
                }
            }


            $this->db->set('name', $name);
            $this->db->where('id', $id);
            $this->db->update('users');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your Profile has been updated! </div>');
            redirect('User');
        }
    }
}
