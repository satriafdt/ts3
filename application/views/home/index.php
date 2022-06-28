<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TS3 Indonesia</title>
    <link rel="Shortcut Icon" href="<?php echo base_url('assets'); ?>/image/4.png" />

    <!-- <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/home_asset'); ?>/assets/favicon.ico" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo base_url('assets/home_asset'); ?>/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-2">

            <a class="navbar-brand font-weight-bold" href="#page-top">

                <img src="<?= base_url('assets/image/3.png'); ?>" alt="TS3 Logo" width="40" height="50" class="brand-image mr-2">
                TS3 Indonesia
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mr-2"><a class="nav-link font-weight-bold" href="#about"><i class="fas fa-globe"></i> About</a></li>
                    <li class="nav-item mr-2"><a class="nav-link font-weight-bold" href="#services"><i class="fas fa-handshake"></i> Services</a></li>
                    <li class="nav-item mr-2"><a class="nav-link font-weight-bold" href="#contact"><i class="fas fa-id-card"></i> Contact</a></li>

                    <li class="nav-item"><a class="nav-link font-weight-bold" href="<?php echo base_url('Auth'); ?>"><i class="fas fa-users"></i> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-success bg-gradient text-white">
        <div class="container px-2 text-center">


            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="2500">
                        <img class="d-block w-100 rounded mx-auto d-block" width="300" height="300" src="<?= base_url('assets/image/') ?>undraw_delivery_truck_vt6p.svg" alt="First slide">
                    </div>
                    <div class="carousel-item" data-interval="2500">
                        <img class="d-block w-100 rounded mx-auto d-block" width="300" height="300" src="<?= base_url('assets/image/') ?>undraw_performance_overview_re_mqrq.svg" alt="Second slide">
                    </div>
                    <div class="carousel-item" data-interval="2500">
                        <img class="d-block w-100 rounded mx-auto d-block" width="300" height="300" src="<?= base_url('assets/image/') ?>undraw_personal_data_re_ihde.svg" alt="Third slide">
                    </div>
                    <div class="carousel-item" data-interval="2500">
                        <img class="d-block w-100 rounded mx-auto d-block" width="300" height="300" src="<?= base_url('assets/image/') ?>undraw_pie_graph_re_fvol.svg" alt="Four slide">
                    </div>
                    <div class="carousel-item" data-interval="2500">
                        <img class="d-block w-100 rounded mx-auto d-block" width="300" height="300" src="<?= base_url('assets/image/') ?>undraw_small_town_re_7mcn.svg" alt="Five slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </header>
    <!-- About section-->
    <section id="about" class="text-dark" style="background:transparent url('<?= base_url('assets/image/') ?>undraw_small_town_re_7mcn.svg');background-repeat: no-repeat;background-position: right bottom; background-size: 450px;">
        <div class="container px-2">
            <div class="row gx-2 justify-content-center">
                <div class="col-lg-10">
                    <h2 class="mb-2">About <i class="fas fa-globe"></i></h2>
                    <p class="lead text-justify text-capitalize">PT.TS3 Indonesia (TS3) adalah sebuah perusahaan yang bergerak dibidang penyedia tenaga kerja, building maintenance, Motor Vehicle maintenance,yang memberikan standar pelayanan kerja terbaik dalam pelaksanaan pekerjaan dibidang jasa dan pengembangan sumber daya manusia. Dengan Sumber Daya Manusia yang profesional serta berdedikasi tinggi menjadi nilai tambah bagi perusahaan yang bermitra dengan kami.Sehingga perusahaan mitra/user dapat fokus dalam mengembangkan core business (bisnis inti) PT.TS3 Indonesia (TS3) berdiri sejak 2014 sebagai perusahaan jasa melayani dengan semangat untuk menjadi bagian dari solusi multi service dan kebutuhan sumber daya manusia yang berkualitas bagi perusahaan, dengan mengedepankan service excellent.</p>

                    <ul>
                        <li class="lead text-justify"><b>Vision </b>
                            Menjadi salah satu perusahaan jasa pelayanan multi
                            service terdepan dan ternama di Indonesia.</li>
                        <li class="lead text-justify"><b>Mission </b>
                            Menyediakan pelayanan berkualitas kepada Klien
                            sehingga user/klien dapat memfokuskan diri pada inti
                            bisnis perusahaan, peran serta dalam program
                            pemerintah mengurangi pengangguran dengan
                            memediasi pencari kerja dengan pemberi kerja.</li>
                        <li class="lead text-justify">Total Karyawan PT .TS3 Indonesia : 30 orang</li>
                        <li class="lead text-justify">Total Karyawan Project PT.TS3 Indonesia: 571 Orang</li>

                    </ul>
                    <ul>


                </div>
            </div>
        </div>
    </section>
    <!-- Services section-->
    <section class="bg-success bg-gradient text-white" id="services" class="text-dark">
        <div class="container px-2">
            <div class="row gx-2 justify-content-center">
                <div class="col-lg-10">
                    <h2>Services <i class="fas fa-handshake"></i></h2>
                    <p class="lead text-justify">Kami memberikan solusi pelayanan terbaik mengenai perawatan
                        Gedung, keamanan, kebersihan, parkir area suatu perusahaan,
                        gedung perkantoran, perumahan, pergudangan dan proyek-proyek
                        lainnya.</p>
                    <p class="lead text-justify">
                        Kami juga memberikan service terbaik untuk perawatan dan
                        perbaikan kendaraan bermotor baik perbaikan ditempat bengkel
                        kami ataupun dengan system service motor keliling ke lokasi
                        kendaraan/motor masing-masing (jemput bola).
                        Kami memberikan service rutin secara periodic ataupun kondisional.
                    </p>


                    <ul>
                        <li class="lead text-justify">Building maintenance service</li>
                        <li class="lead text-justify">Motor vehicle maintenance</li>
                        <li class="lead text-justify">Cleaning Service</li>
                        <li class="lead text-justify">Security Services</li>
                        <li class="lead text-justify">Parking Services</li>
                        <li class="lead text-justify">HR- Provider</li>
                    </ul>
                    <h2>Benefits Fot Your Company</h2>
                    <p class="lead text-justify">
                        Dengan bekerjasama dengan kami, perusahaan mitra mendapatkan keuntungan, keuntungan berupa:
                    </p>
                    <ul>
                        <li class="lead text-justify">Proses rekruitmen tenaga kerja menjadi lebih mudah,singkat serta dapat menghemat anggaran</li>
                        <li class="lead text-justify">Mampu menekan biaya operational terkait upah dan fasilitas tenaga kerja</li>
                        <li class="lead text-justify">Perusahaan tidak lagi direpotkan dengan administrasi kepegawaian</li>
                        <li class="lead text-justify">Target perusahaan dapat terpenuhi tepat waktu</li>
                        <li class="lead text-justify">Perusahaan dapat lebih menghemat biaya, seperti pelatihan tenaga kerja karena tenaga kerja outsourcing merupakan tenaga yang sudah ahli dibidangnya.</li>
                        <li class="lead text-justify">Meningkatkan efisiensi dan perbaikan pada pekerjaan-pekerjaan yang sifatnya non-core</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact section-->
    <section id="contact" class=" text-dark mt-2" class="text-dark" style="background:transparent url('<?= base_url('assets/image/') ?>undraw_performance_overview_re_mqrq.svg');background-repeat: no-repeat;background-position: right top; background-size: 300px;">
        <div class="container px-2">
            <div class="row gx-2 justify-content-center">
                <div class="col-lg-10">
                    <h2>Contact us <i class="fas fa-id-card"></i></h2>
                    <div class="row" data-aos="fade-in">

                        <div class="col-md-6 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="info">
                                        <div class="address">

                                            <h5> <i class="fas fa-city"></i> Alamat </h5>
                                            <p> Jl. Imam Bonjol No 47-48, Ruko Metro Square Blok B8, Semarang Kel Pandansari, Kec Semarang Tengah 50139</p>
                                        </div>

                                        <div class="email">

                                            <h5> <i class="fas fa-at"></i> Email </h5>
                                            <p>ts3indonesia@gmail.com</p>
                                        </div>

                                        <div class="phone">

                                            <h5> <i class="fas fa-phone"></i> Telepon | <a href="https://api.whatsapp.com/send?phone=628179557744" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a></h5>

                                            <p>024-43589182 / 024-86400179</p>
                                        </div>



                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d700.0940589316074!2d110.41584627051736!3d-6.9703333908130665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f4ac104eec83%3A0x775d5373cb1894d3!2sMetro%20Plaza%20Imam%20Bonjol%20(formerly%20known%20as%20Metro%20Square)!5e0!3m2!1sid!2sid!4v1654337852878!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?= base_url('Home/Contact_Us_Send') ?>" method="POST" id="kirim">
                                        <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
                                            <strong>Terimakasih !</strong> Pesan anda telah kami terima.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Nama</label>
                                                <input type="text" name="nama" class="form-control" id="name" data-rule="minlen:4" required data-msg="Please enter at least 4 chars" />
                                                <div class="validate"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" data-rule="email" required data-msg="Please enter a valid email" />
                                                <div class="validate"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Subject</label>
                                            <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" required data-msg="Please enter at least 8 chars of subject" />
                                            <div class="validate"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Pesan</label>
                                            <textarea class="form-control" style="overflow:auto;resize:none" name="pesan" rows="11" normalizer_normalize="pesan" data-rule="required" required data-msg="Please write something for us"></textarea>
                                            <div class="validate"></div>
                                        </div>
                                        <div class="text-center"><button type="submit" id="kirim" class="btn btn-info"><i class="fas fa-paper-plane"></i> Kirim</button></div>



                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-3 bg-dark">
        <div class="container px-2">

            <p class="m-0 text-center text-white">Copyright &copy; TS3 <?= date('Y');  ?> Indonesia <i class="fas fa-copyright font-italic ml-2"> JAP</i></p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>
    <script src="<?= base_url('assets/'); ?>bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url('assets/'); ?>ckeditor/ckeditor.js"></script>

    <script src="<?= base_url('assets/'); ?>js/demo/chart-bar-demo.js"></script>
    <script src="<?php echo base_url('assets/home_asset'); ?>/js/scripts.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if ($this->session->flashdata('kirim')) : ?>
        <script type="text/javascript">
            $(document).ready(function() {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Pesan anda telah kami terima',
                    showConfirmButton: false,
                    timer: 2000
                })
            });
        </script>
    <?php endif; ?>
</body>

</html>