<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        is_logged_in();
        $this->load->model('User_menu_m');
    }

    public function Index()
    {
        $this->Menu();
    }

    public function Menu()
    {
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['title']  = "Menu";

        $data['menu'] = $this->User_menu_m->get_all();

        $this->form_validation->set_rules('name', 'Name Menu', 'required|trim');
        $this->form_validation->set_rules('title', 'Title Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'Menu URL', 'required|trim|is_unique[user_menu.url]', ['is_unique' => 'URL has already added.']);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('navigation/menu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'title' => $this->input->post('title'),
                'url'   => $this->input->post('url'),
                'icon'  => $this->input->post('icon'),
                'name'  => $this->input->post('name'),
                'is_active'  => $this->input->post('is_active'),
                'seq_no'  => $this->input->post('seq_no')

            );

            $this->db->insert('user_menu', $data);


            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Menu',
                'url'        => base_url('Navigation/Menu'),
                'object'     => $data['url'],
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user_log_activity', $logData);

            $this->session->set_flashdata('message', '
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    Data has been added.
                </div>
            ');
            redirect('Navigation/Menu');
        }
    }


    public function SubMenu()
    {
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['title']  = "Sub Menu";
        $data['subMenu'] = $this->User_sub_menu_m->get_all()->result_array();


        $data['menu'] = $this->User_menu_m->get_menu_withoutdash()->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('navigation/submenu', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [

                'menu_id' => $this->input->post('menu_id'),
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'is_active' => $this->input->post('is_active'),
                'icon' => $this->input->post('icon')

            ];

            $this->db->insert('user_sub_menu', $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new SubMenu',
                'url'        => base_url('Navigation/Roles'),
                'object'     => $data['title'],
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user_log_activity', $logData);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
                 <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <h5><i class="icon fas fa-check"></i> Success!</h5>
                 Data has been added.
             </div>');
            redirect('Navigation/SubMenu');
        }
    }


    public function Roles()
    {
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
        $data['title']  = "Roles";
        $data['role'] = $this->db->get('user_roles')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('navigation/role', $data);
            $this->load->view('templates/footer');
        } else {


            $data = [
                'role' => $this->input->post('role'),
                'is_active' => $this->input->post('is_active')

            ];
            $this->db->insert('user_roles', $data);

            $logData = [
                'username' => $this->session->userdata('username'),
                'activities' => 'Add new Role',
                'url'        => base_url('Navigation/Roles'),
                'object'     => $data['role'],
                'ipdevice'   => Get_ipdevice(),
                'at_time'    => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user_log_activity', $logData);

            $this->session->set_flashdata('message', '
               <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    Data has been added.
                </div>
            ');
            redirect('Navigation/Roles');
        }
    }

    public function Menu_delete($id)
    {

        $data = $this->User_menu_m->Get_data($id);
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete menu',
            'url'        => base_url('Navigation/Menu_delete'),
            'object'     => $data['name'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->User_menu_m->Delete_menu($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>
            ');
        redirect('Navigation/Menu');
    }

    public function Submenu_delete($id)
    {

        $data = $this->User_sub_menu_m->get_submenu_by_menu($id);
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete submenu',
            'url'        => base_url('Navigation/SubMenu'),
            'object'     => $data['title'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->User_sub_menu_m->Delete_Submenu($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>');
        redirect('Navigation/SubMenu');
    }


    public function Menu_edit()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->User_menu_m->Get_data($id);
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data = array(
            'title' => $this->input->post('title'),
            'url'   => $this->input->post('url'),
            'icon'  => $this->input->post('icon'),
            'name'  => $this->input->post('name'),
            'is_active'  => $this->input->post('is_active'),
            'seq_no'  => $this->input->post('seq_no')
        );
        $this->User_menu_m->Edit_menu($id, $data);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data menu',
            'object'     => $data['name'],
            'url'        => base_url('Navigation/Menu_edit'),
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
        redirect('Navigation/Menu');
    }


    public function SubMenu_edit()
    {
        $id = $this->input->post('id', TRUE);
        $data = $this->User_menu_m->Get_data($id);
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $dataedit = array(
            'menu_id' => $this->input->post('menu_id'),
            'title' => $this->input->post('title'),
            'url' => $this->input->post('url'),
            'is_active' => $this->input->post('is_active'),
            'icon' => $this->input->post('icon')

        );

        $this->User_sub_menu_m->Edit_SubMenu($id, $dataedit);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data menu',
            'object'     => $data['name'],
            'url'        => base_url('Navigation/SubMenu_edit'),
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
        redirect('Navigation/SubMenu');
    }

    public function Role_edit()
    {
        $id = $this->input->post('id', TRUE);
        $this->load->model('Navigation_m', 'nav');
        $data = $this->nav->Get_data($id);


        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $dataedit = array(
            'role' => $this->input->post('role'),
            'is_active'  => $this->input->post('is_active')
        );
        $this->nav->Edit_role($id, $dataedit);

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'update data menu',
            'object'     => $data['role'],
            'url'        => base_url('Navigation/Role_edit'),
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
        redirect('Navigation/Roles');
    }

    public function Role_delete($id)
    {

        $this->load->model('Navigation_m', 'nav');
        $data = $this->nav->Get_data($id);
        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $logData = [
            'username' => $this->session->userdata('username'),
            'activities' => 'delete menu',
            'url'        => base_url('Navigation/Role_delete'),
            'object'     => $data['role'],
            'ipdevice'   => Get_ipdevice(),
            'at_time'    => date('Y-m-d H:i:s')
        ];
        $this->db->insert('user_log_activity', $logData);
        $this->nav->Delete_role($id);
        $this->session->set_flashdata('message', '
               <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Success!</h5>
                    Data has been Deleted.
                </div>
            ');
        redirect('Navigation/Roles');
    }


    public function RoleAccess($id)
    {
        $data['title'] = 'Role Access ';

        $data['user'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get_where('user_roles', ['id' => $id])->row_array();

        $data['menu'] = $this->User_menu_m->get_menu_withoutdash_role()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('navigation/roleaccess', $data);
        $this->load->view('templates/footer');
    }

    public function RoleChangeaccess()
    {
        $menu_id  = $this->input->post('menuId');
        $role_id  = $this->input->post('roleId');


        $data = [

            'role_id' => $role_id,
            'menu_id'  => $menu_id
        ];


        $result  = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {

            $this->db->insert('user_access_menu', $data);
        } else {

            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Access Changed ! </div>');
    }
}
