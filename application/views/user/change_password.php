<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>






  <div class="row">

    <div class="col-lg-6">
      <?= $this->session->flashdata('message'); ?>
      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('User/Change_Password'); ?>" method="post">

            <div class="form-group">
              <label for="current_password">Current Password</label>
              <input type="password" class="form-control" id="current_password" name="current_password">
              <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="new_password1">New Password</label>
              <input type="password" class="form-control" id="new_password1" name="new_password1">
              <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="new_password2">Repeat Password</label>
              <input type="password" class="form-control" id="new_password2" name="new_password2">
              <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

            <div class="form-group text-right">
              <a href="<?= base_url(); ?>User" class="btn btn-warning">
                <i class="fas fa-arrow-alt-circle-left"></i> Back
              </a>
              <button type="submit" class="btn btn-info"><i class="fas fa-key"></i> Post</button>
            </div>

          </form>


        </div>

      </div>


    </div>

  </div>

</div>



</div>