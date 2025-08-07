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
                        <h4 class="mb-0"><?= $title . ' / Venta' ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3">
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
                                                <td>VENDEDOR</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $asesor = $this->model->get_user($venta[0]['idasesor']);
                                                ?>
                                                <td><?= $asesor[0]['nombre'] ?></td>
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
                                        </table>
                                    </div>
                                </div>

                            <!-- </form> -->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row">
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
                                                    <input style="text-align: center;" type="text" class="form-control cantidad-des" name="descuento" autocomplete="off" placeholder="Desc.">
                                                </th>
                                                <?php
                                                }
                                                ?>
                                                <th style="width: 80px;">
                                                    <button type="submit" name="agregar" class="btn btn-secondary btn-sm agregar"><i class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </form>
                            </div>
                            <div class="row">
                                <form method="POST">
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                            <tr>
                                                <td></td>
                                                <td style="text-align: center; font-weight: bold; width: 140px;">SKU</td>
                                                <td style="text-align: left; font-weight: bold;">PRODUCTO</td>
                                                <td style="text-align: center; font-weight: bold; width: 70px;">CANTIDAD</td>
                                                <td style="text-align: center; font-weight: bold; width: 100px;">PRECIO U.</td>
                                                <td style="text-align: center; font-weight: bold; width: 100px;">GRAN TOTAL</td>
                                            </tr>
                                        </thead>
                                        <tbody id="bodylist">

                                        </tbody>
                                        <tfoot>
                                            <tr style="display: none;">
                                                <td colspan="5" style="font-weight: bold; font-size: 12px; text-align: right;">DESCUENTO</td>
                                                <td>
                                                    <select name="porcentaje" onchange="recalcula()" class="form-control moneyfont" id="percent">
                                                        <option value="0">0%</option>
                                                        <option value=".05">5%</option>
                                                        <option value=".1">10%</option>
                                                        <option value=".15">15%</option>
                                                        <option value=".2">20%</option>
                                                        <option value=".25">25%</option>
                                                        <option value=".3">30%</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr style="color: #36b1ff;">
                                                <td colspan="5" style="font-weight: bold; font-size: 14px; text-align: right;">TOTAL</td>
                                                <td style="text-align: right; font-size: 14px"><span id="elmerototal" class="moneyfont">0.00</span></td>
                                            </tr>
                                            <tr style="color: orange; display: none;">
                                                <td colspan="5" style="font-weight: bold; font-size: 14px; text-align: right;">DESCUENTO</td>
                                                <td style="text-align: right; font-size: 14px">-<span id="elmerodescuento">0.00</span></td>
                                            </tr>
                                            <tr style="color: green; display: none;">
                                                <td colspan="5" style="font-weight: bold; font-size: 14px; text-align: right;">GRAN TOTAL</td>
                                                <td style="text-align: right; font-size: 14px"><span id="elgrantotal">0.00</span></td>
                                            </tr>
											<input type="hidden" name="formapago" value="1">
                                        </tfoot>
                                    </table>
                                    <button type="submit" name="finalizar" class="btn btn-success btn-l finalizarbtn" style="float: right; display: none;"><i class="fa fa-save"></i> GUARDAR PEDIDO</button>
                                </form>
                            </div>
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

        var selproduct = new TomSelect("#productos",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        $('#formagregarproductos').on('submit', function(e){
            e.preventDefault();
            let producto = $('#productos').val();
            let cantidad = $('.cantidad-add').val();
            let indes = $('.cantidad-des').val();

            if(indes === '' || indes === NaN){
                indes = 0;
            }

            minAjax({
                url: base + 'ajax/add_producto',
                type:"POST",
                data:{
                    idp: producto,
                    cantidad: cantidad,
                    indes: indes
                },

                success: function(data){
                    if(data === 'mucho'){
                        alert('La cantidad que ingreso es mayor a la existencia del producto.');
                        selproduct.clear();
                        selproduct.refreshItems();
                        $('.cantidad-add').val('');
                        document.getElementById("productos").focus();
                    }else{
                        $('#bodylist').append(data);
                        selproduct.clear();
                        selproduct.refreshItems();
                        $('.cantidad-add').val('');
                        $('.cantidad-des').val('');
                        document.getElementById("productos").focus();

                        $('.removeresto').on('click', function(){
                            let ob = $(this).parent().parent();
                            ob.remove();
                            recalcula();
                        });

                        recalcula();
                    }
                }
            });
        });

        function recalcula() {
            console.log('recalculando...');
            let merototal = calculateSum();
            let descuentoVal = $('#percent').val();

            decuentoVal = parseFloat(descuentoVal);
            let descuento = merototal * descuentoVal;
			if(descuento === 'NaN'){
				descuento = 0;
			}

            let recalcula = (merototal - descuento).toFixed(2);

            // var nf = Intl.NumberFormat('en-IN');

            let imerototal = currency(merototal, { decimal: '.', precision: 2, separator: ',', symbol: 'Q' }).format();
            let idescuento = currency(descuento, { decimal: '.', precision: 2, separator: ',', symbol: 'Q' }).format();
            let irecalcula = currency(recalcula, { decimal: '.', precision: 2, separator: ',', symbol: 'Q' }).format();

            $('#elmerototal').html(imerototal);
            $('#elmerodescuento').html(idescuento);
            $('#elgrantotal').html(irecalcula);
			$('#percent').val("0");
        }

        function calculateSum() {
            let lasuma = 0;

            $( ".lostotales" ).each(function() {
                let totales = $(this).val();
                totales = totales.replace(',', '');
                totales = parseFloat(totales);
                lasuma = lasuma + totales;
            });

            if(lasuma === 0){
                $('.finalizarbtn').hide();
            }else{
                $('.finalizarbtn').show();
            }

            return lasuma.toFixed(2);
        }

        // let test = currency(1.234433, { decimal: '.', precision: 2, separator: ',', symbol: 'Q' }).format();

        // console.log(test);
    </script>
