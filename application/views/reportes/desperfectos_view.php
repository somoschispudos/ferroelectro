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
                        <h4 class="mb-0"><?= $title . ' / Desperfectos' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="reporteDatatable" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>PRODUCTO</th>
                                            <th>FECHA</th>
                                            <th>CANTIDAD</th>
                                            <th>RAZÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($desperfectos as $d){
                                            $fecha = date('d-m-Y', strtotime($d['fecha']))
                                        ?>
                                        <tr>
                                            <td style="width: 110px; text-align: center;"><?= $d['sku'] ?></td>
                                            <td><?= $d['nombreproducto'] ?></td>
                                            <td style="width: 130px; text-align: center;"><?= $d['fecha'] ?></td>
                                            <td style="width: 110px; text-align: center;"><?= $d['cantidad'] ?></td>
                                            <td><?= $d['razon'] ?></td>
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Enviar a Desperfectos</h4>
                    <button class="btn btn-danger btn-sm" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="prodmodal"></h5>
                    <h6>SKU: <span id="skumodal"></span></h6>
                    <hr>
                    <form method="POST" class="form">
                        <input type="hidden" name="idp" value="" id="modalidp">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" style="width: 150px;" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Razón</label>
                                <input type="text" name="razon" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="enviar_desperfecto" class="btn btn-success">ENVIAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myModal').on('show.bs.modal', function(e) {
                var idp = $(e.relatedTarget).data('idp');
                var sku = $(e.relatedTarget).data('sku');
                var producto = $(e.relatedTarget).data('producto');

                $('#modalidp').val(idp);
                $('#prodmodal').text(producto);
                $('#skumodal').text(sku)
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
                paging: true,
                searching: true,
                order: [[1, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    // 'excel', 'pdf', 'print',
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        className: 'btn btn-danger',
                        title: 'Reporte de Existencias',
                        // orientation: 'landscape',
                        footer: true
                        // pageSize: 'LETTER',
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa fa-file-excel"></i> EXCEL',
                        className: 'btn btn-success',
                        title: 'Reporte de Existencias',
                        footer: true
                    },
                    {
                        extend: 'copy',
                        text: '<i class="fa fa-copy"></i> COPIAR',
                        className: 'btn btn-default',
                        title: 'Reporte de Existencias',
                        footer: true
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> IMPRIMIR',
                        className: 'btn btn-info',
                        title: 'Reporte de Existencias',
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