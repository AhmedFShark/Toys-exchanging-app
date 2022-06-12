var FormValidation = function () {

    // validation using icons
    var addValidation = function() {

        var add_form = $('#form_add');
        var error = $('.alert-danger', add_form);
        var success = $('.alert-success', add_form);
        var ere = $('#ere');
        var suc = $('#suc');


        add_form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                asn: {
                    maxlength: 4,
                    required: true
                },
                amodel: {
                    required: true
                },
                adsize: {
                    required: true
                },
                adres: {
                    required: true
                },
                adtype: {
                    required: true
                },
                aram: {
                    maxlength: 3,
                    digits: true,
                    required: true
                },
                acpu: {
                    maxlength: 2,
                    digits: true,
                    required: true
                },
                agen: {
                    maxlength: 2,
                    digits: true,
                    required: true
                },
                ahd1: {
                    maxlength: 3,
                    digits: true,
                    required: true
                },
                ahd2: {
                    maxlength: 3,
                    digits: true
                },
                aistock: {
                    maxlength: 4,
                    digits: true,
                    required: true
                },
                awprice: {
                    digits: true,
                    required: true
                },
                asprice: {
                    digits: true,
                    required: true
                },
                afsprice: {
                    digits: true,
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success.hide();
                error.show();
                App.scrollTo(error, -200);
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
                success.show();
                error.hide();

                //===============================================================

                var asn = $("#asn");
                var amodel = $("#amodel");
                var adsize = $("#adsize");
                var adres = $("#adres");
                var adtype = $("#adtype");
                var aram = $("#aram");
                var acpu = $("#acpu");
                var agen = $("#agen");
                var agput = $("#agput");
                var agpus = $("#agpus");
                var ahd1 = $("#ahd1");
                var ahd1s = $("#ahd1s");
                var ahd2 = $("#ahd2");
                var ahd2s = $("#ahd2s");
                var aod = document.getElementById("aod").checked;
                var ahdmi = document.getElementById("ahdmi").checked;
                var avga = document.getElementById("avga").checked;
                var acreader = document.getElementById("acreader").checked;
                var aelan = document.getElementById("aelan").checked;
                var ajack = document.getElementById("ajack").checked;
                var afprint = document.getElementById("afprint").checked;
                var acam = document.getElementById("acam").checked;
                var alitkey = document.getElementById("alitkey").checked;
                var aistock = $("#aistock");
                var awprice = $("#awprice");
                var asprice = $("#asprice");
                var afsprice = $("#afsprice");
                var ades = $("#ades");

                var btn = $(this);
                btn.attr('disabled', true);

                $.post('../Masters/includes/toys/add_toys.php', {

                    asntxt: asn.val(),
                    amodeltxt: amodel.val(),
                    adsizetxt: adsize.val(),
                    adrestxt: adres.val(),
                    adtypesel: adtype.val(),
                    aramtxt: aram.val(),
                    acputxt: acpu.val(),
                    agentxt: agen.val(),
                    agputtxt: agput.val(),
                    agpustxt: agpus.val(),
                    ahd1txt: ahd1.val(),
                    ahd1ssel: ahd1s.val(),
                    ahd2txt: ahd2.val(),
                    ahd2ssel: ahd2s.val(),
                    aodcb: aod,
                    ahdmicb: ahdmi,
                    avgacb: avga,
                    acreadercb: acreader,
                    aelancb: aelan,
                    ajackcb: ajack,
                    afprintcb: afprint,
                    acamcb: acam,
                    alitkeycb: alitkey,
                    aistocktxt: aistock.val(),
                    awpricetxt: awprice.val(),
                    aspricetxt: asprice.val(),
                    afspricetxt: afsprice.val(),
                    adestxt: ades.val()

                }, function (res) {
                    if (res.status == 'OK') {
                        var formData = new FormData();
                        formData.append("userfile", aphoto.files[0]);
                        formData.append("toymodel", $("#amodel").val());

                        var filereq = new XMLHttpRequest();

                        filereq.open("POST", "../Masters/uploads/add_toy_photo.php");
                        filereq.send(formData);

                        filereq.onreadystatechange = function()
                        {
                            if (filereq.readyState == 4 && filereq.status == 200) {
                                location.reload();
                            }
                            else {
                                success.hide();
                                error.show();
                            }
                        }
                    }
                    else
                    {
                        success.hide();
                        error.show();
                    }
                    btn.attr('disabled', false);

                }, 'json');

            }
        });

    }

    var updateValidation = function() {

            var update_form = $('#form_update');
            var error = $('.alert-danger', update_form);
            var success = $('.alert-success', update_form);

            update_form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    esn: {
                        maxlength: 4,
                        required: true
                    },
                    emodel: {
                        required: true
                    },
                    edsize: {
                        required: true
                    },
                    edres: {
                        required: true
                    },
                    edtype: {
                        required: true
                    },
                    eram: {
                        maxlength: 3,
                        digits: true,
                        required: true
                    },
                    ecpu: {
                        maxlength: 2,
                        digits: true,
                        required: true
                    },
                    egen: {
                        maxlength: 2,
                        digits: true,
                        required: true
                    },
                    ehd1: {
                        maxlength: 3,
                        digits: true,
                        required: true
                    },
                    ehd2: {
                        maxlength: 3,
                        digits: true
                    },
                    eistock: {
                        maxlength: 4,
                        digits: true,
                        required: true
                    },
                    ewprice: {
                        digits: true,
                        required: true
                    },
                    esprice: {
                        digits: true,
                        required: true
                    },
                    efsprice: {
                        digits: true,
                        required: true
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
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
                    success.show();
                    error.hide();

                    //===============================================================

                    var toyID = $("#updateToyID");
                    var asn = $("#esn");
                    var amodel = $("#emodel");
                    var adsize = $("#edsize");
                    var adres = $("#edres");
                    var adtype = $("#edtype");
                    var aram = $("#eram");
                    var acpu = $("#ecpu");
                    var agen = $("#egen");
                    var agput = $("#egput");
                    var agpus = $("#egpus");
                    var ahd1 = $("#ehd1");
                    var ahd1s = $("#ehd1s");
                    var ahd2 = $("#ehd2");
                    var ahd2s = $("#ehd2s");
                    var aod = document.getElementById("eod").checked;
                    var ahdmi = document.getElementById("ehdmi").checked;
                    var avga = document.getElementById("evga").checked;
                    var acreader = document.getElementById("ecreader").checked;
                    var aelan = document.getElementById("eelan").checked;
                    var ajack = document.getElementById("ejack").checked;
                    var afprint = document.getElementById("efprint").checked;
                    var acam = document.getElementById("ecam").checked;
                    var alitkey = document.getElementById("elitkey").checked;
                    var aistock = $("#eistock");
                    var awprice = $("#ewprice");
                    var asprice = $("#esprice");
                    var afsprice = $("#efsprice");
                    var ades = $("#edes");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../Masters/includes/toys/update_toys.php', {

                        toyID: toyID.val(),
                        asntxt: asn.val(),
                        amodeltxt: amodel.val(),
                        adsizetxt: adsize.val(),
                        adrestxt: adres.val(),
                        adtypesel: adtype.val(),
                        aramtxt: aram.val(),
                        acputxt: acpu.val(),
                        agentxt: agen.val(),
                        agputtxt: agput.val(),
                        agpustxt: agpus.val(),
                        ahd1txt: ahd1.val(),
                        ahd1ssel: ahd1s.val(),
                        ahd2txt: ahd2.val(),
                        ahd2ssel: ahd2s.val(),
                        aodcb: aod,
                        ahdmicb: ahdmi,
                        avgacb: avga,
                        acreadercb: acreader,
                        aelancb: aelan,
                        ajackcb: ajack,
                        afprintcb: afprint,
                        acamcb: acam,
                        alitkeycb: alitkey,
                        aistocktxt: aistock.val(),
                        awpricetxt: awprice.val(),
                        aspricetxt: asprice.val(),
                        afspricetxt: afsprice.val(),
                        adestxt: ades.val()

                    }, function (res) {

                        if (res.status == 'OK')
                            {
                                var formData = new FormData();
                                formData.append("userfile", ephoto.files[0]);
                                formData.append("toyID", $("#updateToyID").val());

                                var filereq = new XMLHttpRequest();

                                filereq.open("POST", "../Masters/uploads/update_toy_photo.php");
                                filereq.send(formData);

                                filereq.onreadystatechange = function()
                                {
                                    if (filereq.readyState == 4 && filereq.status == 200) {
                                        location.reload();
                                    }
                                    else {
                                        success.hide();
                                        error.show();
                                    }
                                }
                            }
                        else
                        {
                            success.hide();
                            error.show();
                        }

                        btn.attr('disabled', false);

                    }, 'json');

                    //================================================================
                }
            });

    }

    var deleteValidation = function() {

            var delete_form = $('#form_delete');
            var error = $('.alert-danger', delete_form);
            var success = $('.alert-success', delete_form);

            delete_form.validate({
                submitHandler: function (form) {
                    success.show();
                    error.hide();

                    //===============================================================

                    var toyID = $("#deleteToyID");

                    var btn = $(this);

                    btn.attr('disabled', true);

                    $.post('../Masters/includes/toys/delete_toys.php', {

                        toyid: toyID.val()

                    }, function (res) {

                        if (res.status == 'OK')
                        {
                            var formData = new FormData();
                            formData.append("toyID", $("#deleteToyID").val());

                            var filereq = new XMLHttpRequest();

                            filereq.open("POST", "../Masters/uploads/delete_toy_photo.php");
                            filereq.send(formData);

                            filereq.onreadystatechange=function()
                            {
                                if (filereq.readyState == 4 && filereq.status == 200) {
                                    location.reload();
                                }
                            }
                        }
                        else
                        {
                            success.hide();
                            error.show();
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
            addValidation();
            updateValidation();
            deleteValidation();
        }
    };

}();

jQuery(document).ready(function() {
    FormValidation.init();
});
