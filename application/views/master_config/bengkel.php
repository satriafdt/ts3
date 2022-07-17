<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= form_error('nama_bengkel', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('regional_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('area_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('branch_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>

  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          <div class="row ">
            <div class="col-md text-right">
              <a href="" class="btn btn-info mb-3 mr-4" data-toggle="modal" data-target="#newBengkelModal"><i class="fas fa-plus-circle"></i> Tambah Data</a>
            </div>
          </div>
          <div class="card-body table-responsive pad">
            <div class="table-responsive">
              <table class="table table-hover text-nowrap" id=" dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Bengkel</th>
                    <th scope="col" class="text-center">Cabang</th>
                    <th scope="col" class="text-center">Area</th>
                    <th scope="col" class="text-center">Regional</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($bengkel as $dt) :  ?>
                    <tr>
                      <td scope="row" class="text-center"> <?= $i; ?></td>
                      <td class="text-left"> <?= $dt['nama_bengkel'];  ?></td>
                      <td class="text-left"> <?= $dt['regional_name'];  ?></td>
                      <td class="text-left"> <?= $dt['area_name'];  ?></td>
                      <td class="text-center"><?= $dt['branch_name'];  ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#EditBengkelModal<?= $dt['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Master_Config/Bengkel_Delete/<?= $dt['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This Bengkel ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
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
<div class="modal fade" id="newBengkelModal" tabindex="-1" role="dialog" aria-labelledby="newBengkelModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newBengkelModalLabel">Add New Bengkel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Master_Config/Bengkel_list'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="nama_bengkel" name="nama_bengkel" placeholder="Nama Bengkel">
          </div>
          <div class="form-group">
            <select name="regional_id" id="area_id" class="form-control">
              <option value="" hidden>Select Regional</option>
              <?php foreach ($regional as $dt) :   ?>
                <option value="<?= $dt['id']; ?>"> <?= $dt['regional_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>
          <div class="form-group">
            <select name="area_id" id="area_id" class="form-control">
              <option value="" hidden>Select Area</option>
              <?php foreach ($area as $dt) :   ?>
                <option value="<?= $dt['id']; ?>"> <?= $dt['area_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>
          <div class="form-group">
            <select name="branch_id" id="area_id" class="form-control">
              <option value="" hidden>Select Branch</option>
              <?php foreach ($branch as $dt) :   ?>
                <option value="<?= $dt['id']; ?>"> <?= $dt['branch_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
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
foreach ($bengkel as $b) : $no++; ?>
  <div class="modal fade" id="EditBengkelModal<?= $b['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditBengkelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditBengkelModalLabel">Edit Bengkel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>Master_Config/Bengkel_Edit/" method="post">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $b['id']; ?>">
              <input type="text" class="form-control" id="nama_bengkel" name="nama_bengkel" placeholder="Nama Bengkel" value="<?= $b['nama_bengkel']; ?>">
            </div>
            <div class="form-group">
              <select name="regional_id" id="regional_id" class="form-control">
                <option value="" hidden>Select Regional</option>
                <?php foreach ($regional as $a) :   ?>
                  <option value="<?= $a['id']; ?>" <?php
                                                    if (trim($b['regional_id']) == $a['id']) {
                                                      echo "selected";
                                                    } ?>>
                    <?= $a['regional_name'];  ?>
                  </option>
                <?php endforeach;   ?>
              </select>
            </div>
            <div class="form-group">
              <select name="area_id" id="area_id" class="form-control">
                <option value="" hidden>Select Area</option>
                <?php foreach ($area as $a) :   ?>
                  <option value="<?= $a['id']; ?>" <?php
                                                    if (trim($b['area_id']) == $a['id']) {
                                                      echo "selected";
                                                    } ?>>
                    <?= $a['area_name'];  ?>
                  </option>
                <?php endforeach;   ?>
              </select>
            </div>
            <div class="form-group">
              <select name="branch_id" id="branch_id" class="form-control">
                <option value="" hidden>Select Branch</option>
                <?php foreach ($branch as $c) :   ?>
                  <option value="<?= $c['id']; ?>" <?php if (trim($b['branch_id']) == $c['id']) {
                                                      echo "selected";
                                                    } ?>> <?= $c['branch_name'];  ?>
                  </option>
                <?php endforeach;   ?>
              </select>
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