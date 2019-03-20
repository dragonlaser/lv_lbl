var Example = (function () {
    var handleTables = function () {
        var table = $('#' + menu).DataTable({
            "responsive": true,
            "serverSide": true,
            "processing": true,
            "ajax": rurl + 'admin/data_install',
            "columns": [{
                    "data": 'DT_RowIndex',
                    "name": 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                },
                {
                    "data": "Tables_in_" + database,
                    "name": "Tables_in_" + database
                }
            ],

        });

        $('#' + menu + ' tbody').on('click', 'tr', function () {
            
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected')
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected')
                var str =$(this).find("td")[1]
                getcolumns(str.textContent)
            }
        });

        function getcolumns(tablename){
            $("#tablename").html(tablename)
            $("[name='table']").val(tablename)
            $(".column").removeClass('d-none')
            $('#column').DataTable().clear().destroy();
            $('#column').DataTable({
                "responsive": true,
                "processing": true,
                "paging": false,
                "ajax":{
                    url : rurl + 'admin/data_install_column',
                    type: "POST",
                    data: {
                        table: tablename
                    }
                },
                "columns": [
                    {
                        "data": "checkall",
                        "name": "checkall",
                        orderable: false,
                        searchable: false,
                        className: "text-center"
                    },
                    {
                        "data": "Field",
                        "name": "Field"
                    },
                    {
                        "data": "Type",
                        "name": "Type"
                    },
                    {
                        "data": 'validate',
                        "name": 'validate',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        "data": "inputtype",
                        "name": "inputtype",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        "data": 'null',
                        "name": 'null',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        "data": 'null',
                        "name": 'null',
                        orderable: false,
                        searchable: false,
                    },

                ],
                "drawCallback": function( settings ){
                    handlePagelink('column')
                }
            })
            
            
            $('html, body').animate({
                scrollTop: $(".column").offset().top
            }, 1500)
        }

    }

    var handleCheckall = function (id) {
        $(document).on('click', '#'+id+' [name="checkall"]', function(){
            var buntton_checkall = $(this).is(':checked')
            var findcheckall = $("#"+id).find('.form-check-input')
            if(buntton_checkall==true){
                findcheckall.prop('checked',true)
            }else{
                findcheckall.prop('checked',false)
            }
        })
    }

    var handlePagelink = function (id) {
        var button_checkall = $('#'+id+' [name="checkall"]')
        var findcheckall = $("#"+id).find('[type="checkbox"]')
        if(button_checkall.is(':checked')==true){
            findcheckall.prop('checked',true)
        }else{
            findcheckall.prop('checked',false)
        }
    }

    var handleChangeinputttype = function () {
        $(document).on('change','.inputtype', function(){
            var $this = $(this)
            var $name = $this.closest('tr').find('td').get(1).textContent
            
            if($(this).val()=='dropdown'||$(this).val()=='checkbox'){
                var td = $this.closest('td')
                td.next().next().html('')
                $.ajax({
                    type: "get",
                    url: rurl + 'admin/detailvalue',
                    dataType: "json",
                    success: function (response) {
                        var str = "<select class='source' name=\""+$name+"[source]\" >";
                            str += '<option value="">== select table ==</option>'
                        $.each(response, function (key, value) { 
                            str += "<option value="+value[('Tables_in_' + database)]+">"+(key+1)+"."+value[('Tables_in_' + database)]+"</option>"
                        });
                        str += "</select>"
                        $this.closest('td').next().html(str)
                        
                    }
                });
            }else{
                var td = $this.closest('td')
                td.next().html(null)
                td.next().next().html("<input type='text' name=\""+$name+"['name']\" value=\""+$name+"\" readonly>")
            }
        })

        $(document).on('click','.source', function(){
            var $this = $(this)
            var $name = $this.closest('tr').find('td').get(1).textContent
            $.ajax({
                type: "get",
                url: rurl + 'admin/detailvalue',
                data: {table:$(this).val()},
                dataType: "json",
                success: function (response) {
                    var str = "<select name=\""+$name+"[id]\" >"
                        str += '<option value="">== select value ==</option>'
                    $.each(response, function (key, value) { 
                        str += "<option value="+value.Field+">"+value.Field+"</option>"
                    });
                    str += "</select>"
                    str += "<select name=\""+$name+"[name]\" >"
                    str += "<option value=''>== select name ==</option>"
                    $.each(response, function (key, value) { 
                        str += "<option value="+value.Field+">"+value.Field+"</option>"
                    });
                    str += "</select>"
                    $this.closest('td').next().html(str)
                    
                }
            })
        })
    }

    var handleForm = function(){
        var btn = $('.validateForm [type="submit"]')
        btn.click(function (e) { 
            e.preventDefault();
            var form = $('.validateForm')
            // console.log( form.serialize() );
            $.ajax({
                type: "POST",
                url: rurl + 'admin/createmvc',
                data: form.serialize(),
                dataType: "json",
                success: function (response) {
                    
                }
            });
        });
    }

    return {
        // main function to initiate the module
        init: function () {
            handleTables()
            handleCheckall("column")
            handleChangeinputttype()
            handleForm()
        }
    }
})()

jQuery(document).ready(function () {
    Example.init()
})