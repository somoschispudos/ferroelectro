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
                        <h4 class="mb-0"><?= $title . ' / Proveedores' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            if($msg == 'success'){
                            ?>
                            <div class="alert alert-success" role="alert">
                                Proveedor creado exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required="true" autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="nombre">DPI</label>
                                        <input type="text" class="form-control" name="dpi" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">NIT</label>
                                        <input type="text" class="form-control" name="nit" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" required="true" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Dirección</label>
                                    <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Email</label>
                                    <input type="email" class="form-control" name="email" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Contacto</label>
                                    <input type="text" class="form-control" name="contacto" required="true" autocomplete="off">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
                                </div>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-xl-8">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>NOMBRE</th>
                                            <th>EMAIL</th>
                                            <th>TELÉFONO</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($proveedores as $p){
                                        ?>
                                        <tr <?= ($p['status'] == 0)?'style="color: #b8b8b8;"':'' ?>>
                                            <td><?= $p['nombre'] ?></td>
                                            <td><?= $p['email'] ?></td>
                                            <td><?= $p['telefono'] ?></td>
                                            <?php
                                            if($p['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('administracion/proveedores/reactivar_proveedores/' . $p['id']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 110px;">
                                                <a href="<?= base_url('administracion/proveedores/editar_proveedor/' . $p['id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('administracion/proveedores/eliminar_proveedor/' . $p['id']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div><!-- end table responsive -->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>

            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
