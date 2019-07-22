@if (session('message'))
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b><i class="icon fa fa-info"></i> Informasi :</b>
                {{session('message')}}
        </div>
@endif