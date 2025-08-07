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
                        <h4 class="mb-0"><?= $title . ' / Pago de crédito' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <!-- <form method="POST" class="form" autocomplete="notnow"> -->
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <table class="table table-bordered table-condensed" style="font-size: 13px;">
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>CÓDIGO VENTA</td>
                                            </tr>
                                            <tr>
                                                <td><?= 'V-' . $venta[0]['id'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>VENDEDOR</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $asesor = $this->model->get_user($venta[0]['idasesor']);
                                                ?>
                                                <td><?= $asesor[0]['nombre'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>CÓDIGO CLIENTE</td>
                                            </tr>
                                            <tr>
                                                <td><?= 'CL-' . $cliente[0]['idclient'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>CLIENTE</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['nombre'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>NIT</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['nit'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>RAZÓN SOCIAL</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['razonsocial'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>TELÉFONO</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['contacto'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>EMAIL</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['email'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>DIRECCIÓN</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['direccion'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>DEPARTAMENTO</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['namedepartamento'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>MUNICIPIO</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['namemunicipio'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            <!-- </form> -->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <table class="table table-condensed table-striped table-bordered">
                                <thead>
                                <?php
                                    $totalSinD = $this->model->get_lasuma_venta($venta[0]['id']);
                                    $totalSinD = $totalSinD[0]['sumatotal'];
                                    $descuento = $venta[0]['descuento'] * $totalSinD;

                                    $saldoInicial = $totalSinD - $descuento;
                                    ?>
                                    <tr style="font-size: 1.2em; color: #007d00; background-color: #c2ffc2;">
                                        <td style="text-align: right; font-weight: bold;" colspan=4>Saldo inicial</td>
                                        <td style="text-align: right; font-weight: bold;">Q<?= number_format($saldoInicial, 2, '.', ',') ?></td>
                                    </tr>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>BANCO</th>
                                        <th>DOCUMENTO</th>
                                        <th style="text-align: center;">ABONO</th>
                                        <th style="text-align: center;">SALDO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $saldo = $saldoInicial;
                                    foreach($pagos as $p){
                                    ?>
                                    <tr>
                                        <td><?= date('d-m-Y', strtotime($p['fecha_pago'])) ?></td>
                                        <td><?= $p['nombre_banco'] . ' | ' . $p['cuenta'] ?></td>
                                        <td><?= $p['doc'] ?></td>
                                        <td style="text-align: right;">Q<?= number_format($p['monto'], 2, '.', ',') ?></td>
                                        <td style="text-align: right;">
                                            <?php
                                            $saldo = $saldo - $p['monto'];
                                            echo "Q" . number_format($saldo, 2, '.', ',');
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr style="font-size: 1.2em; color: #007d00; background-color: #c2ffc2;">
                                        <td style="text-align: right; font-weight: bold;" colspan=4>Saldo pendiente</td>
                                        <td style="text-align: right; font-weight: bold;">Q<?= number_format($saldo, 2, '.', ',') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                            if($saldo > 0){
                            ?>
                            <hr>
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label for="bancos">Banco</label>
                                        <select name="banco" id="bancos" class="form-control">
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
                                    <div class="col-md-2">
                                        <label for="abono">Documento</label>
                                        <input required="required" type="text" class="form-control" name="doc" value="" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Fecha</label>
                                        <input type="text" id="fecha" class="form-control" name="fecha" required="true" autocomplete="off">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="abono">Abono</label>
                                        <input style="text-align: right;" required="required" type="text" class="form-control currencyquet" name="abono" value="0" autocomplete="off">
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label style="color: #fff;">.</label>
                                        <button type="submit" name="pagar" class="btn btn-success form-control"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            }
                            ?>
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
   </script>
