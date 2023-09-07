<!--Banner Section-->
<?php
$page = "index";
?>
<div id="banner" class="clear">
    <div class="wrapper content">
        <a href="https://www.ku.ac.ae">
            <img src="assets/images/logo.png" alt="" />
        </a>
        <div class="sub">
            <h1>Alumni KUcard</h1>
            <p>Request Form</p>
        </div>
    </div>
</div>

<!--Second blk start-->

<div id="second_blk" class="clear">
    <div class="wrapper content">
        <p>
            Only KU graduates can complete this form to request Alumni KU Card.
            If you are continuing further study at KU, please note that you are not eligible yet for this card.
            Kindly wait until you graduate. If you are an alumni and would like to apply for the card, you will need to register at KU Alumni Platform.
            If you are not registered already, Kindly register here; <a href="https://thekualumni.com/.">https://thekualumni.com/.</a> Card request will not be accepted unless you register in the Alumni Portal.
        </p>
    </div>
</div>

<!--Third blk start-->

<div id="third_blk" class="clear">
    <div class="wrapper content">
        <form method="POST" action="" id="submission-form">

            <div class="field single">
                <label for="r_email">Registered email at KU Alumni Platform:</label>
                <input type="text" class="r_email" name="reg_email" required autocomplete="off">
            </div>

            <div class="field single">
                <label for="f_name">Full name:</label>
                <input type="text" class="f_name" name="full_name" required autocomplete="off">
            </div>

            <div class="field insert clear">
                <label>Insert your photo here:</label>
                <div class="blk">
                    <span>Upload</span>
                    <input type="file" class="photo" name="profile_photo" accept="image/png, image/gif, image/jpeg" required autocomplete="off">
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label>Degree:</label>
                    <input type="text" name="degree" class="degree" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label>Major:</label>
                    <input type="text" name="major" class="major" required autocomplete="off">
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label>Degree graduation year:</label>
                    <input type="text" name="d_year" class="d_year" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label>Graduation institution:</label>
                    <input type="text" name="g_insti" class="g_insti" required autocomplete="off">
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label>Mobile:</label>
                    <input type="text" name="mobile" class="mobile" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label>Personal Email:</label>
                    <input type="email" name="personal_email" class="p_email" required autocomplete="off">
                </div>
            </div>

            <div class="field single clear">
                <label>LinkedIn Account : <span>(please type your username or paste your account URL here)</span></label>
                <input type="text" class="linkedin" name="linkd_in" required autocomplete="off">
            </div>

            <div class="field check clear">
                <label>Employment status:</label>

                <div class="blk blk_single clear">
                    <div class="checkbox">
                        <input type="radio" value="Employed and satisfied" id="eas" name="e_status" required />
                        <label for="eas"></label>
                    </div>
                    <label for="eas">Employed and satisfied</label>
                </div>

                <div class="blk blk_single clear">
                    <div class="checkbox">
                        <input type="radio" value="Employed, but unsatisfied" id="ebu" name="e_status" required />
                        <label for="ebu"></label>
                    </div>
                    <label for="ebu">Employed, but unsatisfied</label>
                </div>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" value="Self-Employed" id="se" name="e_status" required />
                            <label for="se"></label>
                        </div>
                        <label class="label" for="se">Self-Employed</label>
                    </div>

                    <div id="check_sub" class="clear">
                        <div class="sub_single clear">
                            <label>Company name</label>
                            <input type="text" class="c_name" name="c_name" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label>Industry</label>
                            <input type="text" class="industry" name="industry" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label>Your work email (optional)</label>
                            <input type="email" class="w_email" name="w_email" disabled>
                        </div>

                        <div class="sub_button clear">
                            <label>Would you say the specialization you studied at KU is relevant to your business? </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="business" id="yes-button" checked="checked" value="yes" disabled required /><label class="button-label" for="yes-button">
                                        <h1>Yes</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business" id="no-button" value="no" disabled required /><label class="button-label" for="no-button">
                                        <h1>No</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business" id="NotSure-button" value="not_sure" disabled required /><label class="button-label" for="NotSure-button">
                                        <h1>Not Sure</h1>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="blk blk_single clear">
                    <div class="checkbox">
                        <input type="radio" value="Unemployed and looking for a job" id="ual" name="e_status" required />
                        <label for="ual"></label>
                    </div>
                    <label for="ual">Unemployed and looking for a job</lable>
                </div>

                <div class="blk blk_single clear">
                    <div class="checkbox">
                        <input type="radio" value="Unemployed, but not looking for a job" id="ubnl" name="e_status" required />
                        <label for="ubnl"></label>
                    </div>
                    <label for="ubnl">Unemployed, but not looking for a job</label>
                </div>
            </div>

            <div class="submit">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>

