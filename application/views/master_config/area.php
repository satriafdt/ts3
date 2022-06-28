<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <?= form_error('client_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('regional_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('area_name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>

  <div class="card card-solid">
    <div class="card-body">
      <div class="row">


        <div class="col-md">


          <div class="row ">
            <div class="col-md text-right">
              <a href="" class="btn btn-info mb-3 mr-4" data-toggle="modal" data-target="#newAreaModal"><i class="fas fa-user-plus"></i> Add New Area</a>
            </div>
          </div>

          <div class="card-body table-responsive pad">
            <div class="table-responsive">



              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Area</th>
                    <th scope="col" class="text-center">Regional</th>
                    <th scope="col" class="text-center">Client</th>
                    <th scope="col" class="text-center">Active</th>
                    <th scope="col" class="text-center">Create Date</th>
                    <th scope="col" class="text-center">Update Date</th>
                    <th scope="col" class="text-center">User Update</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($area as $a) :  ?>

                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td class="text-left"> <?= $a['area_name'];  ?></td>
                      <td class="text-left"> <?= $a['regional_name'];  ?></td>
                      <td class="text-left"> <?= $a['client_name'];  ?></td>
                      <td class="text-center"><?= $a['is_active'];  ?></td>
                      <td><?= $a['create_date'];  ?></td>
                      <td><?= $a['update_date'];  ?></td>
                      <td><?= $a['user_update'];  ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#EditAreaModal<?= $a['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Master_Config/Area_Delete/<?= $a['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This Area ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
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
<div class="modal fade" id="newAreaModal" tabindex="-1" role="dialog" aria-labelledby="newAreaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newAreaModalLabel">Add New Area</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Master_Config/Area_Client'); ?>" method="post">

          <div class="form-group">
            <input type="text" class="form-control" id="area_name" name="area_name" placeholder="Area Name">
          </div>

          <div class="form-group">
            <select name="regional_id" id="regional_id" class="form-control">
              <option value="" hidden>Select Regional</option>

              <?php foreach ($regional as $r) :   ?>
                <option value="<?= $r['id']; ?>"> <?= $r['regional_name'];  ?></option>
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
foreach ($area as $a) : $no++;  ?>


  <div class="modal fade" id="EditAreaModal<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditAreaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditAreaModalLabel">Edit Area</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="  <?= base_url(); ?>Master_Config/Area_Edit/" method="post">

            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $a['id']; ?>">
              <input type="text" class="form-control" id="area_name" name="area_name" placeholder="Area Name" value="<?= $a['area_name']; ?>">
            </div>

            <div class="form-group">
              <select name="regional_id" id="regional_id" class="form-control">
                <option value="" hidden>Select Regional</option>
                <?php foreach ($regional as $r) :   ?>
                  <option value="<?= $r['id']; ?>" <?php if (trim($a['regional_id']) == $r['id']) {
                                                      echo "selected";
                                                    } ?>> <?= $r['regional_name'];  ?></option>
                <?php endforeach;   ?>
              </select>
            </div>


            <div class="form-group">
              <select name="client_id" id="client_id" class="form-control">
                <option value="" hidden>Select Client</option>
                <?php foreach ($client as $c) :   ?>
                  <option value="<?= $c['id']; ?>" <?php if (trim($a['client_id']) == $c['id']) {
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