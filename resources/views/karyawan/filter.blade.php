<?php
    $tgl = date("Y");
?>

<table class="table table-bordered">
    <tr>
        <td><b>Filter Laporan</b></td>
        <td>
            {{-- {!! Form::select('bulan', [ '01'=>'Januari',
                                        '02'=>'Februari',
                                        '03'=>'Maret',
                                        '04'=>'April',
                                        '05'=>'Mei',
                                        '06'=>'Juni',
                                        '07'=>'Juli',
                                        '08'=>'Agustus',
                                        '09'=>'September',
                                        '10'=>'Oktober',
                                        '11'=>'November',
                                        '12'=>'Desember'],
                                        null, ['class'=>'form-control']) !!} --}}
                                        {!! Form::selectMonth('bulan', null, ['class'=>'form-control']) !!}
        </td>
        <td>
            {{-- {!! Form::select('tahun', ['2019'=>'2019'], null, ['class'=>'form-control']) !!} --}}
            {!! Form::selectRange('tahun', 2018, $tgl,$tgl,['class'=>'form-control']) !!}
        </td>
        <td>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </td>
    </tr>
</table>