<div id="home">
	<div id="banner" class="clear">
		<div class="wrapper">
			<?php include 'navbar.php'; ?>

			<div class="dbl_blk_1 clear">
				<div class="left_blk inner">
					<h2>3rd UAE Anatomy and <br>Cellular Biology <br>Conference</h2>
				</div>
				<div class="right_blk inner">
					<img src="assets/images/acb-logo.png" alt="">
				</div>
			</div>

			<div class="dbl_blk_2 clear">
				<div class="left_blk inner">
					<a href="assets/Abstract 3rd UAE ACB -Template.docx" download="" class="abstract">Abstract submission</a>
					<a onclick="scrollToSection('register', 500)" class="registration">Registration</a>
				</div>
				<div class="right_blk inner">
					<div class="sec">
						<img src="assets/images/icons/calender.png" alt="">
						<p>Date</p>
					</div>
					<div class="sec">
						<h3>24-25</h3>
						<p>May, 2024</p>
					</div>
				</div>
			</div>
		</div>
	</div>
    <br class="px-80">

	<div id="register">
		<div class="wrapper">
            
        <div class="dbl_blk clear">
				<div class="left_blk inner">
					<h3 class="common-title">Export</h3>
				</div>
				<div class="right_blk inner">
                <form id="export-form" action="<?= current_url(); ?>" method="POST">
						<div class="main">
							<div class="blk">
								<label class="main-label" for="password">Password</label>
								<input type="password" name="password" id="password" required />
							</div>
                            <input class="submit" type="submit" id="submit-btn" />
                        </div>
                </form>
                </div>
        </div>
        </div>
    </div>
</div>

<script>
    $("#export-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);
        var actionUrl = form.attr('action');

        $.ajax({
            url: actionUrl,
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
                        type: 'green',
                        title: 'Downloding...',
                        content: 'File is being downloaded.',
                        autoClose: 'ok|1000',
                        useBootstrap: false,
                        boxWidth: '30%',
                        buttons: {
                            ok: function() {}
                        }
                    });
                    setTimeout(function() {
                        $("#export-form")[0].reset();
                        var $a = $("<a>");
                        $a.attr("href", data.file);
                        $("body").append($a);
                        $a.attr("download", data.file_name);
                        $a[0].click();
                        $a.remove();
                    }, 1000);
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