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
                        <h4 class="mb-0"><?= $title . ' / Editar Usuario' ?></h4>
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
                                    <input type="text" class="form-control" name="nombre" required="true" autocomplete="off" value="<?= $usuario[0]['nombre'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Email</label>
                                    <input type="email" class="form-control" name="email" required="true" autocomplete="off" value="<?= $usuario[0]['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" required="true" autocomplete="off" value="<?= $usuario[0]['usuario'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Rol</label>
                                    <select name="rol" class="form-control" id="rol">
                                        <?php
                                        foreach($roles as $r){
                                        ?>
                                        <option value="<?= $r['id'] ?>" <?= ($usuario[0]['idrol'] == $r['id'])?'selected="selected"':'' ?>><?= $r['rol'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
                                    <a href="<?= base_url('administracion/usuarios') ?>" class="btn btn-default">CANCELAR</a>
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