<?php
  session_start();
  session_destroy();
  $estado='1';
  header("location:../index.php?log=$estado");
?>
