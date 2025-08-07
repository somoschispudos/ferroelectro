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

    .boldhead{
        font-weight: bold;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <a href="<?= base_url('contabilidad/cuentas_pagar') ?>" class="btn btn-info btn-sm"><i class="fa fa-chevron-left me-2"></i> Regresar</a>
                        <h4 class="mb-0"><?= $title . ' / Cuentas por Pagar' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <table class="table table-bordered table-condensed" style="font-size: 13px;">
                                <tr style="background-color: #f8fafb; font-weight: bold;">
                                    <td>POLIZA</td>
                                    <td>FECHA</td>
                                    <td>TIPO POLIZA</td>
                                    <td>CONCEPTO</td>
                                    <td>STATUS</td>
                                </tr>
                                <tr>
                                    <td><?= 'P-' . $poliza[0]['idpolizas'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($poliza[0]['fecha'])) ?></td>
                                    <td><?= $poliza[0]['tipo'] ?></td>
                                    <td><?= $poliza[0]['concepto'] ?></td>
                                    <td style="width: 140px; text-align: center;">
                                    <?php
                                        if($poliza[0]['status'] == 2){
                                            $status = '<span class="badge badge-pill badge-info" style="background-color: #ffa500;">SIN CUADRAR</span>';
                                        }elseif($poliza[0]['status'] == 1){
                                            $status = '<span class="badge badge-pill badge-light" style="background-color: #8d95ae;">SIN MOVIMIENTOS</span>';
                                        }elseif($poliza[0]['status'] == 4){
                                            $status = '<span class="badge badge-pill badge-success" style="background-color: #51d28c;">CUADRADO</span>';
                                        }

                                        echo $status;
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            // if($statuspoliza == 1){
                            ?>
                            <form method="POST" class="form">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="cuenta_contable">Cuenta Contable</label>
                                        <select id="cuenta_contable" class="idp-add" style="width: 100%;" placeholder="Seleccionar..." autocomplete="off" name="cuenta_contable">
                                            <option value=""></option>
                                            <?php
                                            foreach($cuentas_contables as $c){
                                                if($c['mostrar'] == 1){
                                            ?>
                                            <option data-idp="<?= ($c['idp'] == 0)?'0':'1' ?>" value="<?= $c['id'] ?>"><?= 'Código:' . $c['codigo'] . ' | ' . $c['nombre'] ?></option>
                                            <?php
                                                }{}
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="proveedor">Proveedor</label><a href="#" class="link"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right; background-color: #99d3ff; border: 1px solid #6b94b3; padding: 2px 5px; border-radius: 5px;">Agregar Nuevo</a>
                                        <select id="proveedor" class="idp-add" style="width: 100%;" placeholder="Seleccionar..." autocomplete="off" name="proveedor">
                                            <option value=""></option>
                                            <?php
                                            foreach($proveedores as $p){
                                            ?>
                                            <option value="<?= $p['id'] ?>"><?= 'NIT:' . $p['nit'] . ' | Proveedor: ' . $p['nombre'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="desc">Tipo Documento</label>
                                        <select name="tipo_doc" id="tipo_doc" class="form-select">
                                            <option value="0" selected="selected" disabled="disabled">Seleccionar Opción</option>
                                            <?php
                                            foreach($tipo_documentos as $t){
                                            ?>
                                            <option value="<?= $t['id'] ?>"><?= $t['documento'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="fecha">Fecha</label>
                                        <input type="text" class="form-control" name="fecha" id="fecha" required="true" autocomplete="off" required="true">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="documento">No. Documento</label>
                                        <input type="text" class="form-control" name="documento" id="documento" required="true" autocomplete="off" required="true">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="serie">Serie</label>
                                        <input type="text" class="form-control" name="serie" id="serie" required="true" autocomplete="off" required="true">
                                    </div>
                                    <div class="form-group col-md-1 galonesWrap" style="display: none;">
                                        <label for="galones">Galones</label>
                                        <input type="text" class="form-control" name="galones" id="galones" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cargo">Cargo</label>
                                        <input type="text" class="form-control currencyquet" name="cargo" id="cargo" required="true" autocomplete="off" required="true">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button class="btn btn-success" type="submit" name="guardar" style="margin-top: 35px; width: 100%;"><i class="fa fa-save"></i> GUARDAR</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            // }elseif($statuspoliza == 2){
                            ?>
                            <!-- <table class="table table-bordered table-condensed table-striped">
                                <tbody>
                                    <tr>
                                        <td class="boldhead">Cuenta Contable</td>
                                        <td class="boldhead" colspan="2">Proveedor</td>
                                        <td class="boldhead" colspan="2">Tipo Documento</td>
                                    </tr>
                                    <tr>
                                        <td><?= $cuentas_pagar[0]['codigo'] . ' - ' . $cuentas_pagar[0]['nombre'] ?></td>
                                        <td colspan="2"><?= $cuentas_pagar[0]['proveedor'] ?></td>
                                        <td colspan="2"><?= $cuentas_pagar[0]['documentonombre'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="boldhead">Fecha</td>
                                        <td class="boldhead">No. Documento</td>
                                        <td class="boldhead">Serie</td>
                                        <td class="boldhead">Galones</td>
                                        <td class="boldhead">Cargo</td>
                                    </tr>
                                    <tr>
                                        <td><?= date('d-m-Y', strtotime($cuentas_pagar[0]['fechacuentaspagar'])) ?></td>
                                        <td><?= $cuentas_pagar[0]['documento'] ?></td>
                                        <td><?= $cuentas_pagar[0]['serie'] ?></td>
                                        <td><?= ($cuentas_pagar[0]['galones'] > 0)?$cuentas_pagar[0]['galones']:'N/A' ?></td>
                                        <td style="text-align: right;">Q<?= number_format($cuentas_pagar[0]['monto'], 2, '.', ',') ?></td>
                                    </tr>
                                </tbody>
                            </table> -->
                            <?php
                            // }
                            ?>
                            <hr>
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>CUENTA</th>
                                        <th>NOMBRE CUENTA</th>
                                        <th>REFERENCIA</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>PROVEEDOR</th>
                                        <th>DOCUMENTO</th>
                                        <th>CARGO</th>
                                        <th>ABONO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalCargo = 0;
                                    $totalAbono = 0;
                                    foreach($movimientos as $m){
                                        $totalCargo = $totalCargo + $m['monto'];
                                        $totalAbono = 0;
                                    ?>
                                    <tr>
                                        <td style="width: 140px;"><?= $m['codigo'] ?></td>
                                        <td><?= $m['nombre'] ?></td>
                                        <td></td>
                                        <td><?= $m['descripcion'] ?></td>
                                        <th><?= $m['nombreproveedor'] ?></th>
                                        <th><?= $m['documento'] ?></th>
                                        <td style="text-align: right; width: 110px;">Q<?= number_format($m['monto'], 2, '.', '') ?></td>
                                        <td style="text-align: right; width: 110px;"></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $abonos = $this->model->lista_movimientos_abonos($idpoliza);
                                    if(!empty($abonos)){
                                        foreach($abonos as $a){
                                            $totalAbono = $totalAbono + $a['monto'];
                                    ?>
                                    <tr>
                                        <td style="width: 150px;"><?= $a['codigo'] ?></td>
                                        <td><?= $a['nombre'] ?></td>
                                        <td><?= $a['ref_bancaria'] ?></td>
                                        <td><?= $a['descripcion'] ?></td>
                                        <td style="text-align: right; width: 110px;"></td>
                                        <td style="text-align: right; width: 110px;">Q<?= number_format($a['monto'], 2, '.', '') ?></td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" style="text-align: right;" class="boldhead">TOTALS</td>
                                        <td style="text-align: right; width: 110px;" class="boldhead">Q<?= number_format($totalCargo, 2, '.', '') ?></td>
                                        <td style="text-align: right; width: 110px;" class="boldhead">Q<?= number_format($totalAbono, 2, '.', '') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>

            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required="true" autocomplete="off">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nombre">DPI</label>
                                <input type="text" class="form-control" name="dpi" autocomplete="off">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nombre">NIT</label>
                                <input type="text" class="form-control" name="nit" required="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nombre">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" required="true" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Dirección</label>
                            <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Email</label>
                            <input type="email" class="form-control" name="email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Contacto</label>
                            <input type="text" class="form-control" name="contacto" required="true" autocomplete="off">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">País</label>
                                <input type="text" class="form-control" name="pais" required="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Estado</label>
                                <input type="text" class="form-control" name="estado" required="true" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Código Postal</label>
                                <input type="text" class="form-control" name="codigopostal" required="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Moneda</label>
                                <select class="form-control" placeholder="Seleccionar Categoría..." autocomplete="off" name="moneda">
                                    <?php
                                    foreach($monedas as $m){
                                    ?>
                                    <option value="<?= $m['id'] ?>"><?= $m['moneda'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nombre">Condiciones de Pago</label>
                                <input type="text" class="form-control" name="condicionespago" required="true" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="nombre">Forma de Pago</label>
                                <input type="text" class="form-control" name="formapago" required="true" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-7">
                                <label for="nombre">Banco</label>
                                <input type="text" class="form-control" name="banco" required="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="nombre">Tipo Cuenta</label>
                                <select class="form-control" name="tipocuenta">
                                    <option value="Monetaria">Monetaria</option>
                                    <option value="Ahorro">Ahorro</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Cuenta Bancaria</label>
                                <input type="text" class="form-control" name="cuentabancaria" required="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Regimén Tributario</label>
                                <input type="text" class="form-control" name="regimentributario" required="true" autocomplete="off">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit" name="guardar_proveedor"><i class="fa fa-save"></i> GUARDAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        let base = '<?= base_url() ?>';
        let idp = 0;

        $('#hijos').hide();

        $('.limpiar').on('click', function(){
            $("#hijosWrapper").html('');
            $("#nietosWrapper").html('');
            $("#bisnietosWrapper").html('');
            $("#padre").prop("disabled", false);
            $("#padre").val($("#padre option:first").val());
        });

        $("#padre").change(function() {
            var id = $(this).children("option:selected").val();
            $("#hijosWrapper").load(base + 'contabilidad/cuentas_pagar/loadhijos', { id: id }, function(response, status, xhr) {
                if (status == "success") {
                    $("#padre").prop("disabled", true);
                    callHijos();
                }
            });
        });

        function callHijos() {
            $("#hijos").change(function() {
                var id = $(this).children("option:selected").val();
                $("#nietosWrapper").load(base + 'contabilidad/cuentas_pagar/loadnietos', { id: id }, function(response, status, xhr) {
                    if (status == "success") {
                        $("#hijos").prop("disabled", true);
                        callNietos();
                    }
                });
            });
        }

        function callNietos() {
            $("#nietos").change(function() {
                var id = $(this).children("option:selected").val();
                alert(id);
                $("#bisnietosWrapper").load(base + 'contabilidad/cuentas_pagar/loadbisnietos', { id: id }, function(response, status, xhr) {
                    if (status == "success") {
                        $("#nietos").prop("disabled", true);
                    }
                });
            });
        }

        var selproduct = new TomSelect("#cuenta_contable",{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        var selproduct = new TomSelect("#proveedor",{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        $('#cuenta_contable').on('change', function(){
            var idp = $("#cuenta_contable option:selected").attr("data-idp");
            if(idp == 1){
                $('.galonesWrap').show();
            }else if(idp == 0){
                $('.galonesWrap').hide();
            }
        });

        const picker1 = new Litepicker({
            element: document.getElementById('fecha'),
            format: "DD-MM-YYYY"
        });

    </script>