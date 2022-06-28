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
}
