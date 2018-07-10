<?php
  switch ($_GET['opcion']) {
    case 'cargar':
      cargar();
      break;
    case 'mostrar':
  		mostrar();
  		break;
    case 'nuevo':
      formulario("AGREGAR CATEGORÍA","","","Agregar","agregarCategoria()");
      break;
    case 'agregar':
      agregar();
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

  function cargar()
  {
    include "../vistas/categorias.html";
  }
  function mostrar()
  {
  	include "../bd/conexion.php";

  	if (!$conexion)
  	{
  		dile('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM CATEGORIAS';
  	$result = mysqli_query($conexion,$sql);
    echo '<br />
    <table id="tblCategorias" class="table table-hover table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th>Id</th>
          <th>Nombre</th>
        </tr>
      </thead>';
  	while($row = mysqli_fetch_array($result))
  	{
      echo '<tr>';
      echo '
        <td>
          <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><!--texto-->
            <span class="caret"></span></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
              <li>
                <button id="btnEditar'.$row['IdCategoria'].'" onclick="editarCategoria('.$row['IdCategoria'].')" type="button" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-pencil"></span> Editar
                </button>
                <button id="btnEliminar'.$row['IdCategoria'].'" onclick="eliminarCategoria('.$row['IdCategoria'].')" type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span> Eliminar
                </button>
              </li>
            </ul>
          </div>
        </td>';

      echo '<td id="tdId'         .$row['IdCategoria'].'">'.$row['IdCategoria'] .'</td>';
      echo '<td id="tdNombre'     .$row['IdCategoria'].'">'.$row['Nombre']    .'</td>';
      echo '</tr>';
    }
    echo "</table>";
  }
  function formulario($titulo,$id,$nombre,$btn,$funcion)
  {
    echo '
        <div class="modal fade" id="modalCategoria" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">'.$titulo.'</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <form>
                  <div class="form-group row"><br />
                    <div class="col-xs-12">
                      <input type="hidden" id="tfId" value="'.$id.'" />
                      <label>Nombre:</label>
                      <input id="tfNombre" class="form-control"    type="text" value="'.$nombre.'" placeholder="Nombre"/><br />
                    </div>
                  </div>
                  <spam id="mensaje"></spam>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-success" value="'.$btn.'" onclick="'.$funcion.'"/>

                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    ';
  }

  function agregar()
  {
    require_once("../bd/conexion.php");
		$insertar="INSERT INTO CATEGORIAS VALUES ('','".$_GET['Nombre']."')";
		mysqli_query($conexion,$insertar) or die(mysqli_error($conexion));
  }

  function editar()
  {
    $id='';
    $nombre='';
    include "../bd/conexion.php";
  	if (!$conexion)
  	{
  		dile('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM CATEGORIAS WHERE IdCategoria="'.$_GET['IdCategoria'].'"';
  	$result = mysqli_query($conexion,$sql);
  	while($row = mysqli_fetch_array($result))
    {
      $nombre=$row['Nombre'];
      $id=$row['IdCategoria'];
    }
    formulario("EDITAR CATEGORIA",$id,$nombre,"Guardar cambios","modificarCategoria()");

  }
  function modificar()
  {
    require_once("../bd/conexion.php");
		$modificar="UPDATE CATEGORIAS SET
						Nombre='".$_GET['Nombre']."'
						WHERE IdCategoria='".$_GET['Id']."'";
		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
  }
  function eliminar()
  {
    require_once("../bd/conexion.php");
		$eliminar="DELETE FROM CATEGORIAS WHERE IdCategoria='".$_GET['IdCategoria']."'";
		mysqli_query($conexion,$eliminar) or die(mysqli_error($conexion));
  }
?>
