<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


  <?= $this->session->flashdata('message'); ?>
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Tambah Data</a> -->
          <div class="card-body table-responsive pad">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Plat No</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Service Terakhir</th>
                    <th scope="col">Status</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($dtService as $dt) :  ?>
                    <tr>
                      <td scope="row"> <?= $i++; ?></td>
                      <td><?= $dt['no_polisi']; ?></td>
                      <td><?= $dt['merk_kendaraan']; ?></td>
                      <td><?= date('d-m-Y', strtotime($dt['last_service_date'])); ?></td>
                      <td><?= $dt['status']; ?></td>
                      <td class="text-center">
                        <a href="<?= base_url(); ?>Bengkel/FormServiceProcess/<?= $dt['id']; ?>" class="badge badge-success">Proses</a>
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