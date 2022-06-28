<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Invoice Yang belum Tertagih</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.250.000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


  <div class="card card-solid">
    <div class="card-body">



      <div class="row">


        <div class="col-lg">
          <div class="row ">
            <div class="col-md text-right">
              <a href="<?= base_url(); ?>Invoice/Invoice_C_Create" class="btn btn-info mb-3 mr-4"><i class="fas fa-file-invoice"></i> Create Invoice</a>
            </div>
          </div>
          <div class="card-body table-responsive pad">
            <div class="table-responsive">

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">Invoice No</th>
                    <th scope="col" class="text-center">Service No</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Client</th>
                    <th scope="col" class="text-center">Amount</th>
                    <th scope="col" class="text-center">Invoice Date</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($datainvoice as $a) :  ?>

                    <tr>

                      <td class="text-left"> <?= $a['invoice_no'];  ?></td>
                      <td class="text-center"> <?= $a['service_no'];  ?></td>
                      <td><?= $a['status_invoice'];  ?></td>
                      <td><?= $a['bengkel_name'];  ?></td>
                      <td><?= $a['amount'];  ?></td>
                      <td><?= $a['invoice_date'];  ?></td>
                      <td class="text-center">

                        <a href="<?= base_url(); ?>Invoice/Client_I_Process/<?= $a['id']; ?>" class="badge badge-info "><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
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