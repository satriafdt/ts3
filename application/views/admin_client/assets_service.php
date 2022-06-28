<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= form_error('regional_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('area_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('branch_id', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('no_polisi', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('no_rangka', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('no_mesin', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('tahun_kendaraan', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('tipe_kendaraan', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('merk_kendaraan', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('last_service_date', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('last_bengkel_service', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= form_error('last_km', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>

  <div class="card card-solid">
    <div class="card-body">

      <div class="row">
        <div class="col-md">
          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal"><i class="fas fa-folder-plus"></i> Tambah Data</a>
          <div class="card-body table-responsive pad">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Cabang</th>
                    <th scope="col">Merk</th>
                    <th scope="col">No Polisi</th>
                    <th scope="col">Km Terakhir</th>
                    <th scope="col">Service Terakhir</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($dtAssets as $dt) :  ?>
                    <tr>
                      <td scope="row"> <?= $i++; ?></td>
                      <td><?= $dt['branch_name']; ?></td>
                      <td><?= $dt['merk_kendaraan']; ?></td>
                      <td><?= $dt['no_polisi']; ?></td>
                      <td><?= $dt['last_km']; ?> Km</td>
                      <td><?= date('d-m-Y', strtotime($dt['last_service_date'])); ?></td>
                      <td>
                        <a href="<?= base_url(); ?>Admin_Client/AdminReqToServiceAssets/<?= $dt['id']; ?>" class="badge badge-success " onclick="return confirm('Apakah anda yakin memproses data ini?');"><i class="fas fa-calculator" data-toggle="tooltip" data-placement="top" title="Proses Servis"></i></a>
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

<!-- Modal Form ADD -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('Admin_Client/Assets_service'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <select name="regional_id" id="regional_id" class="form-control form-control-sm" required>
              <option value="" hidden>Select Regional</option>
              <?php foreach ($dtRegional as $dt) :   ?>
                <option value="<?= $dt['id']; ?>"> <?= $dt['regional_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>
          <div class="form-group">
            <select name="area_id" id="area_id" class="form-control form-control-sm" required>
              <option value="" hidden>Select Area</option>
              <?php foreach ($dtArea as $dt) :   ?>
                <option value="<?= $dt['id']; ?>"> <?= $dt['area_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>
          <div class="form-group">
            <select name="branch_id" id="branch_id" class="form-control form-control-sm" required>
              <option value="" hidden>Select Branch</option>
              <?php foreach ($dtBranch as $dt) :   ?>
                <option value="<?= $dt['id']; ?>"> <?= $dt['branch_name'];  ?></option>
              <?php endforeach;   ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="no_polisi" name="no_polisi" placeholder="No Polisi" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="no_rangka" name="no_rangka" placeholder="No Rangka" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="no_mesin" name="no_mesin" placeholder="No Mesin" required>
          </div>
          <div class="form-group">
            <input type="number" class="form-control form-control-sm" id="tahun_kendaraan" name="tahun_kendaraan" placeholder="Tahun Kendaraan" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="tipe_kendaraan" name="tipe_kendaraan" placeholder="Tipe Kendaraan" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="merk_kendaraan" name="merk_kendaraan" placeholder="Merk Kendaraan" required>
          </div>

          <div class="form-group">
            <input type="date" pattern="\d{4}-\d{2}-\d{2}" class="form-control form-control-sm datepicker" id="last_service_date" name="last_service_date" placeholder="Waktu Service Terakhir" required>

            <!-- <div class="input-group date" id="last_service_date" data-target-input="nearest">
              <input type="text" name="last_service_date" class="form-control form-control-sm datetimepicker-input" data-target="#last_service_date" required />
              <div class="input-group-append" data-target="#last_service_date" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div> -->

            <!-- <div class="row mb-4">
              <div class="col col-sm-3 text-left">
                <label for="startdate" class="col col-form-label float-left">Start Date</label>
              </div>
              <div class="col col-sm-3 ">
                <input name="startdate" placeholder=" YYYY-MM-DD" id="startdate" class="form-control datepicker" type="text">
              </div>
            </div> -->
          </div>

          <!-- <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="last_bengkel_service" name="last_bengkel_service" placeholder="Bengkel" required>
          </div> -->
          <div class="form-group">
            <input type="number" class="form-control form-control-sm" id="last_km" name="last_km" placeholder="Km Terakhir" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view('templates/footer'); ?>