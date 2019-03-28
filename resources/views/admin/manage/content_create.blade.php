@extends('admin.layouts.layout-horizontal') @section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.js"></script>
<!-- summernote config -->
<script>
$(document).ready(function(){

    // Define function to open filemanager window
    var lfm = function(options, cb) {
    var route_prefix = (options && options.prefix) ? options.prefix : 'laravel-filemanager';
    window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
    var ui = $.summernote.ui;
    var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Insert image with filemanager',
        click: function() {

        lfm({type: 'image', prefix: '/admin/laravel-filemanager'}, function(lfmItems, path) {
            lfmItems.forEach(function (lfmItem) {
            context.invoke('insertImage', lfmItem.url);
            });
        });

        }
    });
    return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('#summernote').summernote({
    toolbar: [
        ['popovers', ['lfm']],
    ],
    buttons: {
        lfm: LFMButton
    }
    })
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
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>{{ isset($menu) ? $menu : '' }}</h6>
                </div>
                <div class="card-body">
                    <form>
                        <input class="form-control" type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-control ls-select2" id="category_id"
                                style="width: 100%;">
                                <option value="">== Category ==</option>
                                @foreach($categories as $k => $v)
                                <option value="{{$v->id}}">{{$v->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input class="form-control" type="text" name="thumbnail" id="thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <textarea name="detail" id="summernote" class="summernote"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop