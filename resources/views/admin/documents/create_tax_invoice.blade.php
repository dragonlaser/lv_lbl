@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Create Quotation</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Document</a></li>
            <li class="breadcrumb-item active">Create Quotation</li>
        </ol>
    </div>
    <form id="FormAdd">
        {{csrf_field()}}
        <input type="hidden" name="invoice_type" class="invoice_type" value="T">
        <div class="card">
            <div class="card-header">
                Create Quotation
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl- col-md-3 mb-4">
                        <button type="button" class="btn btn-theme btn-sm" data-toggle="modal" data-target="#exampleModalLong">
                            Add Customer
                        </button>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#exampleModalLong">
                            Add Bank
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl- col-md-6 mb-4">
                        <h6>Quotation</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="">
                        </div>
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Customer
                        </h5>
                        <select class="form-control ls-select2" name="contact[customer_company_id]" id='customer_company_id'>
                            <option value="">Choose customer</option>
                            @foreach($customer as $k => $v)
                            <option value="{{$v->id}}">{{$v->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Bank
                        </h5>
                        <select class="form-control ls-select2" name="bank_id" id='bank_id'>
                            <option value="">Choose Bank</option>
                            @foreach($bank as $k => $v)
                            <option value="{{$v->id}}">{{$v->bank_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Contact name
                        </h5>
                        <input type="text" class="form-control" name="contact[contact_name]" value="" id="contact_name">
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Telephone
                        </h5>
                        <input type="text" class="form-control" name="contact[telephone]" value="" id="telephone">
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Email
                        </h5>
                        <input type="email" class="form-control" name="contact[email]" value="" id="email">
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Project type
                        </h5>
                        <select class="form-control ls-select2" name="contact[project_type]" id='project_type'>
                            <option value="">Project type</option>
                            <option value="P">Program</option>
                            <option value="A">Moblie application</option>
                            <option value="W">Web application</option>
                        </select>
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Project name
                        </h5>
                        <input type="text" class="form-control" name="contact[project_name]" value="" id="project_name">
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h5>
                            Source
                        </h5>
                        <select class="form-control ls-select2" name="contact[source]" id='source'>
                            <option value="">Project type</option>
                            <option value="F">Friend</option>
                            <option value="G">google</option>
                            <option value="S">Social</option>
                            <option value="W">Web</option>
                        </select>
                    </div>
                    <div class="col-xl- col-md-6 mb-4">
                        <h6>Due Date</h6>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="icon-fa icon-fa-calendar"></i>
                                </span>
                            </div>
                            <input type="date" class="form-control" name="contact[due_date]" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6>Items</h6>
            </div>
            <div class="card-body">
                <div class="col-xl-12 col-md-12 mb-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>index</th>
                                <th style="width: 10%;">Item</th>
                                <th style="width: 30%;">Description</th>
                                <th style="width: 10%;">Quantity</th>
                                <th style="width: 15%;">Unit Cost</th>
                                <th style="width: 20%;">Total Net</th>
                                <th style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="row-0">
                                <td><input type="text" class="form-control invoice_no" name="item[0][invoice_no]" value=""></td>
                                <td><input type="text" class="form-control item" name="item[0][item]" value=""></td>
                                <td><input type="text" class="form-control description" name="item[0][detail]" value=""></td>
                                <td><input type="text" class="form-control quantity" name="item[0][quantity]" value="0"></td>
                                <td><input type="text" class="form-control unit_cost" name="item[0][unit_cost]" value="0"></td>
                                <td class="text-right"><input type="hidden" class="form-control total_net" name="item[0][price]"
                                        value="0" readonly><span>0.00</span>
                                </td>
                                <td><button class="btn btn-sm btn-danger remove-item">remove</button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" rowspan="3"><button type="button" class="add-row btn btn-info btn-xs">Add
                                        new item</button></th>
                                <th>Sub Total :</th>
                                <th class="text-right"><input type="hidden" class="sub_total" name="sub_total" value=""
                                        readonly><span>0.00</span></th>
                            </tr>
                            <tr>
                                <th><input type="checkbox" name="tax" id="tax" value="T">Tax (7%) :</th>
                                <th class="text-right"><input type="hidden" class="vat" name="vat" value="" readonly><span>0.00</span></th>
                            </tr>
                            <tr>
                                <th>Total :</th>
                                <th class="text-right"><input type="hidden" class="grand_total" name="grand_total"
                                        value="" readonly><span>0.00</span></th>
                            </tr>
                        </tfoot>
                    </table>
                    <button type="button" class="btn btn-danger btn-sm float-left">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm float-right">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop
@section('modals')
<div class="modal fade ls-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormCustomer">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4">
                                <h6>Display name</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="display_name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-4">
                                <h6>Trading name</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="trding_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4">
                                <h6>Business registration</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="display_name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 mb-4">
                                <h6>Trading name</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="trding_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>
    $.ajax({
        url: rurl + '/admin/documents/generate_no/T',
        method: 'GET',
        dataType: 'json'
    }).done(function (result) {
        $('#invoice_no').val(result);
    }).fail(function (result) {

    });
</script>
@stop