<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Seguros Venezuela | Panel </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="css/pe-icon-7-stroke.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- libreria filter-->
    <link rel="stylesheet" href="plugins/TableFilter-master/dist/tablefilter/style/tablefilter.css">
    <!-- TIMER -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
      <!-- ESTILO APLICACION -->
     <link rel="stylesheet" href="css/sistemalaravel.css">
      <!-- SELECT 2 -->
      <link rel="stylesheet" href="plugins/select2/select2.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ asset('/') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>OLOA</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"> <img src="imagenes/logo_sv1.jpg" alt="" width="60"> <b>e n e z u e l a</b> </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <i class="fa fa-cogs" aria-hidden="true"></i><span class="hidden-xs">{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                      <img src="imagenes/avatar.jpg"  alt="User Image"  style="width:50px;height:50px;">
                    <p>
                     {{ Auth::user()->name }}
                      <small>Miembro desde {{Auth::user()->created_at->format('d-m-Y')}}</small>
                      <br>
                      <small><b>Roll:</b> {{Auth::user()->tipo}}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->f
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      {{ link_to('cerrar-panel','Salir',['class'=>'btn btn-default btn-flat']) }}
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>


      </header>
      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="imagenes/avatar.jpg"  alt="User Image"  style="width:50px;height:50px;">
            </div>
            <div class="pull-left info">
              <p>Usuario: {{Auth::user()->name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!--  <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form> -->
            <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            @include('menu')
          </ul>

        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="min-height:2000px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>

            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <section>
          <div id="capa_modal" class="div_modal" ></div>
          <div id="capa_para_edicion" class="div_contenido" style="display: none;" >
          <div  id="contenido_capa_edicion" ></div>
        </section>

        <!-- contenido capas modales -->



<section class="col-lg-12">
@if(Session::has('message-danger'))
    <div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>Lo sentimos!</strong> {{ Session::get('message-danger') }}
</div>
  @endif

  @if(Session::has('message-success'))
    <div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>En hora buena!</strong> {{ Session::get('message-success') }}
</div>
  @endif
 </section>

        <!-- contenido principal -->
        <section class="content"  id="contenido_principal" style="display: none">
        </section>

      <!-- cargador empresa -->
        <div style="display: none;" id="cargador_empresa" align="center">
            <br>
         <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

         <img src="imagenes/cargando.gif" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando tarea solicitada ...</label>

          <br>
         <hr style="color:#003" width="50%">
         <br>
       </div>





      </div><!-- /.content-wrapper -->




    </div><!-- ./wrapper -->


    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <script>  $("#content-wrapper").css("min-height","2000px"); </script>

    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/TableFilter-master/dist/tablefilter/tablefilter.js"></script>
    <!-- TIMER -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- NOTIFICACIONES -->
    <script src="js/push.min.js"></script>
    <!-- INPUT-MASK -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <!-- SELECT 2 -->
    <script src="plugins/select2/select2.js"></script>

 <!-- javascript del sistema laravel -->
   <script src="js/sistemalaravel.js"></script>
    <!-- cheeditor -->
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
  </body>
</html>
