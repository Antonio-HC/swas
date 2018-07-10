<?php
  switch ($_GET['opcion']) {
    case 'cargar':
      cargar();
      break;
    case 'mostrar':
      mostrar();
      break;
    case 'nuevo':
      formulario("","","","slide.jpg","submit","hidden","agregar");
      break;
    case 'agregar':
      insertar();
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
    case 'mostrarCarousel':
      mostrarCarousel();
      break;
  }
  function cargar()
  {
    include "../vistas/config_slider.html";
  }
  function mostrar()
  {
    include "../bd/conexion.php";
    $consulta="SELECT * FROM SLIDERS";
    $result  =mysqli_query($conexion,$consulta);

    echo '<div>';
    while ($row=mysqli_fetch_array($result)) {
      echo '
        <div class="container" style="float:left;width: 50%;">
          <img src="../imagenes/sliders/'.$row['Imagen'].'" class="img-thumbnail" alt="Imagen" width="100%">
          <p><strong>Título: </strong>'.$row['Titulo'].'</p>
          <p><strong>Descripción: </strong>'.$row['Descripcion'].'</p>
          <p><strong>Mostrar: </strong>'.$row['Mostrar'].'</p>
          <span>
          <button id="btnEditar'.$row['Id'].'" onclick="editarSlider('.$row['Id'].')" type="button" class="btn btn-info btn-xs">
            <span class="glyphicon glyphicon-pencil"></span> Editar
          </button>
          <button id="btnEliminar'.$row['Id'].'" onclick="eliminarSlider('.$row['Id'].')" type="button" class="btn btn-danger btn-xs">
            <span class="glyphicon glyphicon-trash"></span> Eliminar
          </button>
          </span>
          <hr />
        </div>
      ';
    }
    echo "</div>";
  }
  function mostrar1()
  {
    include "../bd/conexion.php";
    $consulta="SELECT * FROM SLIDERS";
    $result  =mysqli_query($conexion,$consulta);
    echo '
      <table class="table">
        <thead>
          <tr>
            <th>Título</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th>Mostrar</th>
          </tr>
        </thead>
        ';
      while ($row=mysqli_fetch_array($result)) {
        echo '
          <tr>
            <td width="255"><img src="../imagenes/sliders/'.$row['Imagen'].'" class="img-thumbnail" alt="Imagen" width="255" height="255"></td>
            <td>'.$row['Titulo'].'</td>
            <td>'.$row['Descripcion'].'</td>
            <td>'.$row['Mostrar'].'</td>
          </tr>
      ';
    }
    echo '</table>';
  }

  function formulario($id,$titulo,$descripcion,$img,$agregar,$modificar,$opcion)
  {
    echo '
        <div class="modal fade" id="modalSlider" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">SLIDER</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <form id="frmSlider" method="post" enctype="multipart/form-data" action="../modelos/config_slider.php?opcion='.$opcion.'">
                  <div class="form-group row"><br />
                    <div class="col-xs-6">
                      <input name="tfId" type="hidden" value="'.$id.'"/>
                      <label for="tfTitulo">Título:</label>
                      <input name="tfTitulo" class="form-control"    type="text" value="'.$titulo.'" placeholder="Titulo"/><br />
                      <label for="tfDescripcion">Descripción:</label>
                      <input name="tfDescripcion" class="form-control"   type="text" value="'.$descripcion.'" placeholder="Descripcion"/><br />
                      <select id="cbMostrar" name="cbMostrar" class="input-sm">
                        <option>SI</option>
                        <option>NO</option>
                      </select>
                    </div>
                    <div class="col-xs-6">
                      <label>Imagen:</label>
                      <input id="image" name="image" type="file" /><br />
                      <img src="../imagenes/sliders/'.$img.'" class="img-thumbnail" alt="Ejemplo" width="100%">

                    </div>
                  </div>
                  <spam id="mensaje"></spam>
                  <div class="modal-footer">
                    <input type="'.$agregar.'" name="btnAgregar" class="btn btn-success" value="Agregar Slider">
                    <input type="'.$modificar.'" name="btnModificar" class="btn btn-success" value="Modificar Slider">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
    ';
  }

  function editar()
  {
    $id='';
    $titulo='';
    $descripcion='';
    $imagen='';
    $visible='';

    include "../bd/conexion.php";
  	if (!$conexion)
  	{
  		dile('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM SLIDERS WHERE Id="'.$_GET['Id'].'"';
  	$result = mysqli_query($conexion,$sql);
  	while($row = mysqli_fetch_array($result))
    {
      $id=$row['Id'];
      $titulo=$row['Titulo'];
      $descripcion=$row['Descripcion'];
      $imagen=$row['Imagen'];
      $visible=$row['Mostrar'];
    }
    formulario($id,$titulo,$descripcion,$imagen,"hidden","submit","modificar");
  }

  function insertar()
  {
    error_reporting( ~E_NOTICE ); // avoid notice

  	require_once '../bd/conexion.php';

  	if(isset($_POST['btnAgregar']))
  	{
  		$titulo = $_POST['tfTitulo'];
  		$descripcion = $_POST['tfDescripcion'];
  		$visible = $_POST['cbMostrar'];

  		$imgFile = $_FILES['image']['name'];
  		$tmp_dir = $_FILES['image']['tmp_name'];
  		$imgSize = $_FILES['image']['size'];


  		if(empty($titulo)){
  			$errMSG = "Ingrese un titulo";
  			echo "Ingrese un titulo";
  		}
  		else if(empty($descripcion)){
  			$errMSG = "Ingrese descripcion";
  			echo "Ingrese descripcion";
  		}
  		else if(empty($imgFile)){
  			$errMSG = "Seleccione una imagen";
  			echo "Seleccione una imagen";
  		}
  		else
  		{
  			$upload_dir = '../imagenes/sliders/'; // upload directory

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
    		$insertar="INSERT INTO SLIDERS VALUES('', '".$titulo."','".$descripcion."','".$imagen."', '".$visible."')";

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
    $id=$_POST['tfId'];
    $consulta="SELECT * FROM SLIDERS WHERE Id='".$id."'";
    $result  =mysqli_query($conexion,$consulta);
    while ($row=mysqli_fetch_array($result)) {
      $img=$row['Imagen'];
    }

  	if(isset($_POST['btnModificar']))
  	{
  		$titulo = $_POST['tfTitulo'];// user name
  		$descripcion = $_POST['tfDescripcion'];// user email
      $visible=$_POST['cbMostrar'];

  		$imgFile = $_FILES['image']['name'];
  		$tmp_dir = $_FILES['image']['tmp_name'];
  		$imgSize = $_FILES['image']['size'];

  		if($imgFile)
  		{
  			$upload_dir = '../imagenes/sliders/'; // upload directory
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
        $modificar="UPDATE SLIDERS SET
    						Titulo='".$titulo."',
    						Descripcion='".$descripcion."',
    						Imagen='".$imagen."',
    						Mostrar='".$visible."'
    						WHERE Id='".$id."'";

    		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
        header("location: ".$_SERVER['HTTP_REFERER']);//regresar a la pagina anterior

  		}


  	}
  }

  function eliminar()
  {
    require_once '../bd/conexion.php';
  	if(isset($_GET['Id']))
  	{
      $img;
      $id=$_GET['Id'];
      $consulta="SELECT * FROM SLIDERS WHERE Id='".$id."'";
      $result  =mysqli_query($conexion,$consulta);
      while ($row=mysqli_fetch_array($result)) {
        $img=$row['Imagen'];
      }
  		unlink("../imagenes/sliders/".$img);

      $eliminar="DELETE FROM SLIDERS WHERE Id='".$id."'";
  		mysqli_query($conexion,$eliminar) or die(mysqli_error($conexion));
    }
    echo '
    <div class="alert alert-success alert-dismissable">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
      Slide eliminado
    </div>
    ';
  }

  function mostrarCarousel()
  {
    include "../bd/conexion.php";
    if(!$conexion) {
      echo "No se encontro la Base de Datos";
    } else {
    //Contar imagenes a mostrar para los indicadores
    $numero=0;
    $count="SELECT * FROM SLIDERS WHERE Mostrar='Si'";
    $result1  =mysqli_query($conexion,$count);
    echo '
    <!-- Indicators -->
    <ol class="carousel-indicators">

    ';
    while ($row=mysqli_fetch_array($result1)) {
      if ($numero==0) {
        echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
        $numero=$numero+1;
      }
      else {
        echo '<li data-target="#myCarousel" data-slide-to="'.$numero.'"></li>';
        $numero=$numero+1;
      }
    }
    echo '</ol>';
    echo '<!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
        ';
    $reg=0;
    $consulta="SELECT * FROM SLIDERS WHERE Mostrar='Si'";
    $result  =mysqli_query($conexion,$consulta);
    while ($row=mysqli_fetch_array($result)) {
      if ($reg==0) {
        echo '
        <div class="item active">
          <img src="imagenes/sliders/'.$row['Imagen'].'" alt="imagen" width="1200" height="700">
          <div class="carousel-caption">
            <h3>'.$row['Titulo'].'</h3>
            <p>'.$row['Descripcion'].'</p>
          </div>
        </div>
        ';
        $reg=$reg+1;
      }
      else {
        echo '
        <div class="item">
          <img src="imagenes/sliders/'.$row['Imagen'].'" alt="imagen" width="1200" height="700">
          <div class="carousel-caption">
            <h3>'.$row['Titulo'].'</h3>
            <p>'.$row['Descripcion'].'</p>
          </div>
        </div>
        ';
        $reg=$reg+1;
      }
    }
    echo '</div>';
    }
  }
  function slider()
  {
    echo '
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="imagenes/computer.png" alt="New York" width="1200" height="700">
        <div class="carousel-caption">
          <h3>ADMIN-STORE</h3>
          <p>Sistema de administración de inventario.</p>
        </div>
      </div>

      <div class="item">
        <img src="imagenes/slide2.jpg" alt="Chicago" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Titulo</h3>
          <p>Descripcion.</p>
        </div>
      </div>

      <div class="item">
        <img src="imagenes/slide1.jpg" alt="Los Angeles" width="1200" height="700">
        <div class="carousel-caption">
          <h3>Titulo</h3>
          <p>Descripcion</p>
        </div>
      </div>
    </div>
    ';
  }

?>
