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
                        <h4 class="mb-0"><?= $title . ' / Productos' ?></h4>
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
                                Producto creado exitosamente
                            </div>
                            <?php
                            }
                            ?>
                            <?php
                            if($msg == 'duplicate'){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                SKU ya existe en la base de datos
                            </div>
                            <?php
                            }
                            ?>
                            <form method="POST" class="form" enctype="multipart/form-data" autocomplete="notnow">
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <label for="nombre">SKU</label>
                                        <input type="text" class="form-control" name="sku" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nombre">Producto</label>
                                        <input type="text" class="form-control" name="nombreproducto" required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nombre">Proveedor</label>
                                        <select class="form-select" placeholder="Seleccionar Categoría..." autocomplete="off" name="proveedorid">
                                            <?php
                                            foreach($proveedores as $p){
                                            ?>
                                            <option value="<?= $p['id'] ?>"><?= $p['nombre'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Marca</label>
                                        <select class="form-select" placeholder="Seleccionar Marca..." autocomplete="off" name="marcaid">
                                            <?php
                                            foreach($marcas as $m){
                                            ?>
                                            <option value="<?= $m['id'] ?>"><?= $m['marca'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="nombre">Categoría</label>
                                        <select class="form-select" placeholder="Seleccionar Categoría..." autocomplete="off" name="categoriaid">
                                            <?php
                                            foreach($categorias as $c){
                                            ?>
                                            <option value="<?= $c['id'] ?>"><?= $c['categoria'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
									<div class="form-group col-md-1">
                                        <label for="nombre">Cant. min.</label>
                                        <input type="number" class="form-control" name="cantmin" required="true" autocomplete="off">
                                    </div>
                                </div>
								<div class="row">
									<div class="form-group col-md-1" style="display: none;">
                                        <label for="nombre">Costo</label>
                                        <input style="text-align: right;" type="text" class="form-control currencyquet" name="costo" required="true" value="0" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="nombre">Venta</label>
                                        <input style="text-align: right;" type="text" class="form-control currencyquet" name="venta" required="true" autocomplete="off">
                                    </div>
								</div>
                                <div class="row">
                                    <div class="col-md-3" id="mygallery">
                                        <input type="file" name="files" class="files">
                                    </div>
                                    <div class="col-md-9" style="text-align: right; padding-top: 40px;">
                                        <a href="<?= base_url('administracion/productos') ?>" class="btn btn-light">Cancelar</a>
                                        <button  class="btn btn-success" type="submit" name="guardar"><i class="fa fa-save"></i> GUARDAR</button>
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
