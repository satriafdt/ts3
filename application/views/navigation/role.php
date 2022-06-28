<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card card-solid">
        <div class="card-body">


            <div class="row">


                <div class="col-sm-6">
                    <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>');  ?>
                    <?= $this->session->flashdata('message'); ?>
                    <a href="" class=" btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal"><i class="fas fa-folder-plus"></i> Add Role</a>


                    <thead class="thead-dark">
                        <div class="table-responsive">


                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Role</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="thead-light">
                                    <?php $i = 1;  ?>
                                    <?php foreach ($role as $r) :  ?>
                                        <tr>
                                            <th scope="row" class="text-center"> <?= $i; ?></th>
                                            <td class="text-center"><?= $r['role'];  ?></td>

                                            <td class="text-center">
                                                <a href="<?= base_url('Navigation/RoleAccess/') . $r['id']; ?>" class="badge badge-warning"><i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top" title="Access"></i></a>
                                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#EditRoleModal<?= $r['id']; ?>"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                                <a href="<?= base_url(); ?>Navigation/Role_delete/<?= $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Delete This Role ?');"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>

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

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Navigation/Roles'); ?>" method="post">
                    <div class="form-group">

                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">

                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
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







<!-- Modal EDIT -->


<?php $no = 0;
foreach ($role as $r) : $no++;  ?>

    <div class="modal fade" id="EditRoleModal<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditRoleModalLabel">edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('Navigation/Role_edit'); ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $r['id']; ?>">
                            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name" value="<?= $r['role']; ?>">

                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>


                </form>

            </div>
        </div>
    </div>
<?php endforeach;  ?>