<?php
class Model extends CI_Model
{
  public function all_users(){
    $str = 'usuarios.id idusuario, usuarios.usuario, usuarios.nombre, usuarios.email, usuarios.rol, usuarios.status, ';
    $str .= 'roles.id idrol, roles.rol';

    $q= $this
        ->db
        ->select($str)
	      ->from('usuarios')
        ->join('roles', 'roles.id = usuarios.rol')
        ->where('usuarios.status', 1)
        ->group_by('usuarios.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

	public function all_users_ventas(){
    $str = 'usuarios.id idusuario, usuarios.usuario, usuarios.nombre, usuarios.email, usuarios.rol, usuarios.status';

    $q= $this
        ->db
        ->select($str)
	      ->from('usuarios')
        // ->join('roles', 'roles.id = usuarios.rol')
        ->where('usuarios.status', 1)
				->where('usuarios.rol', 2)
        // ->group_by('usuarios.id')
				->limit(1)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_users_all_status(){
    $str = 'usuarios.id idusuario, usuarios.usuario, usuarios.nombre, usuarios.email, usuarios.rol, usuarios.status, ';
    $str .= 'roles.id idrol, roles.rol';

    $q= $this
        ->db
        ->select($str)
	      ->from('usuarios')
        ->join('roles', 'roles.id = usuarios.rol')
        ->group_by('usuarios.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_roles(){
    $q= $this
        ->db
        ->select('*')
	      ->from('roles')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function check_user($user, $password){
    $str = 'usuarios.id idusuario, usuarios.usuario, usuarios.nombre, usuarios.email, usuarios.rol, usuarios.status, ';
    $str .= 'roles.id idrol, roles.rol';

    $q= $this
        ->db
        ->select($str)
	      ->from('usuarios')
        ->where('usuario', $user)
        ->where('clave', $password)
        ->join('roles', 'roles.id = usuarios.rol')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_user($idu){
    $str = 'usuarios.id idusuario, usuarios.usuario, usuarios.clave, usuarios.nombre, usuarios.email, usuarios.rol, usuarios.status, ';
    $str .= 'roles.id idrol, roles.rol';

    $q= $this
        ->db
        ->select($str)
	      ->from('usuarios')
        ->where('usuarios.id', $idu)
        ->join('roles', 'roles.id = usuarios.rol')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_proveedores(){
    $q= $this
        ->db
        ->select('*')
	      ->from('proveedores')
        ->where('status', 1)
        ->group_by('proveedores.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_proveedores_all_status(){
    $q= $this
        ->db
        ->select('*')
	      ->from('proveedores')
        ->group_by('proveedores.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_proveedor($idu){
    $q= $this
        ->db
        ->select('*')
	      ->from('proveedores')
        ->where('id', $idu)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_departamentos(){
    $q= $this
        ->db
        ->select('*')
	      ->from('departamentos')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_municipios($iddep){
    $q= $this
        ->db
        ->select('*')
	      ->from('municipios')
        ->where('departamento_id', $iddep)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_user_roles($idrol){
    $str = 'usuarios.id idusuario, usuarios.usuario, usuarios.clave, usuarios.nombre, usuarios.email, usuarios.rol, usuarios.status, ';
    $str .= 'roles.id idrol, roles.rol';

    $q= $this
        ->db
        ->select($str)
	      ->from('usuarios')
        ->where('usuarios.rol', $idrol)
        ->join('roles', 'roles.id = usuarios.rol')
        ->where('usuarios.status', 1)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_user_roles_all_status($idrol){
    $str = 'usuarios.id idusuario, usuarios.usuario, usuarios.clave, usuarios.nombre, usuarios.email, usuarios.rol, usuarios.status, ';
    $str .= 'roles.id idrol, roles.rol';

    $q= $this
        ->db
        ->select($str)
	      ->from('usuarios')
        ->where('usuarios.rol', $idrol)
        ->join('roles', 'roles.id = usuarios.rol')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_clientes(){
    $str = 'clientes.id idclient, clientes.nombre, clientes.nit, clientes.razonsocial, clientes.contacto, clientes.email, clientes.direccion, clientes.asesor, clientes.status, ';
    $str .= 'usuarios.id idasesor, usuarios.nombre usuarionombre';

    $q= $this
        ->db
        ->select($str)
	      ->from('clientes')
        ->join('usuarios', 'usuarios.id = clientes.asesor')
        ->where('clientes.status', 1)
        ->group_by('clientes.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_clientes_all_status(){
    $str = 'clientes.id idclient, clientes.nombre, clientes.nit, clientes.razonsocial, clientes.contacto, clientes.email, clientes.direccion, clientes.asesor, clientes.status, ';
    $str .= 'usuarios.id idasesor, usuarios.nombre usuarionombre';

    $q= $this
        ->db
        ->select($str)
	      ->from('clientes')
        ->join('usuarios', 'usuarios.id = clientes.asesor')
        ->group_by('clientes.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_clientes_asesor($uid){
    $str = 'clientes.id idclient, clientes.nombre, clientes.nit, clientes.razonsocial, clientes.contacto, clientes.email, clientes.direccion, clientes.asesor, clientes.status, ';
    $str .= 'usuarios.id idasesor, usuarios.nombre usuarionombre';

    $q= $this
        ->db
        ->select($str)
	      ->from('clientes')
        ->join('usuarios', 'usuarios.id = clientes.asesor')
        ->where('clientes.asesor', $uid)
        ->where('clientes.status', 1)
        ->group_by('clientes.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_cliente($idc){
    $str = 'clientes.id idclient, clientes.nombre, clientes.nit, clientes.razonsocial, clientes.contacto, clientes.email, clientes.direccion, clientes.asesor, clientes.status statuscliente, ';
    $str .= 'usuarios.id idasesor, usuarios.nombre usuarionombre';

    $q= $this
        ->db
        ->select($str)
	      ->from('clientes')
        ->where('clientes.id', $idc)
        ->join('usuarios', 'usuarios.id = clientes.asesor')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_categorias_activa(){
    $q= $this
        ->db
        ->select('*')
	      ->from('categorias')
        ->where('status', 1)
        ->group_by('categorias.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_categorias_all_status(){
    $q= $this
        ->db
        ->select('*')
	      ->from('categorias')
        ->group_by('categorias.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_marcas(){
    $q= $this
        ->db
        ->select('*')
	      ->from('marcas')
        ->where('marcas.status', 1)
        ->group_by('marcas.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function check_marca($marca){
    $q= $this
        ->db
        ->select('*')
	      ->from('marcas')
        ->where('marcas.marca', $marca)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function check_categoria($categoria){
    $q= $this
        ->db
        ->select('*')
	      ->from('categorias')
        ->where('categorias.categoria', $categoria)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_marcas_all_status(){
    $q= $this
        ->db
        ->select('*')
	      ->from('marcas')
        ->group_by('marcas.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_marca($idc){
    $q= $this
        ->db
        ->select('*')
	      ->from('marcas')
        ->where('id', $idc)
        ->where('marcas.status', 1)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_productos(){
    $str = 'productos.id idpr, productos.sku, productos.nombreproducto, productos.descripcion, productos.proveedorid, productos.categoriaid, productos.costo, productos.venta, productos.marcaid, productos.status statusprod, productos.peso, productos.cantmin, productos.fob, ';
    $str .= 'proveedores.id idprov, proveedores.nombre nombreproveedor, ';
    $str .= 'categorias.id idcat, categorias.categoria, categorias.status statcat, ';
    $str .= 'marcas.id idmarca, marcas.marca, marcas.status statusmarca';

    $q= $this
        ->db
        ->select($str)
	      ->from('productos')
        ->join('proveedores', 'proveedores.id = productos.proveedorid')
        ->join('categorias', 'categorias.id = productos.categoriaid')
        ->join('marcas', 'marcas.id = productos.marcaid')
        ->where('productos.status', 1)
        ->group_by('productos.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_desperfectos(){
    $str = 'productos.id idpr, productos.sku, productos.nombreproducto, productos.descripcion, productos.proveedorid, productos.categoriaid, productos.costo, productos.venta, productos.marcaid, productos.status statusprod, productos.peso, productos.cantmin, productos.fob, ';
    $str .= 'desperfectos.id iddes, desperfectos.fecha, desperfectos.idp, desperfectos.razon,, desperfectos.cantidad, desperfectos.status statusdesper';

    $q= $this
        ->db
        ->select($str)
	      ->from('desperfectos')
        ->join('productos', 'productos.id = desperfectos.idp')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_productos_all_status_filtro($marca, $categoria){
    $str = 'productos.id idpr, productos.sku, productos.nombreproducto, productos.descripcion, productos.proveedorid, productos.categoriaid, productos.costo, productos.venta, productos.marcaid, productos.status statusprod, productos.peso, productos.cantmin, productos.fob, ';
    // $str .= 'proveedores.id idprov, proveedores.nombre nombreproveedor, ';
    $str .= 'categorias.id idcat, categorias.categoria, categorias.status statcat, ';
    $str .= 'marcas.id idmarca, marcas.marca, marcas.status statusmarca';

    if(($marca == 0) && ($categoria == 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('productos')
        // ->join('proveedores', 'proveedores.id = productos.proveedorid')
        ->join('categorias', 'categorias.id = productos.categoriaid')
        ->join('marcas', 'marcas.id = productos.marcaid')
        // ->group_by('productos.id')
        ->get();
    }

    if(($marca > 0) && ($categoria == 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('productos')
        // ->join('proveedores', 'proveedores.id = productos.proveedorid')
        ->join('categorias', 'categorias.id = productos.categoriaid')
        ->join('marcas', 'marcas.id = productos.marcaid')
        ->where('marcas.id', $marca)
        // ->group_by('productos.id')
        ->get();
    }

    if(($marca == 0) && ($categoria > 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('productos')
        // ->join('proveedores', 'proveedores.id = productos.proveedorid')
        ->join('categorias', 'categorias.id = productos.categoriaid')
        ->join('marcas', 'marcas.id = productos.marcaid')
        ->where('categorias.id', $categoria)
        // ->group_by('productos.id')
        ->get();
    }

    if(($marca > 0) && ($categoria > 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('productos')
        // ->join('proveedores', 'proveedores.id = productos.proveedorid')
        ->join('categorias', 'categorias.id = productos.categoriaid')
        ->join('marcas', 'marcas.id = productos.marcaid')
        ->where('marcas.id', $marca)
        ->where('categorias.id', $categoria)
        // ->group_by('productos.id')
        ->get();
    }

    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_productos_all_status(){
    $str = 'productos.id idpr, productos.sku, productos.nombreproducto, productos.descripcion, productos.proveedorid, productos.categoriaid, productos.costo, productos.venta, productos.marcaid, productos.status statusprod, productos.peso, productos.cantmin, productos.fob, ';
    $str .= 'proveedores.id idprov, proveedores.nombre nombreproveedor, ';
    $str .= 'categorias.id idcat, categorias.categoria, categorias.status statcat, ';
    $str .= 'marcas.id idmarca, marcas.marca, marcas.status statusmarca';

    $q= $this
      ->db
      ->select($str)
      ->from('productos')
      ->join('proveedores', 'proveedores.id = productos.proveedorid')
      ->join('categorias', 'categorias.id = productos.categoriaid')
      ->join('marcas', 'marcas.id = productos.marcaid')
      // ->group_by('productos.id')
      ->get();

    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_productos_id_not_sold($idp){
    $q= $this
        ->db
        ->select("*")
	      ->from('inventario')
        ->where('idproducto', $idp)
        ->where('idventa', 0)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_productos_id_sold($idp){
    $q= $this
        ->db
        ->select("*")
	      ->from('inventario')
        ->where('idproducto', $idp)
        ->where('idventa >', 0)
        ->count_all_results();

    return $q;
  }

  public function get_all_productos_iventario($idp){
    $q= $this
        ->db
        ->select("*")
	      ->from('inventario')
        ->where('idproducto', $idp)
        ->count_all_results();

    return $q;
  }

  public function get_producto($idp){
    $str = 'productos.id idpr, productos.sku, productos.nombreproducto, productos.descripcion, productos.proveedorid, productos.categoriaid, productos.costo, productos.venta, productos.marcaid, productos.status statusprod, productos.peso, productos.cantmin, productos.fob, ';
    $str .= 'proveedores.id idprov, proveedores.nombre nombreproveedor, ';
    $str .= 'categorias.id idcat, categorias.categoria, categorias.status statcat, ';
    $str .= 'marcas.id idmarca, marcas.marca, marcas.status statusmarca';

    $q= $this
        ->db
        ->select($str)
	      ->from('productos')
        ->join('proveedores', 'proveedores.id = productos.proveedorid')
        ->join('categorias', 'categorias.id = productos.categoriaid')
        ->join('marcas', 'marcas.id = productos.marcaid')
        ->where('productos.status', 1)
        ->where('productos.id', $idp)
        ->group_by('productos.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_producto_sku($sku){
    $q= $this
        ->db
        ->select("*")
	      ->from('productos')
        ->where('sku', $sku)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_productos_venta($idv){
    $str = 'inventario.id idpv, inventario.idcompra, inventario.idproducto, inventario.costo, inventario.idventa, inventario.venta inventarioVenta, inventario.status statusidpv, ';
    $str .= 'productos.id idpr, productos.sku, productos.nombreproducto, productos.descripcion, productos.proveedorid, productos.categoriaid, productos.costo, productos.venta, productos.marcaid, productos.status statusprod, ';
		$str .= 'marcas.id idm, marcas.marca';

    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('inventario.idventa', $idv)
        ->join('productos', 'productos.id = inventario.idproducto')
				->join('marcas', 'productos.marcaid = marcas.id')
        ->group_by('idproducto')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function count_productos_venta($idv){
    $q= $this
        ->db
        ->select('*')
	      ->from('inventario')
        ->where('inventario.idventa', $idv)
        ->count_all_results();

    return $q;
  }

  public function all_imagenes_categoria($idproducto){
    $q= $this
        ->db
        ->select('*')
	      ->from('imagenes')
        ->where('idproducto', $idproducto)
        ->where('status', 1)
        ->group_by('imagenes.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_monedas(){
    $q= $this
        ->db
        ->select('*')
	      ->from('monedas')
        ->where('status', 1)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_exhibidores(){
    $q= $this
        ->db
        ->select('*')
	      ->from('exhibidores')
        // ->where('status', 1)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_mi_exhibidores($idv){
    $str = 'lista_exhibidores.id idlis, lista_exhibidores.idventa, lista_exhibidores.idexhibidor, lista_exhibidores.status statuslist, ';
    $str .= 'exhibidores.id idex, exhibidores.descripcion';

    $q= $this
        ->db
        ->select($str)
	      ->from('lista_exhibidores')
        ->where('idventa', $idv)
        ->join('exhibidores', 'exhibidores.id = lista_exhibidores.idexhibidor')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function check_exhibidores($descripcion){
    $q= $this
        ->db
        ->select('*')
	      ->from('exhibidores')
        ->where('descripcion', $descripcion)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_monedas_all_status(){
    $q= $this
        ->db
        ->select('*')
	      ->from('monedas')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function buscar_sku($sku){
    $q= $this
        ->db
        ->select('*')
	      ->from('productos')
        ->where('sku', $sku)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_compras(){
    $q= $this
        ->db
        ->select('*')
	      ->from('compras')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_compra($idcompra){
    $q= $this
        ->db
        ->select('*')
	      ->from('compras')
        ->where('id', $idcompra)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function lista_inventario($idcompra){
    $str = 'inventario.idcompra, inventario.idproducto, inventario.costo, inventario.idventa, inventario.venta, inventario.status statusinv, ';
    $str .= 'productos.id idpr, productos.sku, productos.nombreproducto';
    // $str = '*';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idcompra', $idcompra)
        ->join('productos', 'productos.id = inventario.idproducto')
        ->group_by('inventario.idproducto')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function lista_inventario_sin_agrupar($idcompra){
    $str = 'inventario.idcompra, inventario.idproducto, inventario.costo, inventario.idventa, inventario.venta, inventario.status statusinv, ';
    $str .= 'productos.id idpr, productos.sku, productos.nombreproducto';
    // $str = '*';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idcompra', $idcompra)
        ->join('productos', 'productos.id = inventario.idproducto')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function lista_inventario_conteo($idcompra, $idproducto){
    $str = '*';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idcompra', $idcompra)
        ->where('idproducto', $idproducto)
        ->count_all_results();

    // if($q->num_rows() > 0) {
    //   return $q->result_array();
    // }
    return $q;
  }

  public function lista_inventario_conteo_venta($idventa, $idproducto){
    $str = '*';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idventa', $idventa)
        ->where('idproducto', $idproducto)
        ->count_all_results();

    // if($q->num_rows() > 0) {
    //   return $q->result_array();
    // }
    return $q;
  }

  public function lista_inventario_array_venta($idventa, $idproducto, $limit){
    $str = 'id, venta, idproducto';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idventa', $idventa)
        ->where('idproducto', $idproducto)
        ->limit($limit)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function lista_inventario_conteo_productos($idproducto){
    $str = '*';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idproducto', $idproducto)
        ->where('idventa', 0)
        ->where('desperfecto', 0)
        ->count_all_results();

    // if($q->num_rows() > 0) {
    //   return $q->result_array();
    // }
    return $q;
  }

  public function lista_inventario_conteo_desperfectos($idproducto){
    $str = '*';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idproducto', $idproducto)
        ->where('idventa', 0)
        ->where('desperfecto >', 0)
        ->count_all_results();

    // if($q->num_rows() > 0) {
    //   return $q->result_array();
    // }
    return $q;
  }

  public function get_venta_id($idv){
    $q= $this
        ->db
        ->select('*')
	      ->from('ventas')
        ->where('id', $idv)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_ventas(){
    $q= $this
        ->db
        ->select('*')
	      ->from('ventas')
        ->order_by('id', 'desc')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

	public function get_all_ventas_asc(){
    $q= $this
        ->db
        ->select('*')
	      ->from('ventas')
        ->order_by('id', 'asc')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

	public function get_all_imagenes($idv){
    $q= $this
        ->db
        ->select('*')
	      ->from('imagenes_eliminadas')
        ->where('ideliminado', $idv)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

	public function get_all_ventas_anuladas(){
    $q= $this
        ->db
        ->select('*')
	      ->from('ventas')
        ->order_by('id', 'desc')
				->where('status', 55)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_ventas_filtro($from, $to, $asesor, $cliente){

    $str = 'ventas.id, ventas.idcliente, ventas.idasesor, ventas.fecha, ventas.total, ventas.descuento, ventas.formapago, ventas.status, ';
    $str .= 'clientes.id idcliente, clientes.nombre, clientes.nit, clientes.razonsocial, clientes.email, clientes.direccion, ';

    $fechaFrom = $from;
    $fechaFrom = date('Y-m-d', strtotime($fechaFrom));

    $fechaTo = $to;
    $fechaTo = date('Y-m-d', strtotime($fechaTo));

    if(($asesor == 0) && ($cliente == 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('ventas')
        ->order_by('id', 'desc')
        ->where('fecha >=', $fechaFrom)
        ->where('fecha <=', $fechaTo)
        ->join('clientes', 'clientes.id = ventas.idcliente')
        ->get();
    }

    if(($asesor > 0) && ($cliente == 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('ventas')
        ->order_by('id', 'desc')
        ->where('fecha >=', $fechaFrom)
        ->where('fecha <=', $fechaTo)
        ->where('idasesor', $asesor)
        ->join('clientes', 'clientes.id = ventas.idcliente')
        ->get();
    }

    if(($asesor == 0) && ($cliente > 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('ventas')
        ->order_by('id', 'desc')
        ->where('fecha >=', $fechaFrom)
        ->where('fecha <=', $fechaTo)
        ->where('idcliente', $cliente)
        ->join('clientes', 'clientes.id = ventas.idcliente')
        ->get();
    }

    if(($asesor > 0) && ($cliente > 0)){
      $q= $this
        ->db
        ->select($str)
	      ->from('ventas')
        ->order_by('id', 'desc')
        ->where('fecha >=', $fechaFrom)
        ->where('fecha <=', $fechaTo)
        ->where('idcliente', $cliente)
        ->where('idasesor', $asesor)
        ->join('clientes', 'clientes.id = ventas.idcliente')
        ->get();
    }

    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_ventas_asesor($uid){
    $q= $this
        ->db
        ->select('*')
	      ->from('ventas')
        ->where('idasesor', $uid)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_ventas_producto($pid){

    $q= $this
        ->db
        ->select("*")
	      ->from('inventario')
        ->where('inventario.idventa >', 0)
        ->where('idproducto', $pid)
        ->group_by('inventario.idventa')
        ->join('ventas', 'ventas.id = inventario.idventa')
        ->join('productos', 'productos.id = inventario.idproducto')
        ->join('clientes', 'clientes.id = ventas.idcliente')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function lista_inventario_conteo_productos_vendidos($idventa, $idproducto){
    $str = '*';
    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('idproducto', $idproducto)
        ->where('idventa', $idventa)
        ->count_all_results();

    // if($q->num_rows() > 0) {
    //   return $q->result_array();
    // }
    return $q;
  }

  public function get_all_ventas_credito(){
    $q= $this
        ->db
        ->select('*')
	      ->from('ventas')
        ->where('formapago >', 1)
        ->order_by('id', 'desc')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_all_ventas_asesor_credito($uid){
    $q= $this
        ->db
        ->select('*')
	      ->from('ventas')
        ->where('idasesor', $uid)
        ->where('formapago >', 1)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_venta($idv){
    $str = 'ventas.id, ventas.idcliente, ventas.idasesor, ventas.fecha, ventas.total, ventas.descuento, ventas.formapago, ventas.status, ';
    $str .= 'clientes.id idcliente, clientes.nombre, clientes.nit, clientes.razonsocial, clientes.email, clientes.direccion, ';
    $str .= 'usuarios.id idu, usuarios.nombre nombreuser, ';

    $q= $this
        ->db
        ->select($str)
	      ->from('ventas')
        ->join('clientes', 'clientes.id = ventas.idcliente')
        ->join('usuarios', 'usuarios.id = ventas.idasesor')
        ->where('ventas.id', $idv)
        // ->group_by('ventas.id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_factura_data($idv){
    $q= $this
        ->db
        ->select('*')
	      ->from('facturas')
        ->where('idventa', $idv)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_factura_data_anuladas(){
    $q= $this
        ->db
        ->select('*')
	      ->from('facturas')
        ->where('status', 2)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_factura_data_idfactura($idfactura){
    $q= $this
        ->db
        ->select('*')
	      ->from('facturas')
        ->where('id', $idfactura)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_bancos(){
    $str = 'bancos.id idbanco, bancos.nombre_banco, bancos.cuenta, bancos.tipo_cuenta, bancos.monedaid, bancos.saldo_inicial, bancos.logo, bancos.status, ';
    $str .= 'monedas.id idmoneda, monedas.moneda, monedas.simbolo, monedas.status statusmoneda';

    $q= $this
        ->db
        ->select($str)
	      ->from('bancos')
        ->join('monedas', 'monedas.id = bancos.monedaid')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_bancos_except($idb){
    $str = 'bancos.id idbanco, bancos.nombre_banco, bancos.cuenta, bancos.tipo_cuenta, bancos.monedaid, bancos.saldo_inicial, bancos.logo, bancos.status, ';
    $str .= 'monedas.id idmoneda, monedas.moneda, monedas.simbolo, monedas.status statusmoneda';

    $q= $this
        ->db
        ->select($str)
	      ->from('bancos')
        ->where('bancos.id !=', $idb)
        ->join('monedas', 'monedas.id = bancos.monedaid')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_banco($id){
    $str = 'bancos.id idbanco, bancos.nombre_banco, bancos.cuenta, bancos.tipo_cuenta, bancos.monedaid, bancos.saldo_inicial, bancos.logo, bancos.status, ';
    $str .= 'monedas.id idmoneda, monedas.moneda, monedas.simbolo, monedas.status statusmoneda';

    $q= $this
        ->db
        ->select($str)
	      ->from('bancos')
        ->where('bancos.id', $id)
        ->join('monedas', 'monedas.id = bancos.monedaid')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_tipo_gastos(){

    $q= $this
        ->db
        ->select('*')
	      ->from('tipo_gasto')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function getpagos_suma($idv){
    $str = 'pagos.id, pagos.idventa, SUM(pagos.monto) sumapagos';
    $q= $this
        ->db
        ->select($str)
	      ->from('pagos')
        ->where('pagos.idventa', $idv)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function getpagos($idv){
    $str = 'pagos.id, pagos.idventa, pagos.fecha_pago, pagos.monto, pagos.doc, pagos.bancoid, ';
    $str .= 'ventas.id idventa, ventas.total, ventas.descuento, ';
    $str .= 'bancos.id idb, bancos.nombre_banco, bancos.cuenta';

    $q= $this
        ->db
        ->select($str)
	      ->from('pagos')
        ->where('pagos.idventa', $idv)
        ->join('ventas', 'ventas.id = pagos.idventa')
        ->join('bancos', 'bancos.id = pagos.bancoid')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_lasuma_venta($idv){
    $str = 'inventario.id idpv, inventario.idcompra, inventario.idproducto,  SUM(inventario.costo) sumatotalcosto, inventario.idventa, SUM(inventario.venta) sumatotal, inventario.status statusidpv, ';
    $str .= 'productos.id idpr, productos.sku, productos.nombreproducto, productos.descripcion, productos.proveedorid, productos.categoriaid, productos.costo, productos.venta, productos.marcaid, productos.status statusprod';

    $q= $this
        ->db
        ->select($str)
	      ->from('inventario')
        ->where('inventario.idventa', $idv)
        ->join('productos', 'productos.id = inventario.idproducto')
        // ->group_by('idproducto')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function all_gastos(){

    $str = "gastos.id idgastos, gastos.fecha fechagastos, gastos.monto, gastos.cuentaid, gastos.proveedorid, gastos.tipogastoid, gastos.metodo, gastos.referencia, gastos.descripcion, gastos.status statusgastos, ";
    $str .= 'bancos.id idbancos, bancos.nombre_banco, bancos.cuenta, ';
    $str .= 'proveedores.id idproveedores, proveedores.nombre, ';
    $str .= 'tipo_gasto.id idtipogastos, tipo_gasto.gasto';

    $q= $this
        ->db
        ->select($str)
	      ->from('gastos')
        ->join('bancos', 'bancos.id = gastos.cuentaid')
        ->join('proveedores', 'proveedores.id = gastos.proveedorid')
        ->join('tipo_gasto', 'tipo_gasto.id = gastos.tipogastoid')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function tipo_polizas(){
    $q= $this
        ->db
        ->select('*')
	      ->from('tipo_polizas')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_polizas(){
    $str = 'tipo_polizas.id idtipop, tipo_polizas.tipo, ';
    $str .= 'polizas.id idpolizas, polizas.fecha, polizas.tipoid, polizas.concepto, polizas.status';

    $q= $this
        ->db
        ->select($str)
	      ->from('polizas')
        ->join('tipo_polizas', 'tipo_polizas.id = polizas.tipoid')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_polizas_bancos(){
    $str = 'tipo_polizas.id idtipop, tipo_polizas.tipo, ';
    $str .= 'polizas.id idpolizas, polizas.fecha, polizas.tipoid, polizas.concepto, polizas.status';

    $q= $this
        ->db
        ->select($str)
	      ->from('polizas')
        ->join('tipo_polizas', 'tipo_polizas.id = polizas.tipoid')
        ->where('polizas.status', 3)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function single_poliza($idpoliza){
    $str = 'tipo_polizas.id idtipop, tipo_polizas.tipo, ';
    $str .= 'polizas.id idpolizas, polizas.fecha, polizas.tipoid, polizas.concepto, polizas.status';

    $q= $this
        ->db
        ->select($str)
	      ->from('polizas')
        ->where('polizas.id', $idpoliza)
        ->join('tipo_polizas', 'tipo_polizas.id = polizas.tipoid')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function cuentas_contables(){
    $q= $this
        ->db
        ->select('*')
	      ->from('cuentas_contables')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_cuenta_contable($idcc){
    $q= $this
        ->db
        ->select('*')
	      ->from('cuentas_contables')
        ->where('id', $idcc)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  // public function get_tipo_documentos(){
  //   $q= $this
  //       ->db
  //       ->select('*')
	//       ->from('tipo_documentos')
  //       ->get();
  //   if($q->num_rows() > 0) {
  //     return $q->result_array();
  //   }
  //   return array();
  // }

  public function single_tipo_documentos($idtipo){
    $q= $this
        ->db
        ->select('*')
	      ->from('tipo_documentos')
        ->where('id', $idtipo)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_tipo_documentos(){
    $q= $this
        ->db
        ->select("*")
	      ->from('tipo_documentos')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_movimientos_gastos($idpoliza){
    $str = "movimientos_gastos.id idcuentaspagar, movimientos_gastos.id_poliza, movimientos_gastos.id_cuenta_contable, movimientos_gastos.descripcion, movimientos_gastos.monto, movimientos_gastos.tipo, movimientos_gastos.status statuscuentapagar, ";
    $str .= "cuentas_pagar.id idcp, cuentas_pagar.idpoliza, cuentas_pagar.idproveedor, cuentas_pagar.idtipodoc, cuentas_pagar.fecha, cuentas_pagar.documento doccuentas, cuentas_pagar.serie, ";
    $str .= "proveedores.id idprov, proveedores.nombre nombreproveedor, ";
    $str .= "tipo_documentos.id iddoc, tipo_documentos.documento, ";
    $str .= "cuentas_contables.id idcc, cuentas_contables.codigo, cuentas_contables.nombre";

    $q= $this
        ->db
        ->select($str)
	      ->from('movimientos_gastos')
        ->where('movimientos_gastos.id_poliza', $idpoliza)
        ->join('cuentas_contables', 'cuentas_contables.id = movimientos_gastos.id_cuenta_contable')
        ->join('cuentas_pagar', 'cuentas_pagar.idpoliza = movimientos_gastos.id_poliza')
        ->join('proveedores', 'proveedores.id = cuentas_pagar.idproveedor')
        ->join('tipo_documentos', 'tipo_documentos.id = cuentas_pagar.idtipodoc')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_movimientos_cargos($idpoliza){
    $str = "movimientos_gastos.id idcuentaspagar, movimientos_gastos.id_poliza, movimientos_gastos.id_cuenta_contable, movimientos_gastos.descripcion, SUM(movimientos_gastos.monto) suma, movimientos_gastos.tipo, movimientos_gastos.status statuscuentapagar, ";

    $q= $this
        ->db
        ->select($str)
	      ->from('movimientos_gastos')
        ->where('movimientos_gastos.id_poliza', $idpoliza)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_movimientos_abonos($idpoliza){
    $str = "movimientos_bancarios.id, movimientos_bancarios.id_banco, movimientos_bancarios.id_poliza, movimientos_bancarios.fecha, movimientos_bancarios.ref_bancaria, movimientos_bancarios.tipo_doc, movimientos_bancarios.descripcion, SUM(movimientos_bancarios.monto) suma, movimientos_bancarios.tipo_transaccion, movimientos_bancarios.status";

    $q= $this
        ->db
        ->select($str)
	      ->from('movimientos_bancarios')
        ->where('movimientos_bancarios.id_poliza', $idpoliza)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function lista_movimientos_abonos($idpoliza){
    $str = "movimientos_bancarios.id, movimientos_bancarios.id_banco, movimientos_bancarios.id_poliza, movimientos_bancarios.fecha, movimientos_bancarios.ref_bancaria, movimientos_bancarios.tipo_doc, movimientos_bancarios.descripcion, movimientos_bancarios.monto, movimientos_bancarios.tipo_transaccion, movimientos_bancarios.status, ";
    $str .= "bancos.id idbanco, bancos.nombre_banco, bancos.cuenta_contable_id, ";
    $str .= "cuentas_contables.id idcc, cuentas_contables.codigo, cuentas_contables.nombre";

    $q= $this
        ->db
        ->select($str)
	      ->from('movimientos_bancarios')
        ->where('movimientos_bancarios.id_poliza', $idpoliza)
        ->join('bancos', "bancos.id = movimientos_bancarios.id_banco")
        ->join('cuentas_contables', 'cuentas_contables.id = bancos.cuenta_contable_id')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_cuentas_pagar($idpoliza){
    $str = "cuentas_pagar.id idcuentaspagar, cuentas_pagar.idpoliza, cuentas_pagar.id_cuenta_contable, cuentas_pagar.idproveedor, cuentas_pagar.idtipodoc, cuentas_pagar.fecha fechacuentaspagar, cuentas_pagar.documento, cuentas_pagar.serie, cuentas_pagar.galones, cuentas_pagar.monto, cuentas_pagar.status statuscuentapagar, ";
    $str .= "cuentas_contables.id idcc, cuentas_contables.codigo, cuentas_contables.nombre, ";
    $str .= "proveedores.id idproveedor, proveedores.nombre proveedor, ";
    $str .= "tipo_documentos.id idtd, tipo_documentos.documento documentonombre";

    $q= $this
        ->db
        ->select($str)
	      ->from('cuentas_pagar')
        ->where('cuentas_pagar.idpoliza', $idpoliza)
        ->join('cuentas_contables', 'cuentas_contables.id = cuentas_pagar.id_cuenta_contable')
        ->join('proveedores', 'proveedores.id = cuentas_pagar.idproveedor')
        ->join('tipo_documentos', 'tipo_documentos.id = cuentas_pagar.idtipodoc')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_doc_contables_padre(){
    $q= $this
        ->db
        ->select("*")
	      ->from('cuentas_contables')
        ->where('padre', 0)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_doc_contables_all(){
    $q= $this
        ->db
        ->select("*")
	      ->from('cuentas_contables')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_doc_contables_hijos($iddc){
    $q= $this
        ->db
        ->select("*")
	      ->from('cuentas_contables')
        ->where('padre', $iddc)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_gastos_banco($idb){

    $q= $this
        ->db
        ->select('*')
	      ->from('movimientos_bancarios')
        ->where('id_banco', $idb)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_abonos_banco($idb){

    $q= $this
        ->db
        ->select('*')
	      ->from('pagos')
        ->where('bancoid', $idb)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

  public function get_deudores(){

    $q= $this
        ->db
        ->select('*')
	      ->from('cuentas_contables')
        ->where('padre', 24)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

	public function get_nota($idpv){

    $q= $this
        ->db
        ->select('*')
	      ->from('inventario')
        ->where('id', $idpv)
				->limit(1)
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }

	public function get_inventario(){

    $q= $this
        ->db
        ->select('*')
	      ->from('inventario')
				->where('idventa !=', 0)
				->where('desperfecto =', 0)
				->group_by('idventa')
        ->get();
    if($q->num_rows() > 0) {
      return $q->result_array();
    }
    return array();
  }
}
