<?php
  switch ($_GET['opcion']) {
    case 'cargar':
      cargarVista();
      break;
    case 'mostrar':
      mostrar($_GET['consulta']);
      break;
    case 'nuevo':
      formulario("Agregar Producto","","","","","","","","no_imagen.png","submit","hidden","agregar","");
      break;
    case 'agregar':
      insertar();
      break;
    case 'codigo':
      buscarCodigo($_GET['consulta']);
      break;
    case 'editar':
      editar();
      break;
    case 'modificar':
      modificar();
      break;
    case 'eliminar':
      eliminar();
      break;
  }

  function cargarVista()
  {
    include "../vistas/productos.html";
  }
  function mostrar($consulta)
  {
    include "../bd/conexion.php";
    //$consulta="SELECT * FROM PRODUCTOS";
    $result = mysqli_query($conexion,$consulta);
    echo '
      <table id="tblProductos" class="table table-hover table-striped">
        <thead>
          <tr>
            <th width="50"></th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Compra</th>
            <th>Venta</th>
            <th>Cantidad</th>
            <th>Proveedor</th>
            <th>Categoria</th>
            <th>Fabricante</th>
            <th width="15%">Imagen</th>
          </tr>
        </thead>
    ';
    while ($row = mysqli_fetch_array($result)) {
      if ($row['Cantidad']==0) {
        echo '<tr class="danger">';
      }
      elseif ($row['Cantidad']<=5) {
        echo '<tr class="warning">';
      }
      else {
        echo '<tr>';
      }
      echo '
        <td>
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><!--texto-->
            <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
              <li>
                <button id="btnEditar'.$row['Codigo'].'" onclick="editarProducto('.$row['Codigo'].')" type="button" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-pencil"></span> Editar
                </button>
                <button id="btnEliminar'.$row['Codigo'].'" onclick="eliminarProducto('.$row['Codigo'].')" type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span> Eliminar
                </button>
              </li>
            </ul>
          </div>
        </td>';
        echo '
        <td>'.$row['Codigo'].'</td>
        <td>'.$row['Nombre'].'</td>
        <td>'.$row['Descripcion'].'</td>
        <td>'.$row['PrecioCompra'].'</td>
        <td>'.$row['PrecioVenta'].'</td>
        <td>'.$row['Cantidad'].'</td>
        <td>'.$row['Proveedor'].'</td>
        <td>'.$row['Categoria'].'</td>
        <td>'.$row['Fabricante'].'</td>
        <td><img src="../imagenes/productos/'.$row['Imagen'].'" width="100%" /></td>
      </tr>';
    }
    echo '</table>';
  }

  function formulario($titulo,$codigo,$nombre,$descripcion,$cantidad,$compra,$venta,$fabricante,$imagen,$agregar,$modificar,$opcion,$estado)
  {
    echo '
        <div class="modal fade" id="modalProducto" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">'.$titulo.'</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <form id="frmProductos" method="post" enctype="multipart/form-data" action="../modelos/productos.php?opcion='.$opcion.'">
                  <div class="form-group row"><br />
                    <div class="col-xs-7">
                      <div class="row">
                        <div class="col-xs-8">
                          <p><label >Código: </label></p>
                        </div>
                        <div class="col-xs-4 text-right">
                          <label id="alert-codigo"></label>
                        </div>
                      </div>
                      <input onkeyup="verificarCodigo()" id="tfCodigo" name="tfCodigo" class="form-control" type="text" value="'.$codigo.'" placeholder="Código" '.$estado.' required/><br />
                      <input name="tfCodigoEdit" class="form-control" type="hidden" value="'.$codigo.'" /><br />
                      <label>Nombre:</label>
                      <input name="tfNombre" class="form-control" type="text" value="'.$nombre.'" placeholder="Nombre" required/><br />
                      <label>Descripción:</label>
                      <input name="tfDescripcion" class="form-control" type="text" value="'.$descripcion.'" placeholder="Descripción" required /><br />
                      <label>Imagen de producto:</label><br />
                      <img src="../imagenes/productos/'.$imagen.'" class="img-thumbnail" alt="Ejemplo" width="50%">
                      <input id="image" name="image" size="30" type="file" />
                    </div>

                    <div class="col-xs-5">
                    <label>Cantidad:</label><p></p>
                    <input name="tfCantidad" class="form-control"   type="text" value="'.$cantidad.'" placeholder="Cantidad" required/><br />
                      <div class="row">
                        <div class="col-xs-6">
                          <label>Compra:</label>
                          <input name="tfCompra" class="form-control"   type="text" value="'.$compra.'" placeholder="$" required/><br />
                        </div>
                        <div class="col-xs-6">
                          <label>Venta:</label>
                          <input name="tfVenta" class="form-control"   type="text" value="'.$venta.'" placeholder="$" required/><br />
                        </div>
                      </div>
                      <label>Fabricante:</label>
                      <input name="tfFabricante" class="form-control"  type="text" value="'.$fabricante.'" placeholder="Fabricante" required/><br />
      ';
                      combo();//cargar comobobox

    echo '          </div>
                  </div>
                  <spam id="mensaje"></spam>
                  <div class="modal-footer">
                  <input type="'.$agregar.'" name="btnAgregar" class="btn btn-success" value="Agregar">
                  <input type="'.$modificar.'" name="btnModificar" class="btn btn-success" value="Modificar">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
    ';
  }
  function combo()
  {
    include "../bd/conexion.php";
    //Categorias
    $comboCat="SELECT * FROM CATEGORIAS";
    $result = mysqli_query($conexion,$comboCat);
    echo '
      <label>Categoría:</label><br />
      <select id="cbCat" name="cbCategoria" class="input-sm">
        <option>--Seleccione--</option>
    ';
    while ($row =mysqli_fetch_array($result)) {
      echo '<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    echo '</select><br />';
    //Proveedores
    $comboP="SELECT * FROM PROVEEDORES";
    $result = mysqli_query($conexion,$comboP);
    echo '
      <label>Proveedor:</label><br />
      <select id="cbPro" name="cbProveedor" class="input-sm">
        <option>--Seleccione--</option>
    ';
    while ($row =mysqli_fetch_array($result)) {
      echo '<option value="'.$row[0].'">'.$row[1].'</option>';
    }
    echo '</select>';
  }

  function buscarCodigo($consulta)
  {
    $codigo='';
    include "../bd/conexion.php";
    $result = mysqli_query($conexion,$consulta);
    $num_row = mysqli_num_rows($result);
    if ($num_row == "1") {
      echo '
      <p style="color:Tomato;"><spam class="glyphicon glyphicon-remove"></spam> Ya existe</p>
      ';
    } else {
      echo '
      <p style="color:MediumSeaGreen;"><spam class="glyphicon glyphicon-ok"></spam></p>

      ';
    }
  }

  function agregar()//no utilizado
  {
    require_once("../bd/conexion.php");
		$insertar="INSERT INTO PRODUCTOS
					VALUES (
						'".$_GET['codigo']."',
						'".$_GET['nombre']."',
						'".$_GET['cantidad']."',
						'".$_GET['compra']."',
						'".$_GET['venta']."',
            '".$_GET['descripcion']."',
            '".$_GET['proveedor']."',
            '".$_GET['categoria']."',
            '".$_GET['fabricante']."',
						'".$_GET['imagen']."')";
		mysqli_query($conexion,$insertar) or die(mysqli_error($conexion));

  }
  function editar()
  {
    $codigo='';
    $nombre='';
    $descripcion='';
    $cantidad='';
    $compra='';
    $venta='';
    $fabricante='';
    $imagen='';

    include "../bd/conexion.php";
  	if (!$conexion)
  	{
  		dile('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM PRODUCTOS WHERE Codigo="'.$_GET['codigo'].'"';
  	$result = mysqli_query($conexion,$sql);
  	while($row = mysqli_fetch_array($result))
    {
      $codigo=$row['Codigo'];
      $nombre=$row['Nombre'];
      $descripcion=$row['Descripcion'];
      $cantidad=$row['Cantidad'];
      $compra=$row['PrecioCompra'];
      $venta=$row['PrecioVenta'];
      $fabricante=$row['Fabricante'];
      $imagen=$row['Imagen'];
    }
    formulario("Editar producto",$codigo,$nombre,$descripcion,$cantidad,$compra,$venta,$fabricante,$imagen,"hidden","submit","modificar","disabled");
  }

  function modificar1()//no utilizado
  {
    require_once("../bd/conexion.php");
		$modificar="UPDATE PRODUCTOS SET
						Nombre='".$_GET['nombre']."',
						Cantidad='".$_GET['cantidad']."',
						PrecioCompra='".$_GET['compra']."',
						PrecioVenta='".$_GET['venta']."',
						Descripcion='".$_GET['descripcion']."',
						Proveedor='".$_GET['proveedor']."',
						Categoria='".$_GET['categoria']."',
						Fabricante='".$_GET['fabricante']."'
						WHERE Codigo='".$_GET['codigo']."'";
		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
  }
  function eliminar1()//no utilizado
  {
    require_once("../bd/conexion.php");
		$eliminar="DELETE FROM PRODUCTOS WHERE Codigo='".$_GET['codigo']."'";
		mysqli_query($conexion,$eliminar) or die(mysqli_error($conexion));
  }

  function insertar()
  {
    error_reporting( ~E_NOTICE ); // avoid notice

  	require_once '../bd/conexion.php';

  	if(isset($_POST['btnAgregar']))
  	{
      $codigo=$_POST['tfCodigo'];
      $nombre=$_POST['tfNombre'];
      $cantidad=$_POST['tfCantidad'];
      $compra=$_POST['tfCompra'];
      $venta=$_POST['tfVenta'];
      $descripcion=$_POST['tfDescripcion'];
      $proveedor=$_POST['cbProveedor'];
      $categoria=$_POST['cbCategoria'];
      $fabricante=$_POST['tfFabricante'];

  		$imgFile = $_FILES['image']['name'];
  		$tmp_dir = $_FILES['image']['tmp_name'];
  		$imgSize = $_FILES['image']['size'];


  		/*if(empty($titulo)){
  			$errMSG = "Ingrese un titulo";
  			echo "Ingrese un titulo";
  		}
  		else if(empty($descripcion)){
  			$errMSG = "Ingrese descripcion";
  			echo "Ingrese descripcion";
  		}
  		else */if(empty($imgFile)){
  			$errMSG = "Seleccione una imagen";
  			echo "Seleccione una imagen";
  		}
  		else
  		{
  			$upload_dir = '../imagenes/productos/'; // upload directory

  			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

  			// valid image extensions
  			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

  			// rename uploading image
  			$imagen = rand(1000,1000000).".".$imgExt;

  			// allow valid image file formats
  			if(in_array($imgExt, $valid_extensions)){
  				// Check file size '5MB'
  				if($imgSize < 5000000)				{
  					move_uploaded_file($tmp_dir,$upload_dir.$imagen);
  				}
  				else{
  					$errMSG = "Archivo muy grande";
  					echo "Archivo muy grande";
  				}
  			}
  			else{
  				$errMSG = "Solo se permiten archivos JPG, JPEG, PNG & GIF.";
  				echo "Solo se permiten archivos JPG, JPEG, PNG & GIF.";
  			}
  		}

  		// if no error occured, continue ....
  		if(!isset($errMSG))
  		{
        require_once("../bd/conexion.php");
    		$insertar="INSERT INTO PRODUCTOS VALUES('".$codigo."','".$nombre."','".$descripcion."','".$compra."',
                                              '".$venta."','".$cantidad."','".$fabricante."',
                                              '".$imagen."','".$proveedor."','".$categoria."')";
                                              echo $insertar;
        mysqli_query($conexion,$insertar) or die(mysqli_error($conexion));
        header("location: ".$_SERVER['HTTP_REFERER']);//regresar a la pagina anterior
  		}
  	}
  }
  function modificar()
  {
    error_reporting( ~E_NOTICE );

  	require_once '../bd/conexion.php';
    $img;
    $codigo=$_POST['tfCodigoEdit'];
    $consulta="SELECT * FROM PRODUCTOS WHERE Codigo='".$codigo."'";
    $result  =mysqli_query($conexion,$consulta);
    while ($row=mysqli_fetch_array($result)) {
      $img=$row['Imagen'];
    }

  	if(isset($_POST['btnModificar']))
  	{
      $codigo=$_POST['tfCodigoEdit'];
      $nombre=$_POST['tfNombre'];
      $cantidad=$_POST['tfCantidad'];
      $compra=$_POST['tfCompra'];
      $venta=$_POST['tfVenta'];
      $descripcion=$_POST['tfDescripcion'];
      $proveedor=$_POST['cbProveedor'];
      $categoria=$_POST['cbCategoria'];
      $fabricante=$_POST['tfFabricante'];

  		$imgFile = $_FILES['image']['name'];
  		$tmp_dir = $_FILES['image']['tmp_name'];
  		$imgSize = $_FILES['image']['size'];

  		if($imgFile)
  		{
  			$upload_dir = '../imagenes/productos/'; // upload directory
  			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  			$imagen = rand(1000,1000000).".".$imgExt;
  			if(in_array($imgExt, $valid_extensions))
  			{
  				if($imgSize < 5000000)
  				{
  					unlink($upload_dir.$img);
  					move_uploaded_file($tmp_dir,$upload_dir.$imagen);
  				}
  				else
  				{
  					$errMSG = "Sorry, your file is too large it should be less then 5MB";
  					echo "Archivo debe ser menor a 5MB";
  				}
  			}
  			else
  			{
  				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          echo "Solo se permiten archivos JPG, JPEG, PNG & GIF.";
  			}
  		}
  		else
  		{
  			// if no image selected the old image remain as it is.
  			$imagen = $img; // old image from database
  		}


  		// if no error occured, continue ....
  		if(!isset($errMSG))
  		{
        require_once("../bd/conexion.php");
        $modificar="UPDATE PRODUCTOS SET
    						Codigo='".$codigo."',
    						Nombre='".$nombre."',
    						Cantidad='".$cantidad."',
    						PrecioCompra='".$compra."',
    						PrecioVenta='".$venta."',
    						Descripcion='".$descripcion."',
    						Proveedor='".$proveedor."',
    						Categoria='".$categoria."',
    						Fabricante='".$fabricante."',
    						Imagen='".$imagen."'
    						 WHERE Codigo='".$codigo."'";
    		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
        header("location: ".$_SERVER['HTTP_REFERER']);//regresar a la pagina anterior

  		}


  	}
  }

  function eliminar()
  {
    require_once '../bd/conexion.php';
  	if(isset($_GET['Codigo']))
  	{
      $img;
      $codigo=$_GET['Codigo'];
      $consulta="SELECT * FROM PRODUCTOS WHERE Codigo='".$codigo."'";
      $result  =mysqli_query($conexion,$consulta);
      while ($row=mysqli_fetch_array($result)) {
        $img=$row['Imagen'];
      }
  		unlink("../imagenes/productos/".$img);

      $eliminar="DELETE FROM PRODUCTOS WHERE Codigo='".$codigo."'";
  		mysqli_query($conexion,$eliminar) or die(mysqli_error($conexion));
    }
    echo '
    <div class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      Slide eliminado
    </div>
    ';
  }
?>
