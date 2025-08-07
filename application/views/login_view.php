<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Ferroelectro - Login</title>

      <!-- Favicon -->
      <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">
      <!-- These two are what you want to use by default -->
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/apple-touch-icon.png') ?>">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/images/apple-touch-icon-precomposed.png') ?>">

    <!-- This one works for anything below iOS 4.2 -->
    <link rel="apple-touch-icon-precomposed apple-touch-icon" href="<?= base_url('assets/images/apple-touch-icon-precomposed.png') ?>">
      <link rel="stylesheet" href="<?= base_url('assets/login/css/backend.css?v=1.0.0') ?>">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	  <link rel="stylesheet" href="<?= base_url('assets/login/css/login.css') ?>">
	</head>
  <body id="loginbody" class=" ">
    <!-- loader Start -->
    <!-- <div id="loading">
          <div id="loading-center">
          </div>
    </div> -->
    <!-- loader END -->

      <div class="wrapper">
      <section class="login-content">
         <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
               <div class="col-md-4 col-sm-8">
                  <div class="card loginshadow animate__animated animate__flipInX">
                     <div class="card-body">
                        <div class="auth-logo">
                           <img src="<?= base_url('assets/images/logoblack.png') ?>" class="img-fluid rounded-normal" alt="logo">
                        </div>
						      <hr>
                        <form method="POST">
                        <?php
                        if($msg == "error"){
                        ?>
                        <div class="alert alert-danger fade show" role="alert">
                           <i class="uil uil-exclamation-octagon me-2"></i>
                           Su usuario o contraseña es incorrecta!
                        </div>
                        <?php
                        }
                        ?>
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label>Usuario</label>
                                    <input class="form-control" type="text" name="username" placeholder="Ingresar usuario" required="true" autocomplete="off">
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="form-control" type="password" name="password" placeholder="********" required="true" autocomplete="off">
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex justify-content-between align-items-center">
                              <button type="submit" name="login" class="btn btn-block btn-dark">ENTRAR</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </div>

    <!-- Backend Bundle JavaScript -->
    <script src="<?= base_url('assets/js/backend-bundle.min.js') ?>"></script>
    <!-- app JavaScript -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
