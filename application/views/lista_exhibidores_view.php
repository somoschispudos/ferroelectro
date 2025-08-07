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
                        <h4 class="mb-0"><?= $title . ' / Agregar Exhibidor' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
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
                <div class="col-xl-6">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" class="form" autocomplete="notnow">
                                    <div class="row">
                                        <div class="form-group col-md-7">
                                            <label for="nombre">Exhibidores</label>
                                            <select id="exhibidores" class="idp-add" style="width: 100%;" placeholder="Seleccionar un exhibidor..." autocomplete="off" name="exhibidores">
                                                <option value=""></option>
                                                <?php
                                                foreach($exhibidores as $e){
                                                    if($e['status']==1){
                                                ?>
                                                <option value="<?= $e['id'] ?>"><?= $e['descripcion'] ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <button  class="btn btn-success" style="margin-top: 35px;" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-condensed table-bordered">
                                        <?php
                                        foreach($listaex as $ge){
                                        ?>
                                        <tr>
                                            <td><?= $ge['descripcion'] ?></td>
                                            <td class="no-print" style="text-align: center; width: 40px;">
                                                <a href="<?= base_url('pos/eliminar_lista_exhibidores/' . $venta[0]['id'] .  '/' . $ge['idlis']) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

<script>
    let base = '<?= base_url() ?>';

    var selproduct = new TomSelect("#exhibidores",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
   </script>
