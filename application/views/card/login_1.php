<div id="login">

    <!--Banner Section-->
    <div id="banner" class="clear">
        <div class="wrapper content">
            <a href="https://www.ku.ac.ae">
                <img src="assets/images/logo.png" alt="" />
            </a>
            <div class="sub">
                <h1>Alumni KU Card</h1>
                <p>LOGIN</p>
            </div>
        </div>
    </div>

    <!--Form Section Start-->

    <div id="form_sec" class="clear">
        <div class="wrapper content">
            <form method="POST" action="" id="check-e-id">
                <input type="text" placeholder="Enter Emirates ID / KU ID" name="emirates_id" id="emirates_id" pattern="^[a-zA-Z0-9]+$" >
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
    $('#emirates_id').on('input', function() {
        var input = $(this).val();
        input = input.replace(/[^a-zA-Z0-9]/g, '');
        $(this).val(input);
    });

    $("#check-e-id").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "<?= base_url('login') ?>",
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