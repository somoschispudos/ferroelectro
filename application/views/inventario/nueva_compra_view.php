<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .code-error{
        display: none;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title . ' / Nueva Compra' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <h4 style="color: #41afc8;">Carga Individual</h4>
                            <form method="POST" class="form" autocomplete="notnow">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Fecha</label>
                                        <input type="text" id="fecha" class="form-control" name="fecha" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button  class="btn btn-success" style="margin-top: 35px;" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
										<a href="<?= base_url('inventario/compras') ?>" class="btn btn-light" style="margin-top: 35px;"><i class="fa fa-cancel"></i> CANCELAR</a>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <h4 style="color: #41afc8;">Carga Por Archivo</h4>
                            <form method="POST" class="form" enctype="multipart/form-data" autocomplete="notnow">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Fecha</label>
                                        <input type="text" id="fecha2" class="form-control" name="fecha" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Archivo CSV</label>
                                        <input type="file" class="form-control" name="csv_file" required="true" accept=".csv">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button  class="btn btn-success" style="margin-top: 35px;" type="submit" name="guardarArchivo"><i class="fa fa-save"></i> GUARDAR</button>
										<a href="<?= base_url('inventario/compras') ?>" class="btn btn-light" style="margin-top: 35px;"><i class="fa fa-cancel"></i> CANCELAR</a>
                                    </div>
                                </div>
                            </form>
							<?php
							if($msg != ''){
							?>
							<hr>
							<div class="alert alert-success" role="alert">
							<?= $msg ?>
							</div>
							<?php
							}
							?>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

<script>
    let base = '<?= base_url() ?>';

    const picker1 = new Litepicker({
        element: document.getElementById('fecha'),
        format: "DD-MM-YYYY"
    });

    const picker2 = new Litepicker({
        element: document.getElementById('fecha2'),
        format: "DD-MM-YYYY"
    });
</script>
