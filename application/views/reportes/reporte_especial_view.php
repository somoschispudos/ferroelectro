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
                        <h4 class="mb-0"><?= $title . ' / Ventas Anuladas' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="posDatatable" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>FECHA</th>
                                            <th>CÓDIGO</th>
                                            <th>CANTIDAD</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>MARCA</th>
                                            <th>PRECIO UNITARIO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $asesor = "";
                                        foreach($ventas as $v){
											$idventa = $v['id'];
											$productosAgregados = $this->model->get_productos_venta($idventa);
											foreach($productosAgregados as $pa){
												$cantidad = $this->model->lista_inventario_conteo_venta($idventa, $pa['idproducto']);
                                                $venta = $pa['inventarioVenta'];
												$nombre = $pa['nombreproducto'];
                                        ?>
                                        <tr>
                                            <td style="width: 80px; text-align: center;"><?= $v['id'] ?></td>
											<td style="width: 120px; text-align: center;"><?= date('Y', strtotime($v['fecha'])) ?></td>
                                            <td style="width: 120px; text-align: center;"><?= date('d-m-Y', strtotime($v['fecha'])) ?></td>
                                            <td style="width: 110px; text-align: center;"><?= $pa['sku'] ?></td>
                                            <td style="width: 80px; text-align: center;"><?= $cantidad ?></td>
                                            <td><?= $nombre ?></td>
											<td style="width: 140px; text-align: center;"><?= $pa['marca'] ?></td>
											<td style="width: 110px; text-align: right;"><?= $venta ?></td>
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
<!-- </div> -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span class="namemodal"></span></h4>
                    <button class="btn btn-danger btn-sm" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
    <script>
        $(document).ready(function () {
            
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
                ordering: false,
                // paging: false,
                order: [[1, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    // 'excel', 'pdf', 'print',
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        title: 'Reportes',
                        // orientation: 'landscape',
                        // pageSize: 'LETTER',
                        // exportOptions: {
                        //     columns: 'th:not(:last-child)'
                        // }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> EXCEL',
                        className: 'btn btn-success',
                        title: 'Reportes',
                        // exportOptions: {
                        //     columns: 'th:not(:last-child)'
                        // }
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i> COPIAR',
                        className: 'btn btn-default',
                        title: 'Reportes',
                        // exportOptions: {
                        //     columns: 'th:not(:last-child)'
                        // }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> IMPRIMIR',
                        className: 'btn btn-info',
                        title: 'Reportes',
                        // exportOptions: {
                        //     columns: 'th:not(:last-child)'
                        // }
                    }
                ]
            });
        });
    </script>

