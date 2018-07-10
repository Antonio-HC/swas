<?php
  switch ($_GET['opcion']) {
    case 'cargar':
      cargar();
      break;
    case 'cantidadProductos':
      cantidadProductos();
      break;
    case 'cantidadVentas':
      cantidadVentas();
      break;
    case 'cantidadProveedores':
      cantidadProveedores();
      break;
    case 'productosAgotados':
      productosAgotados();
      break;
    case 'productosPorAgotar':
      productosPorAgotar();
      break;
    case 'cargarEscritorioEmpleado':
      cargarEscritorioEmpleado();
      break;
  }

  function cargar()
  {
    include "../vistas/inicio.html";
  }
  function cargarEscritorioEmpleado()
  {
    include "../vistas/inicioEmpleado.html";
  }
  function cantidadProductos()
  {
    include "../bd/conexion.php";
    $cantidad="0";
    $consulta="SELECT COUNT(*) FROM PRODUCTOS";
    $result = mysqli_query($conexion,$consulta);
    while ($row = mysqli_fetch_array($result))
    {
      $cantidad=$row[0];
    }
    echo $cantidad;
  }
  function cantidadVentas()
  {
    include "../bd/conexion.php";
    $cantidad="0";
    $consulta="SELECT COUNT(*) FROM VENTAS";
    $result = mysqli_query($conexion,$consulta);
    while ($row = mysqli_fetch_array($result))
    {
      $cantidad=$row[0];
    }
    echo $cantidad;
  }
  function cantidadProveedores()
  {
    include "../bd/conexion.php";
    $cantidad="0";
    $consulta="SELECT COUNT(*) FROM PROVEEDORES";
    $result = mysqli_query($conexion,$consulta);
    while ($row = mysqli_fetch_array($result))
    {
      $cantidad=$row[0];
    }
    echo $cantidad;
  }
  function productosAgotados()
  {
    include "../bd/conexion.php";
    $cantidad="0";
    $consulta="SELECT COUNT(Cantidad) FROM PRODUCTOS WHERE Cantidad=0";
    $result = mysqli_query($conexion,$consulta);
    while ($row = mysqli_fetch_array($result))
    {
      $cantidad=$row[0];
    }
    echo $cantidad;
  }
  function productosPorAgotar()
  {
    include "../bd/conexion.php";
    $cantidad="0";
    $consulta="SELECT COUNT(Cantidad) FROM PRODUCTOS WHERE Cantidad<=5";
    $result = mysqli_query($conexion,$consulta);
    while ($row = mysqli_fetch_array($result))
    {
      $cantidad=$row[0];
    }
    echo $cantidad;
  }

 ?>
