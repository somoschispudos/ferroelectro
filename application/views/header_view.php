<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= 'Ferro⚡Electro .::. ' . $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Dashboard" name="description" />
    <meta content="Dashboard" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">
    <!-- These two are what you want to use by default -->
    <link rel="apple-touch-icon" href="<?= base_url('assets/images/apple-touch-icon.png') ?>">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/images/apple-touch-icon-precomposed.png') ?>">

    <!-- This one works for anything below iOS 4.2 -->
    <link rel="apple-touch-icon-precomposed apple-touch-icon" href="<?= base_url('assets/images/apple-touch-icon-precomposed.png') ?>">

    <!-- gridjs css -->
    <link rel="stylesheet" href="<?= base_url('assets/libs/gridjs/theme/mermaid.min.css') ?>">

    <!-- plugin css -->
    <link href="<?= base_url('assets/libs/jsvectormap/css/jsvectormap.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />

    <link href="<?= base_url('assets/css/spinner.css') ?>" id="app-style" rel="stylesheet" type="text/css" />

    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.5/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.5/dist/js/tom-select.complete.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="<?= base_url('fileupload/font/font-fileuploader.css') ?>" media="all" rel="stylesheet">
    <link href="<?= base_url('fileupload/jquery.fileuploader.min.css') ?>" media="all" rel="stylesheet">
    <!-- <script src="https://kit.fontawesome.com/65f7b954c0.js" crossorigin="anonymous"></script> -->
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.css') ?>">

    <script src="<?= base_url('assets/js/currency.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/login/css/login.css') ?>">

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css"/>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <style>
        label{
            margin-top: 5px;
        }

        .form-check-label{
            margin-top: 0px;
        }

        .caret{
            color: red !important;
        }

		#demo{
			background-color: red;
			padding: 10px;
			color: white;
			text-align: center;
			font-size: 16px;
		}

		@media print
		{
			.no-print, .no-print *
			{
			display: none !important;
			}
		}
    </style>
</head>

