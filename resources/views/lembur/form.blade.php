
<table class="table table-bordered">
    <tr>
        <td><b>Periode</b></td>
        <td>{!! Form::select('periode', $periodeGaji, null, ['class'=>'form-control']) !!}</td>
    </tr>
    <tr>
        <td width="200"><b>Nama Karyawan</b></td>
        <td>
            {{-- {!! Form::text('nama',null, ['list'=>'listKaryawan','class'=>'form-control','placeholder'=>'Input Nama Karyawan']) !!} --}}
            {!! Form::select('nik', $karyawan, null, ['class'=>'form-control select2','placeholder'=>'-Pilih-']) !!}
        </td>
    </tr>
    <tr>
        <td><b>Waktu Mulai</b></td>
        <td>
            <div class="row">
                <div class="col-md-3">
                    {!! Form::date('tanggal_masuk',null, ['class'=>'form-control','id'=>'tgl_masuk']) !!}
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
        <td><b>Waktu Selesai</b></td>
        <td>
            <div class="row">
                <div class="col-md-3">
                    {!! Form::date('tanggal_pulang',null, ['class'=>'form-control','id'=>'tgl_pulang']) !!}
                </div>
                <div class="col-md-3">
                        {{-- {!! Form::text('jam_pulang', null, ['class'=>'form-control','placeholder'=>'Format Jam = 00:00']) !!} --}}
                        <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control" value="" name="jam_pulang" placeholder="Input Waktu Masuk">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
            <a href="/lembur" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
        </td>
    </tr>
    
</table>

{{-- <datalist id="listKaryawan">
    @foreach ($karyawan as $item)
        <option value="{{$item->nama}}">{{ $nikKaryawan ='NIK : '. $item->nik }}</option>
        
    @endforeach
</datalist> --}}