<div id="login">

    <!--Banner Section-->
    <div id="banner" class="clear">
        <div class="wrapper content">
            <a href="https://www.ku.ac.ae">
                <img src="assets/images/logo.png" alt="" />
            </a>
            <div class="sub">
                <h1>Alumni KUcard</h1>
                <p>Reset Password</p>
            </div>
        </div>
    </div>

    <!--Form Section Start-->

    <div id="form_sec" class="clear">
        <div class="wrapper content">
            <form method="POST" action="" id="login-form">
                <input type="password" placeholder="Enter password" name="new_password" id="new_password">
                <input type="password" placeholder="Confirm password" name="confirm_password" id="confirm_password">
                <input type="submit" value="Reset Password">
            </form>
        </div>
    </div>
</div>

<!--Footer section start-->

<div id="footer_log" class="clear">
    <div class="wrapper content">
        <p><b>©Khalifa university.</b> All rights reserved.</p>
    </div>
</div>

<script>
    $("#login-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?= base_url('reset-password').'/'.$this->uri->segment(2) ?>",
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
                    $("#login-form")[0].reset();
                    setTimeout(function() {
                        window.location = "<?= base_url('login') ?>";
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