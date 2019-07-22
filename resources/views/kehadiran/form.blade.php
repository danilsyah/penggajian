<table class="table table-bordered">
    <tr>
        <td width="150"><b>Nama Karyawan</b></td>
        <td>{!! Form::text('nama',null, ['list'=>'listKaryawan','class'=>'form-control','placeholder'=>'Input Nama Karyawan']) !!}</td>
    </tr>
    <tr>
        <td><b>Tanggal Masuk</b></td>
        <td>
            <div class="row">
                <div class="col-md-3">
                    {!! Form::date('tanggal_masuk',null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::text('jam_masuk', null, ['class'=>'form-control','placeholder'=>'Format Jam = 00:00']) !!}
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
                        {!! Form::text('jam_pulang', null, ['class'=>'form-control','placeholder'=>'Format Jam = 00:00']) !!}
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

<datalist id="listKaryawan">
    @foreach ($karyawan as $item)
        <option value="{{$item->nama}}"></option>
    @endforeach
</datalist>