<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= form_error('client_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('area_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('branch_name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>

  <div class="card card-solid">
    <div class="card-body">

      <div class="row">


        <div class="col-md">

          <div class="row ">
            <div class="col-md text-right">
              <a href="" class="btn btn-info mb-3 mr-4" data-toggle="modal" data-target="#newBranchModal"><i class="fas fa-user-plus"></i> Add New Branch</a>
            </div>
          </div>

          <div class="card-body table-responsive pad">
            <div class="table-responsive">



              <table class="table table-hover text-nowrap" id=" dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Branch Name</th>
                    <th scope="col" class="text-center">Area Name</th>
                    <th scope="col" class="text-center">Client Name</th>
                    <th scope="col" class="text-center">Active</th>
                    <th scope="col" class="text-center">Create Date</th>
                    <th scope="col" class="text-center">Update Date</th>
                    <th scope="col" class="text-center">User Update</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($branch as $b) :  ?>

                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td class="text-left"> <?= $b['branch_name'];  ?></td>
                      <td class="text-left"> <?= $b['area_name'];  ?></td>
                      <td class="text-left"> <?= $b['client_name'];  ?></td>
                      <td class="text-center"><?= $b['is_active'];  ?></td>
                      <td><?= $b['create_date'];  ?></td>
                      <td><?= $b['update_date'];  ?></td>
                      <td><?= $b['user_update'];  ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#EditBranchModal<?= $b['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Master_Config/Branch_Delete/<?= $b['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This Branch ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                      </td>

                    </tr>
                    <?php $i++;  ?>
                  <?php endforeach;  ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>



    </div>

  </div>

</div>

</div>



<!-- Modal ADD -->
<div class="modal fade" id="newBranchModal" tabindex="-1" role="dialog" aria-labelledby="newBranchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newBranchModalLabel">Add New Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Master_Config/Branch_Client'); ?>" method="post">

          <div class="form-group">
            <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Branch Name">
          </div>

          <div class="form-group">
            <select name="area_id" id="area_id" class="form-control">
              <option value="" hidden>Select Area</option>

              <?php foreach ($area as $a) :   ?>
                <option value="<?= $a['id']; ?>"> <?= $a['area_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>


          <div class="form-group">
            <select name="client_id" id="client_id" class="form-control">
              <option value="" hidden>Select Client</option>

              <?php foreach ($client as $c) :   ?>
                <option value="<?= $c['id']; ?>"> <?= $c['client_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
              <label class="form-check-label" for="is_active">
                Active
              </label>
            </div>
          </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>


      </form>

    </div>
  </div>
</div>





<!-- Modal EDIT -->

<?php $no = 0;
foreach ($branch as $b) : $no++;  ?>


  <div class="modal fade" id="EditBranchModal<?= $b['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditBranchModalLabel">Edit Branch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="  <?= base_url(); ?>Master_Config/Branch_Edit/" method="post">

            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $b['id']; ?>">
              <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Branch Name" value="<?= $b['branch_name']; ?>">
            </div>

            <div class="form-group">
              <select name="area_id" id="area_id" class="form-control">
                <option value="" hidden>Select Area</option>
                <?php foreach ($area as $a) :   ?>
                  <option value="<?= $a['id']; ?>" <?php if (trim($b['area_id']) == $a['id']) {
                                                      echo "selected";
                                                    } ?>> <?= $a['area_name'];  ?></option>
                <?php endforeach;   ?>
              </select>
            </div>


            <div class="form-group">
              <select name="client_id" id="client_id" class="form-control">
                <option value="" hidden>Select Client</option>
                <?php foreach ($client as $c) :   ?>
                  <option value="<?= $c['id']; ?>" <?php if (trim($b['client_id']) == $c['id']) {
                                                      echo "selected";
                                                    } ?>> <?= $c['client_name'];  ?></option>
                <?php endforeach;   ?>
              </select>
            </div>


            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                <label class="form-check-label" for="is_active">
                  Active
                </label>
              </div>
            </div>


        </div>
        <div class=" modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>


        </form>

      </div>
    </div>
  </div>

<?php endforeach;  ?>