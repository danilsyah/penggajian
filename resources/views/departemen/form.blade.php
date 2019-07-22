<table class="table table-bordered">
        <tr>
            <td width="150"><b>Kode Departemen</b></td>
            @if (isset($departemen))
                <td>{!! Form::text('kode_departemen',null, ['class'=>'form-control','readOnly'=>'']) !!}</td>
            @else
                <td>{!! Form::text('kode_departemen',$kodeOtomatisDepartemen, ['class'=>'form-control','readOnly']) !!}</td>
            @endif 
        </tr>
        <tr>
            <td><b>Nama Departemen</b></td>
            <td>{!! Form::text('nama_departemen',null, ['class'=>'form-control','placeholder'=>'Isi Nama Depertemen']) !!}</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
                <a href="/departemen" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
            </td>
        </tr>
</table>