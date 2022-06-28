<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->model('Invoice_m');
    }

    public function Bengkel_Invoice()
    {

        $data['title'] = 'Bengkel Invoice';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['datainvoice'] = $this->Invoice_m->Get_allDataInvoice_bengkel()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('invoice/bengkel_invoice', $data);
        $this->load->view('templates/footer');
    }

    public function Client_Invoice()
    {

        $data['title'] = 'Client Invoice';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['datainvoice'] = $this->Invoice_m->Get_allDataInvoice_Client()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('invoice/client_invoice', $data);
        $this->load->view('templates/footer');
    }


    public function Bengkel_I_Process($id)
    {

        $data['title'] = 'Invoice Process';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $data['datainvoice_d'] = $this->Invoice_m->Get_allDataInvoice_bengkel_d($id)->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('invoice/bengkel_invoice_process', $data);
        $this->load->view('templates/footer');
    }


    public function Invoice_C_Create()
    {

        $data['title'] = 'Invoice Create';

        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('invoice/invoice_create', $data);
        $this->load->view('templates/footer');
    }
}
