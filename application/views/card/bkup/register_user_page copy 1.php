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
<?php //echo "<pre>";print_r($user_data);exit; ?>
<div id="third_blk" class="clear">
    <div class="wrapper content">
        <form method="POST" action="" id="register-form">

            <div class="field single">
                <label for="ku_id">KU ID :</label>
                <input type="text" class="ku_id" name="ku_id" id="ku_id" required autocomplete="off" value="<?= ($new_data) ? $new_data->ku_id : ( $user_data ? $user_data->ku_id : '') ; ?>" >
            </div>

            <div class="field single">
                <label for="e_id">Emirates ID :</label>
                <input type="text" class="e_id" name="emirates_id" id="e_id" required autocomplete="off" value="<?= ($new_data) ? $new_data->emirates_id : ( $user_data ? $user_data->emirates_id : '') ; ?>" >
            </div>

            <div class="field single">
                <label for="f_name">Full Name :</label>
                <input type="text" class="f_name" name="full_name" id="f_name" required autocomplete="off" value="<?= ($new_data) ? $new_data->full_name : ( $user_data ? $user_data->student_name : '') ; ?>" >
            </div>

            <div class="field single">
                <label for="major">Major :</label>
                <input type="text" class="major" name="major" id="major" required autocomplete="off" value="<?= ($new_data) ? $new_data->major : ( $user_data ? $user_data->major : '') ; ?>" >
            </div>

            <div class="field single">
                <label for="graduation">Year of Graduation :</label>
                <input type="text" class="graduation" name="graduation" id="graduation" required autocomplete="off" readonly value="<?= ($new_data) ? $new_data->graduation : ''; ?>" >
            </div>

            <div class="field single">
                <label for="p_email">Personal Email :</label>
                <input type="email" class="p_email" name="p_email" id="p_email" required autocomplete="off" value="<?= ($new_data) ? $new_data->p_email : ''; ?>" >
            </div>

            <div class="field single">
                <label for="mobile">Mobile :</label>
                <input type="text" class="mobile" name="mobile" id="mobile" required autocomplete="off" value="<?= ($new_data) ? $new_data->mobile : ''; ?>" >
            </div>

            <input type="hidden" name="form_type" value="<?= ($user_data) ? $user_data->form_type : ( $non_user_data ? $non_user_data->form_type : '') ; ?>" />

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
        $(".graduation").datepicker({
            format: 'yyyy'
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