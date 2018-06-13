/**
 * Created by admin on 5/12/14.
 */

function enable_cb() {
    if (this.checked) {
        //$(".submit").removeAttr("disabled");
        $(this).val('1');
    } else {
        //$(".submit").attr("disabled", 'disabled');
        $(this).val('0');
    }
}



$(document).ready(function(){
    // Hide Alert Messages
    var error = $('.alert-danger');
    var success = $('.alert-success');
    var AutError = $('#authMessage');
    setTimeout(function() {
        error.hide('slow');
        success.hide('slow');
        AutError.hide('slow');
    }, 4000);

    $('.close').click(function() {
        $(this).parent().hide('slow');
    });

    $('.add_more_button').click(function() {
        var upload_html = '<input type="file" name="data[User][additional_doc][]" class="additional_upload" required>' +
            '<div class="fa-item col-md-1 col-sm-1 remove_upload"><i class="fa fa-times"></i></div>';
        $('.add_more_block ').append(upload_html);
    });

    $('.add_more_block').on("click", ".remove_upload", function() {
        $(this).prev().remove();
        $(this).remove();
    });

    $(".agree").click(enable_cb);

    $(".reset").click(function() {
        $('.add_more_block').html('');
        var checkboxes = $(".multiselect").find(".select_fees");
        checkboxes.each(function() {
            var checkbox = $(this);

            checkbox.parent().removeClass("multiselect-on");
        });
    });

    // $(".submit").attr("disabled", 'disabled');

    // binds form submission and fields to the validation engine
    $("#UserRegisterForm").validationEngine();
    $("#UserLoginForm").validationEngine();
    $("#UserApplyNewForm").validationEngine();



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
