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
                        <h4 class="mb-0"><?= $title . ' / Nota de Crédito' ?></h4>
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
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>CÓDIGO VENTA</td>
                                            </tr>
                                            <tr>
                                                <td><?= 'V-' . $ventadata[0]['id'] ?></td>
                                            </tr>
                                            <tr style="background-color: #f8fafb; font-weight: bold;">
                                                <td>VENDEDOR</td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $asesor = $this->model->get_user($ventadata[0]['idasesor']);
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

                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                            if($ventadata[0]['status'] == 0){
                            ?>
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
                                                <input style="text-align: center;" type="hidden" class="form-control cantidad-des" name="descuento" autocomplete="off" placeholder="Desc." value="">
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
                            <?php
                            }
                            ?>
                            <div class="row">
                                <h4 class="mb-2">Venta</h4>
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <td style="text-align: center; font-weight: bold; width: 140px;">SKU</td>
                                            <td style="text-align: left; font-weight: bold;">PRODUCTO</td>
                                            <td style="text-align: center; font-weight: bold; width: 70px;">CANTIDAD</td>
                                            <td style="text-align: center; font-weight: bold; width: 100px;">PRECIO U.</td>
                                            <td style="text-align: center; font-weight: bold; width: 100px;">GRAN TOTAL</td>
                                            <td></td>
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
                                            $asterisk = '';
                                            $nombre = $p['nombreproducto'];
                                            $cantidad = $this->model->lista_inventario_conteo_venta($idventa, $p['idproducto']);
                                            $venta = $p['inventarioVenta'];
                                            $total = $venta * $cantidad;
                                            $allTotal = $allTotal + $total;
                                            $total = number_format($total, 2, '.', '');
                                            $inputs = '';

                                            $inputs = '<input type="hidden" name="idp[]" value="'.$idp.'">';
                                            $inputs .= '<input type="hidden" name="cantidad[]" value="'.$cantidad.'">';
                                            $inputs .= '<input type="hidden" name="venta[]" value="'.$venta.'">';
                                            $inputs .= '<input type="hidden" name="totales[]" class="lostotales" value="'.$total.'">';

                                            $html = '<tr>';
                                            $html .= '<td style="text-align: center; width: 140px;">' . $sku . '</td>';
                                            $html .= '<td style="text-align: left; font-weight: bold;">'.$asterisk . ' '  . $nombre . '</td>';
                                            $html .= '<td style="text-align: center; width: 70px;" class="laCantidad">' . $cantidad . '</td>';
                                            $html .= '<td style="text-align: right; width: 100px;">' . 'Q' . $venta . '</td>';
                                            $html .= '<td style="text-align: right; width: 120px;">Q' . '<span class="elTotal">'.$total.'</span>' . '</td>';
                                            // $html .= '<td style="text-align: right; width: 70px;"><input type="text" class="form-control" value="0" /></td>';
                                            $html .= '<td style="text-align: right; width: 40px;">';
                                            $html .= '<a href="javascript:void(0);" class="btn btn-success btn-sm btn-block agregarANota" ';
                                            $html .= 'data-idproducto="'.$idp.'" data-sku="'.$sku.'" data-producto="'.$nombre.'" data-uventa="'.$venta.'">';
                                            $html .= '<i class="fa fa-plus"></i></a>';
                                            $html .= '</td>';
                                            $html .= '</tr>';

                                            echo $html;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- <hr> -->
                            <div class="row">
                                <form method="POST">
                                    <h4 class="mb-2">Nota de Crédito</h4>
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                            <tr>
                                                <td style="text-align: center; font-weight: bold; width: 140px;">SKU</td>
                                                <td style="text-align: left; font-weight: bold;">PRODUCTO</td>
                                                <td style="text-align: center; font-weight: bold; width: 70px;">CANTIDAD</td>
                                                <td style="text-align: center; font-weight: bold; width: 100px;">PRECIO U.</td>
                                                <td style="text-align: center; font-weight: bold; width: 100px;">GRAN TOTAL</td>
                                                <!-- <td></td> -->
                                            </tr>
                                        </thead>
                                        <tbody id="bodylistNota">
                                            <?php
                                            foreach($productosAgregados as $p){
                                                $sku = $p['sku'];
                                                $nombre = $p['nombreproducto'];
                                                $idp = $p['idproducto'];
                                                $venta = number_format($p['inventarioVenta'], 2, '.', '');
                                            ?>
                                            <tr class="tr-<?= $idp ?>">
                                                <td style="text-align: center; width: 140px;"><?= $sku ?></td>
                                                <td style="text-align: left; font-weight: bold;"><?= $nombre ?></td>
                                                <td style="text-align: center; width: 70px;" class="laCantidadNota">0</td>
                                                <td style="text-align: right; width: 100px;">Q<span class="totalUNota"><?= $venta ?></span></td>
                                                <td style="text-align: right; width: 120px;">Q<span class="totalNota">0.00</span></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <button style="float: right;" type="submit" name="crear_nota" class="btn btn-success">CREAR NOTA DE CRÉDITO</button>
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


        $('.agregarANota').on('click', function(){
            //tabla de nota
            let cantidadNota;
            let totalNota;

            let idproducto = $(this).data('idproducto');
            let sku = $(this).data('sku');
            let producto = $(this).data('producto');
            let uventa = parseFloat($(this).data('uventa')).toFixed(2);
            let obj = $(this).parent().parent();
            let cantidad = parseInt(obj.find('.laCantidad').text());
            let eltotal = parseFloat(obj.find('.elTotal').text()).toFixed(2);
            let elnuevoTotal = (eltotal - uventa).toFixed(2);
            let nuevaCantidad = cantidad - 1;
            obj.find('.laCantidad').text(nuevaCantidad);
            obj.find('.elTotal').text(elnuevoTotal);

            if(nuevaCantidad === 0){
                $(this).hide();
            }

            let totalUNota = parseFloat($('.tr-'+idproducto).find('.totalUNota').text()).toFixed(2);

            cantidadNota = parseInt($('.tr-'+idproducto).find('.laCantidadNota').text()) + 1;
            totalNota = parseFloat(totalUNota * cantidadNota).toFixed(2);

            $('.tr-'+idproducto).find('.laCantidadNota').text(cantidadNota);
            $('.tr-'+idproducto).find('.totalNota').text(totalNota);

            let insert = '<input type="hidden" name="idproducto[]" value="'+idproducto+'">';
            insert += '<input type="hidden" name="uventa-'+idproducto+'" value="'+uventa+'">';

            $('#bodylistNota').append(insert);
        });

        // var selproduct = new TomSelect("#productos",{
        //     create: false,
        //     sortField: {
        //         field: "text",
        //         direction: "asc"
        //     }
        // });

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

            let recalcula = (merototal - descuento).toFixed(2);

            // var nf = Intl.NumberFormat('en-IN');

            let imerototal = currency(merototal, { decimal: '.', precision: 2, separator: ',', symbol: 'Q' }).format();
            let idescuento = currency(descuento, { decimal: '.', precision: 2, separator: ',', symbol: 'Q' }).format();
            let irecalcula = currency(recalcula, { decimal: '.', precision: 2, separator: ',', symbol: 'Q' }).format();

            $('#elmerototal').html(imerototal);
            $('#elmerodescuento').html(idescuento);
            $('#elgrantotal').html(irecalcula);
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
