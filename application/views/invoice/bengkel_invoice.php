<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <div class="card card-solid">
    <div class="card-body">



      <div class="row">
        <div class="col-lg">
          <div class="card-body table-responsive pad">
            <div class="table-responsive">

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">Invoice No</th>
                    <th scope="col" class="text-center">Service No</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Bengkel</th>
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

                        <a href="<?= base_url(); ?>Invoice/Bengkel_I_Process/<?= $a['id']; ?>" class="badge badge-info "><i class="fas fa-calculator" data-toggle="tooltip" data-placement="top" title="Process"></i></a>
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