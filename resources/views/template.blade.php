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
                        <a href="/" class="navbar-brand"><i class="fa fa-google-wallet" aria-hidden="true"></i>
                            {{config('app.name')}}</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="/home"><i class="fa fa-tachometer"></i> Dashboard<span
                                        class="sr-only">(current)</span></a>
                            </li>
                            @if (Auth::user()->is_admin == 1)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-slideshare"
                                        aria-hidden="true"></i> Modul Karyawan <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/karyawan">Daftar Karyawan</a></li>
                                    <li class="divider"></li>
                                    <li><a href="/departemen">Departemen</a></li>
                                    <li><a href="/jabatan">Jabatan</a></li>
                                    <li><a href="/statuskawin">Status Kawin</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="fa fa-calendar-check-o" aria-hidden="true"></i> Modul Absensi <span
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
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-btc"
                                        aria-hidden="true"></i> Modul Gaji <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    @if (Auth::user()->is_admin==1)
                                    <li><a href="/komponenGaji"> Komponen Gaji</a></li>
                                    @endif
                                    <li><a href="/gaji">Gaji</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file"
                                        aria-hidden="true"></i> Laporan <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" data-toggle="modal" data-target="#myModalLaporanGaji">Laporan
                                            Gaji</a></li>
                                </ul>
                            </li>
                            @if (Auth::user()->is_admin==1)
                            <li><a href="/pengaturan"><i class="fa fa-cogs"></i> Pengaturan</a>
                            <li><a href="/user"><i class="fa fa-user-plus"></i> User</a>
                            {{-- <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> User</a> --}}
                            @endif
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                           
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <b><span class="hidden-xs">{{Auth::user()->name}}</span> <span
                                class="caret"></span></b>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{asset('uploads/NoPhoto.png')}}" class="img-circle" alt="User Image">
                                <p>
                                    {{Auth::user()->name}}
                                    <small>{{Auth::user()->email}}</small>
                                    <small>{{Auth::user()->nik}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Ubah Kata Sandi</a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Keluar') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
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
                Developer By DanilSyah
            </div>
            <strong>Copyright &copy; <?php echo date('Y') ?> UI By <a href="#"> <b>Version</b> 2.4.0 - AdminLTE</a>.</strong>
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
        $(function () {
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
