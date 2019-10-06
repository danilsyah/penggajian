<table class="table table-bordered">
    <tr>
        <td><b>Tanggal</b></td>
        <td>
            <div class="row">
                <div class="col-md-4">
                    @if(isset($kalenderkerja))
                        {!! Form::date('tanggal',null, ['class'=>'form-control','placeholder'=>'Isi Tanggal Merah']) !!}
                    @else
                        {!! Form::date('tanggal',null, ['class'=>'form-control','placeholder'=>'Isi Tanggal Merah']) !!}
                    @endif
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Keterangan</b></td>
        <td>{!! Form::textarea('keterangan',null, ['class'=>'form-control','placeholder'=>'Keterangan Tanggal Merah','rows'=>2]) !!}</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
            <a href="/kalenderkerja" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
        </td>
    </tr>
</table>