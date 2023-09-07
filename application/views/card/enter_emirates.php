<div id="login">

    <!--Banner Section-->
    <div id="banner" class="clear">
        <div class="wrapper content">
            <a href="https://www.ku.ac.ae">
                <img src="assets/images/logo.png" alt="" />
            </a>
            <div class="sub">
                <h1>Alumni KUcard</h1>
                <p>Enter Emirates ID</p>
            </div>
        </div>
    </div>

    <!--Form Section Start-->

    <div id="form_sec" class="clear">
        <div class="wrapper content">
            <form method="POST" action="" id="check-e-id">
                <input type="text" placeholder="Enter Emirates ID / KU ID" name="emirates_id" id="emirates_id">
                <input type="submit" value="Submit">
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
    $("#check-e-id").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?= base_url('enter-e-id') ?>",
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
                    $("#check-e-id")[0].reset();
                    if(data['status'] == 'unregistered') {
                        setTimeout(function() {
                        window.location = "<?= base_url('unregister-details') ?>";
                    }, 1000);
                    } else {
                        setTimeout(function() {
                        window.location = "<?= base_url('register-details') ?>";
                    }, 1000);
                    }
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