<html>
    <head>
            <style type="text/css">
                table tr td,
                table tr th{
                    font-size: 9pt;
                }
                table, td, th {  
                border: 1px solid #ddd;
                text-align: left;
                }

                table {
                border-collapse: collapse;
                width: 100%;
                }

                th, td {
                padding: 5px;
                }
                h2.judul{
                    text-align: center;
                    font-size: 20px;
                }
                .total_gaji td{
                    text-align: right;
                }
            </style>

    </head>
    <body>
        <img src="{{asset('uploads/'.$pengaturan->logo.'')}}" alt="logo">
        <h2 class="judul">Laporan Gaji</h2>
        <table class="table table-bordered">
            <tr>
                <th>Nama Perusahaan</th>
                <th>:</th>
                <td>{{$pengaturan->nama_perusahaan}}</td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <th>:</th>
                <td>{{$pengaturan->no_telepon}}</td>
            </tr>
            <tr>
                <th>Periode</th>
                <th>:</th>
                <td>{{$periode}}</td>
            </tr>
        </table>
        <hr>
        <table class="table table-bordered" >
            <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Departemen</th>
                <th>Di Terima (Rp.)</th>
            </tr>
            </thead>
            <hr>
            <tbody>
                <?php
                   $noUrut = 1;
                ?>
                @foreach ($gaji as $row)
                <tr>
                    <td>{{$noUrut++}}</td>
                    <td>{{$row->nik}}</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->nama_jabatan}}</td>
                    <td>{{$row->nama_departemen}}</td>
                    <td>@currency($row->total_gaji),-</td>
                </tr>
                @endforeach
               
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td class="totalgaji"><b>Total : </b></td>
                    <td><b>@currency($totalGaji)</b></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
