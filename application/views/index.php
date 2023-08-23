<?php $page = "home"; ?>

<div id="home">
    <div id="banner">
        <div class="wrapper">
            <?php $this->load->view('navbar'); ?>

            <h1>Viggo’s Educational <br>Grants Program for <br>Organ Donation and <br>Transplantation</h1>
        </div>
    </div>

    <br class="px-80">

    <div id="second_blk" class="clear">
        <div class="wrapper">
            <div class="dbl_blk clear">
                <div class="left_blk inner">
                    <p>Viggo’s Educational Grants Program aims to support educational initiatives that promote the awareness and education on organ donation and transplantation.
                        Viggo’s Educational Grants Funds Program has been set up by the UAE Ministry of Health and Prevention (MOHAP) to recognize the importance of organ donation and transplantation in saving lives and improving health outcomes.</p>
                </div>
                <div class="right_blk inner">
                    <p>Through Viggo’s Educational Grants program, support will be provided to hospitals, universities and organizations for conducting innovative and impactful educational activities for the staff and raise awareness publicly of organ donation and transplantation.
                        This initiative will result in more individuals becoming organ donors and improve access to organs for patients in need.</p>
                </div>
            </div>

        </div>
    </div>

    <br class="px-80">

    <div id="vdo_blk" class="clear">
        <div class="wrapper">
            <div class="dbl_blk clear">
                <div class="left_blk">
                    <img src="<?= base_url() ?>assets/images/hm-hear.png" alt="">
                </div>
                <div class="right_blk">
                    <h3>Hear from <br>Viggo’s family</h3>
                    <div class="img">
                        <!-- <a href=""><img src="assets/images/icons/play.png" alt=""></a>
                     -->
                        <div class="video-main">
                            <div class="promo-video">
                                <div class="waves-block">
                                    <div class="waves wave-1"></div>
                                    <div class="waves wave-2"></div>
                                    <div class="waves wave-3"></div>
                                </div>
                            </div>
                            <a data-fancybox data-src="https://www.youtube.com/embed/ECCrpyTIXH0?autoplay=1" href="javascript:;" class="video-link video video-popup mfp-iframe" data-lity><i class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br class="px-80">

    <div id="hayat" class="clear">
        <div class="wrapper">
            <div class="dbl_blk clear">
                <div class="left_blk">
                    <div class="img">
                        <a href="https://mohap.gov.ae/en/hayat" target="_blank"><img src="<?= base_url() ?>assets/images/icons/hayat-logo.png" alt=""></a>
                    </div>
                </div>
                <div class="right_blk">
                    <div class="img">
                        <img src="<?= base_url() ?>assets/images/qr-code.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br class="px-80">

</div>


<script>
    $(document).ready(function() {
        $(".video-link").fancybox({
            type: "iframe",
            iframe: {
                preload: false
            }
        });
    });
</script>