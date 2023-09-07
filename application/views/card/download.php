<?php include 'includes/header.php'; ?>


<div id="download">

    <!--Banner Section-->
    <div id="banner" class="clear">
        <div class="wrapper content">
        <a href="https://www.ku.ac.ae">
                <img src="assets/images/logo.png" alt="" />
            </a>
            <div class="sub">
                <h1>Alumni KUcard</h1>
                <p>Download</p>
            </div>
        </div>
    </div>

    <!--Form Section Start-->

    <div id="form_sec" class="clear">
        <div class="wrapper content">
            <form method="POST" action="<?= base_url('export') ?>" id="download-form">
                <input type="password" placeholder="Enter password" name="password" id="password">
                <input type="submit" value="Download">
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
    $("#download-form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?= base_url('export') ?>",
            type: "POST",
            dataType: "json",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (!data['error']) {
                    var $a = $("<a>");
                    $a.attr("href", data.file);
                    $("body").append($a);
                    $a.attr("download", data.file_name);
                    $a[0].click();
                    $a.remove();
                    $("#download-form")[0].reset();
                    // setTimeout(function() {
                    //     window.location = "<?= base_url() ?>";
                    // }, 1000);
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
            error: function (error) {
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