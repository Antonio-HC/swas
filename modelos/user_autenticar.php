<?php
  session_start();
  //$connect = mysqli_connect("localhost","root","","SWAS");
  include "../bd/conexion.php";

  if(isset($_POST["User"]) && isset($_POST["Pass"])){
    $User = mysqli_real_escape_string($conexion, $_POST["User"]);
    $Pass = mysqli_real_escape_string($conexion, $_POST["Pass"]);
    $sql = "SELECT Usuario FROM USUARIOS WHERE Usuario='$User' AND Password='$Pass'";
    $result = mysqli_query($conexion, $sql);
    $num_row = mysqli_num_rows($result);
    if ($num_row == "1") {
      $data = mysqli_fetch_array($result);
      $_SESSION["User"] = $data["Usuario"];
      echo "1";
    } else {
      echo "error";
    }
  } else {
    echo "error";
  }

?>
