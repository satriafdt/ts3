<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


  <?= form_error('name_sparepart', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>

  <?= form_error('price', '<div class="alert alert-danger alert-dismissible text-sm"><button type="button" class="close text-sm-left" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">


        <div class="col-md ">


          <div class="row ">
            <div class="col-md text-right">
              <a href="" class="btn btn-info mb-3 mr-4" data-toggle="modal" data-target="#newSPModal"><i class="fas fa-folder-plus"></i> Add New Sparepart</a>
            </div>
          </div>

          <div class="card-body table-responsive pad">
            <div class="table-responsive">


              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Sparepart Name</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Merk</th>
                    <th scope="col" class="text-center">Update Date</th>
                    <th scope="col" class="text-center">User Update</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($sparepart as $sp) :  ?>

                    <tr>
                      <th scope="row" class="text-center"> <?= $i; ?></th>
                      <td class="text-left"> <?= $sp['name_sparepart'];  ?></td>
                      <td class="text-center"><?= $sp['price'];  ?></td>
                      <td><?= $sp['merk_motor'];  ?></td>
                      <td><?= $sp['update_date'];  ?></td>
                      <td><?= $sp['user_update'];  ?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#EditSPModal<?= $sp['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                        <a href="<?= base_url(); ?>Master_Config/Sparepart_p_Delete/<?= $sp['id']; ?>" class="badge badge-danger " onclick="return confirm('Delete This Sparepart ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
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




<!-- Modal ADD -->
<div class="modal fade" id="newSPModal" tabindex="-1" role="dialog" aria-labelledby="newSPModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSPModalLabel">Add New Sparepart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Master_Config/Sperpart_p'); ?>" method="post">



          <div class="form-group row">
            <label for="name_sparepart" class="col-sm-4 col-form-label">Nama Sparepart</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="name_sparepart" name="name_sparepart" placeholder="Sparepart Name" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="merk_motor" class="col-sm-4 col-form-label">Merk Motor</label>
            <div class="col-sm-6">
              <select name="merk_motor" id="merk_motor" class="form-control" required>
                <option value="" hidden>Select Merk</option>
                <option value="HONDA">HONDA</option>
                <option value="YAMAHA">YAMAHA</option>
                <option value="SUZUKI">SUZUKI</option>
                <option value="KAWASAKI">KAWASAKI</option>
              </select>

            </div>
          </div>



          <div class="form-group row">
            <label for="price" class="col-sm-4 col-form-label">Harga Sparepart</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="price" name="price" placeholder="harga Sparepart" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>


      </form>

    </div>
  </div>
</div>