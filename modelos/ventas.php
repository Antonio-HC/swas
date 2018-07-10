<?php
  session_start();
  switch ($_GET['opcion']) {
    case 'cargar':
      cargarVista();
      break;
    case 'mostrar':
      mostrar($_GET['consulta']);
      break;
    case 'verDetalleVenta':
      verDetalleVenta($_GET['consulta']);
      break;
    case 'guardar':
      guardarVenta();
      break;
    case 'guardarDetalleVenta':
      guardarDetalleVenta();
      break;
    case 'nuevo':
      nuevaVenta();
      break;
    case 'agregar':
      agregarProducto();
      break;
    case 'listaProductos':
      listaProductos();
      break;
    case 'agregarProducto_venta':
      agregarProducto_venta();
      break;
    case 'cantidadProducto_venta':
      cantidadProducto_venta();
      break;
    case 'seleccionar':
      seleccionar();
      break;
    case 'nVenta':
      nVenta();
      break;
    case 'cobrar':
      cobrarProducto_venta();
      break;
    case 'eliminarVenta':
      eliminarVenta();
      break;
    case 'maxCantidad':
      maxCantidad();
      break;
    case 'actualizarCantidad':
      actualizarCantidad();
      break;
    case 'reporteVentasDiarias':
      reporteVentasDiarias();
      break;
  }
  function cargarVista()
  {
    include "../vistas/ventas.html";
  }
  function mostrar($consulta)
  {
  	include "../bd/conexion.php";

  	if (!$conexion)
  	{
  		die('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}
    $fecha_actual=date("Y-m-d");
  	$result = mysqli_query($conexion,$consulta);
    echo '
    <br />
    <table id="tblVentas" class="table table-striped table-hover">
      <thead>
        <tr>
          <th width="50"></th>
          <th>Id</th>
          <th>Fecha de venta</th>
          <th>Productos vendidos</th>
          <th>Total</th>
          <th>Usuario</th>
        </tr>
      </thead>';
  	while($row = mysqli_fetch_array($result))
  	{
      $id=$row['IdVenta'];
      $fecha=$row['Fecha'];
      $cantidad=$row['ProductosVendidos'];
      $total="$".$row['Total'];
      echo '<tr>';
      echo '
        <td>
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><!--texto-->
            <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
              <li>
                <button onclick="verDetalleVenta('."'".$id."',"."'".$fecha."',"."'".$cantidad."',"."'".$total."'".')" type="button" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-pencil"></span> Ver
                </button>
                <button id="btnEliminar'.$row['IdVenta'].'" onclick="eliminarVenta('."'".$id."'".')" type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span> Eliminar
                </button>
              </li>
            </ul>
          </div>
        </td>';

      echo '<td id="tdId'      .$row['IdVenta'].'">'.$row['IdVenta'] .'</td>';
      echo '<td id="tdFecha'   .$row['IdVenta'].'">'.$row['Fecha']    .'</td>';
      echo '<td id="tdVendidos'.$row['IdVenta'].'">'.$row['ProductosVendidos']   .'</td>';
      echo '<td id="tdTotal'   .$row['IdVenta'].'">$'.$row['Total']   .'</td>';
      echo '<td id="tdUsuario' .$row['IdVenta'].'">'.$row['Usuario']   .'</td>';
      echo '</tr>';
    }
    echo "</table>";
  }
  function nuevaVenta()
  {
    include "../bd/conexion.php";
    $sql = "SELECT Tipo FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($result))
    {
      switch ($row['Tipo']) {
        case 'Administrador':
          $cancel="limpiarTabla()";
          break;
        case 'Empleado':
          $cancel="limpiarTablaEmpleado()";
          break;
      }
    }
    echo '
    <br />
    <div class="panel panel-success">
      <div class="panel-heading">Número de venta: <label id="lblIdVenta"></label><input id="tfIdVenta" type="hidden" value="1" disabled /></div>
      <div class="panel-body">
        <button type="button" class="btn btn-info btn-sm" onclick="agregarProducto_venta()">
            <span class="glyphicon glyphicon-plus"></span> Agregar Producto
        </button>
        <table id="tblVentaAgregar" class="table table-hover table-striped">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio unitario</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr></tr>
          </tbody>
        </table>
        <div class="row">
          <div class="col-sm-6">
            <button id="btnRealizarVenta" class="btn btn-success btn-sm" onclick="cobrarVenta()" disabled="true">
                <span class="glyphicon glyphicon-plus"></span> Realizar venta
            </button>
            <button class="btn btn-danger btn-sm" onclick="'.$cancel.'">
                <span class="glyphicon glyphicon-delete"></span> Cancelar
            </button>
          </div>
          <div class="col-sm-6 text-right" style="color:Tomato; font-size: 30px;">
            <label>Total: $</label><input id="tfTotal" type="text" value="0" size="5" disabled/>
          </div>
        </div>
      </div>
    </div>
    ';
  }
  function agregarProducto()
  {
    echo '
        <div class="modal fade" id="modalVenta" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">Ventas</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <div id="venta-lista-productos">

                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
          </div>
        </div>
    ';
  }
  function listaProductos()
  {
    include "../bd/conexion.php";

  	if (!$conexion)
  	{
  		die('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM PRODUCTOS';
  	$result = mysqli_query($conexion,$sql);
    echo '
    <table id="tblListaProductos" class="table table-striped table-hover table-fixed">
      <thead>
        <tr>
          <th style="width: 20%;">Código</th>
          <th style="width: 50%;">Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Agregar</th>
        </tr>
      </thead>
      <tbody>';
  	while($row = mysqli_fetch_array($result))
  	{
      if ($row['Cantidad']==0) {
        echo '<tr class="danger">';
        $estado='disabled';
      }else {
        echo '<tr>';
        $estado='';
      }
      echo '<td style="width: 20%;" id="tdCodigo'.$row['Codigo'].'">'.$row['Codigo'] .'</td>';
      echo '<td style="width: 50%;" id="tdNombre'.$row['Codigo'].'"><strong>'.$row['Nombre'].'.</strong> <br />'.$row['Descripcion']    .'</td>';
      echo '<td id="tdPrecio'                    .$row['Codigo'].'">$'.$row['PrecioVenta']   .'</td>';
      echo '<td id="tdCantidad'                  .$row['Codigo'].'">'.$row['Cantidad']   .'</td>';
      $codigo=$row['Codigo'];
      $producto=$row['Nombre'];
      $precio=$row['PrecioVenta'];
      echo '
        <td>
          <button id="btnVentaAgrega'.$row['Codigo'].'" onclick="cantidadProducto_venta('.$codigo.')" type="button" class="btn btn-info btn-xs" '.$estado.'>
            <span class="glyphicon glyphicon-plus"></span>
          </button>
        </td>
      ';
      echo '</tr>';
    }
    echo "
      </tbody>
    </table>";
  }

  function cantidadProducto_venta()
  {
    echo '
        <div class="modal fade" id="modalVentaCantidad" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">Cantidad</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <div class="row">
                  <div class="col-xs-12">
                    <p></p>
                    <input type="number" value="1" id="tfCantidadProducto" min="1" max="" class="form-control">
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button onclick="seleccionarProducto_venta('.$_GET['codigo'].')" class="btn btn-success">Aceptar</button>
                  <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </div>
          </div>
        </div>
    ';
  }
  function cobrarProducto_venta()
  {
    include "../bd/conexion.php";
    $sql = "SELECT Tipo FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($result))
    {
      switch ($row['Tipo']) {
        case 'Administrador':
          $aceptar="guardarVenta()";
          break;
        case 'Empleado':
          $aceptar="guardarVenta();,nuevaVenta()";
          break;
      }
    }
    echo '
        <div class="modal fade" id="modalVentaCobrar" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">Pagar</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <div id="input-recibe">
                      <p></p>
                      <label>Recibe: </label>
                      <input type="text" id="tfRecibe" class="form-control input-lg text-center">
                      <p></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <p></p>
                    <button onclick="cambio()" class="btn btn-warning btn-block">Cobrar</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <p></p>
                    <label>Su cambio: </label>
                    <input type="text" id="tfCambio" class="form-control input-lg text-center" disabled>
                    <p></p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button id="btnGuardarVenta" onclick="'.$aceptar.'()" class="btn btn-success" disabled="true">Aceptar</button>
                  <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
            </div>
          </div>
        </div>
    ';
  }
  function seleccionar()
  {
    include "../bd/conexion.php";

  	$sql='SELECT * FROM PRODUCTOS WHERE Codigo='.$_GET['codigo'];
  	$result = mysqli_query($conexion,$sql);
    while ($row=mysqli_fetch_array($result)) {
      echo '
      <tr class="trDato">
        <td>' .$row['Codigo']. '</td>
        <td>' .$row['Nombre'].' '.$row['Descripcion']. '</td>
        <td>' .$_GET['cantidad'].'</td>
        <td>' .$row['PrecioVenta']. '</td>
        <td class="tdTotal">' .$row['PrecioVenta']*$_GET['cantidad']. '</td>
        <td>
          <button onclick="quitarProducto(this)" type="button" class="btn btn-danger btn-xs">
            <span class="glyphicon glyphicon-minus"></span>
          </button>
        </td>
     </tr>
      ';
    }
  }

  function guardarVenta()
  {
    require_once("../bd/conexion.php");
    $usuario;
    $user="SELECT * FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$user);
    while ($row = mysqli_fetch_array($result))
    {
      $usuario=$row['IdUsuario'];
    }
		$insertar="INSERT INTO VENTAS
					VALUES (
            '".$_GET['id']."',
						'".$_GET['vendido']."',
						'".$_GET['fecha']."',
						'".$_GET['total']."',
						'".$usuario."')";
		mysqli_query($conexion,$insertar) or die(mysqli_error($conexion));
  }

  function guardarDetalleVenta()
  {
    require_once("../bd/conexion.php");

		$insertar="INSERT INTO DETALLEVENTA
					VALUES (
            '".$_GET['cantidad']."',
						'".$_GET['precio']."',
						'".$_GET['total']."',
						'".$_GET['codigo']."',
						'".$_GET['id']."')";
		mysqli_query($conexion,$insertar) or die(mysqli_error($conexion));
    actualizarCantidad();
  }
  function eliminarVenta()
  {
    require_once("../bd/conexion.php");
		$eliminar="DELETE FROM VENTAS WHERE IdVenta='".$_GET['id']."'";
		mysqli_query($conexion,$eliminar) or die(mysqli_error($conexion));
  }
  function nVenta()
  {
    include "../bd/conexion.php";
    $consulta='SELECT RIGHT(IdVenta,6)AS Codigo FROM VENTAS ORDER BY IdVenta DESC LIMIT 1';
    $result=mysqli_query($conexion,$consulta);

    $count = mysqli_num_rows($result);
    if ($count <> 0) {
      $data=mysqli_fetch_assoc($result);
      $codigo=$data['Codigo']+1;
    }else {
      $codigo=1;
    }
    $venta=str_pad($codigo,6,"0",STR_PAD_LEFT);
    $codigo="V$venta";

    echo $codigo;
  }
  function verDetalleVenta($consulta)
  {
    include "../bd/conexion.php";
  	$result = mysqli_query($conexion,$consulta);
    echo '
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-sm-3">Venta:  <label id="idVentaDetalle"></label></div>
          <div class="col-sm-3">Fecha:  <label id="fechaVentaDetalle"></label></div>
          <div class="col-sm-3">Vendido:<label id="cantidadVentaDetalle"></label></div>
          <div class="col-sm-3">Total:  <label id="totalVentaDetalle"></label></div>
        </div>
      </div>
      <div class="panel-body">
      <table id="tblDetalleVenta" class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
          </tr>
        </thead>';
  	while($row = mysqli_fetch_array($result))
  	{
      echo '<tr>';

      echo '<td>'.$row['Codigo'] .'</td>';
      echo '<td>'.$row['Producto']    .'</td>';
      echo '<td>'.$row['Cantidad']   .'</td>';
      echo '<td>$'.$row['PrecioUnitario']   .'</td>';
      echo '<td>$'.$row['Total']   .'</td>';
      echo '</tr>';
    }
    echo "</table>";
    echo "</div>
        </div>";
  }
  function maxCantidad()
  {
    include "../bd/conexion.php";
  	$sql='SELECT Cantidad FROM PRODUCTOS WHERE Codigo='.$_GET['codigo'];
  	$result = mysqli_query($conexion,$sql);
    while($row = mysqli_fetch_array($result)) {
      echo $row['Cantidad'];
    }
  }
  function actualizarCantidad()
  {
    include "../bd/conexion.php";
  	$sql='SELECT Cantidad FROM PRODUCTOS WHERE Codigo='.$_GET['codigo'];
  	$result = mysqli_query($conexion,$sql);
    while($row = mysqli_fetch_array($result)) {
      $oldCantidad= $row['Cantidad'];
    }

    $nuevaCantidad=$oldCantidad-$_GET['cantidad'];

    require_once("../bd/conexion.php");
		$modificar="UPDATE PRODUCTOS SET
						Cantidad='".$nuevaCantidad."'
						WHERE Codigo='".$_GET['codigo']."'";
		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
  }
  function reporteVentasDiarias()
  {
    require('../fpdf/fpdf.php');

    class PDF extends FPDF
    {
    // Page header
    function Header()
    {
        // Logo
        $this->Image('../imagenes/logotipo.jpg',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Ventas',1,0,'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->Cell(0,10,datosVenta(),0,1);
    $pdf->Output();
  }
  function datosVenta()
  {

  }
?>
