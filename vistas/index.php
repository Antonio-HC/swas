<?php
  include "../modelos/user_session.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Store | Ferretería El Cura</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <!--DataTables-->
    <link rel="stylesheet" href="../bootstrap/datatables/dataTables.bootstrap.css">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .modal-header, h4, .close {
        background-color: #45BF55;
        color: #fff !important;
        text-align: center;
        font-size: 18px;
    }
    .modal-header, .modal-body {
        padding: 5px 6px;
    }
    /*Scroll table*/
    .table-fixed thead, .table-fixed tbody { display: block; }
    .table-fixed tbody {
        height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    </style>

</head>

<body onload="usuario()">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">AdminSTORE</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Productos por Agotar <span class="label label-warning" id="notificacion-por-Agotar">0</span></a>
                        </li>
                        <li>
                            <a href="#">Productos Agotados <span class="label label-danger" id="notificacion-agotado">0</span></a>
                        </li>
                        <li class="divider"></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><span id="user_name"></span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a onclick="modal()" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li>
                            <a onclick="editarNombreUsuario()"><i class="fa fa-fw fa-gear"></i> Usuario</a>
                        </li>
                        <li>
                            <a onclick="editarPassword()"><i class="fa fa-fw fa-key"></i> Contraseña</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a onclick="logout()"><i class="fa fa-fw fa-power-off"></i> Cerrar sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div id="main-menu"> </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <!--Contenido-->
                        <div id="main-content">

                        </div>
                        <div id="modal-configurar-usuario"></div>
                        <!-- Modal -->


                        <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content" id="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="modal-title">Datos de usuario</h4>
                              </div>
                              <div class="modal-body" id="modal-body">

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--Modal-->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bootstrap/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../bootstrap/datatables/jquery.dataTables.js"></script>
	  <script type="text/javascript" src="../bootstrap/datatables/dataTables.bootstrap.js"></script>
    <!--  -->
    <script src="../controles/principal.js"></script>
    <script src="../controles/usuarios.js"></script>
    <script src="../controles/productos.js"></script>
    <script src="../controles/proveedores.js"></script>
    <script src="../controles/categorias.js"></script>
    <script src="../controles/inicio.js"></script>
    <script src="../controles/ventas.js"></script>
    <script src="../controles/reportes.js"></script>
    <script src="../controles/pedidos.js"></script>
    <script src="../controles/config_slider.js"></script>

</body>
</html>
