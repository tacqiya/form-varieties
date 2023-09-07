<!--Banner Section-->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/countrySelect/build/css/countrySelect.css">
<script src="<?= base_url() ?>assets/plugins/countrySelect/build/js/countrySelect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<?php
$page = "index";
?>

<div id="banner" class="clear">
    <div class="wrapper content">
        <a href="https://www.ku.ac.ae">
            <img src="assets/images/logo.png" alt="" />
        </a>
        <div class="sub">
            <h1>Alumni KU Card</h1>
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
                <label for="emiratesid">Emirates ID / Passport: <span class="required">*</span></label>
                <input type="text" name="emiratesid" id="emiratesid" value="<?= $registered_data->emiratesid ?>" pattern="^[a-zA-Z0-9]+$" required autocomplete="off" />
            </div>

            <div class="field single">
                <label for="ku_id">KU ID : <span>(Format: 1000XXXXX)</span> <span class="required">*</span></label>
                <input type="text" class="ku_id" name="ku_id" id="ku_id" value="<?= $registered_data->ku_id ?>" pattern="^[0-9]+$" required autocomplete="off">
            </div>

            <div class="upload-blk clear">
                <div class="left">
                    <h3 class="fileupload-h3">Upload your Emirates ID / Passport <span class="required" style="color: red;">*</span></h3>
                    <span class="out_span">(Upload the document here in <strong>pdf format</strong>.)</span>
                </div>

                <div class="upload clear">
                    <span>upload</span>
                    <label for="emirates_id_file" style="display: none;"></label>
                    <input type="file" class="input-file" name="emirates_id_file" id="emirates_id_file" <?= ($registered_data->emirates_id_file) ? '' : 'required'; ?> accept="application/pdf,.pdf">
                    <br><br>
                </div>
                <p class="emirates_id_uploaded_file"><?= ($registered_data) ? '<a href="' . base_url() . 'uploads/temp_ku_id/' . $registered_data->emirates_id_file . '" target="_blank">' . $registered_data->emirates_id_file . '</a>' : ''; ?></p>
            </div>

            <div class="field triple clear">
                <div class="blk clear">
                    <label for="first_name">First name: <span class="required">*</span></label><br><br>
                    <input type="text" class="first_name" id="first_name" name="first_name" value="<?= $registered_data->first_name ?>" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label for="middle_name">Middle name: <span class="required">*</span><br><span style="color: #7f7f7d; font-size: 14px;">(Please insert - if you don't have middle name)</span></label>
                    <input type="text" class="middle_name" id="middle_name" name="middle_name" value="<?= $registered_data->middle_name ?>" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label for="last_name">Last name: <span class="required">*</span></label><br><br>
                    <input type="text" class="last_name" id="last_name" name="last_name" value="<?= $registered_data->last_name ?>" required autocomplete="off">
                </div>
            </div>

            <label class="outer-label" for="">Profile picture: <span class="required">*</span> <span style="color: #7f7f7d;">(UAE national's photo should be in Ghutrah and Iqal)</span></label>
            <div class="field insert clear">
                <div class="preview-img-blk">
                    <img class="preview preview_profile" src="<?= ($registered_data->profile_photo) ? base_url() . 'uploads/' . $registered_data->profile_photo : ''; ?>" />
                </div>
                <div class="drop-blk">
                    <div class="img-upload">
                        <span class="text"><b>Choose an image</b> or drag & drop here</span>
                        <input type="file" class="photo" id="photo" name="profile_photo" accept="image/jpg, image/png, image/gif, image/jpeg" <?= ($registered_data->profile_photo) ? '' : 'required'; ?>>
                        <input type="hidden" class="profile_pic_org" name="profile_pic_org" value="" />
                        <!-- <img class="preview preview_profile" src="" /> -->
                        <span class="preview-close"></span>
                    </div>
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label for="degree">Degree: <span class="required">*</span></label>
                    <select name="degree" class="degree" id="degree" required>
                        <option value="">Select Degree</option>
                        <option value="Bachelor" <?= ($registered_data->degree == 'Bachelor') ? 'selected' : ''; ?>>Bachelor</option>
                        <option value="Master" <?= ($registered_data->degree == 'Master') ? 'selected' : ''; ?>>Master</option>
                        <option value="PhD" <?= ($registered_data->degree == 'PhD') ? 'selected' : ''; ?>>PhD</option>
                    </select>
                </div>
                <div class="blk clear">
                    <label for="major">Major: <span class="required">*</span></label>
                    <input type="text" name="major" class="major" value="<?= $registered_data->major ?>" required autocomplete="off">
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label for="d_year">Degree graduation year: <span class="required">*</span></label>
                    <input type="text" name="d_year" class="d_year" value="<?= $registered_data->d_year ?>" required autocomplete="off" readonly>
                </div>
                <div class="blk clear">
                    <label for="mobile">Mobile: <span class="required">*</span></label>
                    <input type="text" name="mobile" class="mobile" id="mobile" value="<?= $registered_data->mobile ?>" required autocomplete="off">
                    <!-- <input type="hidden" name="real_phone" class="real_phone" id="real_phone" value="<?= $registered_data->mobile ?>" autocomplete="off"> -->
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label for="personal_email">Personal Email: <span class="required">*</span></label>
                    <input type="email" name="personal_email" class="p_email" id="personal_email" value="<?= $registered_data->personal_email ?>" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label for="country">Country of Residence : <span class="required">*</span></label>
                    <input type="text" class="country" name="country" id="country" value="<?= $registered_data->country ?>" required autocomplete="off">
                </div>
            </div>

            <div class="field double clear">
                <div class="blk clear">
                    <label for="nationality">Nationality : <span class="required">*</span></label>
                    <input type="text" class="nationality" name="nationality" id="nationality" value="<?= $registered_data->nationality ?>" required autocomplete="off">
                </div>
                <div class="blk clear">
                    <label for="linkd_in">LinkedIn Account : <span class="required">*</span> <span style="color: #7f7f7d;">(Paste your account URL/link here)</span></label>
                    <input type="text" class="linkedin" name="linkd_in" id="linkd_in" value="<?= $registered_data->linkd_in ?>" required autocomplete="off">
                </div>
            </div>

            <div class="field check clear">
                <label>Employment status: <span class="required">*</span></label>

                <div class="blk blk_multiple clear">
                    <?php $other_none = ''; ?>
                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="1" value="Employed and satisfied" id="eas" name="e_status" required <?= ($registered_data && $registered_data->e_status == 'Employed and satisfied') ? 'checked' : ''; ?> />
                            <label for="eas"></label>
                        </div>
                        <label class="label" for="eas">Employed and satisfied</label>
                    </div>

                    <div id="check_sub" class="emp_1 clear" <?= ($registered_data && $registered_data->e_status == 'Employed and satisfied') ? 'style="display: block";' : ''; ?>>
                        <?php if ($registered_data && $registered_data->e_status == 'Employed and satisfied') {
                            $empsat = json_decode($registered_data->employment_details);
                            $first_check_selfe = '';
                        } else {
                            $first_check_selfe = 'checked';
                        } ?>
                        <div class="sub_single clear">
                            <label for="c_name">Company name <span class="required">*</span></label>
                            <input type="text" class="c_name" name="c_name" value="<?= (isset($empsat)) ? $empsat->c_name : ''; ?>" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label for="j_title">Job Title <span class="required">*</span></label>
                            <input type="text" class="j_title" name="j_title" value="<?= (isset($empsat)) ? $empsat->j_title : ''; ?>" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label for="w_email">Your work email (optional)</label>
                            <input type="email" class="w_email" name="w_email" value="<?= (isset($empsat)) ? $empsat->w_email : ''; ?>" disabled>
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
                            <label for="sector">Sector <span class="required">*</span></label>
                            <input type="text" class="sector" name="sector" value="<?= (isset($empsat)) ? $empsat->sector : ''; ?>" disabled required>
                        </div>

                        <div class="sub_button clear">
                            <label>Type <span class="required">*</span></label>
                            <?php $type_emp_1 = ['Full-time', 'Part-time', 'Graduate Trainee', 'Other']; ?>
                            <div class="sub_options clear">
                                <div>
                                    <?php $k = 1;
                                    foreach ($type_emp_1 as $job) {
                                        if (isset($empsat)) {
                                            if ($empsat->type_sec_1 == $job) {
                                                $checked = 'checked';
                                                $other_none = 'style="display: none;"';
                                            } else {
                                                $checked = '';
                                            }
                                        } else {
                                            if ($k == 1) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                        } ?>
                                        <input class="hidden radio-label" type="radio" name="type-sec-1" id="full-button-1-<?= $k ?>" <?= $checked ?> value="<?= $job ?>" disabled required /><label class="button-label" for="full-button-1-<?= $k ?>">
                                            <h1><?= $job ?></h1>
                                        </label>
                                    <?php $k++;
                                    } ?>

                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_type_1" name="other_type_1" value="<?= (isset($empsat->other_type_1)) ? $empsat->other_type_1 : ''; ?>" <?= $other_none ?> disabled required>
                                </div>
                            </div>
                        </div>

                        <div class="sub_button clear">
                            <label>Would you say the specialization you studied at KU is relevant to your business? <span class="required">*</span></label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="business-1" id="relevant-yes-button" checked="checked" <?= (isset($empsat) && $empsat->business_1 == 'Yes') ? 'checked' : ''; ?> <?= $first_check_selfe ?> value="Yes" disabled required /><label class="button-label" for="relevant-yes-button">
                                        <h1>Yes</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-1" id="relevant-no-button" <?= (isset($empsat) && $empsat->business_1 == 'No') ? 'checked' : ''; ?> value="No" disabled required /><label class="button-label" for="relevant-no-button">
                                        <h1>No</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-1" id="relevant-NotSure-button" <?= (isset($empsat) && $empsat->business_1 == 'Not sure') ? 'checked' : ''; ?> value="Not sure" disabled required /><label class="button-label" for="relevant-NotSure-button">
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
                            <input type="radio" data-id="2" value="Employed, but unsatisfied" id="ebu" name="e_status" required <?= ($registered_data && $registered_data->e_status == 'Employed, but unsatisfied') ? 'checked' : ''; ?> />
                            <label for="ebu"></label>
                        </div>
                        <label class="label" for="ebu">Employed, but unsatisfied</label>
                    </div>

                    <div id="check_sub" class="emp_2 clear" <?= ($registered_data && $registered_data->e_status == 'Employed, but unsatisfied') ? 'style="display: block";' : ''; ?>>
                        <?php if ($registered_data && $registered_data->e_status == 'Employed, but unsatisfied') {
                            $empunsat = json_decode($registered_data->employment_details);
                            $first_check_selfer = '';
                        } else {
                            $first_check_selfer = 'checked';
                        } ?>
                        <div class="sub_single clear">
                            <label for="c_name">Company name <span class="required">*</span></label>
                            <input type="text" class="c_name" name="c_name" value="<?= (isset($empunsat)) ? $empunsat->c_name : ''; ?>" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label for="w_email">Your work email (optional)</label>
                            <input type="email" class="w_email" name="w_email" value="<?= (isset($empunsat)) ? $empunsat->w_email : ''; ?>" disabled>
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
                            <label for="sector">Sector <span class="required">*</span></label>
                            <input type="text" class="sector" name="sector" value="<?= (isset($empunsat)) ? $empunsat->sector : ''; ?>" disabled required>
                        </div>

                        <div class="sub_button clear">
                            <?php $job_type_1 = ['Full-time', 'Part-time', 'Graduate Trainee', 'Other']; ?>
                            <label>Type <span class="required">*</span></label>
                            <div class="sub_options clear">
                                <div>
                                    <?php $j = 1;
                                    foreach ($job_type_1 as $job) {
                                        if (isset($empunsat)) {
                                            if ($empunsat->type_sec_2 == $job) {
                                                $checked = 'checked';
                                                $other_none = 'style="display: none;"';
                                            } else {
                                                $checked = '';
                                            }
                                        } else {
                                            if ($j == 1) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                        } ?>
                                        <input class="hidden radio-label" type="radio" name="type-sec-2" id="full-button-2-<?= $j ?>" <?= $checked ?> value="<?= $job ?>" disabled required /><label class="button-label" for="full-button-2-<?= $j ?>">
                                            <h1><?= $job ?></h1>
                                        </label>
                                    <?php $j++;
                                    } ?>
                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_type_2" name="other_type_2" value="<?= (isset($empunsat->other_type_2)) ? $empunsat->other_type_2 : ''; ?>" <?= $other_none ?> disabled required>
                                </div>
                            </div>
                        </div>

                        <div class="sub_button clear">
                            <label>Would you say the specialization you studied at KU is relevant to your business? <span class="required">*</span></label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="business-2" id="business-2-1" <?= (isset($empunsat) && $empunsat->business_2 == 'Yes') ? 'checked' : ''; ?> <?= $first_check_selfer ?> value="Yes" disabled required /><label class="button-label" for="business-2-1">
                                        <h1>Yes</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-2" id="business-2-2" <?= (isset($empunsat) && $empunsat->business_2 == 'No') ? 'checked' : ''; ?> value="No" disabled required /><label class="button-label" for="business-2-2">
                                        <h1>No</h1>
                                    </label><input class="hidden radio-label" type="radio" name="business-2" id="business-2-3" <?= (isset($empunsat) && $empunsat->business_2 == 'Not sure') ? 'checked' : ''; ?> value="Not sure" disabled required /><label class="button-label" for="business-2-3">
                                        <h1>Not Sure</h1>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sub_single clear">
                            <label for="satisfied">Why you are not satisfied with your job? <i>Please specify</i> <span class="required">*</span></label>
                            <input type="text" class="satisfied" name="satisfied" value="<?= (isset($empunsat)) ? $empunsat->satisfied : ''; ?>" disabled required>
                            <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
                        </div>

                    </div>
                </div>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="3" value="Self-Employed" id="se" name="e_status" required <?= ($registered_data && $registered_data->e_status == 'Self-Employed') ? 'checked' : ''; ?> />
                            <label for="se"></label>
                        </div>
                        <label class="label" for="se">Self-Employed</label>
                    </div>

                    <div id="check_sub" class="emp_3 clear" <?= ($registered_data && $registered_data->e_status == 'Self-Employed') ? 'style="display: block";' : ''; ?>>
                        <?php if ($registered_data && $registered_data->e_status == 'Self-Employed') {
                            $selfemp = json_decode($registered_data->employment_details);
                            $first_check_self = '';
                        } else {
                            $first_check_self = 'checked';
                        } ?>
                        <div class="sub_single clear">
                            <label for="c_name">Company name <span class="required">*</span></label>
                            <input type="text" class="c_name" name="c_name" value="<?= (isset($selfemp)) ? $selfemp->c_name : ''; ?>" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label for="industry">Industry <span class="required">*</span></label>
                            <input type="text" class="industry" name="industry" value="<?= (isset($selfemp)) ? $selfemp->industry : ''; ?>" disabled required>
                        </div>

                        <div class="sub_single clear">
                            <label for="w_email">Your work email (optional)</label>
                            <input type="email" class="w_email" name="w_email" value="<?= (isset($selfemp)) ? $selfemp->w_email : ''; ?>" disabled>
                        </div>

                        <div class="sub_button clear">
                            <label>Would you say the specialization you studied at KU is relevant to your business? <span class="required">*</span></label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="special-3" id="special-3-1" <?= (isset($selfemp) && $selfemp->special_3 == 'Yes') ? 'checked' : ''; ?> <?= $first_check_self ?> value="Yes" disabled required /><label class="button-label" for="special-3-1">
                                        <h1>Yes</h1>
                                    </label><input class="hidden radio-label" type="radio" name="special-3" id="special-3-2" value="No" <?= (isset($selfemp) && $selfemp->special_3 == 'No') ? 'checked' : ''; ?> disabled required /><label class="button-label" for="special-3-2">
                                        <h1>No</h1>
                                    </label><input class="hidden radio-label" type="radio" name="special-3" id="special-3-3" value="Not sure" <?= (isset($selfemp) && $selfemp->special_3 == 'Not sure') ? 'checked' : ''; ?> disabled required /><label class="button-label" for="special-3-3">
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
                            <input type="radio" data-id="4" value="Unemployed and looking for a job" id="ual" name="e_status" required <?= ($registered_data && $registered_data->e_status == 'Unemployed and looking for a job') ? 'checked' : ''; ?> />
                            <label for="ual"></label>
                        </div>
                        <label class="label" for="ual">Unemployed and looking for a job</lable>
                    </div>

                    <div id="check_sub" class="emp_4 clear" <?= ($registered_data && $registered_data->e_status == 'Unemployed and looking for a job') ? 'style="display: block";' : ''; ?>>
                        <div class="sub_button clear">
                            <?php if ($registered_data && $registered_data->e_status == 'Unemployed and looking for a job') {
                                $unemp = json_decode($registered_data->employment_details);
                                $first_check = '';
                            } else {
                                $first_check = 'checked';
                            } ?>
                            <label>Sector preference <span class="required">*</span></label>
                            <div class="sub_options clear">
                                <div><input class="hidden radio-label" type="radio" name="preference-4" id="preference-4-1" <?= (isset($unemp) && $unemp->preference_4 == 'Private') ? 'checked' : ''; ?> <?= $first_check ?> value="Private" disabled required /><label class="button-label" for="preference-4-1">
                                        <h1>Private</h1>
                                    </label><input class="hidden radio-label" type="radio" name="preference-4" id="preference-4-2" <?= (isset($unemp) && $unemp->preference_4 == 'Government') ? 'checked' : ''; ?> value="Government" disabled required /><label class="button-label" for="preference-4-2">
                                        <h1>Government</h1>
                                    </label><input class="hidden radio-label" type="radio" name="preference-4" id="preference-4-3" <?= (isset($unemp) && $unemp->preference_4 == 'Any') ? 'checked' : ''; ?> value="Any" disabled required /><label class="button-label" for="preference-4-3">
                                        <h1>Any</h1>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="sub_single clear">
                            <label for="w_emirate">Work Emirate Preference <span class="required">*</span></label>
                            <input type="text" class="w_emirate" name="w_emirate" value="<?= (isset($unemp)) ? $unemp->w_emirate : ''; ?>" disabled required>
                        </div>

                        <div class="sub_button clear">
                            <label>What type of job you are looking for? <span class="required">*</span></label>
                            <?php $job_type = ['Full-time', 'Part-time', 'Graduate Trainee', 'Other']; ?>
                            <div class="sub_options clear">
                                <div>
                                    <?php $j = 1;
                                    foreach ($job_type as $job) {
                                        if (isset($unemp)) {
                                            if ($unemp->type_sec_4 == $job) {
                                                $checked = 'checked';
                                                $other_none = 'style="display: none;"';
                                            } else {
                                                $checked = '';
                                            }
                                        } else {
                                            if ($j == 1) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                        } ?>
                                        <input class="hidden radio-label" type="radio" name="type-sec-4" id="full-button-4-<?= $j ?>" <?= $checked ?> value="<?= $job ?>" disabled required /><label class="button-label" for="full-button-4-<?= $j ?>">
                                            <h1><?= $job ?></h1>
                                        </label>
                                    <?php $j++;
                                    } ?>

                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_type_4" name="other_type_4" value="<?= (isset($unemp->other_type_4)) ? $unemp->other_type_4 : ''; ?>" <?= $other_none ?> disabled required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blk blk_multiple clear">

                    <div class="clear">
                        <div class="checkbox">
                            <input type="radio" data-id="5" value="Unemployed, but not looking for a job" id="ubnl" name="e_status" required <?= ($registered_data && $registered_data->e_status == 'Unemployed, but not looking for a job') ? 'checked' : ''; ?> />
                            <label class="label" for="ubnl"></label>
                        </div>
                        <label class="label" for="ubnl">Unemployed, but not looking for a job</label>
                    </div>

                    <div id="check_sub" class="emp_5 clear" <?= ($registered_data && $registered_data->e_status == 'Unemployed, but not looking for a job') ? 'style="display: block";' : ''; ?>>

                        <div class="sub_button clear">
                            <label>Why are you not looking for a job? <span class="required">*</span></label>
                            <div class="sub_options clear">
                                <?php
                                $looking_job_5 = ['Children/Family Commitments', 'Medical Reasons', 'Personal Reasons', 'Taking Time Out', 'Volunteering', 'National Service', 'Other'];
                                if ($registered_data && $registered_data->e_status == 'Unemployed, but not looking for a job') {
                                    $unemp_not = json_decode($registered_data->employment_details);
                                }
                                $checked = ''; ?>
                                <div>
                                    <?php $i = 1;
                                    foreach ($looking_job_5 as $look_job) {
                                        if (isset($unemp_not)) {
                                            if ($unemp_not->looking_job_5 == $look_job) {
                                                $checked = 'checked';
                                                $other_none = 'style="display: none;"';
                                            } else {
                                                $checked = '';
                                            }
                                        } else {
                                            if ($i == 1) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                        }
                                    ?>
                                        <input class="hidden radio-label" type="radio" name="looking-job-5" id="looking-job-5-<?= $i ?>" <?= $checked ?> value="<?= $look_job ?>" disabled required /><label class="button-label" for="looking-job-5-<?= $i ?>">
                                            <h1><?= $look_job ?></h1>
                                        </label>
                                    <?php $i++;
                                    } ?>
                                </div>
                                <div class="sub_single clear">
                                    <input type="text" class="others other_look_job" value="<?= (isset($unemp_not->other_look_job)) ? $unemp_not->other_look_job : ''; ?>" name="other_look_job" <?= $other_none ?> disabled required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="submit">
                <input type="submit" id="submit-btn" value="Submit">
            </div>
        </form>
    </div>
    <div class="wrapper instruct">
        ( If you face any issue in submitting the request, you can contact us at <a href="mailto:KUAlumni@ku.ac.ae"> KUAlumni@ku.ac.ae </a>)
    </div>
</div>


<div id="uploadimageModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crop Profile Image & Upload</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">

                        <button class="btn btn-success crop_image">Upload Image</button>
                    </div>
                </div>
            </div>

        </div>
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
        $("select option:first-child").attr("disabled", "true");
        $('.preview').css('width', '200px');
        $('.preview').css('height', '200px');

        <?php if ($registered_data->mobile) { ?>
            setTimeout(function() {
            $('#mobile').val('<?= $registered_data->mobile ?>');
        }, 1000);
        <?php } ?>

        $(".d_year").datepicker({
            format: 'yyyy',
            autoHide: true
        });

        $("#country").countrySelect({
            defaultCountry: "ae",
            responsiveDropdown: true
        });

        $("#nationality").countrySelect({
            defaultCountry: "ae",
            responsiveDropdown: true
        });

        <?php if ($registered_data && $registered_data->e_status == 'Employed and satisfied') { ?>
            $('.emp_1 :input').attr('disabled', false);
            <?php if (isset($empsat)) {
                if ($empsat->type_sec_1 != 'Other') { ?>
                    $('.other_type_1').attr('disabled', true);
                    $('.other_type_1').css('display', 'none');
                <?php } else { ?>
                    $('.other_type_1').attr('disabled', false);
                    $('.other_type_1').css('display', 'block');
            <?php }
            } ?>
        <?php } ?>
        <?php if ($registered_data && $registered_data->e_status == 'Employed, but unsatisfied') { ?>
            $('.emp_2 :input').attr('disabled', false);
            <?php if (isset($empunsat)) {
                if ($empunsat->type_sec_2 != 'Other') { ?>
                    $('.other_type_2').attr('disabled', true);
                    $('.other_type_2').css('display', 'none');
                <?php } else { ?>
                    $('.other_type_2').attr('disabled', false);
                    $('.other_type_2').css('display', 'block');
            <?php }
            } ?>
        <?php } ?>
        <?php if ($registered_data && $registered_data->e_status == 'Self-Employed') { ?>
            $('.emp_3 :input').attr('disabled', false);
        <?php } ?>
        <?php if ($registered_data && $registered_data->e_status == 'Unemployed and looking for a job') { ?>
            $('.emp_4 :input').attr('disabled', false);
            <?php if (isset($unemp)) {
                if ($unemp->type_sec_4 != 'Other') { ?>
                    $('.other_type_4').attr('disabled', true);
                    $('.other_type_4').css('display', 'none');
                <?php } else { ?>
                    $('.other_type_4').attr('disabled', false);
                    $('.other_type_4').css('display', 'block');
            <?php }
            } ?>
        <?php } ?>
        <?php if ($registered_data && $registered_data->e_status == 'Unemployed, but not looking for a job') { ?>
            $('.emp_5 :input').attr('disabled', false);
            <?php if (isset($unemp_not)) {
                if ($unemp_not->looking_job_5 != 'Other') { ?>
                    $('.other_look_job').attr('disabled', true);
                    $('.other_look_job').css('display', 'none');
                <?php } else { ?>
                    $('.other_look_job').attr('disabled', false);
                    $('.other_look_job').css('display', 'block');
            <?php }
            } ?>
        <?php } ?>

    });

    const phoneInputField = document.querySelector("#mobile");
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
    $('#mobile').on('change', function(e) {
        process(e);
        console.log(e);
    });

    function process(event) {
        event.preventDefault();
        const phoneNumber = phoneInput.getNumber();
        console.log(phoneInput);
        $('#mobile').val(`${phoneNumber}`);
    }

    // $(document).on("change", ".img-upload input", function() {

    //     // $imgPreview = $(this).siblings('.preview');
    //     // readURL(this, $imgPreview);
    //     // $imgPreview.show();
    //     // $(this).siblings('.preview-close').show();
    //     // $(this).parent().children('.text').css('display', 'none');
    //     // $('#third_blk form .field.insert .blk span').css('background', 'none');
    //     // $(this).parent().children('.preview').css('position', 'unset');
    //     // $(this).siblings('.img-del-re').css('display', 'block');
    //     // $(this).parent('.img-upload').css('height', 'auto');
    // });

    $('#emiratesid').on('input', function() {
        var input = $(this).val();
        input = input.replace(/[^a-zA-Z0-9]/g, '');
        $(this).val(input);
    });

    $('#ku_id').on('input', function() {
        var kuid = $(this).val();
        kuid = kuid.replace(/[^0-9]/g, '');
        if (kuid.length >= 4) {
            kuid_sub = kuid.substring(0, 4);
            if (kuid_sub != 1000) {
                $(this).val(kuid);
                $.dialog({
                    type: 'error',
                    title: 'Failed',
                    content: 'Invalid <b>KU ID</b> format',
                    boxWidth: '30%',
                    useBootstrap: false,
                });
                return false;
            } else {
                $(this).val(kuid);
            }
        } else {
            $(this).val(kuid);
        }
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

    $("#submit-btn").on("click", function() {
        // console.log($('#submission-form')[0]);
        var form = $('#submission-form')[0];
        var warnArray = [];
        var kuid = $('#ku_id').val();
        kuid = kuid.replace(/[^0-9]/g, '');
        if (kuid.length >= 1) {
            kuid_sub = kuid.substring(0, 4);
            if (kuid_sub != 1000) {
                $('#ku_id').val(kuid);
                $.dialog({
                    type: 'orange',
                    title: 'Failed',
                    content: 'Invalid <b>KU ID</b> format',
                    boxWidth: '30%',
                    useBootstrap: false,
                });
                return false;
            } else {
                $('#ku_id').val(kuid);
            }
        } else {
            $('#ku_id').val(kuid);
        }
        for (var i = 0; i < form.elements.length; i++) {
            // console.log(form.elements[i].name)
            if (form.elements[i].value === '' && form.elements[i].hasAttribute('required')) {
                if (!form.elements[i].hasAttribute('disabled')) {
                    if (form.elements[i].name == 'profile_photo') {
                        var cont = '<strong>Profile picture</strong> is required<br><br>';
                    } else if (form.elements[i].name == 'emirates_id_file') {
                        var cont = '<strong>Emirates ID / Passport file</strong> is required<br><br>';
                    } else if (form.elements[i].name == 'degree') {
                        var cont = '<strong>Degree</strong> is required<br><br>';
                    } else if (form.elements[i].name == 'other_look_job') {
                        var cont = '<strong>Other Reason</strong> is required<br><br>';
                    } else if (form.elements[i].name == 'other_type_4') {
                        var cont = '<strong>Other Type</strong> is required<br><br>';
                    } else if (form.elements[i].name == 'other_type_2') {
                        var cont = '<strong>Other Type</strong> is required<br><br>';
                    } else if (form.elements[i].name == 'other_type_1') {
                        var cont = '<strong>Other Type</strong> is required<br><br>';
                    } else {
                        var cont = '<strong>' + $('label[for="' + form.elements[i].name + '"]').text().replace('*', '').split(':')[0] + '</strong> is required<br><br>';
                    }
                    // console.log($('label[for="' + form.elements[i].name + '"]').length)
                    warnArray.push(cont);
                }
            }
        }
        if (cont) {
            $.dialog({
                type: 'orange',
                title: 'Warning',
                content: warnArray,
                boxWidth: '30%',
                useBootstrap: false,
            });
            // console.log(form.elements[i].name);
            // console.log(form.elements[i].closest('label'));
            return false;
        }
    });

    $("#submission-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "<?= base_url() . 'edit' ?>",
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
                        window.location = data['url'];
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


<script>
    // $(document).ready(function() {

    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 321.260,
            height: 306.142,
            type: 'square' //circle
        },
        boundary: {
            width: 400,
            height: 400
        }
    });

    $(document).on("change", ".img-upload input", function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
    });

    $('.crop_image').click(function(event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            encode = JSON.stringify(response);
            $.ajax({
                url: "<?= base_url('crop-image') ?>",
                type: "POST",
                data: {
                    "image": encode
                },
                success: function(data) {
                    $('#uploadimageModal').modal('hide');
                    $('.preview').attr('src', 'uploads/' + data);
                    $('.img-upload .profile_pic_org').val(data);
                    $('.preview').css('width', '200px');
                    $('.preview').css('height', '200px');
                    // $('.img-upload .preview').css('display', 'block');
                    // $(".img-upload input").siblings('.preview-close').show();
                    // $(".img-upload input").parent().children('.text').css('display', 'none');
                    // $('#third_blk form .field.insert .blk span').css('background', 'none');
                    // $(".img-upload input").parent().children('.preview').css('position', 'unset');
                    // $(".img-upload input").siblings('.img-del-re').css('display', 'block');
                    // $(".img-upload input").parent('.img-upload').css('height', 'auto');
                }
            });
        })
    });



    // });
</script>