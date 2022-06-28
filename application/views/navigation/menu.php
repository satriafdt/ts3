<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


  <?= form_error('title', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('url', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('icon', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>

  <div class="card card-solid">
    <div class="card-body">

      <div class="row">


        <div class="col-md">


          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal"><i class="fas fa-folder-plus"></i> Add Menu</a>


          <div class="card-body">
            <div class="table-responsive">


              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">


                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">URL</th>
                    <th scope="col" class="text-center">Icon</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="text-center">Active</th>
                    <th scope="col" class="text-center">Seq No</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($menu as $m) :  ?>
                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td><?= $m['title'];  ?></td>
                      <td><?= $m['url'];  ?></td>
                      <td class="text-center"><i class="<?= $m['icon'];  ?>"></i> </td>
                      <td><?= $m['name'];  ?></td>
                      <td class="text-center"><?= $m['is_active'];  ?></td>
                      <td class="text-center"><?= $m['seq_no'];  ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#EditMenuModal<?= $m['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Navigation/Menu_delete/<?= $m['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This Menu ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>

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
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Navigation/Menu'); ?>" method="post">

          <div class="form-group">

            <input type="text" class="form-control" id="title" name="title" placeholder="Title Menu">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" placeholder="URL Name">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon Menu">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name Menu">
          </div>



          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
              <label class="form-check-label" for="is_active">
                Active
              </label>
            </div>
          </div>

          <div class="form-group">
            <input type="number" class="form-control" id="seq_no" name="seq_no" placeholder="Sequence No">
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
foreach ($menu as $m) : $no++;  ?>


  <div class="modal fade" id="EditMenuModal<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditMenuModalLabel">Edit Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="  <?= base_url(); ?>Navigation/Menu_edit/" method="post">

            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $m['id']; ?>">
              <input type="text" class="form-control" id="title" name="title" placeholder="Title Menu" value="<?= $m['title']; ?>">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="url" name="url" placeholder="URL Name" value="<?= $m['url']; ?>">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon Menu" value="<?= $m['icon']; ?>">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name Menu" value="<?= $m['name']; ?>">
            </div>

            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                <label class="form-check-label" for="is_active">
                  Active
                </label>
              </div>
            </div>

            <div class="form-group">
              <input type="number" class="form-control" id="seq_no" name="seq_no" placeholder="Sequence No" value="<?= $m['seq_no']; ?>">
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