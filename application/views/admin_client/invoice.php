<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>
<?php $this->load->view('templates/topbar'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
                    <th scope="col">No Invoice</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Status</th>
                    <th scope="col">#</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php foreach ($dtInvoices as $dt) :  ?>
                    <tr>
                      <td><?= $dt['invoice_no']; ?></td>
                      <td><?= $dt['invoice_date']; ?></td>
                      <td><?= $dt['amount']; ?></td>
                      <td><?= $dt['status_invoice']; ?></td>
                      <td class="text-center">
                        <a href="<?= base_url(); ?>Assets_service/AdminProcessInvoice/<?= $dt['id']; ?>" class="badge badge-danger " onclick="return confirm('Apakah anda yakin?');">Request</a>
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