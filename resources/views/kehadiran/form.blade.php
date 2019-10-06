<table class="table table-bordered">
    <tr>
        <td width="150"><b>Nama Karyawan</b></td>
        <td>
            {!! Form::select('nik', $karyawan, null, ['class'=>'form-control select2','placeholder'=>'-Pilih-']) !!}
        </td>
    </tr>
    <tr>
        <td><b>Tanggal Masuk</b></td>
        <td>
            <div class="row">
                <div class="col-md-3">
                    {!! Form::date('tanggal_masuk',null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {{-- {!! Form::text('jam_masuk', null, ['class'=>'form-control','placeholder'=>'Format Jam = 00:00']) !!} --}}
                    <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                        <input type="text" class="form-control" value="" name="jam_masuk" placeholder="Input Waktu Masuk">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Tanggal Pulang</b></td>
        <td>
            <div class="row">
                <div class="col-md-3">
                    {!! Form::date('tanggal_pulang',null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-md-3">
                        {{-- {!! Form::text('jam_pulang', null, ['class'=>'form-control','placeholder'=>'Format Jam = 00:00']) !!} --}}
                        <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                                <input type="text" class="form-control" value="" name="jam_pulang" placeholder="Input Waktu Pulang">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                        </div>
                    </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Status Kehadiran</b></td>
        <td>{!! Form::select('kode_status_kehadiran',$statusKehadiran,null, ['class'=>'form-control']) !!}</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
            <a href="/kehadiran" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
        </td>
    </tr>
    
</table>

