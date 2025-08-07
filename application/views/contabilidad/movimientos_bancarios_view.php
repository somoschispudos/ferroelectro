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
                        <h4 class="mb-0"><?= $title . ' / Movimientos Bancarios' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <h4 class="tituloAzul">Operaciones</h4>
                            <hr>
                            <div class="btn-group-vertical" style="width: 100%;">
                                <a href="javascript:void(0);" class="btn btn-info btn-block"  data-idb="<?= $banco[0]['idbanco'] ?>" data-bs-toggle="modal" data-bs-target="#procesarModal">TRANSFERENCIA A OTRO BANCO</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-block"  data-idb="<?= $banco[0]['idbanco'] ?>" data-bs-toggle="modal" data-bs-target="#procesarModal2">TRANSFERENCIA TERCEROS</a>
                                <a href="<?= base_url('contabilidad/cuentas_bancos') ?>" class="btn btn-light">REGRESAR</a>
                            </div>
                            <hr>
                            <h4 style="color: #6bb36b;">SALDO Q<?= number_format($movimientos[0]['saldo'], 2, '.', ',') ?></h4>
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <input type="text" id="min" name="min">
                                    <input type="text" id="max" name="max">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <h4 class="tituloAzul">
                                <img style="width: 50px;" src="<?= base_url('assets/images/bancos/'. $banco[0]['logo'] . '.jpg') ?>" alt="">
                                <?= $banco[0]['nombre_banco'] . ' : ' . $banco[0]['cuenta'] ?>
                            </h4>
                            <div class="table-responsive">
                                <table id="movimientosbancos" class="table table-striped table-bordered table-condensed table-hovered table-selected" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>DOCUMENTO</th>
                                            <th>DESCRIPCIÓN</th>
                                            <th>DEBITO (-)</th>
                                            <th>CREDITO (+)</th>
                                            <th>SALDO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($movimientos as $m){
                                        ?>
                                        <tr>
                                            <?php
                                            if($m['descripcion'] == 'Saldo Inicial'){
                                            ?>
                                            <td style="width: 100px; text-align: center;">---</td>
                                            <td style="width: 200px; text-align: center;">---</td>
                                            <td><?= $m['descripcion'] ?></td>
                                            <td style="width: 140px; text-align: right;">---</td>
                                            <td style="width: 140px; text-align: right;">---</td>
                                            <?php
                                            }else{
                                            ?>
                                            <td style="width: 100px; text-align: center;"><?= date('d-m-Y', strtotime($m['fecha'])) ?></td>
                                            <td style="width: 200px; text-align: center;"><?= $m['doc'] ?></td>
                                            <td><?= $m['descripcion'] ?></td>
                                            <td style="width: 140px; text-align: right;">
                                                <?= ($m['tipo'] == 'Egreso')?'<span style="color:red;">Q'.$m['monto'].'</span>':'' ?>
                                            </td>
                                            <td style="width: 140px; text-align: right;">
                                                <?= ($m['tipo'] == 'Ingreso')?'<span style="color:blue;">Q'.$m['monto'].'</span>':'' ?>
                                            </td>
                                            <?php
                                            }
                                            ?>
                                            <td style="width: 140px; text-align: right;">
                                                <?= 'Q'.$m['saldo'] ?>
                                            </td>
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

    <div class="modal fade" id="procesarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #56bacf;" id="exampleModalLabel">Transferencia a otros bancos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="bancos">Banco a Transferir</label>
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
                                <label for="abono">Monto</label>
                                <input type="text" id="abonoModal" class="form-control currencyquet" name="monto" required="true" autocomplete="off" required="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" id="descModal" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12" style="text-align: center;">
                                <button type="submit" name="transferir" class="btn btn-success btn-block" style="width: 100%;">PROCESAR TRANSFERENCIA</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="procesarModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: #56bacf;" id="exampleModalLabel">Transferencia Terceros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="bancos">Deudores</label>
                                <select name="deudores" id="deudores" class="form-select">
                                    <?php
                                    foreach($deudores as $d){
                                    ?>
                                    <option value="<?= $d['id'] ?>">
                                    <?= $d['nombre'] ?>
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
                                <input type="text" class="form-control" name="fecha" id="fecha2" required="true" autocomplete="off">
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
                                <label for="abono">Monto</label>
                                <input type="text" id="abonoModal" class="form-control currencyquet" name="monto" required="true" autocomplete="off" required="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" id="descModal" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12" style="text-align: center;">
                                <button type="submit" name="transferir_terceros" class="btn btn-success btn-block" style="width: 100%;">PROCESAR TRANSFERENCIA</button>
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
        var idbanco = target.data('idbanco');
        var modal = $(this);


        // $('#fecha').val('');
        // $('#inputPoliza').val(idpoliza);
        // $('#refbank').val('');
        // $('#abonoModal').val('');
        // $('#descModal').val('');
    });

    const picker1 = new Litepicker({
        element: document.getElementById('fecha'),
        format: "DD-MM-YYYY"
    });

    const picker2 = new Litepicker({
        element: document.getElementById('fecha2'),
        format: "DD-MM-YYYY"
    });
</script>