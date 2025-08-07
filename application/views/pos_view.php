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
                        <h4 class="mb-0"><?= $title . ' / Ventas' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                        <?php
                        if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 5){
                        ?>
                        <a href="<?= base_url('pos/nueva_venta') ?>" class="btn btn-success" style="margin-bottom: 20px;"><i class="fas fa-plus"></i> NUEVA VENTA</a>
                        <?php
                        }
                        ?>
                            <div class="table-responsive">
                                <table id="posDatatable" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>COD.</th>
                                            <th>FECHA</th>
                                            <th>CLIENTE</th>
                                            <th>VENDEDOR</th>
                                            <th>PAGO</th>
                                            <th>TOTAL</th>
                                            <!-- <th>GRAN TOTAL</th> -->
                                            <!-- <th>SALDO</th> -->
                                            <th>STATUS</th>
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
                                            }elseif($status == 55){
                                                $labelStatus = '<span class="badge badge-pill badge-info" style="background-color: #b33636;">ELIMINADO</span>';
                                            }

                                            if($grantotal > 0){
                                        ?>
                                        <tr>
                                            <td style="width: 80px; text-align: center;"><?= $v['id'] ?></td>
                                            <td style="width: 120px; text-align: center;"><?= date('d-m-Y', strtotime($v['fecha'])) ?></td>
                                            <td><?= $cliente[0]['nombre'] ?></td>
                                            <td><?= @$asesor ?></td>
                                            <td style="width: 70px; text-align: center;"><?= $formapago?></td>
                                            <td style="width: 110px; text-align: right;"><?= 'Q' . number_format($grantotal, 2, '.', ',') ?></td>
                                            <!-- <td style="width: 110px; text-align: right;">Q<?= number_format($descuento, 2, '.', ',') ?></td> -->
                                            <!-- <td style="width: 110px; text-align: right;">
                                                <?php
                                                // if($status == 55){
												// 	echo "----";
												// }else{
												// 	$getPagos = $this->model->getpagos_suma($v['id']);
												// 	$pagado = $getPagos[0]['sumapagos'];
												// 	$pendiente = $grantotal - $pagado;
												// 	echo "Q".number_format($pendiente, 2, '.', ',');
												// }
                                                ?>
                                            </td> -->
                                            <td style="width: 80px; text-align: center;"><?= $labelStatus ?></td>
                                            <?php
                                            if($v['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('administracion/clientes/reactivar_cliente/' . $v['id']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 100px;">
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-info btn-block dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Opciones
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        	<li><a class="dropdown-item" href="<?= base_url('pos/editar_lista_venta/' . $v['id']) ?>"><i class="fa fa-list"></i> Detalle</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>COD.</th>
                                            <th>FECHA</th>
                                            <th>CLIENTE</th>
                                            <th>VENDEDOR</th>
                                            <th>PAGO</th>
                                            <th>TOTAL</th>
                                            <!-- <th>GRAN TOTAL</th> -->
                                            <!-- <th>SALDO</th> -->
                                            <th>STATUS</th>
                                            <th class="no-print"></th>
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
<!-- </div> -->
    <!-- End Page-content -->
    <script>
        $(document).ready(function () {
            $('#clientSearch').DataTable({
                ordering: false,
                // paging: false,
                order: [[1, 'desc']],
                dom: 'Bfrtip',
                footer: true,
                buttons: [
                    // 'excel', 'pdf', 'print',
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        title: 'Ventas POS',
                        // orientation: 'landscape',
                        // pageSize: 'LETTER',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> EXCEL',
                        className: 'btn btn-success',
                        title: 'Ventas POS',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i> COPIAR',
                        className: 'btn btn-default',
                        title: 'Ventas POS',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> IMPRIMIR',
                        className: 'btn btn-info',
                        title: 'Ventas POS',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    }
                    // 'colvis'
                    // { extend: 'copyHtml5', footer: true },
                    // { extend: 'excelHtml5', footer: true },
                    // { extend: 'pdfHtml5', footer: true }
                ]
            });
            $('#posDatatable').DataTable({
                initComplete: function () {
                    this.api()
                        .columns()
                        .every(function () {
                            var column = this;
                            var select = $('<select class="form-control"><option value="">Seleccionar</option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function (d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                });
                        });
                },
                // columns: [
                //     { "searchable": false },
                //     null,
                //     null,
                //     null,
                //     null
                // ],
                ordering: true,
                // paging: false,
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    // 'excel', 'pdf', 'print',
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        title: 'Ventas POS',
                        // orientation: 'landscape',
                        // pageSize: 'LETTER',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> EXCEL',
                        className: 'btn btn-success',
                        title: 'Ventas POS',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i> COPIAR',
                        className: 'btn btn-default',
                        title: 'Ventas POS',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> IMPRIMIR',
                        className: 'btn btn-info',
                        title: 'Ventas POS',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    }
                ]
            });
        });
    </script>

