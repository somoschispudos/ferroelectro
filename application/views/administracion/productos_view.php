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
                        <h4 class="mb-0"><?= $title . ' / Productos' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                    <div class="card-body">
                        <?php
                        if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
                        ?>
                        <a href="<?= base_url('administracion/productos/nuevo_producto') ?>" class="btn btn-success" style="margin-bottom: 20px;"><i class="fas fa-plus"></i> NUEVO PRODUCTO</a>
                        <?php
                        }
                        ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clientSearch" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>SKU</th>
                                            <th>PRODUCTO</th>
                                            <th>MARCA</th>
                                            <th>CATEGORÍA</th>
                                            <th>COSTO</th>
                                            <th>VENTA</th>
                                            <th>EXIST.</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($productos as $p){
                                            $imagenSearch = $this->model->all_imagenes_categoria($p['idpr']);
                                            $exist = $this->model->lista_inventario_conteo_productos($p['idpr']);
                                            $img = "";
                                            if(!empty($imagenSearch)){
                                                $img = $imagenSearch[0]['filename'];
                                            }else{
                                                $img = 'assets/images/noimage.jpg';
                                            }
                                        ?>
                                        <tr>
                                            <td style="text-align: center; width: 50px;">
                                                <img src="<?= base_url($img) ?>" style="height: 30px;" alt="">
                                            </td>
                                            <td style="width: 90px; text-align: center;"><?= $p['sku'] ?></td>
                                            <td><?= $p['nombreproducto'] ?></td>
                                            <td><?= $p['marca'] ?></td>
                                            <td><?= $p['categoria'] ?></td>
                                            <td style="width: 110px; text-align: right;"><?= 'Q' . number_format($p['costo'], 2, '.', ',') ?></td>
                                            <td style="width: 110px; text-align: right;"><?= 'Q' . number_format($p['venta'], 2, '.', ',') ?></td>
                                            <td style="width: 90px; text-align: center;"><?= $exist ?></td>
                                            <?php
                                            if($p['statusprod'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('administracion/productos/reactivar_producto/' . $p['idpr']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 100px;">
                                                <a href="<?= base_url('administracion/productos/editar_producto/' . $p['idpr']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('administracion/productos/eliminar_producto/' . $p['idpr']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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