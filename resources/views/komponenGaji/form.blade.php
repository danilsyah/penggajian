<table class="table table-bordered">
    <tr>
        <td width="150"><b>Kode Komponen</b></td>
        <td>
        @if (isset($komponenGaji))
            {!! Form::text('kode_komponen',null, ['class'=>'form-control','placeholder'=>'Isi Kode Komponen','readOnly'=>'']) !!}
        @else
            {!! Form::text('kode_komponen',$kodeOtomatisKomponen, ['class'=>'form-control','placeholder'=>'Isi Kode Komponen','readOnly'=>'']) !!}
        @endif
        </td>
    </tr>
    <tr>
        <td><b>Nama Komponen</b></td>
        <td>{!! Form::text('nama_komponen',null, ['class'=>'form-control','placeholder'=>'Isi Nama Komponen']) !!}</td>
    </tr>
    <tr>
        <td><b>Jenis</b></td>
        <td>{!! Form::select('jenis', ['-PILIH-','tunjangan'=>'TUNJANGAN','potongan'=>'POTONGAN'], null, ['class'=>'form-control']) !!}</td>
    </tr>
    <tr>
        <td><b>Nilai (Rp.)</b></td>
        <td>{!! Form::number('nilai',null, ['class'=>'form-control','placeholder'=>'Isi nominal...']) !!}</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
            <a href="/komponenGaji" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
        </td>
    </tr>
    
</table>