<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"> Form <?= $title; ?></h1>

  <?= form_error('service_status', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('ms_ts_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('description', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('amount', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

  <?= $this->session->flashdata('message'); ?>
  <div class="card">

    <div class="card-body">

      <div class="row">
        <div class="col-lg-6">

          <form action="<?= base_url('Bengkel/BengkelApprovalService/' . $dtService['id']); ?>" method="post">
            <div class="form-group row">
              <label for="service_no" class="col-sm-4 col-form-label">No Servis</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="service_no" name="service_no" value="<?= $dtService['service_no']; ?>" readonly required>

                <input type="hidden" class="form-control form-control-sm" id="asset_id" name="asset_id" value="<?= $dtService['asset_id']; ?>">
                <input type="hidden" class="form-control form-control-sm" id="pic_id" name="pic_id" value="<?= $dtService['pic_id']; ?>">
                <input type="hidden" class="form-control form-control-sm" id="bengkel_id" name="bengkel_id" value="<?= $dtService['bengkel_id']; ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="no_polisi" class="col-sm-4 col-form-label">No Polisi</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="no_polisi" name="no_polisi" value="<?= $dtService['no_polisi']; ?>" readonly required>
              </div>
            </div>
            <div class="form-group row">
              <label for="no_mesin" class="col-sm-4 col-form-label">No Mesin</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="no_mesin" name="no_mesin" value="<?= $dtService['no_mesin']; ?>" readonly required>
              </div>
            </div>
            <div class="form-group row">
              <label for="tahun_kendaraan" class="col-sm-4 col-form-label">Tahun</label>
              <div class="col-sm-8">
                <input type="number" class="form-control form-control-sm" id="tahun_kendaraan" name="tahun_kendaraan" value="<?= $dtService['tahun_kendaraan']; ?>" readonly required>
              </div>
            </div>
            <div class="form-group row">
              <label for="km_kendaraan" class="col-sm-4 col-form-label">KM</label>
              <div class="col-sm-8">
                <input type="number" class="form-control form-control-sm" id="km_kendaraan" name="km_kendaraan" value="<?= $dtService['km_kendaraan']; ?>" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="nama_mekanik" class="col-sm-4 col-form-label">Mekanik</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="nama_mekanik" name="nama_mekanik" required>
              </div>
            </div>
            <div class="form-group row text-right">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-sm btn-info">
                  <i class="fas fa-edit"></i> Simpan
                </button>
              </div>
            </div>
          </form>

        </div>

        <div class="col-lg-6">
          <div class="col-sm-12">
            <div class="table-responsive">
              <div class="text-right">
                <a href="" class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#newMenuModal"><i class="fas fa-folder-plus"></i> Tambah Jenis</a>
              </div>
              <table class="table table-bordered" width="100%" cellspacing="0" data-searching="false" data-info="false">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Jenis</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Status</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php foreach ($dtServiceDetail as $dt) :  ?>
                    <tr>
                      <td><?= $dt['type_name']; ?></td>
                      <td><?= $dt['description']; ?></td>
                      <td><?= $dt['service_status']; ?></td>
                      <td>
                        <a href="<?= base_url(); ?>Bengkel/DeleteServiceDetail/<?= $dt['id']; ?>/<?= $dtService['id']; ?>" class="badge badge-danger " onclick="return confirm('Apakah anda yakin menghapus data ini?');">
                          <i class="fas fa-trash-alt"></i>
                        </a>
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


<!-- Modal Form ADD -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Tambah Jenis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Bengkel/AddServiceDetail/' . $dtService['id']); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <select name="ms_ts_id" id="ms_ts_id" class="form-control form-control-sm" required>
              <option value="" hidden>Pilih Jenis Servis</option>
              <?php foreach ($dtMSTS as $dt) :   ?>
                <option value="<?= $dt['id']; ?>"> <?= $dt['type_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="description" name="description" placeholder="Deskripsi" required>
          </div>
          <div class="form-group">
            <select name="service_status" id="service_status" class="form-control form-control-sm" required>
              <option value="" hidden>Pilih Status</option>
              <option value="Perbaikan">Perbaikan</option>
              <option value="Penggantian">Penggantian</option>
            </select>
          </div>
          <div class="form-group">
            <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Biaya" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>


</div>
<?php $this->load->view('templates/footer'); ?>