<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


  <div class="card card-solid">
    <div class="card-body">



      <div class="row">


        <div class="col-lg">

          <?php if (validation_errors()) : ?>

            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?>
            </div>
          <?php endif  ?>

          <?= $this->session->flashdata('message'); ?>
          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-folder-plus"></i> Add Submenu</a>


          <div class="card-body">
            <div class="table-responsive">


              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Url</th>
                    <th scope="col" class="text-center">Icon</th>
                    <th scope="col" class="text-center">Active</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($subMenu as $sm) :  ?>
                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td><?= $sm['title'];  ?></td>
                      <td><?= $sm['titleMenu'];  ?></td>
                      <td><?= $sm['url'];  ?></td>
                      <td class="text-center"><i class="<?= $sm['icon'];  ?>"></i> </td>
                      <td class="text-center"><?= $sm['is_active'];  ?></td>
                      <td class="text-center">

                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Navigation/Submenu_delete/<?= $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('Delete This Sub Menu ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>





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

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Navigation/SubMenu'); ?>" method="post">
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
          </div>

          <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control">
              <option value="" hidden>Select Menu</option>

              <?php foreach ($menu as $m) :   ?>
                <option value="<?= $m['id']; ?>"> <?= $m['name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu Url">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon">
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




<?php $no = 0;
foreach ($subMenu as $sm) : $no++;  ?>



  <!-- Modal  EDIT-->
  <div class="modal fade" id="editSubMenuModal<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSubMenuModalLabel">Edit Sub Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('Navigation/SubMenu_edit/'); ?>" method="post">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $sm['id']; ?>">
              <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title" value="<?= $sm['title']; ?>">
            </div>

            <div class="form-group">
              <select name="menu_id" id="menu_id" class="form-control">
                <option value="" hidden>Select Menu</option>
                <?php foreach ($menu as $m) :   ?>
                  <option value="<?= $m['id']; ?>" <?php if (trim($sm['menu_id']) == $m['id']) {
                                                      echo "selected";
                                                    } ?>> <?= $m['name'];  ?></option>
                <?php endforeach;   ?>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="url" name="url" placeholder="Submenu Url" value="<?= $sm['url']; ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon" value="<?= $sm['icon']; ?>">
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
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>


        </form>

      </div>
    </div>
  </div>

<?php endforeach;  ?>