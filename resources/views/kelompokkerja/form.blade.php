<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered">
            @if (isset($kelompokKerja))
                <tr>
                    <td>ID</td>
                    <td>{!! Form::text('id', null, ['class'=>'form-control','readOnly'=>'']) !!}</td>
                </tr>
            @endif
            <tr>
                <td><b>Kelompok Kerja</b></td>
                <td>{!! Form::text('kelompok_kerja',null, ['class'=>'form-control','placeholder'=>'Isi nama kelompok kerja...']) !!}</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
                    <a href="/kelompokkerja" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
                </td>
            </tr>
        </table>
    </div>
</div>