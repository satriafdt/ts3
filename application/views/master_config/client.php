<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


  <?= form_error('clientname', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">


        <div class="col-md ">


          <div class="row ">
            <div class="col-md text-right">
              <a href="" class="btn btn-info mb-3 mr-4" data-toggle="modal" data-target="#newClientModal"><i class="fas fa-user-plus"></i> Add New Client</a>
            </div>
          </div>

          <div class="card-body table-responsive pad">
            <div class="table-responsive">


              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Client Name</th>
                    <th scope="col" class="text-center">Is Active</th>
                    <th scope="col" class="text-center">Create Date</th>
                    <th scope="col" class="text-center">Update Date</th>
                    <th scope="col" class="text-center">User Update</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($client as $c) :  ?>

                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td class="text-left"> <?= $c['client_name'];  ?></td>
                      <td class="text-center"><?= $c['is_active'];  ?></td>
                      <td><?= $c['create_date'];  ?></td>
                      <td><?= $c['update_date'];  ?></td>
                      <td><?= $c['user_update'];  ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#EditClientModal<?= $c['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Master_Config/Client_Delete/<?= $c['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This Client ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
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
<div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newClientModalLabel">Add New Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Master_Config/Client'); ?>" method="post">

          <div class="form-group">
            <input type="text" class="form-control" id="clientname" name="clientname" placeholder="Client Name">
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
foreach ($client as $c) : $no++;  ?>


  <div class="modal fade" id="EditClientModal<?= $c['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditClientModalLabel">Edit Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="  <?= base_url(); ?>Master_Config/Client_Edit/" method="post">

            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $c['id']; ?>">
              <input type="text" class="form-control" id="clientname" name="clientname" placeholder="Client Name" value="<?= $c['client_name']; ?>">
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