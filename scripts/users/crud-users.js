
var FormValidation = function () {

    // validation using icons
    var handleValidation2 = function() {

        var form2 = $('#form_add');
        var error2 = $('.alert-danger', form2);
        var success2 = $('.alert-success', form2);

        form2.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                ausername: {
                    minlength: 3,
                    maxlength: 10,
                    required: true
                },
                apassword: {
                    minlength: 8,
                    required: true
                },
                arpass: {
                    minlength: 8,
                    required: true,
                    equalTo: "#apassword"
                }
            },
            messages: { arpass: { equalTo: "Password Does Not Match!" } },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success2.hide();
                error2.show();
                App.scrollTo(error2, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");
                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight

            },

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                success2.show();
                error2.hide();

                //===============================================================

                var acredential = $("#acredential");
                var ausername = $("#ausername");
                var apassword = $("#apassword");

                var btn = $(this);

                btn.attr('disabled', true);

                $.post('../clinic/includes/users/add_users.php', {

                    credentialtxt: acredential.val(),
                    usernametxt: ausername.val(),
                    passwordtxt: apassword.val()

                }, function (res) {

                    if (res.status == 'OK')
                    {
                        window.location.href = "user.php";
                    }
                    else
                    {
                        success2.hide();
                        error2.show();
                    }

                    btn.attr('disabled', false);

                }, 'json');

                //================================================================
            }
        });

    }

    var handleValidation3 = function() {

            var form3 = $('#form_update');
            var error2 = $('.alert-danger', form3);
            var success2 = $('.alert-success', form3);

            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    eusername: {
                        minlength: 3,
                        maxlength: 10,
                        required: true
                    },
                    epassword: {
                        minlength: 8,
                        required: true
                    },
                    erpass: {
                        minlength: 8,
                        required: true,
                        equalTo: "#epassword"
                    }
                },
                messages: { erpass: { equalTo: "Password Does Not Match!"} },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight

                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();

                    //===============================================================

                    var userID = $("#updateUserID");
                    var acredential = $("#ecredential");
                    var ausername = $("#eusername");
                    var apassword = $("#epassword");

                    var btn = $(this);

                    btn.attr('disabled', true);       

                    $.post('../clinic/includes/users/update_users.php', {

                        userID: userID.val(),
                        credentialtxt: acredential.val(),
                        usernametxt: ausername.val()

                    }, function (res) {
                        if (res.status == 'OK')
                        {
                            $.post('../clinic/includes/pass_input_checker.php', {

                                userID: userID.val(),
                                npasstxt: apassword.val()

                            }, function (res) {
                                if (res.status == 'OK')
                                {
                                    window.location.href = "user.php";
                                }
                                else
                                {
                                    success2.hide();
                                    error2.show();
                                }

                                btn.attr('disabled', false);

                            }, 'json');
                        }
                        else
                        {
                            success2.hide();
                            error2.show();
                        }

                        btn.attr('disabled', false);

                    }, 'json');

                    //================================================================
                }
            });

    }

    var handleValidation4 = function() {

            var form4 = $('#form_delete');
            var error2 = $('.alert-danger', form4);
            var success2 = $('.alert-success', form4);

            form4.validate({
                submitHandler: function (form) {
                    success2.show();
                    error2.hide();

                    //===============================================================

                    var userID = $("#deleteUserID");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../clinic/includes/users/delete_users.php', {

                        userid: userID.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            window.location.href = "user.php";
                        }
                        else
                        {
                            success2.hide();
                            error2.show();
                        }

                        btn.attr('disabled', false);

                    }, 'json');

                    //================================================================
                }
            });

    }

    return {
        //main function to initiate the module
        init: function () {

            handleValidation2();
            handleValidation3();
            handleValidation4();

        }

    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});