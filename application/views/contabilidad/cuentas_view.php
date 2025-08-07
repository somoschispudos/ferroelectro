<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
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
                        <h4 class="mb-0"><?= $title . ' / Cuentas por cobrar' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clientSearch" class="table table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>COD.</th>
                                            <th>FECHA</th>
                                            <th>FECHA PAGO</th>
                                            <th>DIAS</th>
                                            <th>CLIENTE</th>
                                            <th>GRAN TOTAL</th>
                                            <th>SALDO</th>
                                            <th>STATUS</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($ventas as $v){
                                            $fechaPago = "";
                                            $cliente = $this->model->get_cliente($v['idcliente']);
                                            $ventaModel = $this->model->get_lasuma_venta($v['id']);
                                            // $total = $v['total'];
                                            $total = $ventaModel[0]['sumatotal'];
                                            $descuento = $v['descuento'];
                                            $descuentoPorcentaje = $descuento * 100;
                                            // $descuentoPorcentaje = number_format($descuento, 0, '', '');

                                            $descuento = $total * $descuento;
                                            $grantotal = $total - $descuento;
                                            // $grantotal = number_format($grantotal, 2, '.', ',');
                                            // $total = number_format($total, 2, '.', ',');
                                            $status = $v['status'];
                                            $labelStatus = '';
                                            if($status == 1){
                                                $labelStatus = '<span class="badge badge-pill" style="background-color: #e77c06;">CREADO</span>';
                                            }elseif($status == 2){
                                                $labelStatus = '<span class="badge badge-pill badge-info" style="background-color: #48d6d2;">PROCESADO</span>';
                                            }elseif($status == 3){
                                                $labelStatus = '<span class="badge badge-pill badge-info" style="background-color: #2a6fdb;">FACTURADO</span>';
                                            }

                                            //fecha calculo
                                            $now = time(); // or your date as well
                                            // echo $now;
                                            $your_date = strtotime(date('d-m-Y', strtotime($v['fecha'])));
                                            $datediff = $now - $your_date;


                                            $diasTranscurridos = round($datediff / (60 * 60 * 24));

                                            if($v['formapago'] == 2){
                                                $fechaPago = date('d-m-Y', strtotime($v['fecha'] . ' + ' . 15 . ' days'));
                                            }elseif($v['formapago'] == 3){
                                                $fechaPago = date('d-m-Y', strtotime($v['fecha'] . ' + ' . 30 . ' days'));
                                            }

                                            $diasCredito = 0;
                                            $statusCredito = 0;

                                            if($v['formapago'] == 2){
                                                $diasCredito = 15;
                                                if($diasTranscurridos >= 0 && $diasTranscurridos <= 10){
                                                    $statusCredito = 1;
                                                    $fondoColor = "#c2ffc2";
                                                    $colorText = "#007d00";
                                                    $statusCobro = '<b>' . (15 - $diasTranscurridos) . ' dias para pagar' . '</b>';
                                                }elseif($diasTranscurridos > 10 && $diasTranscurridos <= 15){
                                                    $statusCredito = 2;
                                                    $fondoColor = "#ffffbe";
                                                    $colorText = "#e0a21f";
                                                    $statusCobro = '<b>' . (15 - $diasTranscurridos) . ' dias para pagar' . '</b>';
                                                }elseif($diasTranscurridos > 15){
                                                    $statusCredito = 3;
                                                    $fondoColor = "#ffbebe";
                                                    $colorText = "#b30000";
                                                    $statusCobro = '<b>' . abs((15 - $diasTranscurridos)) . ' dias en mora' . '</b>';
                                                }
                                            }elseif($v['formapago'] == 3){
                                                $diasCredito = 30;
                                                if($diasTranscurridos >= 0 && $diasTranscurridos <= 20){
                                                    $statusCredito = 1;
                                                    $fondoColor = "#c2ffc2";
                                                    $colorText = "#007d00";
                                                    $statusCobro = '<b>' . (30 - $diasTranscurridos) . ' dias para pagar' . '</b>';
                                                }elseif($diasTranscurridos > 20 && $diasTranscurridos <= 30){
                                                    $statusCredito = 2;
                                                    $fondoColor = "#ffffbe";
                                                    $colorText = "#e0a21f";
                                                    $statusCobro = '<b>' . (30 - $diasTranscurridos) . ' dias para pagar' . '</b>';
                                                }elseif($diasTranscurridos > 30){
                                                    $statusCredito = 3;
                                                    $fondoColor = "#ffbebe";
                                                    $colorText = "#b30000";
                                                    $statusCobro = '<b>' . abs((30 - $diasTranscurridos)) . ' dias en mora' . '</b>';
                                                }
                                            }elseif($v['formapago'] == 1){
                                                    // $statusCredito = 1;
                                                    $fondoColor = "#c2ffc2";
                                                    $colorText = "#007d00";
                                                    $statusCobro = 'CONTADO';
                                                    $fechaPago = 'CONTADO';
                                            }

                                            $pendiente = 0;
                                            // if($v['formapago'] == 1){
                                            // echo "Q".number_format($pendiente, 2, '.', ',');
                                            // }elseif($v['formapago'] == 2 || $v['formapago'] == 3){
                                                $getPagos = $this->model->getpagos_suma($v['id']);
                                                $pagado = $getPagos[0]['sumapagos'];
                                                $pendiente = $grantotal - $pagado;
                                                // die($pendiente);
                                                // if($pendiente == -0){
                                                //     $pendiente = 0;
                                                // }
                                            // }

                                            if($status == 4){
                                                $fondoColor = "#a6bcff";
                                                $colorText = "#3655b3";
                                                $statusCobro = 'PAGO COMPLETO';
                                            }

                                            // if($pendiente > 0 && $grantotal > 0){
                                            if($grantotal > 0){
                                        ?>
                                        <tr style="background-color: <?= $fondoColor ?>;">
                                            <td style="width: 120px; text-align: center;"><?= 'V-' . $v['id'] ?></td>
                                            <td style="width: 120px; text-align: center;"><?= date('d-m-Y', strtotime($v['fecha'])) ?></td>
                                            <td style="width: 120px; text-align: center;"><?= $fechaPago ?></td>
                                            <td style="width: 60px; text-align: center;">
                                            <?php
                                            if($v['formapago'] == 1){
                                                echo "&infin;";
                                            }else{
                                                echo $diasTranscurridos . '/' . $diasCredito;
                                            }
                                            ?>
                                            </td>
                                            <td><?= $cliente[0]['nombre'] ?></td>
                                            <td style="width: 110px; text-align: right;">Q<?= number_format($grantotal, 2, '.', ',') ?></td>
                                            <td style="width: 110px; text-align: right;">Q<?= number_format($pendiente, 2, '.', ',') ?></td>
                                            <td style="width: 170px; text-align: center;"><?= $statusCobro ?></td>

                                            <td class="no-print" style="text-align: center; width: 90px;">
                                                <a style="background-color: <?= $colorText ?>; color: #fff;" href="<?= base_url('contabilidad/cuentas/pagos/' . $v['id']) ?>" class="btn btn-sm"><i class="fa fa-money"></i> PAGOS</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
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
    <script>
        $(document).ready(function () {
            $('#clientSearch').DataTable({
                order: [[1, 'desc']],
            });
        });
    </script>