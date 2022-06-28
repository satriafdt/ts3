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
                ADMIN TS3</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">1</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-tie fa-2x text-gray-300"></i>
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
                ADMIN CLIENT</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-check fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                PIC CLIENT</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-edit fa-2x text-gray-300"></i>
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
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                BENGKEL</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">8</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-cog fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>






  </div>

  <?= $this->session->flashdata('message'); ?>
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-lg">

          <div class="row ">
            <div class="col-md text-right">
              <a href="<?= base_url(); ?>User_Manage/Add_user" class="btn btn-info mb-3 mr-4"><i class="fas fa-user-plus"></i> Add New User </a>
            </div>
          </div>
          <div class="card-body table-responsive pad">
            <div class="table-responsive">


              <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" data-order='[[ 3, "desc" ]]'>

                <thead class="thead-dark">

                  <th scope="col" class="text-center">Nama</th>
                  <th scope="col" class="text-center">Email</th>
                  <th scope="col" class="text-center">Role</th>
                  <th scope="col" class="text-center">Date Create</th>
                  <th scope="col" class="text-center">Active</th>

                  <th scope="col">Action</th>


                </thead>
                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($users as $u) :  ?>
                    <tr>

                      <td><?= $u['name'];  ?> </td>
                      <td><?= $u['email'];  ?> </td>
                      <td><?= $u['role'];  ?> </td>
                      <td><?= $u['created_at'];  ?> </td>
                      <td class="text-center"><?= $u['is_active'];  ?> </td>

                      <td class="text-center">
                        <a href="<?= base_url(); ?>User_Manage/Edit_user/<?= $u['id']; ?>" class="badge badge-success"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>User_Manage/Delete_user/<?= $u['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This User ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
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