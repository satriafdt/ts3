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
              <input type="number" class="form-control form-control-sm" id="km_kendaraan" name="km_kendaraan" value="<?= $dtService['km_kendaraan']; ?>" readonly required>
            </div>
          </div>
          <div class="form-group row">
            <label for="nama_mekanik" class="col-sm-4 col-form-label">Mekanik</label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="nama_mekanik" name="nama_mekanik" value="<?= $dtService['nama_mekanik']; ?>" readonly required>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="col-sm-12">
            <div class="table-responsive">
              <div class="text-right">
                <!-- <a href="" class="btn btn-sm btn-info mb-3" data-toggle="modal" data-target="#newMenuModal">Tambah Jenis</a> -->
              </div>
              <table class="table table-bordered" width="100%" cellspacing="0" data-searching="false" data-paging="false" data-info="false">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Jenis</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Status</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php foreach ($dtServiceDetail as $dt) :  ?>
                    <tr>
                      <td><?= $dt['type_name']; ?></td>
                      <td><?= $dt['description']; ?></td>
                      <td><?= $dt['service_status']; ?></td>
                      <td><?= $dt['amount']; ?></td>

                    </tr>
                  <?php endforeach;  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="text-right">
            <a href="" class="btn btn-sm btn-info float-right mb-3" data-toggle="modal" data-target="#newMenuModal">Request</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Keterangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Bengkel/BengkelRequestInvoice/' . $dtService['id']); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">Total (Rp)</label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm" id="amount" name="amount" value="<?= $dtAmmount; ?>" readonly required>
              <input type="hidden" id="approval_id" name="approval_id" value="<?= $dtApprvID; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="img_invoice" class="col-sm-3 col-form-label">Upload Bukti</label>
            <div class="col-sm-9">
              <input type="file" class="form-control-file form-control-sm" id="img_invoice" name="img_invoice" accept="image/jpeg" required><br>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-sm btn-primary">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>


</div>
<?php $this->load->view('templates/footer'); ?>