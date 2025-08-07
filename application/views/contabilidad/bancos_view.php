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
                        <h4 class="mb-0"><?= $title . ' / Bancos' ?></h4>
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
                                Banco creado exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($msg == 'duplicate'){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Banco ya existe en la base de datos
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="banco" required="true" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Número de cuenta</label>
                                    <input type="text" class="form-control" name="cuenta" required="true" autocomplete="off">
                                </div>
                                <div class="form-group" style="width: 50%;">
                                    <label for="nombre">Tipo de cuenta</label>
                                    <select name="tipo" class="form-control">
                                        <option value="1">Monetaria</option>
                                        <option value="2">Ahorros</option>
                                    </select>
                                </div>
                                <div class="form-group" style="width: 50%;">
                                    <label for="nombre">Moneda</label>
                                    <select name="moneda" class="form-control">
                                        <?php
                                        foreach($monedas as $m){
                                        ?>
                                        <option value="<?= $m['id'] ?>"><?= $m['moneda'] ?></option>
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
                <div class="col-xl-6">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>BANCO</th>
                                            <th>CUENTA</th>
                                            <th>TIPO</th>
                                            <th>MONEDA</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($bancos as $b){
                                        ?>
                                        <tr <?= ($b['status'] == 0)?'style="color: #b8b8b8;"':'' ?>>
                                            <td><?= $b['nombre_banco'] ?></td>
                                            <td><?= $b['cuenta'] ?></td>
                                            <td>
                                                <?php
                                                if($b['tipo_cuenta'] == 1){
                                                    echo "Monetaria";
                                                }elseif($b['tipo_cuenta'] == 2){
                                                    echo "Ahorros";
                                                }
                                                ?>
                                            </td>
                                            <td><?= $b['moneda'] ?></td>
                                            <?php
                                            if($b['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('contabilidad/bancos/reactivar_banco/' . $b['idbanco']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 40px;">
                                                <a href="<?= base_url('contabilidad/bancos/eliminar_banco/' . $b['idbanco']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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