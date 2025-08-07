<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php
// die($venta[0]['total']);
?>
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
                        <h4 class="mb-0"><?= $title . ' / Venta' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <form method="POST" class="form" autocomplete="notnow">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <table class="table table-bordered table-condensed" style="font-size: 13px;">
                                            <tr style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>CÓDIGO VENTA</td>
                                            </tr>
                                            <tr>
                                                <td><?= 'V-' . $ventadata[0]['id'] ?></td>
                                            </tr>
                                            <tr class="no-print" style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>VENDEDOR</td>
                                            </tr>
                                            <tr class="no-print">
                                                <?php
                                                $asesor = $this->model->get_user($ventadata[0]['idasesor']);
                                                ?>
                                                <td><?= $asesor[0]['nombre'] ?></td>
                                            </tr>
                                            <tr style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>CÓDIGO CLIENTE</td>
                                            </tr>
                                            <tr>
                                                <td><?= 'CL-' . $cliente[0]['idclient'] ?></td>
                                            </tr>
                                            <tr style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>CLIENTE</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['nombre'] ?></td>
                                            </tr>
                                            <tr style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>NIT</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['nit'] ?></td>
                                            </tr>
                                            <tr class="no-print" style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>RAZÓN SOCIAL</td>
                                            </tr>
                                            <tr class="no-print">
                                                <td><?= $cliente[0]['razonsocial'] ?></td>
                                            </tr>
                                            <tr style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>TELÉFONO</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['contacto'] ?></td>
                                            </tr>
                                            <tr class="no-print" style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>EMAIL</td>
                                            </tr>
                                            <tr class="no-print">
                                                <td><?= $cliente[0]['email'] ?></td>
                                            </tr>
                                            <tr style="background-color: #3399cc; color: #fff; font-weight: bold;">
                                                <td>DIRECCIÓN</td>
                                            </tr>
                                            <tr>
                                                <td><?= $cliente[0]['direccion'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            // if($ventadata[0]['status'] == 0){
                            ?>
                            <!-- <div class="row no-print">
                                <form method="POST" id="formagregarproductos">
                                    <table class="table table-condensed tabled-bordered" id="addtable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <select id="productos" class="idp-add" style="width: 100%;" placeholder="Seleccionar un producto..." autocomplete="off" name="productos">
                                                        <option value=""></option>
                                                        <?php
                                                        foreach($productos as $p){
                                                            $cantidad = $this->model->lista_inventario_conteo_productos($p['idpr']);
                                                        ?>
                                                        <option value="<?= $p['idpr'] ?>" <?= ($cantidad <= 0)?'disabled':'' ?>><?= 'SKU:' . $p['sku'] . ' | ' . $p['nombreproducto'] . ' | Precio: Q' . number_format($p['venta'], 2, '.', ',') . ' | Cant: ' . $cantidad ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </th>
                                                <th style="width: 100px;">
                                                    <input style="text-align: center;" type="text" class="form-control cantidad-add" name="cantidad" autocomplete="off" placeholder="Cant." required="true">
                                                </th>
                                                <?php
                                                if($_SESSION['rol'] == 1){
                                                ?>
                                                <th style="width: 100px;">
                                                    <input style="text-align: center;" type="text" class="form-control cantidad-des" name="descuento" autocomplete="off" placeholder="Desc.">
                                                </th>
                                                <?php
                                                }else{
                                                ?>
													<th style="width: 100px;">
														<!-- <input style="text-align: center;" type="text" class="form-control cantidad-des" name="descuento" autocomplete="off" placeholder="Desc."> -->
														<select name="descuento" class="form-control moneyfont cantidad-des" id="percent">
															<?php
																$c = 0;
																while ($c <= 100) {
															?>
															<option value="<?= $c ?>"><?= $c ?>%</option>
															<?php
																$c = $c + 5;
															}
															?>
														</select>
													</th>
                                                <?php
                                                }
                                                ?>
                                                <th style="width: 80px;">
													<input type="hidden" name="idventa" value="<?= $productosAgregados[0]['idventa'] ?>">
                                                    <button type="submit" name="agregar_nuevo" class="btn btn-secondary btn-sm agregar"><i class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </form>
                            </div> -->
                            <?php
                            // }
                            ?>
                            <div class="row">
								<?php
								if($msg == 'editado'){
								?>
								<div class="alert alert-success" role="alert">
									Editado exitosamente.
								</div>
								<?php
								}
								?>
                                <form method="POST">
                                    <table class="table table-condensed table-bordered tablePedido">
                                        <thead>
                                            <tr>
                                                <!-- <td></td> -->
                                                <td style="text-align: center; font-weight: bold; width: 140px;">SKU</td>
                                                <td style="text-align: left; font-weight: bold;">PRODUCTO</td>
                                                <td style="text-align: center; font-weight: bold; width: 70px;">CANTIDAD</td>
                                                <td style="text-align: center; font-weight: bold; width: 100px;">PRECIO U.</td>
                                                <td style="text-align: center; font-weight: bold; width: 100px;">GRAN TOTAL</td>
                                            </tr>
                                        </thead>
                                        <tbody id="bodylist">
                                            <?php
                                            // echo "<pre>";
                                            // print_r($productosAgregados);
                                            // echo "</pre>";
                                            $allTotal = 0;
                                            foreach($productosAgregados as $p){
                                                $sku = $p['sku'];
                                                $idp = $p['idproducto'];
                                                $idventa = $p['idventa'];
												
                                                $nombre = $p['nombreproducto'];
                                                $cantidad = $this->model->lista_inventario_conteo_venta($idventa, $p['idproducto']);
                                                $venta = $p['inventarioVenta'];
                                                $total = $venta * $cantidad;
                                                $allTotal = $allTotal + $total;
                                                $total = number_format($total, 2, '.', ',');
                                                $inputs = '';

                                                $inputs = '<input type="hidden" name="idp[]" value="'.$idp.'">';
                                                $inputs .= '<input type="hidden" name="cantidad[]" value="'.$cantidad.'">';
                                                $inputs .= '<input type="hidden" name="venta[]" value="'.$venta.'">';
                                                $inputs .= '<input type="hidden" name="totales[]" class="lostotales" value="'.$total.'">';

                                                $html = '<tr>';
												?>

												<?php
                                                if($ventadata[0]['status'] == 1){
                                                    $html .= '<td style="width: 70px; text-align: center;"><a href="javascript:void(0);" class="btn btn-danger btn-sm removeresto"><i class="fas fa-minus"></i></a>' . $inputs . '</td>';
                                                }elseif($ventadata[0]['status'] == 2){
                                                    // $html .= '<td style="width: 70px; text-align: center;">';
                                                    // $html .= '<a href="javascript:void(0);" data-venta="'.$venta.'" data-total="'.$total.'" data-sku="'.$sku.'" data-nombre="'.$nombre.'" data-idventa="'.$idventa.'" data-idp="'.$idp.'" data-cantidad="'.$cantidad.'" class="btn btn-warning btn-sm editaresto" data-toggle="modal" data-target="#myModal">';
                                                    // $html .= '<i class="fas fa-edit"></i></a></td>';
                                                }

												$get_nota = $this->model->get_nota($p['idpv']);
												$asterisk = "";
												$asterisk = '<span style="color: orange;">' . $get_nota[0]['nota'] . '</span>';

												if($asterisk == '<span style="color: orange;">0</span>'){
													$asterisk = "";
												}elseif($asterisk == '<span style="color: orange;">* Desc. %0 (Q0.00)</span>'){
													$asterisk = "";
												}

                                                $html .= '<td style="text-align: center; width: 140px;">' . $sku . '</td>';
                                                $html .= '<td style="text-align: left; font-weight: bold;">'.$asterisk . ' '  . $nombre . '</td>';
                                                $html .= '<td style="text-align: center; width: 70px;">' . $cantidad . '</td>';
                                                $html .= '<td style="text-align: right; width: 100px;">Q' . $venta . '</td>';
                                                $html .= '<td style="text-align: right; width: 120px;">Q' . $total . '</td>';
                                                $html .= '</tr>';
                                                echo $html;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="display: none;">
                                                <td colspan="4" style="font-weight: bold; font-size: 12px; text-align: right;">DESCUENTO</td>
                                                <td>
                                                    <?php
                                                    // echo "<pre>";
                                                    // print_r($ventadata);

                                                    ?>
                                                    <select <?= ($ventadata[0]['status'] == 2)||($ventadata[0]['status'] == 3)?'disabled="disabled"':'' ?> name="porcentaje" onchange="recalcula()" class="form-control moneyfont" id="percent">
                                                        <option value="0" <?= ($ventadata[0]['descuento'] == 0.00)?'selected="selected"':'' ?>>0%</option>
                                                        <option value=".05" <?= ($ventadata[0]['descuento'] == 0.05)?'selected="selected"':'' ?>>5%</option>
                                                        <option value=".1" <?= ($ventadata[0]['descuento'] == 0.10)?'selected="selected"':'' ?>>10%</option>
                                                        <option value=".15" <?= ($ventadata[0]['descuento'] == 0.15)?'selected="selected"':'' ?>>15%</option>
                                                        <option value=".2" <?= ($ventadata[0]['descuento'] == 0.20)?'selected="selected"':'' ?>>20%</option>
                                                        <option value=".25" <?= ($ventadata[0]['descuento'] == 0.25)?'selected="selected"':'' ?>>20%</option>
                                                        <option value=".3" <?= ($ventadata[0]['descuento'] == 0.30)?'selected="selected"':'' ?>>30%</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <?php
                                            $descuento = $ventadata[0]['descuento'];
                                            $tipoPago = $ventadata[0]['formapago'];
                                            $totalDescuento = $allTotal * $descuento;

                                            $granTotal = $allTotal - $totalDescuento;
                                            // echo $totalDescuento;
                                            ?>
                                            <tr style="color: #36b1ff;">
                                                <td colspan="4" style="font-weight: bold; font-size: 14px; text-align: right;">TOTAL</td>
                                                <td style="text-align: right; font-size: 14px"><span id="elmerototal" class="moneyfont"><?= number_format($granTotal, 2, '.', ',') ?></span></td>
                                            </tr>
                                            <tr style="color: orange; display: none;">
                                                <td colspan="5" style="font-weight: bold; font-size: 14px; text-align: right;">DESCUENTO</td>
                                                <td style="text-align: right; font-size: 14px">-<span id="elmerodescuento"><?= number_format($totalDescuento, 2, '.', ',') ?></span></td>
                                            </tr>
                                            <tr style="color: green; display: none;">
                                                <td colspan="5" style="font-weight: bold; font-size: 14px; text-align: right;">GRAN TOTAL</td>
                                                <td style="text-align: right; font-size: 14px"><span id="elgrantotal"><?= number_format($granTotal, 2, '.', ',') ?></span></td>
                                            </tr>
                                            <!-- <tr> -->
                                                <!-- <td colspan="4" style="font-weight: bold; font-size: 14px; text-align: right;">FORMA DE PAGO</td>
                                                <td colspan="2"> -->
													<input type="hidden" name="formapago" value="1">
                                                    <!-- <select <?= ($ventadata[0]['status'] == 2)||($ventadata[0]['status'] == 3)?'disabled="disabled"':'' ?> name="formapago" class="form-control moneyfont">
                                                        <option value="1" <?= ($ventadata[0]['formapago'] == 1)?'selected="selected"':'' ?>>CONTADO</option>
                                                        <option value="2" <?= ($ventadata[0]['formapago'] == 2)?'selected="selected"':'' ?>>CRÉDITO 15 Dias</option>
                                                        <option value="3" <?= ($ventadata[0]['formapago'] == 3)?'selected="selected"':'' ?>>CRÉDITO 30 Dias</option>
                                                <!-- </td> -->
                                            <!-- </tr> -->
                                            <?php
                                            if($ventadata[0]['status'] == 2 && ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3 || $_SESSION['rol'] == 4)){
                                            ?>
                                            <!-- <tr>
                                                <td colspan="4" style="font-weight: bold; font-size: 14px; text-align: right;">TIPO DE FACTURA</td>
                                                <td colspan="2"> -->
													<input type="hidden" name="tipofactura" value="C">
                                                <!-- <select name="tipofactura" id="tipofactura" class="form-control" style="margin: left;">
                                                    <option value="C">Carta</option>
                                                    <option value="T">Ticket</option>
                                                </select> -->
                                                <!-- </td>
                                            </tr> -->
                                            <?php
                                            }
                                            ?>
                                        </tfoot>
                                    </table>
                                    <?php
                                    if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3 || $_SESSION['rol'] == 2){
                                    ?>
                                    <!-- <a target="_blank" href="<?= base_url('pos/ver_orden/' . $ventadata[0]['id']) ?>" class="btn btn-light btn-l finalizarbtn" style="float: right; margin-left: 10px;"><i class="fa fa-receipt"></i> VER ORDEN DE PEDIDO</a> -->
                                    <!-- <a target="_blank" href="<?= base_url('pos/ver_nota/' . $ventadata[0]['id']) ?>" class="btn btn-light btn-l finalizarbtn" style="float: right; margin-left: 10px;"><i class="fa fa-receipt"></i> VER NOTA DE ENVIO</a> -->
                                    <?php
                                        if(count($facturadata) == 0){
                                    ?>
                                        <button type="submit" name="facturar_pedido" class="btn btn-info btn-l finalizarbtn no-print" style="float: right;"><i class="fa fa-receipt"></i> FACTURAR PEDIDO</button>
                                        <a href="javascript:void();" data-url="<?= base_url('pos/eliminar_pedido/' . $ventadata[0]['id']) ?>" data-ventaid="<?= $ventadata[0]['id'] ?>" class="btn btn-danger btn-l eliminar_pedido no-print" style="float: right; margin-right:10px;"><i class="fa fa-ban"></i> ELIMINAR PEDIDO</a>
										<a target="_blank" href="<?= base_url('pos/ver_orden/' . $ventadata[0]['id']) ?>" class="btn btn-light btn-l finalizarbtn" style="float: right; margin-right: 10px;"><i class="fa fa-receipt"></i> VER RECIBO</a>
										<a href="<?= base_url('pos') ?>" class="btn btn-success me-1 no-print">REGRESAR</a>
                                    <?php
                                        }else{
                                    ?>
                                        <a href="<?= $facturadata[0]['urldoc'] ?>" target="_blank" class="btn btn-light btn-l finalizarbtn no-print" style="float: right;"><i class="fa fa-receipt"></i> VER FACTURA</a>
                                        <a href="<?= base_url('pos/anular_factura/' . $facturadata[0]['id']) ?>" class="btn btn-danger btn-l no-print" style="float: right; margin-right:10px;"><i class="fa fa-ban"></i> ANULAR FACTURA</a>
										<a href="<?= base_url('pos') ?>" class="btn btn-success me-1 no-print">REGRESAR</a>
										<a target="_blank" href="<?= base_url('pos/ver_orden/' . $ventadata[0]['id']) ?>" class="btn btn-light btn-l finalizarbtn" style="float: right; margin-right: 10px;"><i class="fa fa-receipt"></i> VER RECIBO</a>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                    }elseif($_SESSION['rol'] == 2){
                                    ?>
                                    <!-- <a target="_blank" href="<?= base_url('pos/ver_orden/' . $ventadata[0]['id']) ?>" class="btn btn-light btn-l finalizarbtn" style="float: right; margin-left: 10px;"><i class="fa fa-receipt"></i> VER ORDEN DE PEDIDO</a> -->
                                    <?php
                                        if(count($facturadata) > 0){
                                    ?>
                                        <a href="<?= $facturadata[0]['urldoc'] ?>" target="_blank" class="btn btn-light btn-l finalizarbtn" style="float: right;"><i class="fa fa-receipt"></i> VER FACTURA</a>
										<a href="<?= base_url('pos') ?>" class="btn btn-success me-1 no-print">REGRESAR</a>
										<a target="_blank" href="<?= base_url('pos/ver_orden/' . $ventadata[0]['id']) ?>" class="btn btn-light btn-l finalizarbtn" style="float: right; margin-right: 10px;"><i class="fa fa-receipt"></i> VER RECIBO</a>
                                    <?php
                                        }
                                    }
                                    ?>


                                </form>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

			

        </div> <!-- container-fluid -->
    </div>

	<!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><span class="namemodal"></span></h4>
                    <button class="btn btn-danger btn-sm" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="prodmodal"></h5>
                    <h6>SKU: <span id="skumodal"></span></h6>
                    <hr>
                    <form method="POST" class="form">
                        <input type="hidden" name="idp" value="" id="modalidp">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Cantidad</label>
                                <input type="number" name="cantidad" class="form-control cantidadinput" style="width: 150px;" required>
                            </div>
							<div class="col-md-6">
								<?php
								if($_SESSION['rol'] == 1){
								?>
								<label>Precio Unidad</label>
								<input style="text-align: right; width: 150px;" type="text" class="form-control percio-des currencyquet" name="descuento" autocomplete="off" placeholder="Desc.">
								<?php
								}
								?>
							</div>
							<input type="hidden" class="idpmodal" name="idp">
							<input type="hidden" class="idvmodal" name="idventa">
							<input type="hidden" class="ventamodal" name="venta">
                        </div>
						<br>
						<div class="row">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Cantidad</th>
										<th>Precio U.</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td style="text-align: center;" class="cantidadtablemodal"></td>
										<td style="text-align: right;" class="precioutablemodal"></td>
										<td style="text-align: right;" class="totalutablemodal"></td>
									</tr>
								</tbody>
							</table>
						</div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="editarventa" class="btn btn-success">GUARDAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script>
	$(document).ready(function () {
        let base = '<?= base_url() ?>';

		$('.eliminar_pedido').on('click', function(){
			var url = $(this).data('url');
			var ventaid = $(this).data('ventaid');

			Swal.fire({
				title: 'Eliminar Pedido',
				text: "¿Está seguro que desea eliminar el pedido?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, eliminar'
			}).then((result) => {
				if (result.isConfirmed) {
					html2canvas(document.querySelector(".tablePedido")).then(function(canvas) {
						var ventaEliminada = canvas.toDataURL("image/png");

						const requestData = {
							idventa: ventaid,
							imagen: ventaEliminada
						};

						$.ajax({
							url: base + 'ajax/saveimageneliminada',
							method: "POST",
							data: requestData,
							success: function(data) {
								if(data == "insertado"){
									window.location.href = url;
								}
							},
							error: function(xhr, status, error) {
								// Handle any errors that occurred during the request
								console.error("Error:", error);
							}
						});
					});
				}
			})
		});

		$('#myModal').on('show.bs.modal', function(e) {
			var idp = $(e.relatedTarget).data('idp');
			var sku = $(e.relatedTarget).data('sku');
			var nombre = $(e.relatedTarget).data('nombre');
			var idventa = $(e.relatedTarget).data('idventa');
			var cantidad = $(e.relatedTarget).data('cantidad');
			var venta = $(e.relatedTarget).data('venta');
			var total = $(e.relatedTarget).data('total');

			// $('#modalidp').val(idp);
			// $('#prodmodal').text(producto);
			$('.cantidadtablemodal').text(cantidad);
			$('#skumodal').text(sku);
			$('.namemodal').text(nombre);
			$('.cantidadinput').val(cantidad);
			$('.precioutablemodal').text('Q'+venta);
			$('.ventamodal').val(venta);
			$('.totalutablemodal').text('Q'+total);
			$('.idpmodal').val(idp);
			$('.idvmodal').val(idventa);
			$('.percio-des').val('Q'+venta);
		});

		var selproduct = new TomSelect("#productos",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
	});
    </script>
