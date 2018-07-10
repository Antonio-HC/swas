<?php
  switch ($_GET['opcion']) {
    case 'cargar':
      cargarVista();
      break;
  }
  function cargarVista()
  {
    include "../vistas/reportes.html";
  }
?>
