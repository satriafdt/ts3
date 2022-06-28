<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="card">
    <div class="card-body">


      <?php foreach ($userdata as $udt) : ?>



        <div class="row">
          <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('User_Manage/Update_user'); ?>

            <div class="form-group row">
              <label for="name" class="col-sm-4 col-form-label">Name</label>
              <div class="col-sm-6">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $udt['id']; ?>">
                <input type="text" class="form-control" id="name" name="name" value="<?= $udt['name']; ?>" readonly>

              </div>
            </div>

            <div class=" form-group row">
              <label for="email" class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="email" name="email" value="<?= $udt['email']; ?>" readonly>

              </div>
            </div>

            <div class="form-group row">
              <label for="client_id" class="col-sm-4 col-form-label">Client</label>
              <div class="col-sm-6">
                <select name="client_id" id="client_id" class="form-control" disabled>
                  <option value="" hidden>Select Client</option>
                  <?php foreach ($client as $c) :   ?>
                    <option value="<?= $c['id']; ?>" <?php if (trim($udt['id_client']) == $c['id']) {
                                                        echo "selected";
                                                      } ?>> <?= $c['client_name'];  ?></option>
                  <?php endforeach;   ?>
                </select>
              </div>
            </div>


            <div class="form-group row">
              <label for="id_role" class="col-sm-4 col-form-label">Role</label>
              <div class="col-sm-6">
                <select name="id_role" id="id_role" class="form-control">
                  <option value="" hidden>Select Role</option>

                  <?php foreach ($role as $r) :   ?>
                    <option value="<?= $r['id']; ?>" <?php if (trim($udt['id_role']) == $r['id']) {
                                                        echo "selected";
                                                      } ?>> <?= $r['role'];  ?></option>
                  <?php endforeach;   ?>
                </select>
              </div>
            </div>






            <div class="form-group row">
              <label for="regional" class="col-sm-4 col-form-label">Regional</label>
              <div class="col-sm-6">
                <select name="regional_id" id="regional_id" class="form-control">
                  <option value="" hidden>Select Regional</option>

                  <?php foreach ($regional as $rg) :   ?>
                    <option value="<?= $rg['id']; ?>" <?php if (trim($udt['regional_id']) == $rg['id']) {
                                                        echo "selected";
                                                      } ?>> <?= $rg['regional_name'];  ?></option>
                  <?php endforeach;   ?>
                </select>
              </div>
            </div>



            <div class="form-group row">
              <label for="area_id" class="col-sm-4 col-form-label">Area</label>
              <div class="col-sm-6">
                <select name="area_id" id="area_id" class="form-control">
                  <option value="" hidden>Select Area</option>

                  <?php foreach ($area as $ar) :   ?>
                    <option value="<?= $ar['id']; ?>" <?php if (trim($udt['area_id']) == $ar['id']) {
                                                        echo "selected";
                                                      } ?>> <?= $ar['area_name'];  ?></option>
                  <?php endforeach;   ?>
                </select>
              </div>
            </div>


            <div class="form-group row">
              <label for="branch_id" class="col-sm-4 col-form-label">Branch</label>
              <div class="col-sm-6">
                <select name="branch_id" id="branch_id" class="form-control">
                  <option value="" hidden>Select Branch</option>

                  <?php foreach ($branch as $b) :   ?>
                    <option value="<?= $b['id']; ?>" <?php if (trim($udt['branch_id']) == $b['id']) {
                                                        echo "selected";
                                                      } ?>> <?= $b['branch_name'];  ?></option>
                  <?php endforeach;   ?>
                </select>
              </div>
            </div>





            <div class="form-group row">
              <label for="is_active" class="col-sm-4 col-form-label">Activated</label>
              <div class="col-sm-6">
                <input class="form-control-right" type="checkbox" value="1" id="is_active" name="is_active" checked>
              </div>
            </div>









            <div class="form-group row text-right">

              <div class="col-sm-10">
                <a href="<?= base_url(); ?>User_Manage/User_List" class="btn btn-warning">
                  <i class="fas fa-arrow-alt-circle-left"></i> Back
                </a>
                <button type="submit" class="btn btn-info">
                  <i class="fas fa-user-edit"></i> Edit
                </button>
              </div>

            </div>





            </form>



          </div>


        </div>
      <?php endforeach;  ?>


    </div>
  </div>























</div>

</div>