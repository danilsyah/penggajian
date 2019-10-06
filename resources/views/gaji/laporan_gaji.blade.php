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
            </style>

    </head>
    <body>
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
                <th>Hari Normal</th>
                <th>Absen</th>
            </tr>
            </thead>
            <hr>
            <tbody>
                <?php
                   $noUrut = 1;
                ?>
                @foreach ($karyawan as $row)
                <tr>
                    <td>{{$noUrut++}}</td>
                    <td>{{$row->nik}}</td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->nama_jabatan}}</td>
                    <td>{{$row->nama_departemen}}</td>
                    <td>25</td>
                    <td>{{$row->kehadiran}}</td>
                    <td>jml lembur</td>
                    <td>Gaji</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>