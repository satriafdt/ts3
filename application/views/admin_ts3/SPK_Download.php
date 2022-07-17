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
              <a href="<?= base_url(); ?>Admin_ts3/DownloadSPKReport" class="btn btn-info mb-3"><i class="fas fa-download"></i> Download </a>
            </div>
          </div>
          <div class="card-body table-responsive pad">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">SPK</th>
                    <th scope="col">Cabang</th>
                    <th scope="col">Nomor Polisi</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($dtSPK as $dt) :  ?>
                    <tr>
                      <td scope="row"> <?= $i++; ?></td>
                      <td><?= $dt['spk']; ?></td>
                      <td><?= $dt['branch']; ?></td>
                      <td><?= $dt['nomor_polisi']; ?></td>
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

<?php $this->load->view('templates/footer'); ?>