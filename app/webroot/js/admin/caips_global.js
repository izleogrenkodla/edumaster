var dataString = '';

function clearForm(form_id)
{
    $(form_id+ " .form-control").each(function() {
        $(this).val('');
    });
}

function insert_data(form_data, url, redirect_url, form_id, success, form_mode)
{
    dataString = form_data;
    $.ajax({
        type: "POST",
        url: JS_SITEURL+url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            if(data == 1){
                success.show().fadeOut(4000);
                if(form_mode == 'add') {
                    clearForm(form_id);
                }
                return true;
            } else {
                return false;
            }
        },
        beforeSend: function(){
            Metronic.blockUI({target: form_id, iconOnly: true});
        },
        error : function (xhr, textStatus, errorThrown) {
            //other stuff
        },
        complete : function (){
            Metronic.unblockUI(form_id);
        }
    });
    //form.submit();
    // $(form).ajaxSubmit();
}

function changed_status(element, path)
{
    var $this = element, url = path
    var mode = $($this).attr('data-mode');
    $.ajax({
        type: "POST",
        url: url,
        data: 'mode='+mode,
        dataType: "html",
        success: function(result) {
            if(result == 1){
                if(mode == 0) {
                    $($this).removeClass('green').addClass('red');
                    $($this).attr('data-mode', '1');
                    $($this).attr('data-original-title', 'Click Here To Active');
                    $($this).text('Inactive');

                } else if(mode == 1) {
                    $($this).removeClass('red').addClass('green');
                    $($this).attr('data-mode', '0');
                    $($this).attr('data-original-title', 'Click Here To Inactive');
                    $($this).text('Active');
                }
            }
        },
        beforeSend: function(){
            Metronic.blockUI({target: $($this).parent().parent().parent().parent().parent(), iconOnly: true});
        },
        error : function (xhr, textStatus, errorThrown) {
            //other stuff
        },
        complete : function (){
            Metronic.unblockUI($($this).parent().parent().parent().parent().parent());
        }
    });
}

function pay_commision(element, path)
{
    var $this = element, url = path
    var mode = $($this).attr('data-mode');
    $.ajax({
        type: "POST",
        url: url,
        data: 'mode='+mode,
        dataType: "html",
        success: function(result) {
            if(result == 1){
                if(mode == 0) {
                    $($this).removeClass('greenc').addClass('redc');
                    $($this).attr('data-mode', '1');
                    $($this).attr('data-original-title', 'Click Here To Active');
                    $($this).text('Un-Paid');

                } else if(mode == 1) {
                    $($this).removeClass('red').addClass('greenc');
                    $($this).removeAttr('onclick');
                    $($this).attr('data-mode', '0');
                    $($this).text('Paid');
                }
            }
        },
        beforeSend: function(){
            Metronic.blockUI({target: $($this).parent().parent().parent().parent().parent(), iconOnly: true});
        },
        error : function (xhr, textStatus, errorThrown) {
            //other stuff
        },
        complete : function (){
            Metronic.unblockUI($($this).parent().parent().parent().parent().parent());
        }
    });
}

