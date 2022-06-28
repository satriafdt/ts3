<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/fonts/icomoon/style.css" />

    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/owl.carousel.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/sweetalert2.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/auth_assets/css/style.css" />

    <title><?= $title; ?></title>
    <link rel="Shortcut Icon" href="<?php echo base_url('assets'); ?>/img/belife-logo-1.png" />

</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <img src="<?= base_url('assets'); ?>/auth_assets/images/undraw_accept_tasks_re_09mv.svg" alt="Image" class="img-fluid" />

                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4 text-center">
                                <a href="<?= base_url('Home'); ?>">
                                    <img src="<?= base_url('assets'); ?>/auth_assets/images/1.png" alt="Image" class="img-fluid" width="200" height="200" />
                                    <!-- <p class="mb-4">Belife Apps Change Your Life Become Better</p> -->
                                </a>
                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <form action="<?= base_url('Auth'); ?>" method="post">
                                <div class="form-group first">
                                    <label for="email">Username or Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" required />
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required />
                                </div>

                                <div class="d-flex mb-2 align-items-center">
                                    <label class="control control--checkbox mb-0">


                                        <span class="caption">Show Password</span>
                                        <input type="checkbox" onclick="showpassword()" />
                                        <div class="control__indicator"></div>


                                    </label>
                                    <span class="ml-auto"><a href="javascript:void(0)" onclick="location.href='<?= base_url('Auth/Forgot_password'); ?>'" class="forgot-pass">Forgot Password</a></span>
                                </div>

                                <input type="submit" value="Log In" class="btn btn-block btn-light" />

                                <!-- <span class="d-block text-left my-4 text-muted"><a href="javascript:void(0)" onclick="location.href='<?= base_url('Auth/Registration'); ?>'" class="signup-pass">Sign Up</a></span> -->

                                <span class="d-block text-left my-4 text-center text-white">Copyright &copy;<?= date('Y'); ?> PT TS3 Indonesia <i class="fas fa-copyright font-italic ml-2"> JAP</i></span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card card-footer text-center">
            <strong class="text-center">
                Copyright &copy;<?= date('Y'); ?> PT TS3 Indonesia
            </strong>
    </div> -->
    <script src="<?= base_url('assets'); ?>/auth_assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets'); ?>/auth_assets/js/popper.min.js"></script>
    <script src="<?= base_url('assets'); ?>/auth_assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>dist/js/sweetalert2.min.js"></script>
    <script src="<?= base_url('assets'); ?>/auth_assets/js/main.js"></script>
    <script>
        function showpassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>


</html>