<body data-layout="horizontal" data-layout-size="fluid" id="bodyall">
<!-- pay no attention -->
<div id="right-bar-toggle"></div>
<div id="sidebar-setting"></div>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
			<!-- <div id="demo">VERSION DEMO -- NO INGRESAR PRODUCTOS OFICIALES</div> -->
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="<?= base_url() ?>" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?= base_url('assets/images/logoblack.png') ?>" style="width: 250px;">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('assets/images/logoblack.png') ?>" style="width: 250px;">
                            </span>
                        </a>

                        <a href="<?= base_url() ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?= base_url('assets/images/logoblack.png') ?>" style="width: 250px;">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('assets/images/logoblack.png') ?>" style="width: 250px;">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-26 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                </div>

                <div class="d-flex">
                    <div class="dropdown d-inline-block">

                    </div>


                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" style="border: 2px solid #41afc8;" src="<?= base_url('assets/images/users/' . $_SESSION['rol'] . '.jpg') ?>"
                            alt="Header Avatar">
                            <span class="ms-2 d-none d-sm-block user-item-desc">
                                <span class="user-name"><?= $_SESSION['nombre'] ?></span>
                                <span class="user-sub-title">
                                    <?php
                                    echo $_SESSION['rolname'];
                                    ?>
                                </span>
                            </span>
                        </button>

                    </div>
                </div>
            </div>
            <div class="topnav">
                <div class="container-fluid">
                    <!-- this menu is only for admin -->
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">
                                <li class="nav-item <?= ($title == 'Dashboard')?'active':'' ?>">
                                    <a class="nav-link arrow-none <?= ($title == 'Dashboard')?'active':'' ?>" href="<?= base_url('dashboard') ?>">
                                        <i class="fa-duotone fa-house"></i>
                                        <span data-key="t-horizontal">Dashboard</span>
                                    </a>
                                </li>
                                <?php
                                if($_SESSION['rol'] == 1){
                                ?>
                                <li class="nav-item dropdown <?= ($title == 'Administración')?'active':'' ?>">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-duotone fa-briefcase"></i>
                                        <span data-key="t-dashboards">Administración</span>
                                        <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                        <a href="<?= base_url('administracion/usuarios') ?>" class="dropdown-item">Usuarios</a>
                                        <a href="<?= base_url('administracion/proveedores') ?>" class="dropdown-item">Proveedores</a>
                                        <a href="<?= base_url('administracion/clientes') ?>" class="dropdown-item">Clientes</a>
                                        <a href="<?= base_url('administracion/productos') ?>" class="dropdown-item">Productos</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown <?= ($title == 'Configuración')?'active':'' ?>">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-duotone fa-gear"></i>
                                        <span data-key="t-dashboards">Configuración</span>
                                        <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                        <a href="<?= base_url('configuracion/categorias') ?>" class="dropdown-item">Categorías</a>
                                        <a href="<?= base_url('configuracion/marcas') ?>" class="dropdown-item">Marcas</a>
                                        <!-- <a href="<?= base_url('configuracion/tipo_documento') ?>" class="dropdown-item">Tipo de documento</a> -->
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-duotone fa-scanner-keyboard"></i>
                                        <span data-key="t-dashboards">Inventario</span>
                                        <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                        <a href="<?= base_url('inventario/compras') ?>" class="dropdown-item">Compras</a>
                                        <!-- <a href="<?= base_url('trips/') ?>" class="dropdown-item">Lista de inventario</a>
                                        <a href="<?= base_url('trips/') ?>" class="dropdown-item">Pedidos</a> -->
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                                <?php
                                if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 5){
                                ?>
                                <li class="nav-item <?= ($title == 'Configuración')?'active':'' ?>">
                                    <a class="nav-link arrow-none <?= ($title == 'Configuración')?'active':'' ?>" href="<?= base_url('administracion/clientes') ?>">
                                        <i class="fa-duotone fa-users"></i>
                                        <span data-key="t-horizontal">Clientes</span>
                                    </a>
                                </li>
                                <li class="nav-item <?= ($title == 'Reportes')?'active':'' ?>">
                                    <a class="nav-link arrow-none <?= ($title == 'Reportes')?'active':'' ?>" href="<?= base_url('reportes/existencias') ?>">
                                    <i class="fa-duotone fa-file-invoice"></i>
                                        <span data-key="t-horizontal">Existencias Inventario</span>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                                <?php
                                if($_SESSION['rol'] == 3){
                                ?>
                                <li class="nav-item <?= ($title == 'Reportes')?'active':'' ?>">
                                    <a class="nav-link arrow-none <?= ($title == 'Reportes')?'active':'' ?>" href="<?= base_url('reportes/existencias') ?>">
                                    <i class="fa-duotone fa-file-invoice"></i>
                                        <span data-key="t-horizontal">Existencias Inventario</span>
                                    </a>
                                </li>
                                <?php
                                }
                                ?>
                                <li class="nav-item <?= ($title == 'POS')?'active':'' ?>">
                                    <a class="nav-link arrow-none <?= ($title == 'POS')?'active':'' ?>" href="<?= base_url('pos') ?>">
                                        <i class="fas fa-cash-register"></i>
                                        <span data-key="t-horizontal">Ventas</span>
                                    </a>
                                </li>
                                <?php
                                if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3){
                                ?>
                                <li class="nav-item dropdown <?= ($title == 'Reportes')?'active':'' ?>">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-duotone fa-print"></i>
                                        <span data-key="t-dashboards">Reportes</span>
                                        <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                        <a href="<?= base_url('reportes/reportes_ventas/'.date('Y-m-1').'/'.date('Y-m-31').'/0/0/0/0') ?>" class="dropdown-item">Ventas</a>
                                        <a href="<?= base_url('reportes/utilidades/'.date('Y-m-1').'/'.date('Y-m-31').'/0/0') ?>" class="dropdown-item">Utilidades</a>
                                        <a href="<?= base_url('reportes/existencias') ?>" class="dropdown-item">Existencias Inventario</a>
                                        <a href="<?= base_url('reportes/rotacion') ?>" class="dropdown-item">Rotación Inventario</a>
                                        <a href="<?= base_url('reportes/facturas_anuladas') ?>" class="dropdown-item">Facturas Anuladas</a>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link arrow-none" href="<?= base_url('logout') ?>">
                                        <i class="fa-duotone fa-power-off"></i>
                                        <span data-key="t-horizontal">Cerrar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
