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

    .tituloAzul {
        color: #56bacf;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title . ' / Cuentas Bancos' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <h4 class="tituloAzul">Bancos</h4>
                            <div class="row">
                                <?php
                                foreach($bancos as $b){
                                ?>
                                <div class="col-md-3 p-4">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img style="width: 70px;" src="<?= base_url('assets/images/bancos/'. $b['logo'] . '.jpg') ?>" alt="">
                                        </div>
                                        <div class="col-md-9">
                                            <h5 class="tituloAzul"><a href="<?= base_url('contabilidad/cuentas_bancos/saldos_banco/'.$b['idbanco']) ?>"><?= $b['nombre_banco'] ?> <i class="fa-duotone fa-2xs fa-arrow-up-right-from-square"></i></a></h5>
                                            <p style="margin: 0px;"><?= $b['cuenta'] ?></p>
                                            <p style="margin: 0px;"><?= ($b['tipo_cuenta'] == 1)?'Monetaria': 'Ahorro' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <hr>
                            <h4 class="tituloAzul">Cuentas por Pagar</h4>
                            <div class="table-responsive">
                                <table id="cuentasPagar" class="table table-striped table-bordered table-condensed table-hovered table-selected" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>FECHA</th>
                                            <th>TIPO POLIZA</th>
                                            <th>CONCEPTO</th>
                                            <th>STATUS</th>
                                            <th>CARGO</th>
                                            <th>ABONO(S)</th>
                                            <th>SALDO</th>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalTodo = 0;
                                        foreach($polizas as $p){
                                        ?>
                                        <tr class="lasPolizas">
                                            <td style="width: 90px;"><?= 'P-'.$p['idpolizas'] ?></td>
                                            <td style="width: 100px; text-align: center;"><?= date('d-m-Y', strtotime($p['fecha'])) ?></td>
                                            <td style="width: 200px; text-align: center;"><?= $p['tipo'] ?></td>
                                            <td><?= $p['concepto'] ?></td>
                                            <td style="width: 100px; text-align: center;">
                                                <?php
                                                $status = '<span class="badge badge-pill badge-info" style="background-color: #ffa500;">SIN CUADRAR</span>';
                                                echo $status;
                                                ?>
                                            </td>
                                            <td style="width: 130px; text-align: right;">
                                                <?php
                                                $cargo = $this->model->get_movimientos_cargos($p['idpolizas']);
                                                $totalTodo = $totalTodo + $cargo[0]['suma'];
                                                    echo 'Q'.$cargo[0]['suma'];
                                                ?>
                                            </td>
                                            <td style="width: 130px; text-align: right;">
                                                <?php
                                                $abono = $this->model->get_movimientos_abonos($p['idpolizas']);

                                                if(empty($abono[0]['suma'])){
                                                    echo "Q0.00";
                                                }else{
                                                    echo 'Q'.$abono[0]['suma'];
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 130px; text-align: right;">
                                                <?php
                                                $saldo = $cargo[0]['suma'] - $abono[0]['suma'];
                                                $saldo = number_format($saldo, 2, '.', ',');
                                                // $suma_cargos = $this->model->get_movimientos_cargos($p['idpolizas']);
                                                echo 'Q'. $saldo;
                                                ?>
                                            </td>
                                            <td style="text-align: right; width: 170px;">
                                                <?php
                                                //mostrar para bancos solo si es status 2
                                                if($p['status'] == 3){
                                                ?>
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm btn-block" data-saldo="<?= $saldo ?>" data-idpoliza="<?= $p['idpolizas'] ?>" data-monto="<?= 'Q'.$cargo[0]['suma'] ?>" data-bs-toggle="modal" data-bs-target="#procesarModal"><i class="fa-duotone fa-money-check-dollar-pen"></i> PROCESAR PAGO</a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" style="text-align: right; font-weight: bold;">SUMA TOTALES</td>
                                            <td style="width: 130px; text-align: right;">Q<?= number_format($totalTodo, 2,'.', ',') ?></td>
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

    <div class="modal fade" id="procesarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #56bacf;" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="idpoliza" id="inputPoliza">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="bancos">Banco</label>
                                <select name="banco" id="bancos" class="form-select">
                                    <?php
                                    foreach($bancos as $b){
                                    ?>
                                    <option value="<?= $b['idbanco'] ?>">
                                    <?= $b['nombre_banco'] . ' | ' . $b['cuenta'] . ' | ' . $b['moneda'] ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha</label>
                                <input type="text" class="form-control" name="fecha" id="fecha" required="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipodoc">Tipo Documento</label>
                                <select name="tipodoc" class="form-select">
                                    <option value="" selected="selected" disabled="disabled">Seleccionar...</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="refbank">Referencia Bancaria</label>
                                <input type="text" id="refbank" class="form-control" name="refbank" required="true" autocomplete="off">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="abono">Abono</label>
                                <input type="text" id="abonoModal" class="form-control currencyquet" name="abono" required="true" autocomplete="off" required="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" id="descModal" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <h3 style="color: #56bacf;">Abonos</h3>
                        <div class="misabonos"></div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12" style="text-align: center;">
                                <button type="submit" name="procesarAbono" class="btn btn-success btn-block" style="width: 100%;">PROCESAR ABONO</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    const base = '<?= base_url() ?>';

    $('#procesarModal').on('show.bs.modal', function (event) {
        var target = $(event.relatedTarget);
        var monto = target.data('monto');
        var idpoliza = target.data('idpoliza');
        var saldo = target.data('saldo');
        var modal = $(this);

        modal.find('.modal-title').text('Procesar Abono de Q' + saldo);

        $(this).find('.misabonos').load(base + "contabilidad/cuentas_bancos/carga_abonos", { idpoliza: idpoliza });

        $('#fecha').val('');
        $('#inputPoliza').val(idpoliza);
        $('#refbank').val('');
        $('#abonoModal').val('');
        $('#descModal').val('');
    });

    const picker1 = new Litepicker({
        element: document.getElementById('fecha'),
        format: "DD-MM-YYYY"
    });

</script>