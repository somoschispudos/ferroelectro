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

    .totalBancos{
        width: 130px;
        text-align: right;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title . ' / Cuentas por Pagar' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                        <a href="<?= base_url('contabilidad/cuentas_pagar/nueva_poliza') ?>" class="btn btn-success" style="margin-bottom: 20px;"><i class="fas fa-plus"></i> CREAR POLIZA</a>
                            <h4 class="tituloAzul">Nuevas Polizas de Gastos</h4>
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
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($polizas as $p){
                                            if(($p['status'] < 3) || ($p['status'] == 4)){
                                        ?>
                                        <tr class="lasPolizas">
                                            <td style="width: 90px;"><?= 'P-'.$p['idpolizas'] ?></td>
                                            <td style="width: 100px; text-align: center;"><?= date('d-m-Y', strtotime($p['fecha'])) ?></td>
                                            <td style="width: 200px; text-align: center;"><?= $p['tipo'] ?></td>
                                            <td><?= $p['concepto'] ?></td>
                                            <td style="width: 100px; text-align: center;">
                                                <?php
                                                if($p['status'] == 2){
                                                    $status = '<span class="badge badge-pill badge-info" style="background-color: #ffa500;">SIN CUADRAR</span>';
                                                }elseif($p['status'] == 1){
                                                    $status = '<span class="badge badge-pill badge-light" style="background-color: #8d95ae;">SIN MOVIMIENTOS</span>';
                                                }elseif($p['status'] == 4){
                                                    $status = '<span class="badge badge-pill badge-success" style="background-color: #51d28c;">CUADRADO</span>';
                                                }

                                                echo $status;
                                                ?>
                                            </td>
                                            <td style="width: 130px; text-align: right;">
                                                <?php
                                                $cargo = $this->model->get_movimientos_cargos($p['idpolizas']);
                                                if($p['status'] == 2 || $p['status'] == 4){
                                                    echo 'Q'.$cargo[0]['suma'];
                                                }else{
                                                    echo '-----';
                                                }

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
                                                // $suma_cargos = $this->model->get_movimientos_cargos($p['idpolizas']);
                                                echo 'Q'.number_format($saldo, 2, '.', ',');
                                                ?>
                                            </td>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                            <?php
                                                //mostrar para bancos solo si es status 1
                                                if($p['status'] == 1){
                                                ?>
                                                <a href="<?= base_url('contabilidad/cuentas_pagar/editar_movimientos/' . $p['idpolizas']) ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                                <?php
                                                }if($p['status'] == 4){
                                                ?>
                                                <a href="<?= base_url('contabilidad/cuentas_pagar/editar_movimientos/' . $p['idpolizas']) ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                <?php
                                                }elseif($p['status'] == 3){
                                                ?>
                                                <a href="<?= base_url('contabilidad/cuentas_pagar/editar_movimientos/' . $p['idpolizas']) ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: right; width: 40px;">
                                                <?php
                                                //mostrar para bancos solo si es status 2
                                                if($p['status'] == 2){
                                                ?>
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm btn-block agregarPoliza" data-id="<?= $p['idpolizas'] ?>" data-fecha="<?= date('d-m-Y', strtotime($p['fecha'])) ?>" data-tipo="<?= $p['tipo'] ?>" data-concepto="<?= $p['concepto'] ?>" data-cargo="<?= $cargo[0]['suma'] ?>"><i class="fa fa-arrow-down"></i></a>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div><!-- end table responsive -->
                            <hr>
                            <h4 class="tituloAzul tituloBancos"></h4>
                            <div class="table-responsive polizasWrapper" style="display: none;">
                                <form method="POST">
                                    <table id="cuentasPagar" class="table table-striped table-bordered table-condensed table-hovered table-selected" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>FECHA</th>
                                                <th>TIPO POLIZA</th>
                                                <th>CONCEPTO</th>
                                                <th>CARGO</th>
                                            </tr>
                                        </thead>
                                        <tbody class="rowSeleccionado">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" style="font-weight: bold; text-align: right;">TOTAL</td>
                                                <td class="totalBancos">0</div>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="enviarBtn" style="text-align: center; display: none;">
                                        <button type="submit" name="enviarBancos" class="btn btn-success btn-lg">ENVIAR A BANCOS</button>
                                    </div>
                                </form>
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
        $('.agregarPoliza').on('click', function(){
            let id = $(this).data('id');
            let fecha = $(this).data('fecha');
            let tipo = $(this).data('tipo');
            let concepto = $(this).data('concepto');
            let cargo = $(this).data('cargo');

            $(this).parent().parent().remove();

            let html = '<tr>';
            html += '<input type="hidden" name="polizas[]" value="'+id+'">';
            html += '<td style="width: 90px;">P-' + id + '</td>';
            html += '<td style="width: 100px; text-align: center;">' + fecha + '</td>';
            html += '<td style="width: 200px; text-align: center;">' + tipo + '</td>';
            html += '<td>' + concepto + '</td>';
            html += '<td style="width: 130px; text-align: right;">Q' + cargo + '</td>';
            html += '</tr>';

            $('.rowSeleccionado').append(html);

            let cargoTotal = $('.totalBancos').text();

            if(cargoTotal === undefined || cargoTotal === NaN){
                cargoTotal = 0;
            }else{
                cargoTotal = cargoTotal.replace('Q', '');
            }

            console.log(cargoTotal)

            cargoTotal = parseFloat(cargoTotal);
            cargo = parseFloat(cargo);
            cargoTotal = cargoTotal + cargo;

            $('.totalBancos').html("Q"+cargoTotal.toFixed(2));

            var rowCount = $('.rowSeleccionado > tr').length;
            if(rowCount == 1){
                $('.enviarBtn').show();
                $('.polizasWrapper').show();
                $('.tituloBancos').text('Cuentas a Enviar a Proceso de Bancos')
            }
        });
    </script>