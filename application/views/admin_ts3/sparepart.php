<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= form_error('sparepart_name', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('qty_type', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('qty', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          <div class="row ">
            <div class="col-md text-right">
              <a href="" class="btn btn-info mb-3" data-toggle="modal" data-target="#newDataModal"><i class="fas fa-plus-circle"></i> Tambah Data</a>
            </div>
          </div>
          <div class="card-body table-responsive pad">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Sparepart</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($dtSparepart as $dt) :  ?>
                    <tr>
                      <td scope="row"> <?= $i++; ?></td>
                      <td><?= $dt['sparepart_name']; ?></td>
                      <td>
                        <?php if ($dt['harga'] != null) : ?>
                          <?= $dt['harga']; ?>
                        <?php else : ?>
                          <i>NULL</i>
                        <?php endif; ?>
                      </td>
                      <td><?= $dt['qty']; ?> <?= $dt['qty_type']; ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#EditDataModal<?= $dt['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                      </td>
                    </tr>
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

<!-- MODAL ADD -->
<div class="modal fade" id="newDataModal" tabindex="-1" role="dialog" aria-labelledby="newDataModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newDataModalLabel">Tambah Data Sparepart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Admin_ts3/SparepartAdd'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group row">
            <label for="sparepart_name" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm" id="sparepart_name" name="sparepart_name" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="qty_type" class="col-sm-3 col-form-label">Satuan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm" id="qty_type" name="qty_type" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="sparepart_name" class="col-sm-3 col-form-label">Jumlah</label>
            <div class="col-sm-9">
              <input type="number" class="form-control form-control-sm" id="qty" name="qty" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<?php $no = 0;
foreach ($dtSparepart as $dt) : $no++; ?>
  <div class="modal fade" id="EditDataModal<?= $dt['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditDataModalLabel">Edit Sparepart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url(); ?>Admin_ts3/SparepartEdit/" method="post">
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" class="form-control" id="id" name="id" value="<?= $dt['id']; ?>">
              <input type="text" class="form-control" id="sparepart_name" name="sparepart_name" placeholder="Nama Sparepart" value="<?= $dt['sparepart_name']; ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= $dt['harga']; ?>">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="qty_type" name="qty_type" placeholder="Nama Bengkel" value="<?= $dt['qty_type']; ?>">
            </div>
            <div class="form-group">
              <input type="number" class="form-control" id="qty" name="qty" placeholder="Nama Bengkel" value="<?= $dt['qty']; ?>">
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

<?php $this->load->view('templates/footer'); ?>