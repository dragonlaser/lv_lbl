@extends('admin.layouts.layout-horizontal')

@section('content')
<div class="main-content">
    <form id="FormAdd">
        {{csrf_field()}}
        <input type="hidden" name="invoice_type" class="invoice_type" value="Q">
        <div class="page-header">
            <h3 class="page-title">Create Invoice</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Document</a></li>
                <li class="breadcrumb-item active">Create Invoice</li>
            </ol>
        </div>
        <div class="card">
            <div class="card-header">
                Create Invoice
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <h5>
                            Customer
                        </h5>
                        <select class="form-control ls-select2" name="customer_id">
                            <option value="">Choose customer</option>
                            @foreach($customer as $k => $v)
                            <option value="{{$v->id}}">{{$v->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="row">
                            <h6>Date</h6>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-fa icon-fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="date" class="form-control" name="date" value="{{date('d/m/Y')}}">
                            </div>
                        </div>
                        <div class="row">
                            <h6>Due Date</h6>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="icon-fa icon-fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="date" class="form-control" name="due_date" value="{{date('d/m/Y')}}">
                            </div>
                        </div>
                        <div class="row">
                            <h6>Invoice</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="">
                            </div>
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
@section('scripts')
<script>
    $.ajax({
        url: rurl + '/admin/documents/generate_no/B',
        method: 'GET',
        dataType: 'json'
    }).done(function (result) {
        $('#invoice_no').val(result);
    }).fail(function (result) {

    });
</script>
@stop