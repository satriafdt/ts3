<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{



    public function Index()
    {

        $this->load->view('home/index');
    }

    public function Contact_Us_Send()
    {
        $data = [

            'nama'  => $this->input->post('nama'),
            'email'  => $this->input->post('email'),
            'subject'  => $this->input->post('subject'),
            'pesan'  => $this->input->post('pesan'),
            'ip_post'   => Get_ipdevice(),
            'date_post'    => date('Y-m-d H:i:s'),
            'is_reply'  => 0

        ];


        $this->db->insert('contact_us', $data);

        $this->session->set_flashdata('kirim', 'success');

        redirect('Home');
    }
}
