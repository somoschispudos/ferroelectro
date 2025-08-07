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
                        <h4 class="mb-0"><?= $title . ' / Editar Cliente' ?></h4>
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
                                    <div class="form-group col-md-3">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" required="true" autocomplete="off" value="<?= $cliente[0]['nombre'] ?>">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="nombre">NIT</label>
                                        <input type="text" class="form-control" name="nit" required="true" autocomplete="off" value="<?= $cliente[0]['nit'] ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Razón Social</label>
                                        <input type="text" class="form-control" name="razonsocial" autocomplete="off" value="<?= $cliente[0]['razonsocial'] ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nombre">Teléfono</label>
                                        <input type="text" class="form-control" name="contacto" autocomplete="off" value="<?= $cliente[0]['contacto'] ?>">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nombre">Email</label>
                                        <input type="email" class="form-control" name="email" autocomplete="off" value="<?= $cliente[0]['email'] ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" required="true" autocomplete="off" value="<?= $cliente[0]['direccion'] ?>">
                                    </div>
									<div class="form-group col-md-2" style="padding-top: 35px;">
                                        <a href="<?= base_url('administracion/clientes') ?>" class="btn btn-light">Cancelar</a>
                                        <button class="btn btn-success btn-block" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
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
