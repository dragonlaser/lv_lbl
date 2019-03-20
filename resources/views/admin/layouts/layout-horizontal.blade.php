<!DOCTYPE html>
<html>

<head>
    <title>Laraspace - Laravel Admin</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <script src="{{asset('/assets/admin/js/core/pace.js')}}"></script>
    <link href="{{ mix('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.partials.favicons')
    @yield('styles')
</head>

<body class="layout-horizontal skin-default">

    <div id="app" class="site-wrapper">
        @include('admin.layouts.partials.laraspace-notifs')
        @include('admin.layouts.partials.header')
        <div class="mobile-menu-overlay"></div>
        @include('admin.layouts.partials.header-bottom')
        @yield('content')
        @include('admin.layouts.partials.footer')
        @include('admin.layouts.partials.skintools')
    </div>

    <script src="{{mix('/assets/admin/js/core/plugins.js')}}"></script>
    <script src="{{asset('/assets/admin/js/demo/skintools.js')}}"></script>
    <script src="{{mix('/assets/admin/js/core/app.js')}}"></script>
    <script>
        rurl = "{{asset('')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var menu = "{{ !empty($menu) ? $menu : '' }}";
        var database = "{{env('DB_DATABASE')}}";
        var checked = null;
    </script>
    <script>
        $('.add-row').click(function () {
            var clone = $('body').find('tbody tr:last').clone();
            var index = parseInt(clone[0].id.match(/\d+/)[0]) + 1;
            clone.prop('id', 'row-' + index);
            clone.find('.invoice_no').prop({
                'name': 'item[' + index + '][invoice_no]',
                'value': ''
            });
            clone.find('.item').prop({
                'name': 'item[' + index + '][item]',
                'value': ''
            });
            clone.find('.description').prop({
                'name': 'item[' + index + '][description]',
                'value': ''
            });
            clone.find('.quantity').prop({
                'name': 'item[' + index + '][quantity]',
                'value': '0'
            });
            clone.find('.unit_cost').prop({
                'name': 'item[' + index + '][unit_cost]',
                'value': '0'
            });
            clone.find('.total_net').prop({
                'name': 'item[' + index + '][total_net]',
                'value': '0'
            }).next().text('0.00');
            $('body').find('tbody').append(clone);
        });
        $('body').on('keyup', '.unit_cost, .quantity', function () {
            var quantity = $(this).closest('tr').find('.quantity').val() || 0;
            var unit_cost = $(this).closest('tr').find('.unit_cost').val() || 0;
            $(this).closest('tr').find('.total_net').val(quantity * unit_cost).next().text(numberWithCommas((
                quantity * unit_cost).toFixed(2)));
            sum();
        });

        function sum() {
            var sub_total = 0;
            var tax = $('#tax').is(':checked')? 7 : 0;
            $.each($('body').find('tbody tr'), function (k, v) {
                var quantity = $(v).find('.quantity').val() || 0;
                var unit_cost = $(v).find('.unit_cost').val() || 0;
                sub_total += quantity * unit_cost;
            });
            $('.sub_total').val(sub_total).next().text(numberWithCommas(sub_total.toFixed(2)));
            $('.vat').val(sub_total * tax / 100).next().text(numberWithCommas((sub_total * tax / 100).toFixed(2)));
            $('.grand_total').val(sub_total + (sub_total * tax / 100)).next().text(numberWithCommas(((sub_total + (
                sub_total * tax / 100)).toFixed(2))));
        }

        function numberWithCommas(number) {
            var parts = number.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
        $('body').on('keypress', '.quantity', function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        $('body').on('keypress', '.unit_cost', function (e) {
            if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
                e.preventDefault();
            }
        });
        $('body').on('blur', '.unit_cost, .quantity', function (e) {
            if ($(this).val() == '' || $(this).val() == null) {
                $(this).val(0);
            } else {
                $(this).val(parseFloat($(this).val()));
            }
            sum();
        });
        $('body').on('focus', '.unit_cost, .quantity', function (e) {
            if ($(this).val() == 0 || $(this).val() == '0') {
                $(this).val('');
            }
            sum();
        });
        $('body').on('click', '.remove-item', function () {
            if ($(this).closest('tbody').find('tr').length > 1) {
                $(this).closest('tr').remove();
            }
            sum();
        });
        $('#tax').change(function() {
            sum();
        });
        @if(isset($segment))
        $('#FormAdd').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: rurl + '/admin/documents/{{$segment}}',
                method: "POST",
                dataType: 'json',
                data: $(this).serialize()
            }).done(function (result) {
                console.log(result);
            }).fail(function () {

            });
        });
        @endif
        $('select').select2({
            tags: true
        });
    </script>
    @yield('scripts')
    @yield('modals')
</body>

</html>