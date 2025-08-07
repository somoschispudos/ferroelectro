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
                        <h4 class="mb-0"><?= $title . ' / Nueva Venta' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4 offset-md-4">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <form method="POST" class="form" autocomplete="notnow">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="nombre">Clientes</label>
                                        <select id="clientes" class="idp-add" style="width: 100%;" placeholder="Seleccionar un cliente..." autocomplete="off" name="clientes">
                                            <option value=""></option>
                                            <?php
                                            foreach($clientes as $c){
                                                if($c['status'] > 0){
                                            ?>
                                            <option value="<?= $c['idclient'] ?>"><?= 'CL-' . $c['idclient'] . ': ' . $c['nombre'] . ' - NIT:' . $c['nit'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <button  class="btn btn-success" style="margin-top: 35px;" type="submit" name="guardar">CONTINUAR <i class="fa fa-chevron-right"></i></button>
										<a  class="btn btn-info" style="margin-top: 35px;" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".modal-notes">NUEVO CLIENTE <i class="fa fa-user"></i></a>
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

	<div class="modal fade modal-notes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
					<form method="POST" class="form">
						<div class="row">
							<div class="form-group col-md-8">
								<label for="nombre">Nombre</label>
								<input type="text" class="form-control" name="nombre" required="true" autocomplete="off">
							</div>
							<div class="form-group col-md-4">
								<label for="nombre">NIT <span style="padding-left: 15px;"><a id="nitsearch" href="javascript:void(0);"><i class="fa fa-search"></i></a></span></label>
								<input type="text" class="form-control" name="nit" required="true" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="nombre">Razón Social</label>
								<input type="text" class="form-control" name="razonsocial" autocomplete="off">
							</div>
							<div class="form-group col-md-6">
								<label for="nombre">Teléfono</label>
								<input type="text" class="form-control" name="contacto" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="nombre">Dirección</label>
								<input type="text" class="form-control" name="direccion" required="true" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="nombre">Email</label>
								<input type="email" class="form-control" name="email" autocomplete="off">
							</div>
							<div class="form-group col-md-6" style="padding-top: 35px;">
								<button class="btn btn-success btn-block" type="submit" name="guardarcliente"><i class="fa fa-save"></i> GUARDAR</button>
							</div>
						</div>
					</form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

<script>
    let base = '<?= base_url() ?>';

    var selproduct = new TomSelect("#clientes",{
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

	$('#nitsearch').on('click', function(){
		var nit = $('.nit').val();
		$(this).html('<i class="fa-solid fa-cog fa-spin"></i>');

		minAjax({
			url: base + 'administracion/clientes/searchNIT',
			type:"POST",
			data:{
				nit: nit
			},

			success: function(data){
				if(data === ""){
					alert("NIT incorrecto");
				}else{
					// alert("Razón social: " + data);
					$('.razon').val(data);
					$('#nitsearch').html('<a id="nitsearch" href="javascript:void(0);"><i class="fa fa-search"></i>');
				}
			}
		});
	});
   </script>
