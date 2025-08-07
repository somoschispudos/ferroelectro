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
                        <h4 class="mb-0"><?= $title . ' / Gastos' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            if($msg == 'success'){
                            ?>
                            <div class="alert alert-success" role="alert">
                                Gasto creado exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form">
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="nombre">Fecha</label>
                                        <input type="text" class="form-control" id="fecha" name="fecha" required="true" autocomplete="off" value="<?= date('d-m-Y') ?>">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="nombre">Monto</label>
                                        <input type="text" class="form-control currencyquet" name="monto" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nombre">Cuenta</label>
                                        <select name="cuenta" class="form-select">
                                            <?php
                                            foreach($bancos as $b){
                                                if($b['status'] == 1){
                                            ?>
                                            <option value="<?= $b['idbanco'] ?>"><?= $b['nombre_banco'] . ': ' . $b['cuenta'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Proveedor</label>
                                        <select name="proveedor" class="form-select">
                                            <?php
                                            foreach($proveedores as $p){
                                                if($p['status'] == 1){
                                            ?>
                                            <option value="<?= $p['id'] ?>"><?= $p['nombre'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Tipo Gasto</label>
                                        <select name="tipo_gastos" class="form-select">
                                            <?php
                                            foreach($tipo_gastos as $t){
                                            ?>
                                            <option value="<?= $t['id'] ?>"><?= $t['gasto'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Método de Pago</label>
                                        <select name="metodo_pago" class="form-select">
                                            <option value="Efectivo">Efectivo</option>
                                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                            <option value="Deposito">Deposito</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="TdC">TdC</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="nombre">Referencia</label>
                                        <input type="text" class="form-control" name="referencia" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="nombre">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion" autocomplete="off">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group col-md-2 offset-md-10" style="text-align: right;">
                                        <button class="btn btn-success btn-block" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clientSearch" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>MONTO</th>
                                            <th>CUENTA</th>
                                            <th>PROVEEDOR</th>
                                            <th>TIPO GASTO</th>
                                            <th>MÉTODO PAGO</th>
                                            <th>REFERENCIA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($gastos as $g){
                                        ?>
                                        <tr>
                                            <td><?= date('d-m-Y', strtotime($g['fechagastos'])) ?></td>
                                            <td>Q<?= number_format($g['monto'], 2, '.', ',') ?></td>
                                            <td><?= $g['nombre_banco'] . ': ' . $g['cuenta'] ?></td>
                                            <td><?= $g['nombre'] ?></td>
                                            <td><?= $g['gasto'] ?></td>
                                            <td><?= $g['metodo'] ?></td>
                                            <td><?= $g['referencia'] ?></td>
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
        // new TomSelect("#departamentos",{
        //     create: false,
        //     sortField: {
        //         field: "text",
        //         direction: "asc"
        //     }
        // });

        // new TomSelect("#municipios",{
        //     create: false,
        //     sortField: {
        //         field: "text",
        //         direction: "asc"
        //     }
        // });
        let base = '<?= base_url() ?>';


        const picker1 = new Litepicker({
            element: document.getElementById('fecha'),
            format: "DD-MM-YYYY"
        });

        $('#departamentos').on('change', function(e){
           $('.losMunicipios').html('<div class="looping-rhombuses-spinner"><div class="rhombus"></div><div class="rhombus"></div><div class="rhombus"></div></div>');

           let iddep = $(this).val();
           console.log(iddep);

           minAjax({
                url: base + 'ajax/getMunicipios',
                type:"POST",
                data:{
                    iddep: iddep
                },

                success: function(data){
                    $('.losMunicipios').html(data);
                }
            });
        });
    </script>