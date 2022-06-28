<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i>Sorry!</h5>
                Please login first!
            </div>
        ');

        redirect('Auth');
    } else {
        $id_role    = $ci->session->userdata('id_role');
        $menu       = $ci->uri->segment(1);
        $queryMenu  = $ci->db->get_where('user_menu', ['url' => $menu])->row_array();
        $menu_id    = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $id_role,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('Auth/Blocked');
        }
    }
}

function check_access($roleId, $menuId) //Digunakan oleh Views('user/role_access_v') untuk edit role group
{
    $ci = get_instance();

    $ci->db->where('role_id', $roleId);
    $ci->db->where('menu_id', $menuId);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}


function get_signature_login($get_array = array(), $secret_key)
{
    $email = $get_array['email'];

    $belife_signature = sha1($email . $secret_key);

    return $belife_signature;
}





function is_login()
{
    $ci = get_instance();
    $is_login = $ci->session->userdata('is_login');


    return ($is_login === TRUE);
}
