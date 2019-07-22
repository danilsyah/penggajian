<table class="table table-bordered">
    <tr>
        <td width="150"><b>Kode Jabatan</b></td>
        <td>
        @if (isset($jabatan))
            {!! Form::text('kode_jabatan',null, ['class'=>'form-control','placeholder'=>'Isi Kode Jabatan','readOnly'=>'']) !!}
        @else
            {!! Form::text('kode_jabatan',$kodeOtomatisJabatan, ['class'=>'form-control','placeholder'=>'Isi Kode Jabatan','readOnly'=>'']) !!}
        @endif
        </td>
    </tr>
    <tr>
        <td><b>Nama Jabatan</b></td>
        <td>{!! Form::text('nama_jabatan',null, ['class'=>'form-control','placeholder'=>'Isi Nama Jabatan']) !!}</td>
    </tr>
    <tr>
        <td><b>Tunjangan (Rp.)</b></td>
        <td>{!! Form::number('tunjangan_jabatan',null, ['class'=>'form-control','placeholder'=>'Isi Total Tunjangan']) !!}</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
            <a href="/jabatan" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
        </td>
    </tr>
    
</table>