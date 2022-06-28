<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= form_error('type_name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">


        <div class="col-md">


          <div class="row ">
            <div class="col-md text-right">
              <a href="" class="btn btn-info mb-3 mr-4" data-toggle="modal" data-target="#newAreaModal"><i class="fas fa-user-plus"></i> Add New Type Service</a>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">



              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Type Name</th>
                    <th scope="col" class="text-center">Active</th>
                    <th scope="col" class="text-center">Create Date</th>
                    <th scope="col" class="text-center">Update Date</th>
                    <th scope="col" class="text-center">User Update</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($type_s as $a) :  ?>

                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td class="text-left"> <?= $a['type_name'];  ?></td>
                      <td class="text-center"> <?= $a['is_active'];  ?></td>
                      <td><?= $a['create_date'];  ?></td>
                      <td><?= $a['update_date'];  ?></td>
                      <td><?= $a['user_update'];  ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#EditTypeService<?= $a['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Master_Config/Type_Service_Delete/<?= $a['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This Type Service ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
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
        <h5 class="modal-title" id="newAreaModalLabel">Add New Type Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Master_Config/Type_Service'); ?>" method="post">

          <div class="form-group">
            <label for="fintech_name">Type Name Service</label>
            <input type="text" class="form-control" id="type_name" name="type_name" oninput="this.value = this.value.toUpperCase()">
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
foreach ($type_s as $a) : $no++;  ?>


  <div class="modal fade" id="EditTypeService<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditTypeServiceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditTypeServiceLabel">Edit Type Service</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="  <?= base_url(); ?>Master_Config/Type_Service_Edit/" method="post">

            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $a['id']; ?>">
              <input type="text" class="form-control" id="type_name" name="type_name" placeholder="Type Name" value="<?= $a['type_name']; ?>">
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