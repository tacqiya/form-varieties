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
                <input type="email" class="r_email" name="reg_email" required autocomplete="off">
            </div>

            <div class="field single">
                <label for="f_name">Full name:</label>
                <input type="text" class="f_name" name="full_name" required autocomplete="off" value="<?= ($user_details && $user_details->full_name) ? $user_details->full_name : ''; ?>">
            </div>

            <div class="field insert clear">
                <label>Insert your photo here:</label>
                <div class="blk">
                    <div class="img-upload">
                        <span class="text">Choose / Drag and drop your <br><b>profile picture</b></span>
                        <input type="file" class="photo" name="profile_photo" accept="image/png, image/gif, image/jpeg" required autocomplete="off">
                        <input type="hidden" name="profile_pic_org" value="" />
                        <img class="preview preview_profile" src="" />
                        <span class="preview-close"></span>
                    </div>
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label>Degree:</label>
                    <input type="text" name="degree" class="degree" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label>Major:</label>
                    <input type="text" name="major" class="major" required autocomplete="off" value="<?= ($user_details && $user_details->major) ? $user_details->major : ''; ?>">
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label>Degree graduation year:</label>
                    <input type="text" name="d_year" class="d_year" required autocomplete="off" value="<?= ($user_details && $user_details->graduation) ? $user_details->graduation : ''; ?>" readonly>
                </div>
                <div class="blk clear">
                    <label>Graduation institution:</label>
                    <input type="text" name="g_insti" class="g_insti" required autocomplete="off">
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label>Mobile:</label>
                    <input type="text" name="mobile" class="mobile" required autocomplete="off" value="<?= ($user_details && $user_details->mobile) ? $user_details->mobile : ''; ?>">
                </div>
                <div class="blk clear">
                    <label>Personal Email:</label>
                    <input type="email" name="personal_email" class="p_email" required autocomplete="off" value="<?= ($user_details && $user_details->p_email) ? $user_details->p_email : ''; ?>">
                </div>
            </div>

            <div class="field single clear">
                <label>LinkedIn Account : <span>(please type your username or paste your account URL here)</span></label>
                <input type="text" class="linkedin" name="linkd_in" required autocomplete="off">
            </div>

            <div class="field check clear">
                <label>Employment status:</label>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="1" value="Employed and satisfied" id="eas" name="e_status" required />
                            <label for="eas"></label>
                        </div>
                        <label class="label" for="eas">Employed and satisfied</label>
                    </div>

                    <div id="check_sub" class="emp_1 clear">
                        <div class="sub_single clear">
                            <label>Company name</label>
                            <input type="text" class="c_name" name="c_name" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label>Job Title</label>
                            <input type="text" class="j_title" name="j_title" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label>Your work email (optional)</label>
                            <input type="email" class="w_email" name="w_email" disabled>
                        </div>

                        <?php if ('show' != 'show') { ?>
                            <div class="sub_button clear">
                                <label>Work related to your field of study? </label>
                                <div class="sub_options clear">
                                    <div><input class="hidden radio-label" type="radio" name="work-study-1" id="work-yes-button" checked="checked" value="Yes" disabled required /><label class="button-label" for="work-yes-button">
                                            <h1>Yes</h1>
                                        </label><input class="hidden radio-label" type="radio" name="work-study-1" id="work-no-button" value="No" disabled required /><label class="button-label" for="work-no-button">
                                            <h1>No</h1>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="sub_single clear">
                            <label>Sector</label>
                            <input type="text" class="sector" name="sector" disabled required>
                        </div>

                        <div class="sub_button clear">
                            <label>Type </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="type-sec-1" id="full-button-1" checked value="Full-time" disabled required /><label class="button-label" for="full-button-1">
                                        <h1>Full-time</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-1" id="part-button-1" value="Part-time" disabled required /><label class="button-label" for="part-button-1">
                                        <h1>Part-time</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-1" id="traine-button-1" value="Graduate Trainee" disabled required /><label class="button-label" for="traine-button-1">
                                        <h1>Graduate Trainee</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-1" id="other-button-1" value="Other" disabled required /><label class="button-label" for="other-button-1">
                                        <h1>Other (Please specify)</h1>
                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_type_1" name="other_type_1" disabled required>
                                </div>
                            </div>
                        </div>

                        <div class="sub_button clear">
                            <label>Would you say the specialization you studied at KU is relevant to your business? </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="business-1" id="relevant-yes-button" checked="checked" value="Yes" disabled required /><label class="button-label" for="relevant-yes-button">
                                        <h1>Yes</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-1" id="relevant-no-button" value="No" disabled required /><label class="button-label" for="relevant-no-button">
                                        <h1>No</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-1" id="relevant-NotSure-button" value="Not sure" disabled required /><label class="button-label" for="relevant-NotSure-button">
                                        <h1>Not Sure</h1>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="2" value="Employed, but unsatisfied" id="ebu" name="e_status" required />
                            <label for="ebu"></label>
                        </div>
                        <label class="label" for="ebu">Employed, but unsatisfied</label>
                    </div>

                    <div id="check_sub" class="emp_2 clear">
                        <div class="sub_single clear">
                            <label>Company name</label>
                            <input type="text" class="c_name" name="c_name" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label>Your work email (optional)</label>
                            <input type="email" class="w_email" name="w_email" disabled>
                        </div>

                        <?php if ('show' != 'show') { ?>
                            <div class="sub_button clear">
                                <label>Work related to your field of study? </label>
                                <div class="sub_options clear">
                                    <div><input class="hidden radio-label" type="radio" name="field-2" id="field-2-1" checked="checked" value="Yes" disabled required /><label class="button-label" for="field-2-1">
                                            <h1>Yes</h1>
                                        </label><input class="hidden radio-label" type="radio" name="field-2" id="field-2-2" value="No" disabled required /><label class="button-label" for="field-2-2">
                                            <h1>No</h1>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="sub_single clear">
                            <label>Sector</label>
                            <input type="text" class="sector" name="sector" disabled required>
                        </div>

                        <div class="sub_button clear">
                            <label>Type </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="type-sec-2" id="full-button-2" checked="checked" value="Full-time" disabled required /><label class="button-label" for="full-button-2">
                                        <h1>Full-time</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-2" id="part-button-2" value="Part-time" disabled required /><label class="button-label" for="part-button-2">
                                        <h1>Part-time</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-2" id="traine-button-2" value="Graduate Trainee" disabled required /><label class="button-label" for="traine-button-2">
                                        <h1>Graduate Trainee</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-2" id="other-button-2" value="Other" disabled required /><label class="button-label" for="other-button-2">
                                        <h1>Other (Please specify)</h1>
                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_type_2" name="other_type_2" disabled required>
                                </div>
                            </div>
                        </div>

                        <div class="sub_button clear">
                            <label>Would you say the specialization you studied at KU is relevant to your business? </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="business-2" id="business-2-1" checked="checked" value="Yes" disabled required /><label class="button-label" for="business-2-1">
                                        <h1>Yes</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-2" id="business-2-2" value="No" disabled required /><label class="button-label" for="business-2-2">
                                        <h1>No</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-2" id="business-2-3" value="Not sure" disabled required /><label class="button-label" for="business-2-3">
                                        <h1>Not Sure</h1>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sub_single clear">
                            <label>Why you are not satisfied with your job? <i>Please specify</i></label>
                            <input type="text" class="satisfied" name="satisfied" disabled required>
                            <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
                        </div>

                    </div>
                </div>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="3" value="Self-Employed" id="se" name="e_status" required />
                            <label for="se"></label>
                        </div>
                        <label class="label" for="se">Self-Employed</label>
                    </div>

                    <div id="check_sub" class="emp_3 clear">
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
                                <div><input class="hidden radio-label" type="radio" name="special-3" id="special-3-1" checked="checked" value="Yes" disabled required /><label class="button-label" for="special-3-1">
                                        <h1>Yes</h1>
                                    </label><input class="hidden radio-label" type="radio" name="special-3" id="special-3-2" value="No" disabled required /><label class="button-label" for="special-3-2">
                                        <h1>No</h1>
                                    </label><input class="hidden radio-label" type="radio" name="special-3" id="special-3-3" value="Not sure" disabled required /><label class="button-label" for="special-3-3">
                                        <h1>Not Sure</h1>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="4" value="Unemployed and looking for a job" id="ual" name="e_status" required />
                            <label for="ual"></label>
                        </div>
                        <label class="label" for="ual">Unemployed and looking for a job</lable>
                    </div>

                    <div id="check_sub" class="emp_4 clear">
                        <div class="sub_button clear">
                            <label>Sector preference </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="preference-4" id="preference-4-1" checked="checked" value="Private" disabled required /><label class="button-label" for="preference-4-1">
                                        <h1>Private</h1>
                                    </label><input class="hidden radio-label" type="radio" name="preference-4" id="preference-4-2" value="Government" disabled required /><label class="button-label" for="preference-4-2">
                                        <h1>Government</h1>
                                    </label><input class="hidden radio-label" type="radio" name="preference-4" id="preference-4-3" value="Any" disabled required /><label class="button-label" for="preference-4-3">
                                        <h1>Any</h1>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="sub_single clear">
                            <label>Work Emirate Preference</label>
                            <input type="text" class="w_emirate" name="w_emirate" disabled required>
                        </div>

                        <div class="sub_button clear">
                            <label>What type of job you are looking for? </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="type-sec-4" id="full-button-4" checked="checked" value="Full-time" disabled required /><label class="button-label" for="full-button-4">
                                        <h1>Full-time</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-4" id="part-button-4" value="Part-time" disabled required /><label class="button-label" for="part-button-4">
                                        <h1>Part-time</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-4" id="traine-button-4" value="Graduate Trainee" disabled required /><label class="button-label" for="traine-button-4">
                                        <h1>Graduate Trainee</h1>
                                    </label><input class="hidden radio-label" type="radio" name="type-sec-4" id="other-button-4" value="Other" disabled required /><label class="button-label" for="other-button-4">
                                        <h1>Other (Please specify)</h1>
                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_type_4" name="other_type_4" disabled required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="5" value="Unemployed, but not looking for a job" id="ubnl" name="e_status" required />
                            <label class="label" for="ubnl"></label>
                        </div>
                        <label class="label" for="ubnl">Unemployed, but not looking for a job</label>
                    </div>

                    <div id="check_sub" class="emp_5 clear">

                        <div class="sub_button clear">
                            <label>Why are you not looking for a job? </label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-1" checked="checked" value="Children/Family Commitments" disabled required /><label class="button-label" for="looking-job-5-1">
                                        <h1>Children/Family Commitments</h1>
                                    </label><input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-2" value="Medical Reasons" disabled required /><label class="button-label" for="looking-job-5-2">
                                        <h1>Medical Reasons</h1>
                                    </label><input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-3" value="Personal Reasons" disabled required /><label class="button-label" for="looking-job-5-3">
                                        <h1>Personal Reasons</h1>
                                    </label><input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-4" value="Taking Time Out" disabled required /><label class="button-label" for="looking-job-5-4">
                                        <h1>Taking Time Out</h1>
                                    </label><input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-5" value="Volunteering" disabled required /><label class="button-label" for="looking-job-5-5">
                                        <h1>Volunteering</h1>
                                    </label><input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-6" value="National Service" disabled required /><label class="button-label" for="looking-job-5-6">
                                        <h1>National Service</h1>
                                    </label><input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-7" value="Other" disabled required /><label class="button-label" for="looking-job-5-7">
                                        <h1>Other (Please specify)</h1>
                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_look_job" name="other_look_job" disabled required>
                                </div>
                            </div>
                        </div>

                    </div>
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
    $(document).ready(function() {
        $(".d_year").datepicker({
            format: 'yyyy'
        });
    });


    $(document).on("change", ".img-upload input", function() {
        $imgPreview = $(this).siblings('.preview');
        readURL(this, $imgPreview);
        $imgPreview.show();
        $(this).siblings('.preview-close').show();
        $(this).parent().children('.text').css('display', 'none');
        $('#third_blk form .field.insert .blk span').css('background', 'none');
        $(this).parent().children('.preview').css('position', 'unset');
        $(this).siblings('.img-del-re').css('display', 'block');
        $(this).parent('.img-upload').css('height', 'auto');
    });

    function readURL(input, $imgPreview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $imgPreview.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }


    $('.emp_1 input:radio[name="type-sec-1"]').change(function() {
        if ($(this).prop("checked") && $(this).val() == 'Other') {
            $('.other_type_1').attr('disabled', false);
            $('.other_type_1').css('display', 'block');
        } else if ($(this).prop("checked") && $(this).val() != 'Other') {
            $('.other_type_1').attr('disabled', true);
            $('.other_type_1').css('display', 'none');
        }
    });

    $('.emp_2 input:radio[name="type-sec-2"]').change(function() {
        if ($(this).prop("checked") && $(this).val() == 'Other') {
            $('.other_type_2').attr('disabled', false);
            $('.other_type_2').css('display', 'block');
        } else if ($(this).prop("checked") && $(this).val() != 'Other') {
            $('.other_type_2').attr('disabled', true);
            $('.other_type_2').css('display', 'none');
        }
    });

    $('.emp_4 input:radio[name="type-sec-4"]').change(function() {
        if ($(this).prop("checked") && $(this).val() == 'Other') {
            $('.other_type_4').attr('disabled', false);
            $('.other_type_4').css('display', 'block');
        } else if ($(this).prop("checked") && $(this).val() != 'Other') {
            $('.other_type_4').attr('disabled', true);
            $('.other_type_4').css('display', 'none');
        }
    });

    $('.emp_5 input:radio[name="looking-job-5"]').change(function() {
        if ($(this).prop("checked") && $(this).val() == 'Other') {
            $('.other_look_job').attr('disabled', false);
            $('.other_look_job').css('display', 'block');
        } else if ($(this).prop("checked") && $(this).val() != 'Other') {
            $('.other_look_job').attr('disabled', true);
            $('.other_look_job').css('display', 'none');
        }
    });

    $("input:radio[name='e_status']").click(function() {
        id = $(this).attr('data-id');
        $('.emp_' + id + ' :input').attr('disabled', false);
        $(".emp_" + id).css('display', 'block');
        $('.others').attr('disabled', true);
        $('.others').css('display', 'none');
        id_array = [1, 2, 3, 4, 5];
        $.map(id_array, function(i) {
            if (id != i) {
                $('.emp_' + i + ' :input').attr('disabled', true);
                $(".emp_" + i).css('display', 'none');
            }
        });
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