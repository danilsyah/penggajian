<?php
    $tahun = date("Y");
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

<table class="table table-hover">
    <tr class="info">
        <td><b>Filter Laporan</b></td>
        <td>
            {!! Form::selectMonth('bulan', $bln, ['class'=>'form-control']) !!}
        </td>
        <td>
            {!! Form::selectRange('tahun', 2018, $tahun,$tahun,['class'=>'form-control']) !!}
        </td>
        <td>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </td>
    </tr>
</table>