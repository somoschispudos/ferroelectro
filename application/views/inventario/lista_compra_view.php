<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .code-error{
        display: none;
    }

    .code-error{
        display: none;
    }

    table{
        font-family: 'Source Code Pro', monospace;
        /* font-size: 14px; */
    }

    .table > :not(caption) > * > * {
        padding: 8px;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title . ' / Nueva Compra' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Fecha</label>
                                        <input type="text" id="fecha" disabled="disabled" class="form-control" name="fecha" required="true" autocomplete="off" value="<?= $compra[0]['fecha'] ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Descripción</label>
                                        <input type="text" class="form-control" disabled="disabled" name="descripcion" required="true" autocomplete="off" value="<?= $compra[0]['descripcion'] ?>">
                                    </div>

                                </div>
                                <div class="productos-agregados">

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <form method="POST" class="form" autocomplete="notnow">
                                            <table class="table table-condensed tabled-bordered" id="addtable">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <select id="productos" class="idp-add" style="width: 100%;" placeholder="Seleccionar un producto..." autocomplete="off" name="productos">
                                                                <option value=""></option>
                                                                <?php
                                                                foreach($productos as $p){
                                                                ?>
                                                                <option data-sku="<?= $p['sku'] ?>" value="<?= $p['idpr'] ?>"><?= $p['sku'] . ' - ' . $p['nombreproducto'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </th>
                                                        <th style="width: 130px;">
                                                            <input type="text" class="form-control cantidad-add" name="cantidad" autocomplete="off" placeholder="Cantidad" required="true">
                                                        </th>
                                                        <th style="width: 130px;">
                                                            <input type="text" style="text-align: right;" class="form-control currencyquet costo-add" name="costo" autocomplete="off" placeholder="Costo" required="true">
                                                        </th>
                                                        <th style="width: 80px;">
                                                            <button type="submit" name="agregar" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></button>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <table class="table table-condensed table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>SKU</th>
                                                    <th>PRODUCTO</th>
                                                    <th style="width: 130px;">COSTO U.</th>
                                                    <th style="width: 130px;">CANTIDAD</th>
                                                    <th style="width: 130px;">TOTAL</th>
                                                    <th>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="listacompras">
                                                <?php
                                                $merototal = 0;
                                                foreach($listaproductos as $l){
                                                    $conteo = $this->model->lista_inventario_conteo($l['idcompra'], $l['idproducto']);
                                                    $eltotal = $conteo * $l['costo'];
                                                    $merototal = $merototal + $eltotal;
                                                ?>
                                                <tr>
                                                    <td style="width: 130px;"><?= $l['sku'] ?></td>
                                                    <td><?= $l['nombreproducto'] ?></td>
                                                    <td style="text-align: right;"><?= 'Q' . number_format($l['costo'], 2, '.', ',') ?></td>
                                                    <td style="text-align: center;"><?= $conteo ?></td>
                                                    <td style="text-align: right;"><?= 'Q' . number_format($eltotal, 2, '.', ',') ?></td>
                                                    <td style="width: 70px; text-align: center;">
                                                        <a href="<?= base_url('inventario/compras/eliminar_lista/' . $l['idcompra'] . '/' . $l['idproducto']) ?>" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td style="text-align: right;"><?= 'Q' . number_format($merototal, 2, '.', ',') ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <script>
    let base = '<?= base_url() ?>';

    const picker1 = new Litepicker({
        element: document.getElementById('fecha'),
        format: "DD-MM-YYYY"
    });

    var selproduct = new TomSelect("#productos",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });




</script>