<?php
session_start();
$_SESSION['date'] = date("Y/m/d");
if (!isset($_SESSION['id']) ){
    header("Location: index.php");
    die;
}
 require 'db/db.php';
if ( isset($_GET['m']) ){
    switch($_GET['m']) {
        case "DataGraficasPorYear":
        $paginaPHP = "php/DataGraficasPorYear.php";
        break;
        case "AgregarProyectos":
        $paginaPHP = "php/AgregarProyectos.php";
        break;
        case "clientes":
            $paginaPHP = "php/clientes.php";
        break;
        case "clientesAgregar":
            $paginaPHP = "php/clientesAgregar.php";
        break;
        case "clientesEditar":
            $paginaPHP = "php/clientesEditar.php";
        break;

        case "busquedaInv":
            $paginaPHP = "php/busqueda.php";
        break;
        case "clienteCitas":
            $paginaPHP = "php/clienteCitas.php";
        break;

        /* citas */
        case "CrucesAgregar":
            $paginaPHP = "php/Facturacion/CrucesAgregar.php";
        break;
        case "citasAgregar":
            $paginaPHP = "php/citasAgregar.php";
        break;
        case "citasEditar":
            $paginaPHP = "php/citasEditar.php";
        break;

        
        /* punto de venta */
        case "exportacion":
            $paginaPHP = "php/phillips.php";
        break;
        case "proyectos":
            $paginaPHP = "php/proyectos.php";
        break;
        case "pventaEditar":
            $paginaPHP = "php/pventaEditar.php";
        break;

        /* liquidar */
        case "graficas":
            $paginaPHP = "php/graficas.htm";
        break;

        /* categorias */
        case "categorias":
            $paginaPHP = "php/categorias.php";
        break;
        case "categoriasAgregar":
            $paginaPHP = "php/categoriasAgregar.php";
        break;
        case "trGastos":
            $paginaPHP = "php/trGastos.php";
        break;
        case "resumen":
            $paginaPHP = "php/resumen.php";
        break;

        case "modificar":
            $paginaPHP = "php/modificar.php";
        break;

       
        case "reportescats":
            $paginaPHP = "php/reportescat.php";
        break;
        //reporte Miriam
        case "reportes":
            $paginaPHP = "php/reportesPed.html";
        break;
        //reporte Salma
        case "reportePedCon":
            $paginaPHP = "php/reportePedCon.html";
        break;
        case "tickets":
            $paginaPHP = "php/tickets.php";
        break;
        case "ticketsAgregar":
            $paginaPHP = "php/ticketsAgregar.php";
        break;
        case "trInvoice":
            $paginaPHP= "php/trInvoice.php";
        break;
        case "trbusqueda":
            $paginaPHP= "php/trbusqueda.php";
        break;
        case "trmodificar":
            $paginaPHP= "php/trmodificar.php";
        break;
        /* usuarios */
        case "usuarios":
            $paginaPHP = "php/usuarios.php";
        break;
        case "usuariosAgregar":
            $paginaPHP = "php/usuariosAgregar.php";
        break;
        case "usuariosEditar":
            $paginaPHP = "php/usuariosEditar.php";
        break;

        /* Bitacora */
        case "bitacora":
            $paginaPHP = "php/bitacora.php";
        break;
    }
} else {
        $paginaPHP = "php/null.php";
}

$errorMsg = "";

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>TCI | Sistema </title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
      <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery-2.1.1.js"%3E%3C/script%3E'))</script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>        
    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <!-- Peity -->
    <script src="js/demo/peity-demo.js"></script> 
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="Lib/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="Lib/css/dx.light.css" /> 
    <script src="Lib/js/dx.all.js"></script>
    <script src="Lib/js/jszip.min.js"></script>
    <script src="js/data.js"></script>
    <link rel="stylesheet" type ="text/css" href ="style.css" />
    <!-- Globalize scripts -->
    <script type="text/javascript" src="Lib/js/cldr.js"></script>
    <script type="text/javascript" src="Lib/js/cldr/event.js"></script>
    <script type="text/javascript" src="Lib/js/cldr/supplemental.js"></script>
    <script type="text/javascript" src="Lib/js/globalize.js"></script>
    <script type="text/javascript" src="Lib/js/globalize/message.js"></script>
    <script type="text/javascript" src="Lib/js/globalize/number.js"></script>
    <script type="text/javascript" src="Lib/js/globalize/currency.js"></script>
    <script type="text/javascript" src="Lib/js/globalize/date.js"></script>
   
  

  
