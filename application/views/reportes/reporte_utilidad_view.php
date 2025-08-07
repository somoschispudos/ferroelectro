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
                        <h4 class="mb-0"><?= $title . ' / Reporte de Utilidad' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            if($msg == 'success'){
                            ?>
                            <div class="alert alert-success" role="alert">
                                Cliente creado exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Rango de fechas</label>
                                        <input type="text" name="fecha" placeholder="Seleccionar rango de fecha" class="form-control selector" id="datepicker-range">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Asesor</label>
                                        <select placeholder="Seleccionar asesor..." autocomplete="off" name="asesor" id="asesor">
                                            <option value="0" selected="selected">Todos</option>
                                            <option <?= ($asesorURL == 1)?'selected="selected"':'' ?>>Administrador</option>
                                            <?php
                                            foreach($asesores as $a){
                                                $status = '';
                                                if($a['status'] == 0){
                                                    $status = ' (deshabilitado)';
                                                }
                                            ?>
                                            <option <?= ($asesorURL == $a['idusuario'])?'selected="selected"':'' ?> value="<?= $a['idusuario'] ?>"><?= $a['nombre'] . $status ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="nombre">Clientes</label>
                                        <select placeholder="Seleccionar cliente..." autocomplete="off" name="cliente" id="cliente">
                                            <option value="0" selected="selected">Todos</option>
                                            <?php
                                            foreach($clientes as $c){
                                                $status = '';
                                                if($c['status'] == 0){
                                                    $status = ' (deshabilitado)';
                                                }
                                            ?>
                                            <option <?= ($clienteURL == $c['idclient'])?'selected="selected"':'' ?> value="<?= $c['idclient'] ?>"><?= $c['nombre'] . $status ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="" style="color: #fff;">....</label>
                                        <br>
                                        <button class="btn btn-success btn-block" type="submit" name="filtrar"><i class="fa fa-save"></i> REPORTE</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div class="table-responsive">
                                <table id="reporteDatatable" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>COD.</th>
                                            <th>FECHA</th>
                                            <th>CLIENTE</th>
                                            <th>VENDEDOR</th>
                                            <th>COSTO (GQT)</th>
                                            <th>TOTAL (GQT)</th>
                                            <th>UTILIDAD (GQT)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $asesor = "";
                                        $alltotal = 0;
                                        $allpendiente = 0;
                                        $allcosto = 0;
                                        $allutilidad = 0;
                                        foreach($ventas as $v){
                                            $cliente = $this->model->get_cliente($v['idcliente']);
                                            @$asesor = $cliente[0]['usuarionombre'];
                                            $ventaModel = $this->model->get_lasuma_venta($v['id']);
                                            $total = $ventaModel[0]['sumatotal'];
                                            $totalcosto = $ventaModel[0]['sumatotalcosto'];
                                            $allcosto = $allcosto + $totalcosto;
                                            $utilidad = $total - $totalcosto;
                                            $allutilidad = $allutilidad + $utilidad;
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
                                            $alltotal = $alltotal + $grantotal;
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
                                        ?>
                                        <tr>
                                            <td style="width: 80px; text-align: center;"><?= 'V-' . $v['id'] ?></td>
                                            <td style="width: 120px; text-align: center;"><?= date('d-m-Y', strtotime($v['fecha'])) ?></td>
                                            <td><?= $cliente[0]['nombre'] ?></td>
                                            <td><?= @$asesor ?></td>
                                            <td style="width: 110px; text-align: right;"><?= number_format($totalcosto, 2, '.', '') ?></td>
                                            <td style="width: 110px; text-align: right;"><?= number_format($grantotal, 2, '.', '') ?></td>
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
                                                // $getPagos = $this->model->getpagos_suma($v['id']);
                                                // $pagado = $getPagos[0]['sumapagos'];
                                                // $pendiente = $grantotal - $pagado;
                                                // $allpendiente = $allpendiente + $pendiente;
                                                echo number_format($utilidad, 2, '.', '');
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: right;"></td>
                                            <td style="width: 110px; text-align: right; font-weight: bold;"><?= number_format($allcosto, 2, '.', '') ?></th>
                                            <td style="width: 110px; text-align: right; font-weight: bold;"><?= number_format($alltotal, 2, '.', '') ?></th>
                                            <td style="width: 110px; text-align: right; font-weight: bold;"><?= number_format($allutilidad, 2, '.', '') ?></th>
                                        </tr>
                                    </tfoot>
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

            $("#datepicker-range").flatpickr({
                mode: "range"
            });

            $('#reporteDatatable').DataTable({
                // columns: [
                //     { "searchable": false },
                //     null,
                //     null,
                //     null,
                //     null
                // ],
                ordering: false,
                paging: false,
                searching: false,
                order: [[1, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    // 'excel', 'pdf', 'print',
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        title: 'Reporte de Utilidad',
                        // orientation: 'landscape',
                        footer: true
                        // pageSize: 'LETTER',
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> EXCEL',
                        className: 'btn btn-success',
                        title: 'Reporte de Utilidad',
                        footer: true
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i> COPIAR',
                        className: 'btn btn-default',
                        title: 'Reporte de Utilidad',
                        footer: true
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> IMPRIMIR',
                        className: 'btn btn-info',
                        title: 'Reporte de Utilidad',
                        footer: true
                    }
                ]
            });
        });

        var selproduct = new TomSelect("#cliente",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
        });

        var selproduct = new TomSelect("#asesor",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
        });
    </script>
