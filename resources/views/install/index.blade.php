{{-- @extends('admin.layouts.layout-basic') --}}
@extends('admin.layouts.layout-horizontal')

@section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{asset('assets/admin/js/install/install.js')}}"></script>
<script src="{{asset('assets/admin/js/settings/validation_th.js')}}"></script>
@stop

@section('content')
<div class="main-content">
    <div class="card">
        <div class="card-header">
            <h6>{{$menu}}</h6>
        </div>
        <div class="card-body">
            <div class="dataTables_wrapper container-fluid dt-bootstrap4">
                <table id="{{$menu}}" class="table table-sm">
                    <thead class="thead-inverse">
                        <tr>
                            <th>#</th>
                            <th>Table</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <form class="validateForm">
        <div class="column card d-none">
            <div class="card-header">
                <h6 id="tablename"></h6>
                <input type="hidden" name="table">
            </div>
            <div class="card-body">
                <div class="dataTables_wrapper container-fluid dt-bootstrap4">
                    <table id="column" class="table table-sm table-hover">
                        <thead class="thead-inverse">
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="checkall">
                                        <label class="form-check-label" for="checkall"></label>
                                    </div>
                                </th>
                                <th>field</th>
                                <th>type</th>
                                <th>validate</th>
                                <th>input type</th>
                                <th>source</th>
                                <th>name/value</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="column card d-none">
            <div class="card-body">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>

</div>

@stop