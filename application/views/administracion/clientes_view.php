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
                        <h4 class="mb-0"><?= $title . ' / Clientes' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
                            ?>
                            <a href="<?= base_url('administracion/clientes/nuevo_cliente') ?>" class="btn btn-success" style="margin-bottom: 20px;"><i class="fas fa-plus"></i> NUEVO CLIENTE</a>
                            <?php
                            }
                            ?>
                            <div class="table-responsive">
                                <table id="clientSearch" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>COD.</th>
                                            <th>NOMBRE</th>
                                            <th>EMAIL</th>
                                            <th>NIT</th>
                                            <th>RAZÓN SOCIAL</th>
                                            <th class="no-print"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($clientes as $c){
                                        ?>
                                        <tr <?= ($c['status'] == 0)?'style="color: #b8b8b8;"':'' ?>>
                                            <td style="width: 80px; text-align: center;"><?= 'CL-' . $c['idclient'] ?></td>
                                            <td><?= $c['nombre'] ?></td>
                                            <td><?= $c['email'] ?></td>
                                            <td style="width: 120px; text-align: center;"><?= $c['nit'] ?></td>
                                            <td><?= $c['razonsocial'] ?></td>
                                            <?php
                                            if($c['status'] == 0){
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 50px;">
                                                <a href="<?= base_url('administracion/clientes/reactivar_cliente/' . $c['idclient']) ?>" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                                            </td>
                                            <?php
                                            }else{
                                            ?>
                                            <td class="no-print" style="text-align: center; width: 110px; <?= ($c['idclient'] == 1)?'display: none':'' ?>">
                                                <a href="<?= base_url('administracion/clientes/editar_cliente/' . $c['idclient']) ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <?php
                                                if($_SESSION['rol'] == 1){
                                                ?>
                                                <a href="<?= base_url('administracion/clientes/eliminar_cliente/' . $c['idclient']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                <?php
                                                }
                                                ?>
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