function changed_cash_flow_status(element, path)
{
    var $this = element, url = path
    var mode = $($this).attr('data-mode');
    var $next = $($this).parent().next().children('button');
    $.ajax({
        type: "POST",
        url: url,
        data: 'mode='+mode,
        dataType: "html",
        success: function(result) {
            if(result == 1){
                if(mode == 0) {
                    $($this).removeClass('green').addClass('red');
                    $($this).attr('data-mode', '1');
                    $($this).attr('data-original-title', 'Click Here To Confirm');
                    $($this).text('Not Confirmed');

                    $($next).removeClass('green').addClass('red');
                    $($next).text('Not Received');

                } else if(mode == 1) {
                    $($this).removeClass('red').addClass('green').addClass('disable_link');
                    $($this).removeAttr('data-mode', '0');
                    $($this).removeAttr('data-original-title');
                    $($this).text('Confirmed');
                    $($this).removeAttr('onclick');
                    $($next).removeClass('red').addClass('green').addClass('disable_link');
                    $($next).text('Received');
                }
            }
        },
        beforeSend: function(){
            Metronic.blockUI({target: $($this).parent().parent().parent().parent().parent(), iconOnly: true});
        },
        error : function (xhr, textStatus, errorThrown) {
            //other stuff
        },
        complete : function (){
            Metronic.unblockUI($($this).parent().parent().parent().parent().parent());
        }
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_image_preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
        $('#profile_image_preview').show();
    }
}

function showConfirmDlg(message, url)
{
    var returnValue = window.showModalDialog("dialog.html",message,"dialogHeight:150px;dialogWidth:200px");

    if(returnValue == 'yes') {
        window.location.href = url;
    } else {
        return false;
    }
}

function yesnodialog(button1, button2, element){
    var btns = {};
    btns[button1] = function(){
        element.parents('li').hide();
        $(this).dialog("close");
    };
    btns[button2] = function(){
        // Do nothing
        $(this).dialog("close");
    };
    $("<div></div>").dialog({
        autoOpen: true,
        title: 'Condition',
        modal:true,
        buttons:btns
    });
}
$('.delete').on('click', function(){
    yesnodialog('Yes', 'No', $(this));
});


$("#photoupload").change(function(){
    readURL(this);
});

function printme(sec_id)
{  
	//alert("'"+sec_id+"'");
  /*var cnt=document.getElementById("user_table").innerHTML;*/
  /*var cnt=document.getElementById(""+sec_id+"").innerHTML;*/
  var cnt=document.getElementById(""+sec_id+"").outerHTML;  

  
  /*var prnt_cnt='<table id="user_table1" class="table table-striped table-bordered table-hover dataTable" aria-describedby="user_table_info">';*/
  var prnt_cnt = cnt;
  /*prnt_cnt += '</table>';*/

  var pw = window.open("");
  pw.document.open();
  pw.document.write(prnt_cnt);
  pw.print(); 	
  pw.document.close();
}

$(document).ready(function(){


    $('.delete_btn').attr('disabled', 'disabled');
    $('.checkboxes').change(function () {
        var sList = false;
        var set = ".dataTable .checkboxes";
        var checked = $(this).is(":checked");
        $(set).each(function () {
            if(this.checked) {
                sList = true;
            }
        });

        if (checked) {
            $(this).attr("checked", true);
            $('.delete_btn').removeAttr('disabled');
        } else {
            $(this).attr("checked", false);
            if(sList == false) {
                $('.delete_btn').attr('disabled', 'disabled');
            }
        }
        $.uniform.update(set);
    });

    // Hide Alert Messages
    var error = $('.alert-danger');
    var success = $('.alert-success');
    var AutError = $('#authMessage');
    setTimeout(function() {
        error.hide('slow');
        success.hide('slow');
        AutError.hide('slow');
    }, 4000);

    $('.add_more_button').click(function() {
        var upload_html = '<input type="file" name="data[Applicant][additional_doc][]" class="additional_upload">' +
            '<div class="fa-item col-md-1 col-sm-1 remove_upload"><i class="fa fa-times"></i></div>';
        $('.add_more_block ').append(upload_html);
    });

    $('.remove_upload').live('click', function() {
        $(this).prev().remove();
        $(this).remove();
    });

    // Submit Form On Press Enter Key
    $(function() {
        $('.form-horizontal').each(function() {
            $(this).find('input').keypress(function(e) {
                // Enter pressed?
                if(e.which == 10 || e.which == 13) {
                    $('button[type=submit]').trigger('click', function () {

                    });
                }
            });
        });
    });

    // Set Upload File Validation Image
    $("select#UserRoleId").on('change', function () {
        var agent_role_id = $(this).val();
    });

    $("select#ApplicantPaymentType").on('change', function () {
        var payment_mode = $(this).val();
        $('.hide_element').hide();
        $('.submit_btn').show();
        if(payment_mode == 1)
        {
            $('.submit_btn').hide();
            $('.paypal_element').show();
        } else if(payment_mode == 3)
        {
            $('.bank_element').show();
        }
    });



    $("select.trans_options").on('change', function () {
        var trans_way = $(this).val();
        $('.hide_bank').hide();
        $('.other_tran_mode').hide();
        if(trans_way == 1)
        {
            $('.hide_bank').show();
        } else if(trans_way == 4)
        {
            $('.other_tran_mode').show();
        }
    });

    $(".from_to_type").on('change', function () {
        var trans_way = $(this).val();
        $('.hidden_block').hide();
        $('.other_pay_option').hide();
        if(trans_way == 1)
        {
            $('.college_opt').show();
            $('.other_pay_option').show();
        } else if(trans_way == 2)
        {
            $('.agent_opt').show();
            $('.other_pay_option').show();
        } else if(trans_way == 3)
        {
            $('.direct_app_opt').show();
            $('.other_pay_option').show();
        }
    });

    $(".multiple_app").on('change', function () {
        var trans_way = $(this).val();
        $('.multiple_files').hide();
        if(trans_way != '')
        {
            $('.multiple_files').show();
            $('.other_pay_option').show();
        } else
        {
            $('.multiple_files').hide();
            $('.other_pay_option').hide();
        }
    });

    $(".payment_type").on('change', function () {
        var trans_way = $(this).val();
        $('.from_to_hide').hide();
        $('.multiple_files').hide();
        $('.hidden_block').hide();
        if(trans_way != '')
        {
            $('.from_to_hide').show();
        } else
        {
            $('.from_to_hide').hide();
        }
    });

    $(".direct_app_select").on('change', function () {
        var direct_app = $(this).val();
        $('.direct_app_profile_link').hide();
        if(direct_app != '')
        {
            $('.direct_app_profile_link').show();
        } else
        {
            $('.direct_app_profile_link').hide();
        }
    });

    $("select#SubscriptionSubscriptionTypeId").on('change', function () {
        var service_type = $(this).val();
        $('.hide_element').hide();
        if(service_type == 3)
        {
            $('.agent_show').show();
        } else if(service_type == 4)
        {
            $('.college_show').show();
        }
    });


    $("input[type=file]").change(function () {
        $(this).parents(".col-md-9").find(".IsUpload").val('1');
    });

    $("#photoupload").bind("change", function (event) {
        $(".IsUpload").val('1');
        return false;
    });

    $("#photodelete").bind("change", function (event) {
        $(".IsDelete").val('1');
        return false;
    });

    $(".IsDelete").change(function () {
        if (this.checked) {
            $(".IsDelete").val('1');
        } else {
            $(".IsDelete").val('0');
        }
    });

    $(".changed_date").datepicker({
        format: "dd-mm-yyyy"
    })
        .on('changeDate', function(ev){
            window.location.href = "?day=" + ev.format();
        });

    $("#filter_month").datepicker({
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months"
    })
        .on('changeDate', function(ev){
            window.location.href = "?day=" + ev.format();
        });

    $(function() {
        $(".multiselect").multiselect();
    });

    $.fn.multiselect = function() {
        $(this).each(function() {
            var checkboxes = $(this).find(".select_fees");
            checkboxes.each(function() {
                var checkbox = $(this);
                // Highlight pre-selected checkboxes
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");

                // Highlight checkboxes that the user selects
                checkbox.click(function() {
                    if (checkbox.prop("checked"))
                        checkbox.parent().addClass("multiselect-on");
                    else
                        checkbox.parent().removeClass("multiselect-on");
                });
            });
        });
    };
});