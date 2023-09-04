<?php $page = "submission_portal"; ?>

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqueryConfirm/css/jquery-confirm.custom.min.css" />
<script src="<?= base_url() ?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.js"></script>

<div id="submission_portal">
    <div id="banner">
        <div class="wrapper">
            <?php $this->load->view('submit_simple/navbar'); ?>
            <h1>Submission Portal</h1>
        </div>
    </div>

    <br class="px-80">

    <div id="submission">
        <div class="content wrapper">
            <h1>Submission portal</h1>

            <form class="clear" action="<?= base_url() ?>submission-portal" method="POST" id="register-form">
                <div class="blk-1">
                    <div class="single">
                        <label for="a_title"><span>Activity Title</span></label>
                        <input type="text" id="a_title" name="a_title" required>
                    </div>
                    <div class="single clear">
                        <label for="lead"><span>Lead Organization</span></label>
                        <input type="text" id="lead" name="lead" required>
                    </div>
                    <div class="single clear">
                        <label for="name"><span>Lead Applicant Name</span></label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="single clear">
                        <label for="email"><span>Lead Applicant Email</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="single clear">
                        <label for="budget"><span>Budget Requested <br><bdi>(up to AED 200,000)<bdi></span></label>
                        <input type="number" id="budget" name="budget" max="200000" required>
                    </div>
                </div>
                <div class="blk-2">
                    <div class="dbl_blk clear">
                        <div class="left_blk inner">
                            <h3>Proposal template</h3>
                            <span class="out_span">(Please use the Viggo’s Educational Grant Program proposal template which can be found in the <a href="call-documents">Call Documents</a> page. <strong>Size not exceed 5MB.</strong>)</span>
                            <p class="proposal_file_name"></p>
                        </div>
                        <div class="right_blk inner">
                            <div class="upload clear">
                                <span>upload</span>
                                <input type="file" class="input" name="preposal_file" id="preposal_file" required>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blk-3">
                    <div class="btns clear">
                        <input class="submit" type="button" name="save_form" id="save_form" value="Save" disabled style="cursor: not-allowed;">
                        <input class="submit" type="submit" name="submit" id="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <br class="px-80">

</div>

<script>
    $("#preposal_file").change(function() {
        var filename = $('input[type=file]').val().split('\\').pop();
        if (filename) {
            $('.proposal_file_name').text(filename);
        } else {
            $('.proposal_file_name').text('');
        }
    });

    $("#submit").on("click", function() {
        var form = $('#register-form')[0];
        var myFieldVar = $('#budget').attr('max');
        var warnArray = [];
        for (var i = 0; i < form.elements.length; i++) {
            if (form.elements[i].value === '' && form.elements[i].hasAttribute('required')) {
                if (form.elements[i].name == 'preposal_file') {
                    var cont = '<strong>Proposal Template</strong> is required<br><br>';
                } else {
                    var cont = '<strong>' + $('label[for="' + form.elements[i].name + '"]').text().replace('*', '') + '</strong> is required<br><br>';
                }
                warnArray.push(cont);
            }
        }
        if(myFieldVar > 200000) {
            var cont = '<strong>Budget</strong> only up to AED 200,000<br><br>';
            warnArray.push(cont);
        }
        if (cont) {
            $.dialog({
                type: 'orange',
                title: 'Warning',
                content: warnArray,
                boxWidth: '30%',
                useBootstrap: false,
            });
            return false;
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
            processData: false,
            contentType: false,
            async: false,
            success: function(data) {
                if (!data['error']) {
                    $.confirm({
                        type: 'green',
                        title: 'Success',
                        content: data['message'],
                        boxWidth: '30%',
                        useBootstrap: false,
                    });
                    $('#register-form')[0].reset();
                    $('.proposal_file_name').text('');
                } else {
                    $.dialog({
                        type: 'red',
                        title: 'Failed',
                        content: data['message'],
                        boxWidth: '30%',
                        useBootstrap: false,
                    });
                }
            },
            error: function(error) {
                $.dialog({
                    type: 'red',
                    title: 'Failed',
                    content: 'Something went wrong',
                    boxWidth: '30%',
                    useBootstrap: false,
                });
            }
        });
    });
</script>