<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/countrySelect/build/css/countrySelect.css">
<script src="<?= base_url() ?>assets/plugins/countrySelect/build/js/countrySelect.js"></script>

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
            <h1>Register Your Details</h1>
            <!-- <p>Details Form</p> -->
        </div>
    </div>
</div>



<!--Third blk start-->
<?php //echo "<pre>";print_r($user_data);exit; 
?>
<div id="third_blk" class="clear">
    <div class="wrapper content">
        <form method="POST" action="" id="register-form">

            <label class="outer-label" for="">Profile picture:</label>
            <div class="field insert clear">
                <div class="preview-img-blk">
                    <img class="preview preview_profile" src="<?= ($new_data && $new_data->profile_pic_org) ? base_url() . 'uploads/' . $new_data->profile_pic_org : ''; ?>" />
                </div>
                <div class="drop-blk">
                    <div class="img-upload">
                        <span class="text"><b>Choose an image</b> or drag & drop here</span>
                        <input type="file" class="photo" id="photo" name="profile_photo" accept="image/jpg, image/png, image/gif, image/jpeg" <?= ($new_data && $new_data->profile_pic_org) ? '' : 'required'; ?>>
                        <input type="hidden" class="profile_pic_org" name="profile_pic_org" value="" />
                        <!-- <img class="preview preview_profile" src="<?= ($new_data && $new_data->profile_pic_org) ? base_url() . 'uploads/' . $new_data->profile_pic_org : ''; ?>" /> -->
                        <span class="preview-close"></span>
                    </div>
                </div>
            </div>

            <div class="field single">
                <label for="ku_id">KU ID : <span>(Format: 1000123456)</span></label>
                <input type="text" class="ku_id" name="ku_id" id="ku_id" required autocomplete="off" value="<?= ($new_data) ? substr($new_data->ku_id, 0, 2) . '*****' . substr($new_data->ku_id, -2) : ($user_data ? substr($user_data->ku_id, 0, 2) . '*****' . substr($user_data->ku_id, -2) : ''); ?>">
            </div>

            <div class="field single">
                <label for="e_id">Emirates ID : <span>(Format: 784000123456789)</span></label>
                <input type="text" class="e_id" name="emirates_id" id="e_id" required autocomplete="off" value="<?= ($new_data) ? substr($new_data->emirates_id, 0, 3) . '********' . substr($new_data->emirates_id, -4) : ($user_data ? substr($user_data->emirates_id, 0, 3) . '********' . substr($user_data->emirates_id, -4) : ''); ?>">
            </div>

            <div class="field single">
                <label for="f_name">Full Name :</label>
                <input type="text" class="f_name" name="full_name" id="f_name" required autocomplete="off" value="<?= ($new_data) ? $new_data->full_name : ($user_data ? $user_data->student_name : ''); ?>">
            </div>

            <div class="field single">
                <label for="major">Major :</label>
                <input type="text" class="major" name="major" id="major" required autocomplete="off" value="<?= ($new_data) ? $new_data->major : ($user_data ? $user_data->major : ''); ?>">
            </div>

            <div class="field single">
                <label for="graduation">Year of Graduation :</label>
                <input type="text" class="graduation" name="graduation" id="graduation" required autocomplete="off" readonly value="<?= ($new_data) ? $new_data->graduation : ''; ?>">
            </div>

            <div class="field single">
                <label for="graduation">Country of Residence :</label>
                <input type="text" class="country" name="country" id="country" required value="<?= ($new_data) ? $new_data->country : ''; ?>">
            </div>

            <div class="field single">
                <label for="graduation">Nationality :</label>
                <input type="text" class="nationality" name="nationality" id="nationality" required value="<?= ($new_data) ? $new_data->nationality : ''; ?>">
            </div>

            <div class="field single">
                <label for="p_email">Personal Email :</label>
                <input <?= ($new_data) ? 'type="text"' : 'type="email"' ?> class="p_email" name="p_email" id="p_email" required autocomplete="off" value="<?= ($new_data) ? substr($new_data->p_email, 0, 3) . '***********' . substr($new_data->p_email, -5) : ''; ?>">
            </div>

            <div class="field single">
                <label for="mobile">Mobile :</label>
                <input type="text" class="mobile" name="mobile" id="mobile" required autocomplete="off" value="<?= ($new_data) ? substr($new_data->mobile, 0, 3) . '********' . substr($new_data->mobile, -3) : ''; ?>">
            </div>

            <input type="hidden" name="form_type" value="<?= ($user_data) ? $user_data->form_type : ($non_user_data ? $non_user_data->form_type : ''); ?>" />

            <div class="submit">
                <input type="submit" value="Submit">
            </div>
        </form>
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
        $(".graduation").datepicker({
            format: 'yyyy'
        });

        $("#country").countrySelect({
            defaultCountry: "ae",
            responsiveDropdown: true
        });

        $("#nationality").countrySelect({
            defaultCountry: "ae",
            responsiveDropdown: true
        });

        $("#country").on("change", function() {
            var countryData = $("#country").countrySelect("getSelectedCountryData");
            if (countryData['iso2'] == 'ae') {
                $('#e_id').prop('required',true);
            } else {
                $('#e_id').prop('required', false);
            }
        });

    });


    $("#register-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?= base_url('register-details') ?>",
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
                    $("#register-form")[0].reset();
                    setTimeout(function() {
                        window.location = "<?= base_url('enter-e-id') ?>";
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
            width: 200,
            height: 200,
            type: 'square' //circle
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $(document).on("change", ".img-upload input", function() {
        console.log('ara ara')
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