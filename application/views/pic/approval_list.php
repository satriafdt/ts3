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
                    <th scope="col">No Approval</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php foreach ($dtApproval as $dt) :  ?>
                    <tr>
                      <td><?= $dt['approval_no']; ?></td>
                      <td><?= date('d-m-Y', strtotime($dt['approval_date'])); ?></td>
                      <td><?= $dt['approval_status']; ?></td>
                      <td class="text-center">
                        <!-- <a href="" class="badge badge-success" data-toggle="modal" data-target="#EditMenuModal<?= $dt['id']; ?>">edit</a> -->
                        <!-- <a href="<?= base_url(); ?>Pic/PicReqServiceToBengkel/<?= $dt['id']; ?>" class="badge badge-success " onclick="return confirm('Apakah anda yakin?');">Request</a> -->
                        <a href="<?= base_url(); ?>Pic/Detail_Approval/<?= $dt['service_id']; ?>" class="badge badge-success"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
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