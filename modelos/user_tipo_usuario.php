<?php
  session_start();
  if(!isset($_SESSION["User"]))
  {
    header("location:../");
  }
  else{
    tipoUsuario();
  }

  #Identificar tipo de usuario
  function tipoUsuario()
  {
    $usuario = '';

    include "../bd/conexion.php";
    $sql = "SELECT TipoUsuario FROM USUARIOS WHERE Usuario='".$_SESSION["User"]."'";
    $result = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($result))
    {
      $usuario = $row['TipoUsuario'];
    }
    #Direccionar a las vistas por tipo de usuario
    switch ($usuario) {
      case 'Administrador':
        header("location:../vistas/");
        break;

      case 'Empleado':
        header("location:../vistas/");
        break;
    }
  }
?>
