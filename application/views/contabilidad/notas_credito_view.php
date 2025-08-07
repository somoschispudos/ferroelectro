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
                        <h4 class="mb-0"><?= $title . ' / Notas de Crédito' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clientSearch" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>COD.</th>
                                            <th>FECHA</th>
                                            <th>CLIENTE</th>
                                            <th>VENDEDOR</th>
                                            <th>PAGO</th>
                                            <th>TOTAL</th>
                                            <!-- <th>GRAN TOTAL</th> -->
                                            <th>SALDO</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $asesor = "";
                                        foreach($ventas as $v){
                                            $cliente = $this->model->get_cliente($v['idcliente']);
                                            @$asesor = $cliente[0]['usuarionombre'];
                                            // $total = $v['total'];
                                            $ventaModel = $this->model->get_lasuma_venta($v['id']);
                                            $total = $ventaModel[0]['sumatotal'];
                                            $descuento = $v['descuento'];
                                            $descuentoPorcentaje = $descuento * 100;
                                            $formapago = $v['formapago'];
                                            if($formapago == 1){
                                                $formapago = "CONTADO";
                                            }else{
                                                $formapago = "CRÉDITO";
                                            }
                                            // $descuentoPorcentaje = number_format($descuento, 0, '', '');

                                            $descuento = $total * $descuento;
                                            $grantotal = $total - $descuento;
                                            // $grantotal = number_format($grantotal, 2, '.', ',');
                                            $total = number_format($total, 2, '.', ',');
                                            $status = $v['status'];
                                            $labelStatus = '';
                                            if($status == 1){
                                                $labelStatus = '<span class="badge badge-pill" style="background-color: #e77c06;">CREADO</span>';
                                            }elseif($status == 2){
                                                $labelStatus = '<span class="badge badge-pill badge-info" style="background-color: #48d6d2;">PROCESADO</span>';
                                            }elseif($status == 3){
                                                $labelStatus = '<span class="badge badge-pill badge-info" style="background-color: #2a6fdb;">FACTURADO</span>';
                                            }elseif($status == 4){
                                                $labelStatus = '<span class="badge badge-pill badge-info" style="background-color: #a6bcff;">PAGADO</span>';
                                            }

                                            if($grantotal > 0){
                                                if($status >= 3){
                                        ?>
                                        <tr>
                                            <td style="width: 80px; text-align: center;"><?= 'V-' . $v['id'] ?></td>
                                            <td style="width: 120px; text-align: center;"><?= date('d-m-Y', strtotime($v['fecha'])) ?></td>
                                            <td><?= $cliente[0]['nombre'] ?></td>
                                            <td><?= @$asesor ?></td>
                                            <td style="width: 70px; text-align: center;"><?= $formapago?></td>
                                            <td style="width: 110px; text-align: right;"><?= 'Q' . number_format($grantotal, 2, '.', ',') ?></td>
                                            <!-- <td style="width: 110px; text-align: right;">Q<?= number_format($descuento, 2, '.', ',') ?></td> -->
                                            <td style="width: 110px; text-align: right;">
                                                <?php
                                                // $pendiente = 0;
                                                // if($v['formapago'] == 1){
                                                // echo "Q".number_format($pendiente, 2, '.', ',');
                                                // }elseif($v['formapago'] == 2 || $v['formapago'] == 3){
                                                //     $getPagos = $this->model->getpagos_suma($v['id']);
                                                //     $pagado = $getPagos[0]['sumapagos'];
                                                //     $pendiente = $grantotal - $pagado;
                                                //     echo "Q".number_format($pendiente, 2, '.', ',');
                                                // }
                                                $getPagos = $this->model->getpagos_suma($v['id']);
                                                $pagado = $getPagos[0]['sumapagos'];
                                                $pendiente = $grantotal - $pagado;
                                                echo "Q".number_format($pendiente, 2, '.', ',');
                                                ?>
                                            </td>

                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('contabilidad/nota_credito/edit_nota_credito/' . $v['id']) ?>" class="btn btn-sm btn-secondary" style="background-color: #fff; color: #000;"><i class="fa-duotone fa-notebook"></i></a>
                                            </td>

                                        </tr>
                                        <?php
                                                }
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
<!-- </div> -->
    <!-- End Page-content -->
    <script>
        $(document).ready(function () {
            $('#clientSearch').DataTable({
                order: [[1, 'desc']],
            });
        });
    </script>

