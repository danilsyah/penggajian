@extends('template')
@section('title', 'Data User')
@section('content')
    @include('alert')
    <a href="{{ route('register') }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        Tambah</a>
    <hr>
    <table class="table table-hover" id="example1">
        <thead>
            <tr class="warning">
                <th width="150px">Nik</th>
                <th>Name</th>
                <th>Email</th>
                <th>Privillage</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user_list as $user)
                <tr>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    @if ($user->is_admin == 1)
                        <td>Admin</td>
                    @else
                        <td>User</td>
                    @endif
                    <td width="50px">
                        {!! Form::open([
                            'method' => 'delete',
                            'action' => ['UserController@destroy', $user->id],
                            'onsubmit' => 'return confirm("Yakin Data Akan Dihapus ?")',
                        ]) !!}
                        @if ($user->is_admin == 1)
                        @else
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Hapus</button>
                        @endif
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
@push('script')
    <!-- DataTables -->
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
@endpush
