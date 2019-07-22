<table class="table table-bordered">
    <tr>
        <td width="170"><b>No Induk Karyawan</b></td>
        <td>
            <div class="row">
                <div class="col-md-4">
                    @if(isset($karyawan))
                        {!! Form::text('nik',null, ['class'=>'form-control','placeholder'=>'Isi No Induk Karyawan...','readOnly'=>'']) !!}
                    @else
                        {!! Form::text('nik',null, ['class'=>'form-control','placeholder'=>'Isi No Induk Karyawan...']) !!}
                    @endif
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Nama Karyawan</b></td>
        <td>{!! Form::text('nama',null, ['class'=>'form-control','placeholder'=>'Isi Nama Karyawan...']) !!}</td>
    </tr>
    <tr>
        <td><b>Tanggal Lahir</b></td>
        <td>
            <div class="row">
                <div class="col-md-4">
                    {!! Form::date('tanggal_lahir',null, ['class'=>'form-control','placeholder'=>'Isi Tanggal Lahir...']) !!}
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Alamat</b></td>
        <td>{!! Form::textarea('alamat',null, ['class'=>'form-control','placeholder'=>'Isi Alamat Tempat Tinggal...','rows'=>3]) !!}</td>
    </tr>
    <tr>
        <td><b>Tanggal Masuk</b></td>
        <td>
            <div class="row">
                <div class="col-md-4">
                    {!! Form::date('tanggal_masuk',null, ['class'=>'form-control','placeholder'=>'Isi Tanggal Mulai Bergabung Bekerja...']) !!}
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Status Kawin</b></td>
        <td>{!! Form::select('kode_status_kawin',$status_kawin,null, ['class'=>'form-control']) !!}</td>
    </tr>
    <tr>
        <td><b>Jenis Kelamin</b></td>
        <td>
            <div class="row">
                <div class="col-md-4">
                    {!! Form::select('jenis_kelamin',['-Pilih-','L'=>'Laki-Laki','P'=>'Perempuan'],null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Departemen & Jabatan</b></td>
        <td>
            <div class="row">
                <div class="col-md-5">
                    {!! Form::select('kode_departemen',$departemen,null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-md-5">
                    {!! Form::select('kode_jabatan',$jabatan,null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Upload Foto</b></td>
        <td>{{Form::file('foto')}}</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"> Simpan</i></button>
            <a href="/karyawan" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"> Batal</i></a>
        </td>
    </tr>
    
</table>