<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<style>
    .iti {
        width: calc(100% - 290px);
    }

    .iti input {
        width: 100% !important;
        padding-left: 50px !important;
    }

    .jconfirm .jconfirm-box .jconfirm-content {
        font-family: 'Montserrat', sans-serif;
    }

    .jconfirm .jconfirm-box div.jconfirm-title-c .jconfirm-title {
        font-family: 'PT Sans', sans-serif;
    }
</style>

<div class="content">
    <div class="wrapper clear">
        <h2>REGISTER WITH<br>BODY MUSEUM</h2>
        <img src="<?= base_url() ?>assets/images/about/abt_banner.png" alt="">
    </div>
</div>
</div>

<div id="second_blk">
    <div class="wrapper">
        <form class="register_form" action="<?= base_url('register'); ?>" method="POST" id="register-form">
            <div class="row single clear">
                <div class="num_visitors">
                    <div class="inner">
                        <h3>Number of Visitors</h3>
                        <input type="number" class="full" name="num_visit" id="num_visit" value="1" required autocomplete="off" />&nbsp&nbsp&nbsp&nbsp&nbsp
                        <h3>Date</h3>
                        <input type="date" class="full" min="<?= date('Y-m-d') ?>" style="width: 210px;" name="date_visit" id="date_visit" value="1" required autocomplete="off" />&nbsp&nbsp&nbsp&nbsp&nbsp
                        <h3>Time</h3>
                        <input type="time" class="full" style="width: 180px;" name="time_visit" id="time_visit" value="1" required autocomplete="off" />&nbsp&nbsp&nbsp&nbsp&nbsp
                    </div>
                </div>
                <p>*It is free to visit the Body Museum</p>
            </div>

            <div class="visitor_sec">
                <h3>Visitor 1</h3>
                <div class="row single clear">
                    <label class="full" for="name_1">Name <b>*</b></label>
                    <input type="text" class="full" name="name_1" id="name_1" required autocomplete="off" />
                </div>
                <div class="row single clear">
                    <label class="full" for="sur_name_1">Surname <b>*</b></label>
                    <input type="text" class="full" name="sur_name_1" id="sur_name_1" required autocomplete="off" />
                </div>
                <div class="row single clear">
                    <div class="blk clear">
                        <label class="full" for="mobile_1">Mobile No <b>*</b></label>
                        <input type="text" class="full" name="mobile_1" id="mobile_1" required autocomplete="off" />
                        <input type="hidden" class="real_phone_1" name="real_phone_1" id="real_phone_1" />
                    </div>
                </div>
                <div class="row single clear">
                    <label class="full" for="email_1">Email <b>*</b></label>
                    <input type="email" class="full" name="email_1" id="email_1" required autocomplete="off" />
                </div>
                <div class="row single clear">
                    <label class="full" for="emirates_id_1">Emirates ID / Passport <b>*</b></label>
                    <input type="file" class="full" name="emirates_id_1" id="emirates_id_1" required accept="image/png, image/jpeg, image/jpg, application/pdf" />
                    <b style="line-height: 3;" id="emirates_file_name" class="emirates_file_name"></b>
                </div>
            </div>

            <div id="visitor-details"></div>

            <div class="row single clear">
                <button type="submit" class="submit" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        const phoneInputField = document.querySelector("#mobile_1");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "ae",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "us";
                    callback(countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        $('#mobile_1').on('change', function(e) {
            process(e);
        });

        function process(event) {
            event.preventDefault();
            const phoneNumber = phoneInput.getNumber();
            $('#real_phone_1').val(`${phoneNumber}`);
        }
    });

    $("input[type=file]").change(function() {
        var filename = $(this).val().split('\\').pop();
        $(this).next('#emirates_file_name').text(filename);
    });

    $("#num_visit").on('change', function() {
        let visitors = $(this).val();
        var numItems = $('.visitor_sec').length;
        // console.log(numItems);
        // console.log(visitors);
        if (visitors < numItems) {
            let removeDiv = -(numItems - visitors);
            console.log(removeDiv);
            $('.visitor_sec').slice(removeDiv).remove();
        }
        $('.close').remove();
        for (var i = numItems; i < visitors; i++) {
            var k = i + 1;
            html = '<div class="visitor_sec" id="visitor_sec' + k + '">';
            if (k == visitors) {
                html += '<img src="<?= base_url() ?>assets/images/icons/close_btn.png" alt="" class="close">';
            }
            html += '<h3>Visitor ' + k + '</h3>' +
                '<div class="row single clear">' +
                '<label class="full" for="name_' + k + '">Name <b>*</b></label>' +
                '<input type="text" class="full" name="name_' + k + '" id="name_' + k + '" required autocomplete="off" />' +
                '</div>' +
                '<div class="row single clear">' +
                '<label class="full" for="sur_name_' + k + '">Surname <b>*</b></label>' +
                '<input type="text" class="full" name="sur_name_' + k + '" id="sur_name_' + k + '" required autocomplete="off" />' +
                '</div>' +
                '<div class="row single clear">' +
                '<div class="blk clear">' +
                '<label class="full" for="mobile_' + k + '">Mobile No <b>*</b></label>' +
                '<input type="text" class="full" name="mobile_' + k + '" id="mobile_' + k + '" required autocomplete="off" />' +
                '<input type="hidden" class="real_phone" name="real_phone_' + k + '" id="real_phone_' + k + '" />' +
                '</div>' +
                '</div>' +
                '<div class="row single clear">' +
                '<label class="full" for="email_' + k + '">Email <b>*</b></label>' +
                '<input type="email" class="full" name="email_' + k + '" id="email_' + k + '" required autocomplete="off" />' +
                '</div>' +
                '<div class="row single clear">' +
                '<label class="full" for="emirates_id_' + k + '">Emirates ID / Passport <b>*</b></label>' +
                '<input type="file" class="full" name="emirates_id_' + k + '" id="emirates_id_' + k + '" required accept="image/png, image/jpeg, image/jpg, application/pdf" />' +
                '<b style="line-height: 3;" id="emirates_file_name" class="emirates_file_name"></b>' +
                '</div>' +
                '</div>';
            $('#visitor-details').append(html);

            const phoneInputField = document.querySelector("#mobile_" + k);
            const phoneInput = window.intlTelInput(phoneInputField, {
                initialCountry: "ae",
                geoIpLookup: function(callback) {
                    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "us";
                        callback(countryCode);
                    });
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
            $('#mobile' + k).on('change', function(e) {
                process(e);
            });

            function process(event) {
                event.preventDefault();
                const phoneNumber = phoneInput.getNumber();
                $('#real_phone' + k).val(`${phoneNumber}`);
            }

        }

        if (visitors < numItems) {
            $('.visitor_sec:last').append('<img src="<?= base_url() ?>assets/images/icons/close_btn.png" alt="" class="close">');
        }

        $("input[type=file]").change(function() {
            var filename = $(this).val().split('\\').pop();
            $(this).next('#emirates_file_name').text(filename);
        });
    });

    $(document).on("click", ".close", function() {
        var numItems = $('.visitor_sec').length;
        var last_block = numItems - 1;
        $('#visitor_sec' + last_block).append('<img src="<?= base_url() ?>assets/images/icons/close_btn.png" alt="" class="close">');
        $(this).closest('.visitor_sec').remove();
        $('#num_visit').val(last_block);
    });

    $("#submit-btn").on("click", function() {
        var form = $('#register-form')[0];
        var warnArray = [];
        for (var i = 0; i < form.elements.length; i++) {
            if (form.elements[i].value === '' && form.elements[i].hasAttribute('required')) {
                console.log((form.elements[i].name).split('_')[0]);
                if ((form.elements[i].name).split('_')[0] == 'mobile' || (form.elements[i].name).split('_')[0] == 'email') {

                } else if(form.elements[i].name == 'date_visit') {
                    var cont = '<strong>Date</strong> is required<br><br>';
                    warnArray.push(cont);
                } else if(form.elements[i].name == 'time_visit') {
                    var cont = '<strong>Time</strong> is required<br><br>';
                    warnArray.push(cont);
                  }  else {
                    var cont = 'Visitor ' + (form.elements[i].id).split('_').pop() + ' <strong>' + $('label[for="' + form.elements[i].name + '"]').text().replace('*', '') + '</strong> is required<br><br>';
                    warnArray.push(cont);
                }
            }
        }
        if (cont) {
            $.dialog({
                type: 'orange',
                title: 'Warning',
                content: warnArray,
                boxWidth: ($(window).width() > 700) ? '30%' : '90%',
                useBootstrap: false,
            });
            return false;
        }
        // let visitors = $("#num_visit").val();
        var numItems = $('.visitor_sec').length;
        // console.log(numItems);
        for (var i = 1; i <= numItems; i++) {
            if ($('#mobile_' + i).attr('required') !== undefined) {
                console.log($('#mobile_' + i).attr('required'));
                if ($('#email_' + i).val().length !== 0) {
                    $('#mobile_' + i).removeAttr('required');
                } else {
                    if ($('#mobile_' + i).val().length !== 0) {
                        $('#email_' + i).removeAttr('required');
                    } else {
                        $.dialog({
                            type: 'orange',
                            title: 'Warning',
                            content: 'Fill either mobile number or email for Visitor ' + i,
                            boxWidth: ($(window).width() > 700) ? '30%' : '90%',
                            useBootstrap: false,
                        });
                        $('#mobile_' + i).scrollTop(300);
                        return false;
                    }
                }
                // console.log($('#mobile_' + i).val().length);

            }
            if ($('#email_' + i).attr('required') != undefined) {
                if ($('#email_' + i).val().length !== 0) {
                    $('#mobile_' + i).removeAttr('required');
                } else {
                    $.dialog({
                        type: 'orange',
                        title: 'Warning',
                        content: 'Fill either mobile number or email for Visitor ' + i,
                        boxWidth: ($(window).width() > 700) ? '30%' : '90%',
                        useBootstrap: false,
                    });
                    $('#email_' + i).scrollTop(300);
                    return false;
                }
            }
        }
    });

    $("#register-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);
        var actionUrl = form.attr('action');
        $.ajax({
            url: actionUrl,
            type: "POST",
            dataType: "json",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (!data['error']) {
                    $.confirm({
                        type: 'green',
                        title: 'Success',
                        content: data['message'],
                        boxWidth: ($(window).width() > 700) ? '30%' : '90%',
                        useBootstrap: false,
                        buttons: {
                            somethingElse: {
                                text: 'Copy booking id',
                                btnClass: 'btn-blue',
                                keys: ['enter', 'shift'],
                                action: function() {
                                    value_s = $('#refid').text();
                                    console.log(value_s);
                                    var $temp = $("<input>");
                                    $("body").append($temp);
                                    $temp.val(value_s).select();
                                    document.execCommand("copy");
                                    $temp.remove();
                                    $(".btn-blue").text('Copied');
                                    return false;
                                }
                            },
                            cancel: function() {},
                        },
                    });
                    $('#register-form')[0].reset();
                    $('#visitor-details').empty();
                    $('.emirates_file_name').text('');
                    // $(".refBtn").on("click", function() {
                    //     var $temp = $("#refid");
                    //     $("body").append($temp);
                    //     $temp.val($(element).text()).select();
                    //     document.execCommand("copy");
                    //     $temp.remove();
                    // });
                } else {
                    $.dialog({
                        type: 'red',
                        title: 'Failed',
                        content: data['message'],
                        boxWidth: ($(window).width() > 700) ? '30%' : '90%',
                        useBootstrap: false,
                    });
                }
            },
            error: function(error) {
                $.dialog({
                    type: 'red',
                    title: 'Failed',
                    content: 'Something went wrong',
                    boxWidth: ($(window).width() > 700) ? '30%' : '90%',
                    useBootstrap: false,
                });
            }
        });
    });
</script>