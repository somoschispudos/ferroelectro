<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Admin Accounts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Pichforest" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">

        <!-- Bootstrap Css -->
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url('assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />

    </head>


    <body>

    <!-- <body data-layout="horizontal"> -->
        <style>
            .auth-img {
                background-image: url(<?= base_url('assets/images/truck.jpeg') ?>) !important;
            }
        </style>

        <div class="authentication-bg min-vh-100">
            <!-- <div class="bg-overlay bg-white"></div> -->
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-lg-10">
                            <div class="py-5">
                                <div class="card auth-cover-card overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <div class="auth-img">
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-lg-6">
                                            <div class="p-4 p-lg-5 bg-dark h-100 d-flex align-items-center justify-content-center">
                                                <div class="w-100">
                                                    <div class="mb-4 mb-md-5">
                                                        <a href="#" class="d-block auth-logo">
                                                            <img src="assets/images/logo-light.png" alt="" style="width: 300px;">
                                                        </a>
                                                    </div>

                                                    <!-- <div class="text-white-50 mb-4">
                                                        <h5 class="text-white">Welcome Back !</h5>
                                                        <p>Sign in to continue to Dashonic.</p>
                                                    </div> -->
                                                    <?php
                                                    if($msg == "error"){
                                                    ?>
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <i class="uil uil-exclamation-octagon me-2"></i>
                                                        Your username or password is incorrect!
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <form method="POST">
                                                        <div class="form-floating form-floating-custom mb-3">
                                                            <input type="text" class="form-control" id="input-username" placeholder="Enter User name" name="username">
                                                            <label for="input-username">Username</label>
                                                            <div class="form-floating-icon">
                                                                <i class="uil uil-users-alt"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-floating form-floating-custom mb-3">
                                                            <input type="password" class="form-control" id="input-password" placeholder="Enter Password" name="password">
                                                            <label for="input-password">Password</label>
                                                            <div class="form-floating-icon">
                                                                <i class="uil uil-padlock"></i>
                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            <button class="btn btn-light w-100" type="submit" name="login">Log In</button>
                                                        </div>

                                                        <!-- <div class="mt-4 text-center">
                                                            <a href="auth-resetpassword-cover.html" class="text-white-50 text-decoration-underline">Forgot your password?</a>
                                                        </div> -->
                                                    </form><!-- end form -->
                                                </div>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end card -->
                                <!-- <div class="mt-5 text-center text-muted">
                                    <p>Don't have an account ? <a href="auth-signup-cover.html" class="fw-medium text-decoration-underline"> Signup </a></p>
                                </div> -->
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center text-muted p-4">
                                <p class="mb-0">&copy; <script>document.write(new Date().getFullYear())</script> Dashonic</p>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            </div>
            <!-- end container -->
        </div>
        <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

    </body>
</html>
