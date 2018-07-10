<?php
  session_start();
  $login='';
  if (isset($_SESSION["User"]))
  {
    //header("location:index2.php");
    $login = '
      <li><a href="vistas/">CONECTADO</a></li>
      <li><a href="modelos/user_logout.php">CERRAR SESIÓN</a></li>
      ';
  }
  else {
    $login = '<li><button type="button" data-toggle="modal" data-target="#myModal">ACCEDER</button></li>';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  -->
  <style>
  body {
      font: 400 15px/1.8 Lato, sans-serif;
      color: #777;
  }
  h3, h4 {
      margin: 10px 0 30px 0;
      letter-spacing: 1px;
      font-size: 20px;
      color: #111;
  }
  .container {
      padding: 80px 120px;
  }
  .person {
      border: 10px solid transparent;
      margin-bottom: 25px;
      width: 80%;
      height: 80%;
      opacity: 0.7;
  }
  .person:hover {
      border-color: #f1f1f1;
  }
  .carousel-inner img {
      /*-webkit-filter: grayscale(90%);
      /*filter: grayscale(90%); /* make all photos black and white */
      width: 100%; /* Set width to 100% */
      margin: auto;
  }
  .carousel-caption h3 {
      color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
    }
    .container {
        padding: 50px 50px;
    }
    body {
        font: 400 12px/1.8 Lato, sans-serif;
    }
  }
  .bg-1 {
      background: #2d2d30;
      color: #bdbdbd;
  }
  .bg-1 h3 {color: #fff;}
  .bg-1 p {font-style: italic;}
  .list-group-item:first-child {
      border-top-right-radius: 0;
      border-top-left-radius: 0;
  }
  .list-group-item:last-child {
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail p {
      margin-top: 15px;
      color: #555;
  }
  .btn {
      padding: 10px 20px;
      background-color: #055D8A;
      color: #f1f1f1;
      border-radius: 10;
      transition: .2s;
  }
  .btn:hover, .btn:focus {
      border: 1px solid #333;
      background-color: #fff;
      color: #000;
  }
  .modal-header, h4, .close {
      background-color: #FC6B1B;
      color: #fff !important;
      text-align: center;
      font-size: 20px;
  }
  .modal-header, .modal-body {
      padding: 5px 6px;
  }
  .nav-tabs li a {
      color: #777;
  }
  .navbar {
      /*font-family: Montserrat, sans-serif;*/
      margin-bottom: 0;
      background-color: #2d2d30;
      border: 0;
      font-size: 11px !important;
      letter-spacing: 2px;
      opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
      color: #fff !important;
  }
  .navbar-nav li.active a {
      color: #fff !important;
      background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
  }
  .open .dropdown-toggle {
      color: #fff;
      background-color: #555 !important;
  }
  .dropdown-menu li a {
      color: #000 !important;
  }
  .dropdown-menu li a:hover {
      background-color: red !important;
  }
  footer {
      background-color: #2d2d30;
      color: #f5f5f5;
      padding: 32px;
  }
  footer a {
      color: #f5f5f5;
  }
  footer a:hover {
      color: #777;
      text-decoration: none;
  }
  .form-control {
      border-radius: 0;
  }
  textarea {
      resize: none;
  }
  </style>
</head>
<body id="inicio" data-spy="scroll" data-target=".navbar" data-offset="50" onload="verificarBD()">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="#inicio">ADMIN | STORE</a>-->
      <a href="#inicio"><img src="imagenes/logotipo1.png" width="93" height="70"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#inicio">INICIO</a></li>
        <li><a href="#quienes-somos">QUIÉNES SOMOS</a></li>
        <li><a href="#proveedor">PROVEEDORES</a></li>
        <li><a href="#contact">MARCAS</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">MÁS
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php echo $login; ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--Slider-->

<div id="myCarousel" class="carousel slide" data-ride="carousel">

  <div id="contenido-carousel">Ejemplo</div><!--Contenido del carousel, indicadores y imagenes-->

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!--Slider-->

<!-- Container (The Band Section) -->
<div id="quienes-somos" class="container text-center">
  <h3>QUIÉNES SOMOS</h3>
  <p>
    Nuestro local, amplio y ameno, se destaca por su capacidad para exhibir la gran cantidad de artículos puestos a disposición y por brindar un espacio agradable para quienes nos visitan. Nuestra meta es continuar el camino de excelencia heredado, adaptándonos a los tiempos que corren, modernizándonos y actualizándonos pero sin perder nuestra esencia, esforzándonos por brindarles el mejor servicio a todos nuestros clientes.
  </p>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <p class="text-center"><strong>FERRETERÍA</strong></p><br>
      <a href="#demo" data-toggle="collapse">
        <img src="imagenes/ferreteria.png" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo" class="collapse">
        <p>Tenemos todo lo que estás buscando en las áreas de la construcción, decoración y mantenimiento del hogar, el comercio o la industría.</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>PLOMERÍA</strong></p><br>
      <a href="#demo2" data-toggle="collapse">
        <img src="imagenes/plomeria.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo2" class="collapse">
        <p>Los productos de plomería general, son productos profesionales para la instalación y el mantenimiento de artefactos de cocina y baño.</p>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>ELÉCTRICIDAD</strong></p><br>
      <a href="#demo3" data-toggle="collapse">
        <img src="imagenes/electricidad.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
      </a>
      <div id="demo3" class="collapse">
        <p>Con nosotros encontrarás las mejores ofertas en los productos que necesitas.
        Contamos con un personal capacitado para facilitar la busqueda de aquello que necesitas, ofreciendo la asesoría especializada.</p>
      </div>
    </div>
  </div>
</div>

<!-- Container (TOUR Section) -->
<div id="proveedor" class="bg-1">
  <div class="container">
    <h3 class="text-center">PROVEEDORES</h3>
    <p class="text-center">Proveedores, distribuidores y fabricantes de Ferretería</p>
    <div class="row text-center">
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="imagenes/truper.jpg" alt="Paris" width="400" height="300">
          <p><strong>Somos el mayor fabricante del mundo de marros, zapapicos, hachas, carretillas, palas y herramientas de mango largo. Nuestras exportaciones representan el 90% de las exportaciones totales de herramientas de México y nuestros productos se venden en más de 60 países,con una participación destacada en E.U.A.</strong></p>
          <p></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="imagenes/emco.jpg" alt="New York" width="400" height="300">
          <p><strong>En Grupo Ferretero EMCO estamos conscientes que nuestros clientes y consumidores son simplemente lo primero. Estamos especializados en la venta de artículos ferreteros, herramientas, material para construcción, material eléctrico, pisos, azulejos, muebles de baño, tubería y conexiones de cobre, pvc y galvanizado.</strong></p>
          <p></p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="thumbnail">
          <img src="imagenes/grupo.png" alt="San Francisco" width="400" height="300">
          <p><strong>Nuestra empresa: Habiendo iniciado operaciones a principios del año 2000, nos hemos ido consolidando a través del tiempo como una de las mejores empresas de mantenimiento industrial, comercial y doméstico en el centro del país, y buscando crecer más.</strong></p>
          <p></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Login -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4><span class="glyphicon glyphicon-lock"></span>Acceder</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="post">
            <div class="form-group">
              <label for="usuario"><span class="glyphicon glyphicon-user"></span>Usuario</label>
              <input autofocus type="text" class="form-control" id="user" name="user" placeholder="Ingrese su usuario" required>
            </div>
            <div class="form-group">
              <label for="pass"><span class="glyphicon glyphicon-lock"></span>Contraseña</label>
              <input type="password" class="form-control" name="pass" id="pass" placeholder="Ingrese su contraseña" required>
            </div>
            <center>
              <input type="button" name="login" id="login" value="Acceder" class="btn btn-success">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                <span class="glyphicon glyphicon-remove"></span> Cancelar
              </button>
            </center>
              <br>
              <span id="result"></span>
          </form>
        </div>
        <div class="modal-footer">
          <p><a href="#">¿Olvidé mi contraseña?</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container">
  <h3 class="text-center">Marcas</h3>
  <!--<hr class="fancy-line"> -->
  <table>
      <tr>
        <th><a href="http://www.deacero.com/en/" data-toggle="tooltip" title=""><img src="imagenes/deacero.png" alt="De Acero" width="150" height="150"/></a></th>
        <th><a href="http://ws.iusa.com.mx/" data-toggle="tooltip" title=""><img src="imagenes/iusa.png" alt="IUSA" width="150" height="90"/></a></th>
        <th><a href="http://www.austromex.com.mx/" data-toggle="tooltip" title=""><img src="imagenes/austromex.png" alt="AUSTROMEX" width="150" height="90"/></a></th>
        <th><a href="http://www.bellota.com/MX/es/" data-toggle="tooltip" title=""><img src="imagenes/bellota.png" alt="BELLOTA" width="150" height="90"/></a></th>
        <th><a href="http://www.resistol.com.mx/es.html" data-toggle="tooltip" title=""><img src="imagenes/resistol.png" alt="AUSTROMEX" width="150" height="90"/></a></th>
        <th><a href="https://www.urrea.com/" data-toggle="tooltip" title=""><img src="imagenes/urrea.png" alt="URRE" width="150" height="80"/></a></th>
      </tr>
  </table>
  <table>
    <tr>
      <th><a href="http://www.alcione.mx/" data-toggle="tooltip" title=""><img src="imagenes/square.png" alt="SQUARE" width="150" height="90"/></a></th>
      <th><a href="https://www.voltech.com.mx/" data-toggle="tooltip" title=""><img src="imagenes/volt.jpg" alt="VOLT" width="150" height="90"/></a></th>
      <th><a href="http://www.dewalt.com.mx/productos/Prodinic.asp" data-toggle="tooltip" title=""><img src="imagenes/dewalt.png" alt="SQUARE" width="150" height="90"/></a></th>
      <th><a href="https://rotoplas.com.mx/" data-toggle="tooltip" title=""><img src="imagenes/rotoplas.png" alt="VOLT" width="150" height="90"/></a></th>
      <th><a href="https://www.linio.com.mx/b/pretul" data-toggle="tooltip" title=""><img src="imagenes/pretul.png" alt="SQUARE" width="150" height="90"/></a></th>
      <th><a href="https://www.truper.com.mx/" data-toggle="tooltip" title=""><img src="imagenes/truper.jpg" alt="SQUARE" width="150" height="90"/></a></th>
  </table>
</div>
<!-- Footer -->
<footer class="text-center">
  <div id="jm-footer-left" class="clearfix">
    <div id="jm-copyrights">
      <div class="custom">
        <p>
          Ferretería "El Cura" Copyright © 2017.
          <br>
          Celular 75611111111
          <br>
          Calle 7 Oriente, Barrio de San Juan
          <br>
          Todas las otras marcas registradas que aparecen en la página son propiedad de sus respectivos propietarios.
        <p>
      </div>
    </div>
  </div>
  <a class="up-arrow" href="#inicio" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Realizado por <a href="http://www.utchilapagrouarm.com.mx/" data-toggle="tooltip" title="">UT Chilapa</a></p>
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#inicio']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });


////////////////////////////////////////////////////////////////////////////////
  //mostrar login despues de cerrar sesion
  <?php $estado=$_GET['log']; ?>
  if (<?php echo $estado; ?> == 1) {
    $("#myModal").modal();
  }

})
</script>

</body>
  <script src="controles/principal.js"></script>
  <script src="controles/user_login.js"></script>
  <script src="controles/config_slider.js"></script>
</html>
