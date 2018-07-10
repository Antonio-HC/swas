<?php

  session_start();
  if(!isset($_SESSION["User"]))
  {
    header("location:../");
  }
  else {
    $menu= '
      <li><a href="../">INICIO</a></li>
      <li><a href="../modelos/user_logout.php">CERRAR SESIÓN</a></li>
    ';
  }

?>
