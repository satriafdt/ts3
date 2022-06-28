<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center mt-4">

    <div class="col-lg-7">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row mt-4">

            <div class="col-lg">
              <div class="p-5">
                <div class="text-center mb-4">
                  <img src="<?php echo base_url('assets'); ?>/image/1.png" width="250" height="250" class="img-fluid" alt="">

                </div>
                <?= $this->session->flashdata('message'); ?>

                <form class="user" method="post" action="<?= base_url('Auth/Forgot_password'); ?>">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="email" placeholder="Enter Email user..." name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>


                  <button type="submit" class="btn btn-info btn-user btn-block">
                    <b>Reset Password </b>
                  </button>

                </form>
                <hr>

                <div class="text-center">
                  <a class="small" href="<?= base_url(); ?>Auth">Back To Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>