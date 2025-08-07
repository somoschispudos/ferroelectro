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
                        <h4 class="mb-0"><?= $title . ' / Monedas' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            if($msg == 'success'){
                            ?>
                            <div class="alert alert-success" role="alert">
                                Moneda creada exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form">
                                <div class="form-group">
                                    <label for="nombre">Moneda</label>
                                    <input type="text" class="form-control" name="moneda" required="true" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Símbolo</label>
                                    <input type="text" class="form-control" name="simbolo" required="true" autocomplete="off">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
                                </div>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-xl-5">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>MONEDA</th>
                                            <th>SÍMBOLO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($monedas as $m){
                                        ?>
                                        <tr>
                                            <td><?= $m['moneda'] ?></td>
                                            <td class="no-print" style="text-align: center; width: 40px;"><?= $m['simbolo'] ?></td>
                                            <?php
                                            if($m['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('configuracion/monedas/reactivar_moneda/' . $m['id']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 40px;">
                                                <a href="<?= base_url('configuracion/monedas/eliminar_moneda/' . $m['id']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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