<!--Social Media section start-->

<div id="social" class="clear">
    <div class="wrapper content">
        <div class="blks">
            <ul>
                <a href="https://www.facebook.com/khalifauniversity">
                    <li><img src="assets/images/icons/facebook.png" alt="" /></li>
                </a>
                <a href="https://www.youtube.com/user/KhalifaUniversity">
                    <li><img src="assets/images/icons/youtube.png" alt="" /></li>
                </a>
                <a href="https://twitter.com/KhalifaUni">
                    <li><img src="assets/images/icons/twitter.png" alt="" /></li>
                </a>
                <a href="https://www.instagram.com/khalifauniversity">
                    <li><img src="assets/images/icons/instagram.png" alt="" /></li>
                </a>
                <a href="https://www.linkedin.com/school/khalifa-university-/">
                    <li><img src="assets/images/icons/linkedin.png" alt="" /></li>
                </a>
            </ul>
        </div>
    </div>
</div>

<!--Footer section start-->

<div id="footer">
    <div class="wrapper content">
        <p><b>©Khalifa university.</b> All rights reserved.</p>
    </div>
</div>

<script>
    // $("#se").click(function() {
    //     if ($(this).is(":checked")) {
    //         $("#check_sub").css('display', 'block');
    //     } else if (!$(this).is(":checked")) {
    //         $("#check_sub").css('display', 'none');
    //     }
    // });
</script>



<script>
    $(document).ready(function() {
        $(".d_year").datepicker({
            format: 'yyyy'
        });
    });

    $('#submission-form input:radio[name="e_status"]').change(
        function() {
            if ($(this).prop("checked") && $(this).val() == 'Self-Employed') {
                $("#check_sub").css('display', 'block');
                $('#submission-form input[name=c_name]').prop("disabled", false);
                $('#submission-form input[name=c_name]').prop("required", true);
                $('#submission-form input[name=industry]').prop("disabled", false);
                $('#submission-form input[name=industry]').prop("required", true);
                $('#submission-form input[name=w_email]').prop("disabled", false);
                $('#submission-form input[name=business]').prop("disabled", false);
                $('#submission-form input[name=business]').prop("required", true);
            } else if ($(this).prop("checked") && $(this).val() != 'Self-Employed') {
                $("#check_sub").css('display', 'none');
                $('#submission-form input[name=c_name]').prop("disabled", true);
                $('#submission-form input[name=c_name]').prop("required", false);
                $('#submission-form input[name=industry]').prop("disabled", true);
                $('#submission-form input[name=industry]').prop("required", false);
                $('#submission-form input[name=w_email]').prop("disabled", true);
                $('#submission-form input[name=business]').prop("disabled", true);
                $('#submission-form input[name=business]').prop("required", false);
            }
        });

    $("#submission-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?= base_url() ?>",
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
                        type: 'success',
                        title: 'Success',
                        content: data['message'],
                        boxWidth: '30%',
                        useBootstrap: false,
                        buttons: {},
                    });
                    $("#submission-form")[0].reset();
                    setTimeout(function() {
                        window.location = "<?= base_url() ?>";
                    }, 1000);
                } else {
                    $.dialog({
                        type: 'error',
                        title: 'Failed',
                        content: data['message'],
                        boxWidth: '30%',
                        useBootstrap: false,
                    });
                }
            },
            error: function(error) {
                $.dialog({
                    type: 'error',
                    title: 'Failed',
                    content: 'Something went wrong',
                    boxWidth: '30%',
                    useBootstrap: false,
                });
            }
        });
    });
</script>