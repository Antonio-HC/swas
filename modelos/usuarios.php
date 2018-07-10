<?php
  switch ($_GET['opcion']) {
    case 'cargar':
      cargar();
      break;
    case 'mostrar':
  		mostrar();
  		break;
    case 'nuevo':
      formulario("Crear nuevo","","","","","","","","Agregar usuario","agregarUsuario()");
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
    case 'usuario':
      buscarUsuario($_GET['consulta']);
      break;
  }

  function cargar()
  {
    include "../vistas/usuarios.html";
  }
  function mostrar()
  {
  	include "../bd/conexion.php";

  	if (!$conexion)
  	{
  		die('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM USUARIOS';
  	$result = mysqli_query($conexion,$sql);
    echo '<br />
    <table id="tblUsuarios" class="table">
      <thead>
        <tr>
          <th width="50"></th>
          <th>Id</th>
          <th>Nombre</th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Usuario</th>

          <th>TipoUsuario</th>
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
                <button id="btnEditar'.$row['IdUsuario'].'" onclick="editarUsuario('.$row['IdUsuario'].')" type="button" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-pencil"></span> Editar
                </button>
                <button id="btnEliminar'.$row['IdUsuario'].'" onclick="eliminarUsuario('.$row['IdUsuario'].')" type="button" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash"></span> Eliminar
                </button>
              </li>
            </ul>
          </div>
        </td>';

      echo '<td id="tdId'         .$row['IdUsuario'].'">'.$row['IdUsuario'] .'</td>';
      echo '<td id="tdNombre'     .$row['IdUsuario'].'">'.$row['Nombre']    .'</td>';
      echo '<td id="tdPaterno'    .$row['IdUsuario'].'">'.$row['APaterno']   .'</td>';
      echo '<td id="tdMaterno'    .$row['IdUsuario'].'">'.$row['AMaterno']   .'</td>';
      echo '<td id="tdUsuario'    .$row['IdUsuario'].'">'.$row['Usuario']   .'</td>';
      //echo '<td id="tdPassword'   .$row['IdUsuario'].'"><input type="password" value="'.$row['Password'].'" /></td>';
      echo '<td id="tdTipoUsuario'.$row['IdUsuario'].'">'.$row['Tipo'].'</td>';
      echo '</tr>';
    }
    echo "</table>";
  }
  function formulario($titulo,$id,$nombre,$paterno,$materno,$usuario,$password,$tipo,$btn,$funcion)
  {
    echo '
        <div class="modal fade" id="modalUsuario" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title">USUARIOS</h4>
              </div>
              <div class="modal-body" style="padding:0px 20px;">
                <h3><samall>'.$titulo.'</samall></h3>
                <form>
                  <div class="form-group row"><br />
                    <div class="col-xs-6">
                      <input id="tfId" type="hidden" value="'.$id.'"/>
                      <label>Nombre:</label>          <input id="tfNombre" class="form-control"    type="text" value="'.$nombre.'" placeholder="Nombre"/><br />
                      <label>Apellido paterno:</label><input id="tfPaterno" class="form-control"   type="text" value="'.$paterno.'" placeholder="Apellido paterno"/><br />
                      <label>Apellido materno:</label><input id="tfMaterno" class="form-control"   type="text" value="'.$materno.'" placeholder="Apellido materno"/>
                    </div>
                    <div class="col-xs-6">
                      <div class="row">
                        <div class="col-xs-4">
                          <label>Usuario: </label>
                        </div>
                        <div class="col-xs-8 text-right" style="font-size: 10px;">
                          <label id="alert-usuario"></label>
                        </div>
                      </div>
                      <input onkeyup="verificarUsuario()" id="tfUsuario" class="form-control"   type="text" value="'.$usuario.'" placeholder="Nombre de usuario"/><br />
                      <label>Contraseña:</label>
                      <input id="pfPassword" class="form-control"  type="password" value="'.$password.'" placeholder="Contraseña"/><br />
                      <label>Tipo Usuario:</label><br />
                      <select id="cbTipo" class="input-sm" value="'.$tipo.'">
                        <option>Empleado</option>
                        <option>Administrador</option>
                      </select>
                    </div>
                  </div>
                  <spam id="mensaje"></spam>
                  <div class="modal-footer">
                    <input type="button" class="btn btn-success" value="'.$btn.'" onclick="'.$funcion.'" />
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
    ';
  }

  function buscarUsuario($consulta)
  {
    $codigo='';
    include "../bd/conexion.php";
    $result = mysqli_query($conexion,$consulta);
    $num_row = mysqli_num_rows($result);
    if ($num_row == "1") {
      echo '
      <p style="color:Tomato;"><spam class="glyphicon glyphicon-remove"></spam> El nombre de usuario ya existe</p>
      ';
    } else {
      echo '
      <p style="color:MediumSeaGreen;"><spam class="glyphicon glyphicon-ok"></spam></p>

      ';
    }
  }

  function agregar()
  {
    require_once("../bd/conexion.php");
		$insertar="INSERT INTO USUARIOS
					VALUES ('',
						'".$_GET['Nombre']."',
						'".$_GET['Paterno']."',
						'".$_GET['Materno']."',
						'".$_GET['Usuario']."',
						'".$_GET['Password']."',
						'".$_GET['TipoUsuario']."')";
		mysqli_query($conexion,$insertar) or die(mysqli_error($conexion));
  }

  function editar()
  {
    $nombre='';
    $paterno='';
    $materno='';
    $usuario='';
    $password='';
    $tipo='';
    $id='';
    include "../bd/conexion.php";
  	if (!$conexion)
  	{
  		die('Conexión fallida a la bd: ' . mysql_error($conexion));
  	}

  	$sql='SELECT * FROM USUARIOS WHERE IdUsuario="'.$_GET['IdUsuario'].'"';
  	$result = mysqli_query($conexion,$sql);
  	while($row = mysqli_fetch_array($result))
    {
      $nombre=$row['Nombre'];
      $paterno=$row['APaterno'];
      $materno=$row['AMaterno'];
      $usuario=$row['Usuario'];
      $password=$row['Password'];
      $tipo=$row['Tipo'];
      $id=$row['IdUsuario'];
    }
    formulario("Editar usuario",$id,$nombre,$paterno,$materno,$usuario,$password,$tipo,"Guardar cambios","modificarUsuario()");

  }
  function modificar()
  {
    require_once("../bd/conexion.php");
		$modificar="UPDATE USUARIOS SET
						Nombre='".$_GET['Nombre']."',
						APaterno='".$_GET['Paterno']."',
						AMaterno='".$_GET['Materno']."',
						Usuario='".$_GET['Usuario']."',
						Password='".$_GET['Password']."',
						Tipo='".$_GET['TipoUsuario']."'
						WHERE IdUsuario='".$_GET['Id']."'";
		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
  }
  function eliminar()
  {
    require_once("../bd/conexion.php");
		$eliminar="DELETE FROM USUARIOS WHERE IdUsuario='".$_GET['IdUsuario']."'";
		mysqli_query($conexion,$eliminar) or die(mysqli_error($conexion));
  }
?>
