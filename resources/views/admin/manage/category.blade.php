{{-- @extends('admin.layouts.layout-basic') --}} @extends('admin.layouts.layout-horizontal') @section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <script src="{{asset('assets/admin/js/example.js')}}"></script> -->
<script src="{{asset('assets/admin/js/settings/valudation_th.js')}}"></script>
<script>
    $('.save').click(function(e) {
        e.preventDefault();
        console.log($('#FormAdd').serialize());
        $.ajax({
            url: rurl+'/admin/manages/category/store',
            method: 'POST',
            data: $('#FormAdd').serialize(),
            success: function() {
                $("#example").DataTable().ajax.reload(null, false);
                toastr['success']('Example Deleted', 'Success')
                $('.modal').modal('hide');
                $('input, select, textarea').val('');
            },
            error: function() {
                toastr['error']('There was an error', 'Error')
            }
        });
    });
    $('body').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        $.ajax({
            method:'POST',
            url: rurl+'/admin/manages/category/'+id,
            success: function (data) {
            toastr['success']('Example Deleted', 'Success')
            $("#example").DataTable().ajax.reload(null, false);
            },
            error: function (data) {
            toastr['error']('There was an error', data)
            }
        });
    });
      var table = $('#example').DataTable({
        "responsive": true,
        "serverSide": true,
        "processing": true,
        "ajax": rurl + '/admin/manages/category/lists',
        "columns": [{
            "data": 'DT_RowIndex',
            "name": 'DT_RowIndex',
            orderable: false,
            searchable: false,
            className:"text-center"
          },

          {
            "data": "name",
            "name": "name"
          },
          {
            "data": "action",
            orderable: false,
            searchable: false,
            className: 'text-center'
          }
        ],
      });
      $('body').on('click', '.btn-edit', function(){
          var id = $(this).data('id')
          $('#id').val(id);
          $.ajax({
            type: 'get',
            url: rurl+'/admin/manages/category/'+id,
            dataType: "json",
            success: function (data) {
                $('#title').val(data.title);                
                $('.modal').modal('show');
            },
            error: function (data) {
                toastr['error']('There was an error', data)
            }
          });
        });
</script>
@stop @section('content')

<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">{{ isset($menu) ? $menu : '' }}</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('example.index')}}">{{ isset($menu) ? $menu : '' }}</a></li>
            <li class="breadcrumb-item active">{{ isset($menu) ? $menu : '' }}</li>
        </ol>
        <div class="page-actions">
            <button type="button" class="btn btn-theme btn-add" data-toggle="modal" data-target="#exampleModal">+ {{
                isset($menu) ?
                $menu : '' }}</button>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>{{ isset($menu) ? $menu : '' }}</h6>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-sm table-hover table-striped table-bordered" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>name</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Simple Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="FormAdd">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ isset($menu) ? $menu : '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


@stop