<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2" href="<?= base_url('User'); ?>">

    <img src="<?php echo base_url('assets'); ?>/image/1.png" width="120" height="120" class="img-fluid mb-2 mt-2" alt="">


  </a>

  <!-- 
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('User'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-cogs"></i>
    </div>
    <div class="sidebar-brand-text mx-3">TS3 Indonesia</div>
  </a> -->

  <!-- Divider -->
  <hr class="sidebar-divider mt-2">


  <?php



  $menu = $this->User_menu_m->get_menu_by_role($this->session->userdata('id_role'));


  ?>


  <?php if ($this->session->userdata('id_role') == '1') : ?>

    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Dashboard_SAdmin'); ?>">
        <i class="fas fa-fw fa-home"></i>
        <span> <b> Dashboard </b></span> </a>
    </li>
  <?php elseif ($this->session->userdata('id_role') == '2') : ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Dashboard_User'); ?>">
        <i class="fas fa-fw fa-home"></i>
        <span> <b> Dashboard </b></span> </a>
    </li>
  <?php elseif ($this->session->userdata('id_role') == '3') : ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Dashboard_Admin'); ?>">
        <i class="fas fa-fw fa-home"></i>
        <span> <b> Dashboard </b></span> </a>
    </li>
  <?php elseif ($this->session->userdata('id_role') == '4') : ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Dashboard_Admin_Client'); ?>">
        <i class="fas fa-fw fa-home"></i>
        <span> <b> Dashboard </b></span> </a>
    </li>
  <?php elseif ($this->session->userdata('id_role') == '5') : ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Dashboard_Pic'); ?>">
        <i class="fas fa-fw fa-home"></i>
        <span> <b> Dashboard </b></span> </a>
    </li>
  <?php elseif ($this->session->userdata('id_role') == '6') : ?>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url('Dashboard_Bengkel'); ?>">
        <i class="fas fa-fw fa-home"></i>
        <span> <b> Dashboard </b></span> </a>
    </li>

  <?php endif; ?>

  <?php foreach ($menu as $m) :   ?>

    <li class="nav-item">
      <?php if ($this->uri->segment(1) === $m['url']) : ?>

        <a class="nav-link" href="<?= base_url($m['url']); ?>" data-toggle="collapse" data-target="#<?= $m['name']  ?>" aria-expanded="true" aria-controls="menu">
          <i class="<?= $m['icon']; ?>"></i>
          <span> <b> <?= $m['title']; ?> </b></span>
        </a>
        <div id="<?= $m['name']  ?>" class="collapse " aria-labelledby="headingUtilities" style="">

        <?php else :  ?>

          <a class="nav-link collapsed" href="<?= base_url($m['url']); ?>" data-toggle="collapse" data-target="#<?= $m['name']  ?>" aria-expanded="false" aria-controls="menu">
            <i class="<?= $m['icon']; ?>"></i>
            <span> <b> <?= $m['title'];  ?></b></span>
          </a>

          <div id="<?= $m['name']  ?>" class="collapse " aria-labelledby="headingUtilities" style="">
          <?php endif;  ?>



          <div class="bg-gray-300 py-2 collapse-inner rounded">

            <?php


            $subMenu = $this->User_sub_menu_m->get_submenu_by_menu($m['id']);


            //   $querySubMenu = "SELECT usm.id,
            //   usm.menu_id ,
            //   usm.title  as title_usm,
            //   usm.url,
            //   usm.is_active ,
            //   usm.icon,
            //   um.id as id_m,
            //   um.title,
            //   um.url as url_m,
            //   um.name 
            //  FROM   user_sub_menu  usm
            //  Left JOIN  user_menu um on usm.menu_id = um.id WHERE  usm.menu_id = '{$menuId}' and usm.is_active = 1
            //           ORDER BY usm.id  asc";

            //   $subMenu = $this->db->query($querySubMenu)->result_array();


            ?>



            <?php foreach ($subMenu as $sm) :   ?>

              <?php if ($title == $sm['title']) :   ?>

                <a class="collapse-item active" href="<?= base_url($sm['url']); ?>">
                  <i class="<?= $sm['icon']; ?>"></i>
                <?php else :  ?>

                  <a class="collapse-item" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                  <?php endif;  ?>

                  <small> <b>
                      <?= $sm['title'];  ?>

                    </b></small>
                  </a>





                <?php endforeach;  ?>


          </div>
          </div>



    </li>


  <?php endforeach;  ?>


  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('Auth/Logout'); ?>">
      <i class="fas  fa-fw fa-sign-out-alt"></i>
      <span> <b> Logout </b></span> </a>
  </li>

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->