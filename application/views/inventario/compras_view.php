<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<!-- <style>
    .code-error{
        display: none;
    }

    .code-error{
        display: none;
    }

    table{
        font-family: 'Source Code Pro', monospace;
        /* font-size: 14px; */
    }

    /* .table > :not(caption) > * > * {
        padding: 5px;
    } */
</style> -->
<style>
    .code-error{
        display: none;
    }

    table{
        font-family: 'Source Code Pro', monospace;
        font-size: 14px;
    }

    .table > :not(caption) > * > * {
        padding: 5px;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title . ' / Compras' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">

                    <div class="card card-h-100">

                        <div class="card-body">
                        <a href="<?= base_url('inventario/compras/nueva_compra') ?>" class="btn btn-success" style="margin-bottom: 20px;"><i class="fas fa-plus"></i> NUEVA COMPRA</a>
                            <div class="table-responsive">
                                <table id="clientSearch" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>COD.</th>
                                            <th>FECHA</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>CANTIDAD</th>
                                            <th>TOTAL</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($compras as $c){
                                            $lalista = $this->model->lista_inventario_sin_agrupar($c['id']);
                                            $cantidad = 0;
                                            $total = 0;
                                            foreach($lalista as $l){
                                                $cantidad = $cantidad + 1;
                                                $total = $total + $l['costo'];
                                            }
                                        ?>
                                        <tr>
                                            <td style="width: 120px; text-align: center;"><?= 'CO-' . $c['id'] ?></td>
                                            <td style="width: 120px; text-align: center;"><?= date('d-m-Y', strtotime($c['fecha'])) ?></td>
                                            <td><?= $c['descripcion'] ?></td>
                                            <td style="width: 110px; text-align: center;"><?= $cantidad ?></td>
                                            <td style="width: 110px; text-align: right;"><?= 'Q' . number_format($total, 2, '.', ',') ?></td>
                                            <?php
                                            if($c['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('administracion/clientes/reactivar_cliente/' . $c['id']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('inventario/compras/lista_compra/' . $c['id']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <!-- <a href="<?= base_url('administracion/clientes/eliminar_cliente/' . $c['id']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->
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
