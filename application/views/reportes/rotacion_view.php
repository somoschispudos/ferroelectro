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
                        <h4 class="mb-0"><?= $title . ' / Rotación de Inventario' ?></h4>
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
                                <table id="reporteDatatable" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>PRODUCTO</th>
                                            <th>MARCA</th>
                                            <th>CATEGORÍA</th>
                                            <th>COMPRAS</th>
                                            <th>VENTAS</th>
                                            <th>EXIST.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($productos as $p){
                                            $ventasTotal = $this->model->all_productos_id_sold($p['idpr']);
                                        ?>
                                        <tr>
                                            <td style="width: 90px; text-align: center;">
                                                <?php
                                                if($ventasTotal > 0){
                                                ?>
                                                <a href="<?= base_url('reportes/rotacion/historial_rotacion/' . $p['idpr']) ?>"><?= $p['sku'] ?></a>
                                                <?php
                                                }elseif($ventasTotal == 0){
                                                ?>
                                                <?= $p['sku'] ?>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?= $p['nombreproducto'] ?></td>
                                            <td><?= $p['marca'] ?></td>
                                            <td><?= $p['categoria'] ?></td>
                                            <td style="width: 110px; text-align: right;">
                                            <?php
                                            $comprasTotal = $this->model->get_all_productos_iventario($p['idpr']);
                                            echo $comprasTotal;
                                            ?>
                                            </td>
                                            <td style="width: 110px; text-align: right;">
                                            <?php
                                            echo $ventasTotal;
                                            $exist = $comprasTotal - $ventasTotal;
                                            ?>
                                            </td>
                                            <td style="width: 90px; text-align: center; color:<?= ($exist <= $p['cantmin'])?'red':'black' ?>;"><?= $exist ?></td>
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
    <script>
        $(document).ready(function () {
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