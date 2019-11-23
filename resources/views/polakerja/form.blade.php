<div class="row">
    <div class="col-md-4">
        <table class="table table-bordered">
            @if (isset($polaKerja))
            <tr>
                <td>ID</td>
                <td>{!! Form::text('id', null, ['class'=>'form-control','readOnly'=>'']) !!}</td>
            </tr>
            @endif
            <tr>
                <td><b>Nama Pola Kerja</b></td>
                <td>{!! Form::text('pola_kerja',null, ['class'=>'form-control','placeholder'=>'Nama Pola Kerja'])!!}
                </td>
            </tr>
            <tr>
                <td><b>Jam Masuk</b></td>
                {{-- <td>{!! Form::text('jam_masuk',null, ['class'=>'form-control','placeholder'=>'ex 00:00'])!!}</td> --}}
                <td>
                    <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                        <input type="text" class="form-control" value="" name="jam_masuk" placeholder="Waktu Masuk">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                </div>
                </td>
            </tr>
            <tr>
                <td><b>Jam Pulang</b></td>
                {{-- <td>{!! Form::text('jam_pulang',null, ['class'=>'form-control','placeholder'=>'ex 00:00'])!!}</td> --}}
                <td>
                    <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                        <input type="text" class="form-control" value="" name="jam_pulang" placeholder="Waktu Pulang">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                </div> 
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
                    <a href="/polakerja" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
                </td>
            </tr>
        </table>
    </div>
</div>
