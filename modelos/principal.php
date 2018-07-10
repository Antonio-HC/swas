<?php
  # Este archivo contiene las funciones de la ventana principal
  session_start();

  switch ($_GET['opcion'])
  {
    case 'usuario':
      usuario();
      break;
    case 'menu':
      mostrarMenu();
      break;
    case 'escritorio':
      tipoUsuarioEscritorio();
      break;
    case 'modal':
      datosUsuario();
      break;
    case 'editarUsuario':
      editarUsuario();
      break;
    case 'editarPassword':
      editarPassword();
      break;
    case 'password':
      password();
      break;
    case 'user':
      user();
      break;
    case 'modificarPassword':
      modificarPassword();
      break;
    case 'modificarUsuario':
      modificarUsuario();
      break;
    case 'verificar':
      verificarBD();
      break;
  }

  function usuario()
  {
    include "../bd/conexion.php";
    if (!$conexion)
    {
      die('Conexión fallida, a la BD: '. mysqli_error($conexion));
    }

    $sql="SELECT * FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($result))
    {
      echo " ".$row['Nombre'];
    }
  }

  function mostrarMenu()
  {
    $usuario = '';

    include "../bd/conexion.php";
    $sql = "SELECT Tipo FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($result))
    {
      $usuario = $row['Tipo'];
    }
    #Direccionar a las vistas por tipo de usuario
    switch ($usuario) {
      case 'Administrador':
        menuAdmin();
        break;

      case 'Empleado':
        menuUsuario();
        break;
    }
  }

  function menuAdmin()
  {
    echo '
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a onclick="cargarEscritorio()"><i class="fa fa-fw fa-dashboard"></i> Escritorio</a>
            </li>
            <li>
                <a onclick="cargarVentas()"><i class="fa fa-fw fa-bar-chart-o"></i> Ventas</a>
            </li>
            <li>
                <a onclick="cargarProductos()"><i class="fa fa-fw fa-table"></i> Productos</a>
            </li>
            <li>
                <a onclick="cargarProveedores()"><i class="fa fa-fw fa-users"></i> Proveedores</a>
            </li>
            <li>
                <a onclick="cargarCategorias()"><i class="fa fa-fw fa-list"></i> Categorias</a>
            </li>
            <!--
            <li>
                <a onclick="cargarPedidos()"><i class="fa fa-fw fa-edit"></i> Pedidos</a>
            </li>
            <li>
                <a onclick="cargarReportes()"><i class="fa fa-fw fa-file"></i> Reportes</a>
            </li>
            -->
            <li>
                <a onclick="cargarUsuarios()"><i class="fa fa-fw fa-desktop"></i> Usuarios</a>
            </li>

            <li>
                <a href="#" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-wrench"></i> Configuración <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a onclick="cargarConfigSlider()"><i class="fa fa-fw fa-sliders"></i> Sliders</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    ';
  }

  function menuUsuario()
  {
    echo '
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a onclick="puntoDeVenta()"><i class="fa fa-fw fa-bar-chart-o"></i> Ventas</a>
            </li>
        </ul>
    </div>
    ';
  }
  function datosUsuario()
  {

    include "../bd/conexion.php";
    if (!$conexion)
    {
      die('Conexión fallida, a la BD: '. mysqli_error($conexion));
    }

    $sql="SELECT * FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($result))
    {
      echo '
          <div class="row">
            <div class="col-lg-3">
              <img src="../imagenes/logotipo1.png" width="100%" height="100%" />
            </div>
            <div class="col-lg-9">
              <p>Nombre: '.$row['Nombre'].' '.$row['APaterno'].' '.$row['AMaterno'].'</p>
              <p>Privilegios: '.$row['Tipo'].'</p>
            </div>
          </div>
      ';
    }
  }
  function editarUsuario()
  {
    echo '
    <div class="modal fade" id="modalCambiarUsuario" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content" id="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="modal-title">Cambiar usuario</h4>
          </div>
          <div class="modal-body" id="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
                <form>
                <div id="input-old">
                  <label>Usuario actual:</label>
                  <input type="text" id="tfUsuarioOld" placeholder="Usuario actual" class="form-control" />
                </div>
                <div class="row">
                  <div class="col-xs-4">
                    <label>Nuevo: </label>
                  </div>
                  <div class="col-xs-8 text-right" style="font-size: 10px;">
                    <label id="alert-usuario"></label>
                  </div>
                </div>
                <input type="text" id="tfUsuario" onkeyup="verificarUsuario()" placeholder="Nuevo" class="form-control" />
                <div id="input-password">
                  <label>Ingrese su contraseña:</label>
                  <input type="password" id="tfUsuarioPassword" placeholder="Contraseña" class="form-control" />
                </div>
              </div>
            </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="cambiarUser()" >Aceptar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    ';
  }
  function editarPassword()
  {
    echo '
    <div class="modal fade" id="modalCambiarPassword" role="dialog">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content" id="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="modal-title">Cambiar contraseña</h4>
          </div>
          <div class="modal-body" id="modal-body">
            <div class="form-group row">
              <form>
              <div class="col-sm-12">
                <div id="input-old">
                  <label>Contraseña actual:</label>
                  <input id="tfPasswordOld" type="password" placeholder="Contraseña" class="form-control" />
                </div>
                <label>Nueva contraseña:</label>
                <input id="tfPasswordNueva" type="password" placeholder="Nueva" class="form-control" />
                <div id="input-confirmar">
                  <label>Confirmar nueva contraseña:</label>
                  <input id="tfPasswordConfirmar" type="password" placeholder="Confirmar" class="form-control" />
                </div>
              </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="cambiarPassword()" >Aceptar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    ';
  }

  function crearModal()//Plantilla
  {
    echo '

        <div class="row">
          <h2>datos de usuario</h2>
        </div>

    ';
  }

  function verificarBD()
  {
    include "../bd/conexion.php";
    if ($conexion) {
      echo "ok";
    }
  }
  function password()
  {
    include "../bd/conexion.php";
    $sql="SELECT Password FROM USUARIOS WHERE Usuario='".$_SESSION['User']."'";
    $result=mysqli_query($conexion,$sql);
    while ($row=mysqli_fetch_array($result)) {
      echo $row['Password'];
    }
  }
  function user()
  {
    echo $_SESSION['User'];
  }
  function modificarPassword()
  {
    require_once("../bd/conexion.php");
		$modificar="UPDATE USUARIOS SET
						Password='".$_GET['password']."'
						WHERE Usuario='".$_SESSION['User']."'";
		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
    echo "Realizado";
  }
  function modificarUsuario()
  {
    require_once("../bd/conexion.php");
		$modificar="UPDATE USUARIOS SET
						Usuario='".$_GET['usuario']."'
						WHERE Usuario='".$_SESSION['User']."'";
		mysqli_query($conexion,$modificar) or die(mysqli_error($conexion));
    echo "Realizado";
  }
  function tipoUsuarioEscritorio()
  {
    include "../bd/conexion.php";
    $sql = "SELECT Tipo FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($result))
    {
      echo $row['Tipo'];
    }
  }
?>
