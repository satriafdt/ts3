<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
    }

    public function Index()
    {

        $data['title'] = 'Dashboard';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard/dashboard_admin', $data);
        $this->load->view('templates/footer');
    }
}
