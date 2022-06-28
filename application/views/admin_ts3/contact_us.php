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
                    <th scope="col" class="text-center">Nama</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Subject</th>
                    <th scope="col" class="text-center">Date Post</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody class="thead-light">
                  <?php $i = 1;  ?>
                  <?php foreach ($datacontact as $a) :  ?>

                    <tr>

                      <td class="text-left"> <?= $a['nama'];  ?></td>
                      <td class="text-center"> <?= $a['email'];  ?></td>
                      <td><?= $a['subject'];  ?></td>
                      <td><?= $a['date_post'];  ?></td>
                      <td class="text-center">

                        <a href="<?= base_url(); ?>Admin_ts3/Contact_Us_Reply/<?= $a['id']; ?>" class="badge badge-info "><i class="fas fa-reply" data-toggle="tooltip" data-placement="top" title="Reply"></i></a>
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