<div id="navbar">
    <div class="dbl-blk clear">
        <div class="left_blk">
            <div class="logos clear">
                <div class="img">
                    <img src="<?= base_url() ?>assets/images/ku-logo.png" style="width: 173px;" alt="">
                </div>
                <div class="img">
                    <img src="<?= base_url() ?>assets/images/health-logo.png" style="width: 197px;" alt="">
                </div>
            </div>
        </div>
        <div class="right_blk">
            <div class="content clear">
                <h3>Grant Program</h3>
                <div id="btn-menu-responsive" class="btn-menu"><span></span></div>
            </div>
            <div id="drp_menu">
                <ul>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="<?= base_url() ?>cfp">Call for Proposal</a></li>
                    <li><a href="<?= base_url() ?>call-documents">Call Documents</a></li>
                    <li><a href="<?= base_url() ?>submission-portal">Submission Portal</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        var firstClick = true;

        $('#btn-menu-responsive').click(function() {
            if (firstClick) {
                $("#navbar .dbl-blk .right_blk").toggleClass("active");
                $("#navbar .dbl-blk .right_blk .content .btn-menu").toggleClass('close');
                setTimeout(function() {
                    $("#navbar .dbl-blk .right_blk #drp_menu").slideToggle("slow");
                }, 280);
                firstClick = false;
            } else {
                $("#navbar .dbl-blk .right_blk .content .btn-menu").toggleClass('close');
                $("#navbar .dbl-blk .right_blk #drp_menu").slideToggle("slow");
                setTimeout(function() {
                    $("#navbar .dbl-blk .right_blk").toggleClass("active");
                }, 400); 
                firstClick = true;
            }
        });
    });
</script>