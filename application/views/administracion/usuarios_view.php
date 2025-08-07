<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .code-error{
        display: none;
    }

    .badge-outline-supervisor {
        border: 1px solid #7700b3;
        background-color: #7700b3;
        color: #fff;
    }

    .badge-outline-administrador {
        border: 1px solid #4d4dff;
        background-color: #4d4dff;
        color: #fff;
    }

    .badge-outline-asesor {
        border: 1px solid #95adbe;
        background-color: #95adbe;
        color: #fff;
    }

    .badge-outline-contador {
        border: 1px solid #ef9bcc;
        background-color: #ef9bcc;
        color: #fff;
    }

    .badge-outline-bodega {
        border: 1px solid #ffa500;
        background-color: #ffa500;
        color: #fff;
    }

</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title . ' / Usuarios' ?></h4>
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
                                Usuario creado exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required="true" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Email</label>
                                    <input type="email" class="form-control" name="email" required="true" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Usuario</label>
                                    <input type="text" class="form-control" name="usuario" required="true" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Contraseña</label>
                                    <input type="password" class="form-control" name="clave" required="true" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Rol</label>
                                    <select name="rol" class="form-select" id="rol">
                                        <?php
                                        foreach($roles as $r){
                                        ?>
                                        <option value="<?= $r['id'] ?>"><?= $r['rol'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
                                            <th>USUARIO</th>
                                            <th>ROL</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($usuarios as $u){
                                        ?>
                                        <tr <?= ($u['status'] == 0)?'style="color: #b8b8b8;"':'' ?>>
                                            <td><?= $u['nombre'] ?></td>
                                            <td><?= $u['email'] ?></td>
                                            <td><?= $u['usuario'] ?></td>
                                            <td class="no-print" style="text-align: center; width: 40px;">
                                            <?php
                                            if($u['idrol'] == 1){
                                                $badgerol = 'badge-outline-administrador';
                                            }elseif($u['idrol'] == 2){
                                                $badgerol = 'badge-outline-asesor';
                                            }elseif($u['idrol'] == 3){
                                                $badgerol = 'badge-outline-contador';
                                            }elseif($u['idrol'] == 4){
                                                $badgerol = 'badge-outline-bodega';
                                            }elseif($u['idrol'] == 5){
                                                $badgerol = 'badge-outline-supervisor';
                                            }
                                            ?>
                                                <span class="badge rounded-pill <?= $badgerol ?>"><?= $u['rol'] ?></span>
                                            </td>
                                            <?php
                                            if($u['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('administracion/usuarios/reactivar_usuario/' . $u['idusuario']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 110px; <?= ($u['usuario'] == 'ventas')?'display:none;':'' ?>">
                                                <a href="<?= base_url('administracion/usuarios/editar_usuario/' . $u['idusuario']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('administracion/usuarios/eliminar_usuario/' . $u['idusuario']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
