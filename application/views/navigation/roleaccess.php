<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> : <?= $role['role'];  ?></h1>



  <div class="card card-solid">
    <div class="card-body">
      <a href="<?= base_url(); ?>Navigation/Roles" class="btn btn-sm btn-warning">
        <i class="fas fa-arrow-alt-circle-left"></i> Back
      </a>

      <div class="row">


        <div class="col-lg-8">


          <?= $this->session->flashdata('message'); ?>

          <div class="card-body">
            <div class="table-responsive">


              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Menu</th>
                    <th scope="col" class="text-center">Access</th>
                  </tr>
                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($menu as $m) :  ?>
                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td><?= $m['name'];  ?></td>
                      <td class="text-center">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>  ">

                        </div>

            </div>

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