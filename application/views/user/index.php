<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <?= $this->session->flashdata('message'); ?>

  <div class="row ">
    <div class="col">
      <div class="card mb-3" style="max-width: 880px; ">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile/') . $user['img_user']; ?>" class="card-img" alt="...">
          </div>
          <div class="col-md-5">
            <div class="card-body">
              <h5 class="card-title"><?= $profile['name'];  ?></h5>
              <p class="card-text"><?= $profile['role'];  ?></p>
              <p class="card-text"><?= $profile['email'];  ?></p>
              <p class="card-text"><small class="text-muted">Member since <?= $profile['created_at'];  ?></small></p>
            </div>

          </div>
          <div class="col-md-3">
            <div class="card-body">
              <div class="btn-group-vertical btn-group-md" role="group" aria-label="Basic example">
                <a href="<?= base_url(); ?>User/Edit/" class="btn btn-info btn-sm mb-3">Edit Profile</a>
                <a href="<?= base_url(); ?>User/Change_Password/" class="btn btn-primary btn-sm mb-3">Change Password</a>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>


  </div>



</div>



</div>