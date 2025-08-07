<div id="layout-wrapper">
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content" style="margin-top: 0px !important;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-15">Pedido P-<?= $ventadata[0]['id'] ?></h4>
                                        <div class="mb-4">
                                            <img src="<?= base_url('assets/images/logoblack.png') ?>" alt="logo" height="30"/>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="text-muted">
                                                <h5 class="font-size-15 mb-2"><?= $ventadata[0]['nombre'] ?></h5>
                                                <p class="mb-1"><?= $ventadata[0]['direccion'] ?></p>
                                                <p class="mb-1"><?= $ventadata[0]['email'] ?></p>
                                                <!-- <p><?= $ventadata[0]['telefono1'] ?></p> -->
                                            </div>
                                        </div>

                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                    <hr>
                                    <div class="py-2">
                                        <h5 class="font-size-15">Recibo</h5>

                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>SKU</th>
                                                        <th>Item</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th class="text-end" style="width: 120px;">Total</th>
                                                    </tr>
                                                </thead><!-- end thead -->
                                                <tbody>
                                                    <?php
                                                    $allTotal = 0;
                                                    foreach($productosAgregados as $p){
                                                        $precio = $p['inventarioVenta'];
                                                        $cantidad = $this->model->lista_inventario_conteo_venta($p['idventa'], $p['idproducto']);
                                                        $precioTotalProd = $precio * $cantidad;
                                                        $allTotal = $allTotal + $precioTotalProd;
                                                    ?>
                                                    <tr>
                                                        <td><?= $p['sku'] ?></td>
                                                        <td>
                                                            <div>
                                                                <h5 class="text-truncate font-size-14 mb-1"><?= $p['nombreproducto'] ?></h5>
                                                            </div>
                                                        </td>
                                                        <td>Q<?= number_format($precio, 2, '.', ',') ?></td>
                                                        <td><?= $cantidad ?></td>
                                                        <td class="text-end">Q<?= number_format($precioTotalProd, 2 , '.', ',') ?></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                    <!-- end tr -->
                                                    <tr>
                                                        <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                        <td class="border-0 text-end"><h4 class="m-0 fw-semibold" style="font-size: 16px;">Q<?= number_format($allTotal, 2 , '.', ',') ?></h4></td>
                                                    </tr>
                                                    <!-- end tr -->
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div><!-- end table responsive -->
                                        <div class="d-print-none mt-4">
                                            <div class="float-end">
                                                <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->

    </div>
    </body>
</html>
