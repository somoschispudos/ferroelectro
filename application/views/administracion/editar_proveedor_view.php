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
                        <h4 class="mb-0"><?= $title . ' / Editar Proveedor' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <form method="POST" class="form">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required="true" autocomplete="off" value="<?= $proveedor[0]['nombre'] ?>">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="nombre">DPI</label>
                                        <input type="text" class="form-control" name="dpi" autocomplete="off" value="<?= $proveedor[0]['dpi'] ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">NIT</label>
                                        <input type="text" class="form-control" name="nit" required="true" autocomplete="off" value="<?= $proveedor[0]['nit'] ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" required="true" autocomplete="off" value="<?= $proveedor[0]['telefono'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Dirección</label>
                                    <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="3"><?= $proveedor[0]['direccion'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Email</label>
                                    <input type="email" class="form-control" name="email" autocomplete="off" value="<?= $proveedor[0]['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Contacto</label>
                                    <input type="text" class="form-control" name="contacto" required="true" autocomplete="off" value="<?= $proveedor[0]['contacto'] ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
                                    <a href="<?= base_url('administracion/proveedores') ?>" class="btn btn-default">CANCELAR</a>
                                </div>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>

            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
