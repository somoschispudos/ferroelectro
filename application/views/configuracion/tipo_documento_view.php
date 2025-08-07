<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .code-error{
        display: none;
    }
    table{
        font-family: 'Source Code Pro', monospace;
        font-size: 12px;
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
                        <h4 class="mb-0"><?= $title . ' / Tipo de Documento' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            if($msg == 'success'){
                            ?>
                            <div class="alert alert-success" role="alert">
                                Tipo de documento creado exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($msg == 'duplicate'){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Tipo de documento ya existe en la base de datos
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Tipo</label>
                                        <input type="text" class="form-control" name="gasto" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="origen">Origen</label>
                                        <select name="origen" class="form-select">
                                            <option value="1">Merc.</option>
                                            <option value="2">Serv.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mt-4 col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="iva_compras" type="checkbox" role="switch" id="flexSwitchCheckDefault1">
                                            <label class="form-check-label" for="flexSwitchCheckDefault1">IVA Compras</label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="combustible" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
                                            <label class="form-check-label" for="flexSwitchCheckDefault2">Combustible</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Valor IDP</label>
                                        <input type="text" class="form-control" name="valoridp" autocomplete="off">
                                    </div>
                                    <div class="form-group mt-4 col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="retencion_iva" type="checkbox" role="switch" id="flexSwitchCheckDefault3">
                                            <label class="form-check-label" for="flexSwitchCheckDefault3">Retención IVA</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mt-4 col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="retencion_isr" type="checkbox" role="switch" id="flexSwitchCheckDefault4">
                                            <label class="form-check-label" for="flexSwitchCheckDefault4">Retención ISR</label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="peq_contr" type="checkbox" role="switch" id="flexSwitchCheckDefault5">
                                            <label class="form-check-label" for="flexSwitchCheckDefault5">Peque. Contr.</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mt-4 col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="nota_credito" type="checkbox" role="switch" id="flexSwitchCheckDefault6">
                                            <label class="form-check-label" for="flexSwitchCheckDefault6">Nota Credito</label>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="extento" type="checkbox" role="switch" id="flexSwitchCheckDefault7">
                                            <label class="form-check-label" for="flexSwitchCheckDefault7">Extento</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">% Ret. ISR</label>
                                        <input type="text" class="form-control" name="ret_isr" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nombre">% Ret. IVA</label>
                                        <input type="text" class="form-control" name="ret_iva" autocomplete="off">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
                                </div>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>TIPO</th>
                                            <th>ORIGEN</th>
                                            <th>IVA COMPRAS</th>
                                            <th>COMB.</th>
                                            <th>IDP</th>
                                            <th>RET. IVA</th>
                                            <th>RET. ISR</th>
                                            <th>PEQ. CONTR.</th>
                                            <th>NOTA CRÉDITO</th>
                                            <th>EXTENTO</th>
                                            <th>ISR %</th>
                                            <th>IVA %</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($tipo_gastos as $t){
                                        ?>
                                        <tr <?= ($t['status'] == 0)?'style="color: #b8b8b8;"':'' ?>>
                                            <td><?= $t['gasto'] ?></td>
                                            <td>
                                                <?php
                                                if($t['origen'] == 1){
                                                    echo "Mercaderia";
                                                }elseif($t['origen'] == 2){
                                                    echo "Servicio";
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 60px; text-align: center; padding-top: 12px;">
                                                <?php
                                                if($t['iva_compras'] == 1){
                                                    echo '<i style="color: green;" class="fa-duotone fa-circle-check fa-xl"></i>';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 60px; text-align: center; padding-top: 12px;">
                                                <?php
                                                if($t['combustible'] == 1){
                                                    echo '<i style="color: green;" class="fa-duotone fa-circle-check fa-xl"></i>';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 65px; text-align: <?= ($t['combustible'] == 1)?'right;':'center;' ?>; padding-top: 12px;">
                                                <?php
                                                if($t['combustible'] == 1){
                                                    echo $t['idp'].'%';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 60px; text-align: center; padding-top: 12px;">
                                                <?php
                                                if($t['retencion_iva'] == 1){
                                                    echo '<i style="color: green;" class="fa-duotone fa-circle-check fa-xl"></i>';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 60px; text-align: center; padding-top: 12px;">
                                                <?php
                                                if($t['retencion_isr'] == 1){
                                                    echo '<i style="color: green;" class="fa-duotone fa-circle-check fa-xl"></i>';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 60px; text-align: center; padding-top: 12px;">
                                                <?php
                                                if($t['peque_cont'] == 1){
                                                    echo '<i style="color: green;" class="fa-duotone fa-circle-check fa-xl"></i>';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 60px; text-align: center; padding-top: 12px;">
                                                <?php
                                                if($t['nota_credito'] == 1){
                                                    echo '<i style="color: green;" class="fa-duotone fa-circle-check fa-xl"></i>';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 60px; text-align: center; padding-top: 12px;">
                                                <?php
                                                if($t['extento'] == 1){
                                                    echo '<i style="color: green;" class="fa-duotone fa-circle-check fa-xl"></i>';
                                                }else{
                                                    echo '<i style="color: red;" class="fa-duotone fa-circle-xmark fa-xl"></i>';
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 70px; text-align: right;"><?= $t['por_ret_isr'].'%' ?></td>
                                            <td style="width: 70px; text-align: right;"><?= $t['por_ret_iva'].'%' ?></td>
                                            <?php
                                            if($t['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('configuracion/categorias/reactivar_categoria/' . $t['id']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 40px;">
                                                <a href="<?= base_url('configuracion/categorias/eliminar_categoria/' . $t['id']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                            <?php
                                            }
                                            ?>
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