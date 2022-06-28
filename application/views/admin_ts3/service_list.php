<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Open</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-box-open fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Request</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">22</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-hand-holding-heart fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pick up
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">33</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-motorcycle fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Done</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">52</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
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

          <div class="card-body table-responsive pad">
            <div class="table-responsive">


              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">Service No</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">No Polisi</th>
                    <th scope="col" class="text-center">Last Bengekl Service</th>
                    <th scope="col" class="text-center">Request Date</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($dataservice as $a) :  ?>

                    <tr>

                      <td class="text-left"> <?= $a['service_no'];  ?></td>
                      <td class="text-center"> <?= $a['status'];  ?></td>
                      <td><?= $a['no_polisi'];  ?></td>
                      <td><?= $a['last_bengkel_service'];  ?></td>
                      <td><?= $a['request_date'];  ?></td>

                      <td class="text-center">

                        <a href="<?= base_url(); ?>Admin_ts3/Service_View_Detail/<?= $a['id']; ?>" class="badge badge-info "><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" title="View"></i></a>
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