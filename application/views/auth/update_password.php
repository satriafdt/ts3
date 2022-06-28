<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-lg-7">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">

            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <img src="<?php echo base_url('assets'); ?>/image/1.png" width="250" height="250" class="img-fluid" alt="">

                  <h1 class="h5 text-gray-900 mt-2">Change Your Password for <?= $user['email']; ?>!!!</h1>

                  <h5 class="mb-4"> <?= $this->session->userdata('reset_email');  ?></h5>
                </div>
                <?= $this->session->flashdata('message'); ?>

                <form class="user" method="post" action="<?= base_url('Auth/Update_Password'); ?>">
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password1" placeholder="Enter new password " name="password1" value="">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password2" placeholder="Repeat password " name="password2" value="">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>


                  <button type="submit" class="btn btn-info btn-user btn-block">
                    Update Password
                  </button>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>