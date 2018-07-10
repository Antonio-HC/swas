<?php
  switch ($_GET['opcion']) {
    case 'cargar':
      cargar();
      break;
    case 'mostrar':
  		mostrar();
  		break;
    case 'nuevo':
      formulario("Agregar Proveedor","","","","Agregar Proveedor","agregarProveedor()");
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
    include "../vistas/proveedores.html";
  }
  function mostrar()
  {
  	include "../bd/conexion.php";

  	if (!$conexion)
  	{
  		dile('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM PROVEEDORES';
  	$result = mysqli_query($conexion,$sql);
    echo '<br />
    <table id="tblProveedores" class="table table-hover table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th>Id</th>
          <th>Nombre</th>
          <th>Telefono</th>
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
                <button id="btnEditar'.$row['IdProveedor'].'" onclick="editarProveedor('.$row['IdProveedor'].')" type="button" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-pencil"></span> Editar
                </button>
                <button id="btnEliminar'.$row['IdProveedor'].'" onclick="eliminarProveedor('.$row['IdProveedor'].')" type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span> Eliminar
                </button>
              </li>
            </ul>
          </div>
        </td>';

      echo '<td id="tdId'         .$row['IdProveedor'].'">'.$row['IdProveedor'] .'</td>';
      echo '<td id="tdNombre'     .$row['IdProveedor'].'">'.$row['Nombre']    .'</td>';
      echo '<td id="tdTelefono'    .$row['IdProveedor'].'">'.$row['Telefono']   .'</td>';
      echo '</tr>';
    }
    echo "</table>";
  }
  function formulario($titulo,$id,$nombre,$telefono,$btn,$funcion)
  {
    echo '
        <div class="modal fade" id="modalProveedor" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">PROVEEDOR</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <h3><samall>'.$titulo.'</samall></h3>
                <form>
                  <div class="form-group row"><br />
                    <div class="col-xs-6">
                      <input type="hidden" id="tfId" value="'.$id.'" />
                      <label>Nombre:</label>
                      <input id="tfNombre" class="form-control"    type="text" value="'.$nombre.'" placeholder="Nombre"/><br />
                    </div>
                    <div class="col-xs-6">
                    <label>Telefono:</label>
                    <input id="tfTelefono" class="form-control"   type="text" value="'.$telefono.'" placeholder="Telefono"/>
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
		$insertar="INSERT INTO PROVEEDORES
					VALUES (
            '',
						'".$_GET['Nombre']."',
						'".$_GET['Telefono']."')";
		mysqli_query($conexion,$insertar) or die(mysqli_error($conexion));
  }

  function editar()
  {
    $nombre='';
    $telefono='';

    include "../bd/conexion.php";
  	if (!$conexion)
  	{
  		dile('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM PROVEEDORES WHERE IdProveedor="'.$_GET['IdProveedor'].'"';
  	$result = mysqli_query($conexion,$sql);
  	while($row = mysqli_fetch_array($result))
    {
      $nombre=$row['Nombre'];
      $telefono=$row['Telefono'];
      $id=$row['IdProveedor'];
    }
    formulario("Editar proveedor",$id,$nombre,$telefono,"Guardar cambios","modificarProveedor()");

  }
  function modificar()
  {
    require_once("../bd/conexion.php");
		$modificar="UPDATE PROVEEDORES SET
						Nombre='".$_GET['Nombre']."',
						Telefono='".$_GET['Telefono']."'
						WHERE IdProveedor='".$_GET['Id']."'";
		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
  }
  function eliminar()
  {
    require_once("../bd/conexion.php");
		$eliminar="DELETE FROM PROVEEDORES WHERE IdProveedor='".$_GET['IdProveedor']."'";
		mysqli_query($conexion,$eliminar) or die(mysqli_error($conexion));
  }
?>