</head>

<body >

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li >
                    <div class="dropdown profile-element"> <span>
                            <img alt="TCI" class="" src="img/tci/L2.png" style="width:100%" />

                            <span class="clear"> <span class="block m-t-xs"><center><strong class="font-bold" class="col-lg-6"><?php echo "Bienvenido ".$_SESSION["nombre"]; ?></strong></center> 
<!-- Agregar condicion en base a privilegios -->
                    </div>
                    <div class="logo-element">
                        <!-- agregar solo la t del logo en ves d elo de abajo -->
                        TCI
                    </div>
                </li>
                <li>
                    <a href="admin.php?m=null"><i class="fa fa-home"></i><span class="nav-label">Inicio</span></a>
                </li>
<!--                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Archivo Digital</span></a>
                </li>-->
                <li>
                    <a href="#"><i  class="fa fa-th-large"></i><span class="nav-label">Cruces y Cajas</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="admin.php?m=CrucesAgregar"><i class=""></i> <span class="nav-label">Agregar Cruces</span></a>
                        </li>
                        <li>
                            <a href="admin.php?m=busquedaInv"><i class=""></i> <span class="nav-label">Busqueda Cruces</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="admin.php?m=tickets"><i  class="fa fa-th-large"></i><span class="nav-label">Tickets</span><span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href=""><i  class="fa fa-star"></i><span class="nav-label">Catalogos</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#"><i class=""></i> <span class="nav-label">Clientes</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-files-o"></i> <span class="nav-label">Reportes</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                         <li>
                            <a href="admin.php?m=reportePedCon"><i class=""></i><span class="nav-label">Consolidados</span> </a>
                        </li>
                        <li>
                            <a href="admin.php?m=reportes"><i class=""></i><span class="nav-label">Pedimentos</span> </a>
                        </li>
                        
                        <!--<li>
                            <a href="admin.php?m=proyectos"><i class=""></i><span class="nav-label">Proyectos</span> </a>
                        </li>-->
                        <li>
                            <a href="admin.php?m=graficas"><i class=""></i><span class="nav-label">Grafica</span> </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href=""><i class="fa fa-laptop"></i><span class="nav-label">Transportaciones</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">  
                        <li><a href="admin.php?m=trbusqueda"><i class=""></i><span class="nav-label">Busqueda</span></a></li>
                        <li><a href="admin.php?m=trInvoice"><i class=""></i><span class="nav-label">Invoice</span></a></li>
                        <li><a href="admin.php?m=trGastos"><i class=""></i><span class="nav-label">Gastos</span></a></li>
                    </ul>
                </li>
                <!--<li>
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orden de Compra</span></a>
                </li>-->
                <li>
                    <a href=""><i class="fa fa-laptop"></i><span class="nav-label">Configuraciones</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <!--<li><a href=""><i class=""></i><span class="nav-label">Bitacora</span></a></li>-->
                        <li><a href="admin.php?m=usuarios"><i class=""></i><span class="nav-label">Usuarios</span></a></li>
                        <!--<li><a href=""><i class=""></i><span class="nav-label">Paginas</span></a></li>-->
                    </ul>
                </li>
                <!--<li>
                    <a href=""><i class="fa fa-laptop"></i><span class="nav-label">Soporte</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="admin.php?m=tickets"><i class=""></i><span class="nav-label">Tickets</span></a></li>
                    </ul>
                </li>-->
                <li class="landing_link">
                    <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Paginas Web</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="www.tramitaciones.com">tramitaciones.com <span class="fa arrow"></span></a>
                        </li>
                        <li><a href="#">transportaciones.com</a></li>
                        <li>
                            <a href="#">tcilogistics.com</a></li>
                        <li>
                    </ul>
                </li>
              
            </ul>
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="">
                        <i class="fa fa-user-o  "></i> <?php echo $_SESSION['nombre']; ?>
                    </a>
                </li>
            </ul>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="cerrar.php">
                        <i class="fa fa-sign-out"></i> Cerrar Ses&iacute;on
                    </a>
                </li>
            </ul>
        </nav>
        </div>
            <?php include $paginaPHP; ?>
        </div>
        </div>
</body>
 
</html>
