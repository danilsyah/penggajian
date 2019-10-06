<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href=" {{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
        <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href=" {{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('clockpicker/dist/bootstrap-clockpicker.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/" class="navbar-brand"><i class="fa fa-google-wallet" aria-hidden="true"></i> {{config('app.name')}}</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="/"><i class="fa fa-tachometer"></i> Dashboard<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-slideshare" aria-hidden="true"></i> Modul Karyawan <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/karyawan">Daftar Karyawan</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/departemen">Departemen</a></li>
                                    <li><a href="/jabatan">Jabatan</a></li>
                                    <li><a href="/statuskawin">Status Kawin</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Modul Absensi <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/kehadiran">Riwayat Kehadiran</a></li>
                                    <li><a href="/lembur">Riwayat Lembur</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/kelompokkerja">Kelompok Kerja</a></li>
                                    <li><a href="/kalenderkerja">Kalender Kerja</a></li>
                                    <li><a href="/polakerja">Pola Kerja</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-btc" aria-hidden="true"></i> Modul Gaji <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/komponenGaji"> Komponen Gaji</a></li>
                                    <li><a href="/gaji">Gaji</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file" aria-hidden="true"></i> Laporan <span
                                        class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" data-toggle="modal" data-target="#myModalLaporanGaji">Laporan Gaji</a></li>
                                </ul>
                            </li>
                            <li><a href="/pengaturan"><i class="fa fa-cogs"></i> Pengaturan</a>
                        </ul>
                        {{-- <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                            </div>
                        </form> --}}
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            {{-- <li class="dropdown messages-menu">
                                <!-- Menu toggle button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="label label-success">4</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 4 messages</li>
                                    <li>
                                        <!-- inner menu: contains the messages -->
                                        <ul class="menu">
                                            <li>
                                                <!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <!-- User Image -->
                                                        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}"
                                                            class="img-circle" alt="User Image">
                                                    </div>
                                                    <!-- Message title and timestamp -->
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <!-- The message -->
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                        </ul>
                                        <!-- /.menu -->
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a></li>
                                </ul>
                            </li> --}}
                            <!-- /.messages-menu -->

                            <!-- Notifications Menu -->
                            {{-- <li class="dropdown notifications-menu">
                                <!-- Menu toggle button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- Inner Menu: contains the notifications -->
                                        <ul class="menu">
                                            <li>
                                                <!-- start notification -->
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                            <!-- end notification -->
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li> --}}
                            <!-- Tasks Menu -->
                            {{-- <li class="dropdown tasks-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-flag-o"></i>
                                    <span class="label label-danger">9</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 9 tasks</li>
                                    <li>
                                        <!-- Inner menu: contains the tasks -->
                                        <ul class="menu">
                                            <li>
                                                <!-- Task item -->
                                                <a href="#">
                                                    <!-- Task title and progress text -->
                                                    <h3>
                                                        Design some buttons
                                                        <small class="pull-right">20%</small>
                                                    </h3>
                                                    <!-- The progress bar -->
                                                    <div class="progress xs">
                                                        <!-- Change the css width attribute to simulate progress -->
                                                        <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                            role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <!-- end task item -->
                                        </ul>
                                    </li>
                                    <li class="footer">
                                        <a href="#">View all tasks</a>
                                    </li>
                                </ul>
                            </li> --}}
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="user-image"
                                        alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">Admin</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle"
                                            alt="User Image">

                                        <p>
                                            Alexander Pierce - Web Developer
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Friends</a>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Full Width Column -->
        <div class="content-wrapper" style="margin-top: 50px">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('navigasi')
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">@yield('title')</h3>
                        </div>
                        <div class="box-body">
                            @yield('content')
                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.4.0 - AdminLTE
                </div>
                <strong>Copyright &copy; <?php echo date('Y') ?> Developer By <a href="#"> Danil Syah Arihardjo</a>.</strong>
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->
{{-- modal laporan gaji --}}
<?php
    $tahun = date('Y');
    $bulan = date("m");
    if($bulan == '01'){
        $bln = '1';
    }elseif($bulan== '02'){
        $bln = '2';
    }elseif($bulan == '03'){
        $bln = '3';
    }elseif($bulan == '04'){
        $bln = '4';
    }elseif($bulan == '05'){
        $bln = '5';
    }elseif($bulan == '06'){
        $bln = '6';
    }elseif($bulan == '07'){
        $bln = '7';
    }elseif($bulan == '08'){
        $bln = '8';
    }elseif($bulan == '09'){
        $bln = '9';
    }elseif($bulan == '10'){
        $bln = '10';
    }elseif($bulan == '11'){
        $bln = '11';
    }elseif($bulan == '12'){
        $bln = '12';
    }
?>
    <div id="myModalLaporanGaji" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Export Laporan Gaji</h4>
            </div>
            <div class="modal-body">
            {!! Form::open(['url'=>'export-laporan-gaji-pdf']) !!}
              <table class="table table-bordered">
                  <tr>
                      <td>Periode Gaji</td>
                      <td>{!! Form::selectMonth('bulan', $bln, ['class'=>'form-control']) !!}</td>
                      <td>{!! Form::selectRange('tahun', 2019, $tahun,$tahun,['class'=>'form-control']) !!}</td>
                  </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-success"> Download</button></td>
                    <td></td>
                </tr>
              </table>
            {!! Form::close() !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
      </div>

    <!-- jQuery 3 -->
    <script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('clockpicker/dist/bootstrap-clockpicker.min.js')}}"></script>
    <script>
        $(function(){
            $('.select2').select2()
        })
    </script>
    <script>
    $('.clockpicker').clockpicker({
            placement: 'right',
            align: 'left',
            donetext: 'Done'
        });
    </script>

    @stack('script')


</body>

</html>
