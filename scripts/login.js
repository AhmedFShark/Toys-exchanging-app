var Login = function() {

    var handleLogin = function() {

        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                username: {
                    minlength: 3,
                    required: true
                },
                password: {
                    required: true
                }
            },

            messages: {
                username: {
                    required: "Username required"
                },
                password: {
                    required: "Password required"
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
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

                $.post('../Masters/includes/access_input_checker.php', {
                        usertxt: $("#username").val(),
                        passtxt: $("#password").val()
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
                            document.getElementById('errmsg').innerHTML = res.status;
                            $('.alert-danger', $('.login-form')).show();
                        }
                        console.log(res.status);

                        btn.attr('disabled', true);

                    }, 'json');
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();

        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});