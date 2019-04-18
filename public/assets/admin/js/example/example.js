var Examples = (function () {
    var handleTables = function () {
      var table = $('#example').DataTable({
        "responsive": true,
        "serverSide": true,
        "processing": true,
        "ajax": rurl + 'admin/data_example',
        "columns": [{
            "data": 'DT_RowIndex',
            "name": 'DT_RowIndex',
            orderable: false,
            searchable: false,
            className:"text-center"
          },

          {
            "data": "field_1",
            "name": "examples.field_1"
          },
          {
            "data": "field_2",
            "name": "examples.field_2"
          },
          {
            "data": "field_3",
            "name": "examples.field_3"
          },
          {
            "data": "field_4",
            "name": "examples.field_4"
          },
          {
            "data": "created_by",
            "name": "examples.created_by"
          },
          {
            "data": "action",
            orderable: false,
            searchable: false
          }

        ],
  
      });
    }
  
    var handleValidation = function () {
      var form = $('.validateForm')
      var btn = $('.validateForm [type="submit"]')

      form.validate({
        errorElement: 'span', // default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: '', // validate all fields including form hidden input

        rules: {
          field_1: {
            required: true
          },
          field_2: {
            required: true
          },
          field_3: {
            required: true
          },
          field_4: {
            required: true
          },
          created_by: {
            required: true
          },
        },
  
        highlight: function (element) { // hightlight error inputs
          $(element)
            .closest('.form-group .form-control').addClass('is-invalid') // set invalid class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
          $(element)
            .closest('.form-group .form-control').removeClass('is-invalid') // set invalid class to the control group
            .closest('.form-group .form-control').addClass('is-valid')
        },
        errorPlacement: function (error, element) {
          if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
            error.insertAfter(element.parent())
          } else {
            error.insertAfter(element)
          }
        },
        success: function (label) {
          label
            .closest('.form-group .form-control').removeClass('is-invalid') // set success class to the control group
        },
        submitHandler: function(element) {
          btn.prop('disabled', true)
          $.ajax({
            type: "post",
            url: rurl+'admin/example',
            data: $( element ).serialize(),
            dataType: "html",
            success: function () {
              btn.prop('disabled', false)
              $('[data-dismiss="modal"]').trigger('click');
              $('.validateForm').removeClass('formadd')
              $('.validateForm').removeClass('formedit')
              $("#example").DataTable().ajax.reload(null, false);
              toastr['success']('Success','Adding information');
            },
            error: function (data) {
              $('.validateForm').removeClass('formadd')
              $('.validateForm').removeClass('formedit')
              toastr['error']('ERROR!!!' + '/\n/' + data,'Adding information')
            }
          });
        }
      })
    }

    var handleButton = function () {
        $(document).on('click', '[data-confirmation="notie"]', function(){
          $this = $(this)
          notie.confirm({
            text: 'Are you sure you want to delete this item?',
            submitText: 'Yes', // optional, default = 'Yes'
            cancelText:  'Cancel', // optional, default = 'Cancel'
            submitCallback: function(){
              deleteUser($this)
            },
          })
        })

        $(document).on('click', '.modal', function(){
          $('.validateForm').removeClass('formadd')
          $('.validateForm').removeClass('formedit')
        })

        $(document).on('click', '[data-dismiss="modal"]', function(){
          $('.validateForm').removeClass('formadd')
          $('.validateForm').removeClass('formedit')
        })

        $(document).on('click', '.btn-add', function(){
          $('[name="id"]').val(null)
          console.log($('[name="id"]').val())
          $('.validateForm').trigger('reset')
          $('.validateForm').addClass('formadd')
          $('.validateForm').removeAttr('data-id')
            //add value to form example
            $('[name="field_1"]').val('f1')
            $('[name="field_2"]').val('f2')
            $('[name="field_3"]').val('f3')
            $('[name="field_4"]').val('f4')
            $('[name="created_by"]').val(1)
            $('.ls-select2').select2()
        })

        $(document).on('click', '.btn-edit', function(){
          var id = $(this).data('id')
          $('[name="id"]').val(id);
          console.log($('[name="id"]').val())
          var selector = $('.validateForm')
          selector.addClass('formedit')
          selector.find('[type="submit"]').removeAttr('data-id');
          selector.find('[type="submit"]').attr('data-id',id)
          $.ajax({
            type: 'get',
            url: rurl+'admin/example/'+id,
            dataType: "json",
            success: function (data) {
              Object.entries(data).forEach(entry => {
                $('[name="'+entry[0]+'"]').val(entry[1])
              });
              $('.modal').modal('show');
            },
            error: function (data) {
              toastr['error']('There was an error', data)
            }
          })
        })

        $(document).on('click', '.formadd [type="submit"]', function(){
          handleValidation()
        })

        $(document).on('click', '.formedit [type="submit"]', function(e){
          handleValidation()
        })
    }

    var handleToastrNotifs = function () {
      toastr.options = {
        'closeButton': true,
        'debug': false,
        'positionClass': 'toast-top-right',
        'onclick': null,
        'showDuration': '1000',
        'hideDuration': '1000',
        'timeOut': '5000',
        'extendedTimeOut': '1000',
        'showEasing': 'swing',
        'hideEasing': 'linear',
        'showMethod': 'fadeIn',
        'hideMethod': 'fadeOut'
      }
    }

    var deleteUser = function (value) {
      var id = value.data('id')
      var token = value.data('token')

      $.ajax({
        url: rurl+'admin/example/'+id,
        type: 'DELETE',
        data: {
          _method: 'delete',
          _token: token,
          _id : id
        },
        success: function (data) {
          toastr['success']('Example Deleted', 'Success')
          $("#example").DataTable().ajax.reload(null, false)
        },
        error: function (data) {
          toastr['error']('There was an error', data)
        }
      })
    }
  
    return {
      // main function to initiate the module
      init: function () {
        handleTables()
        handleButton()
        handleToastrNotifs()
      }
    }
  })()
  
  jQuery(document).ready(function () {
    Examples.init()
  })