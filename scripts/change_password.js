var ChangePassword = function() {

    var handleChangePassword = function() {

        $('.change_password-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                npassword: {
                    minlength: 8,
                    required: true
                },
                rpassword: {
                    minlength: 8,
                    required: true,
                    equalTo: "#npassword"
                }
            },

            messages: {
                npassword: {
                    required: "New Password required"
                },
                rpassword: {
                    required: "Repeat Password required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.change_password-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                var btn = $(this);
                btn.attr('disabled', true);
                
                $.post('../clinic/includes/pass_input_checker.php', {
                        npasstxt: $("#npassword").val()
                        //robottxt: grecaptcha.getResponse()
                    }, function (res) {
                        if (res.status == 'OK')
                        {
                            // window.location.href = "index.php";
                            form.submit();
                        }
                        else
                        {
                            //grecaptcha.reset();
                            $("#npassword").val('');
                            $("#rpassword").val('');
                            $('.alert-danger', $('.change_password-form')).show();
                        }

                        btn.attr('disabled', true);

                    }, 'json');
            }
        });

        // $('.change_password-form input').keypress(function(e) {
        //     // if (e.which == 13) {
        //     //     if ($('.change_password-form').validate().form()) {
        //     //     }
        //         return false;
        //     }
        // });
    }

    return {
        //main function to initiate the module
        init: function() {

            handleChangePassword();

        }

    };

}();

jQuery(document).ready(function() {
    ChangePassword.init();
});