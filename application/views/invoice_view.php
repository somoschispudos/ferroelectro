<style>
    table
    {
        table-layout: fixed;
        width: 100px;
    }
    @media print
    {
    .no-print, .no-print *
    {
    display: none !important;
    }
    }

</style>
<div style="width: 302px; border: 1px solid #9000;">
<h4 class="float-end font-size-15">Pedido V-<?= $ventadata[0]['id'] ?></h4>
    <p class="mb-1"><b>Asesor: <?= $ventadata[0]['nombreuser'] ?></b></p>
    <p><b>Fecha:</b><?= date('d-m-Y', strtotime($ventadata[0]['fecha'])) ?></p>
    <h5 class="font-size-16 mb-3"><b>Cliente <?= 'CL-'.$ventadata[0]['idcliente'] ?></b></h5>
    <h5 class="font-size-15 mb-2"><b>Nombre cliente:</b> <?= $ventadata[0]['nombre'] ?></h5>
    <h5 class="font-size-15 mb-2"><b>Razón social: </b><?= $ventadata[0]['razonsocial'] ?></h5>
    <h5 class="font-size-15 mb-2"><b>NIT: </b><?= $ventadata[0]['nit'] ?></h5>
    <p class="mb-1"><?= $ventadata[0]['direccion']. ', ' . $ventadata[0]['municipio']. ', ' . $ventadata[0]['departamento'] ?></p>
    <p class="mb-1"><?= $ventadata[0]['email'] ?></p>
    <p>Tel: <?= $ventadata[0]['telefono1'] ?></p>
    <hr>
    <table class="table table-condensed" style="font-size: 10px; width: 302px;" width=50>
        <thead>
            <tr>
                <th style="width: 40px;">SKU</th>
                <th style="width: 100px;">Producto</th>
                <th style="width: 15px;">Cant.</th>
            </tr>
        </thead><!-- end thead -->
        <tbody>
            <?php
            foreach($productosAgregados as $p){
                $sku = $p['sku'];
                $idp = $p['idproducto'];
                $idventa = $p['idventa'];
                $asterisk = '';
                $nombre = $p['nombreproducto'];
                $cantidad = $this->model->lista_inventario_conteo_venta($idventa, $p['idproducto']);
                $venta = $p['venta'];
                $total = $venta * $cantidad;
                $total = number_format($total, 2, '.', ',');
            ?>
            <tr>
                <td><?= $p['sku'] ?></td>
                <td>
                    <div>
                        <h5 class="text-truncate font-size-10 mb-1"><?= $nombre ?></h5>
                    </div>
                </td>
                <td><?= $cantidad ?></td>
            </tr>
            <?php
            $descuento = $ventadata[0]['descuento'];
            $tipoPago = $ventadata[0]['formapago'];
            $totalDescuento = $ventadata[0]['total'] * $descuento;
            $granTotal = $ventadata[0]['total'] - $totalDescuento;
            }
            ?>

            <!-- end tr -->
        </tbody><!-- end tbody -->
    </table><!-- end table -->
    <hr>
    <?php
    if(count($listaex) > 0){
    ?>
    <hr>
    <h5 class="font-size-15">Exhibidores</h5>
    <ul>
        <?php
        foreach($listaex as $l){
        ?>
        <li><?= $l['descripcion'] ?></li>
        <?php
        }
        ?>
    </ul>
    <?php
    }
    ?>
</div>
<div class="no-print">
    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
</div>