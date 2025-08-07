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
                        <h4 class="mb-0"><?= $title . ' / Existencias Inventario' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <form method="POST" class="form">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Marca</label>
                                        <select class="form-control" placeholder="Seleccionar Marca..." autocomplete="off" name="marcaid">
                                            <option value="<?= ($marcaURL == 0)?'selected="selected"':'' ?>">Todas</option>
                                            <?php
                                            foreach($marcas as $m){
                                            ?>
                                            <option <?= ($marcaURL == $m['id'])?'selected="selected"':'' ?> value="<?= $m['id'] ?>"><?= $m['marca'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="nombre">Categoría</label>
                                        <select class="form-control" placeholder="Seleccionar Categoría..." autocomplete="off" name="categoriaid">
                                            <option  value="<?= ($categoriaURL == 0)?'selected="selected"':'' ?>">Todas</option>
                                            <?php
                                            foreach($categorias as $c){
                                            ?>
                                            <option <?= ($categoriaURL == $c['id'])?'selected="selected"':'' ?> value="<?= $c['id'] ?>"><?= $c['categoria'] ?></option>
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
                                <?php
                                if($msg == 'success'){
                                ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Se ha transferido a desperfectos los productos.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <?php
                                }
                                ?>
                                <table id="reporteDatatable" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>PRODUCTO</th>
                                            <th>MARCA</th>
                                            <th>CATEGORÍA</th>
                                            <?php
                                                if($_SESSION['rol'] == 1){
                                            ?>
                                            <th>COSTO (GQT)</th>
                                            <?php
                                                }
                                            ?>
                                            <th>VENTA (GQT)</th>
                                            <th>EXIST.</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($productos as $p){
                                            $exist = $this->model->lista_inventario_conteo_productos($p['idpr']);
                                            $desperfectos = $this->model->lista_inventario_conteo_desperfectos($p['idpr']);
                                            $totales = $exist + $desperfectos;
                                        ?>
                                        <tr>
                                            <td style="width: 90px; text-align: center;"><?= $p['sku'] ?></td>
                                            <td><?= $p['nombreproducto'] ?></td>
                                            <td><?= $p['marca'] ?></td>
                                            <td><?= $p['categoria'] ?></td>
                                            <?php
                                                if($_SESSION['rol'] == 1){
                                            ?>
                                            <td style="width: 110px; text-align: right;"><?= number_format($p['costo'], 2, '.', '') ?></td>
                                            <?php
                                                }
                                            ?>
                                            <td style="width: 110px; text-align: right;"><?= number_format($p['venta'], 2, '.', '') ?></td>
                                            <td style="width: 90px; text-align: center; color:<?= ($exist <= $p['cantmin'])?'red':'black' ?>;"><?= $exist ?></td>
                                            <td style="width: 90px; text-align: center;"><?= $totales ?></td>
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
