@if (session('message'))
        <div class="alert alert-info alert-dismissible" role="alertdialog">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
                <strong><i class="icon fa fa-info"></i> Informasi :</strong>
                {{session('message')}}
        </div>
@endif