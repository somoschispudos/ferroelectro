<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .code-error{
        display: none;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title . ' / Nueva Poliza' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-8 offset-md-2">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <form method="POST" class="form">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="fecha">Fecha</label>
                                        <input type="text" class="form-control" name="fecha" id="fecha" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="fecha">Tipo poliza</label>
                                        <select name="tipo_poliza" id="tipopoliza" class="form-select">
                                            <?php
                                            foreach($tipo_polizas as $t){
                                            ?>
                                            <option value="<?= $t['id'] ?>"><?= $t['tipo'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="concepto">Concepto</label>
                                        <input type="text" class="form-control" name="concepto" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button class="btn btn-success" type="submit" name="guardar" style="margin-top: 35px; width: 100%;"><i class="fa fa-save"></i> GUARDAR</button>
                                    </div>
                                </div>
                            </form>
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