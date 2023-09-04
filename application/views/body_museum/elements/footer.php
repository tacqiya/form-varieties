<div id="footer">
    <div class="wrapper">
        <div class="dbl_blk clear">
            <div class="left_blk inner">
                <ul>
                    <li><a href="<?= base_url('about') ?>">About</a></li>
                    <li><a href="<?= base_url('plastination') ?>">Plastination</a></li>
                    <li><a href="<?= base_url('exhibits') ?>">Exhibit</a></li>
                    <li><a href="<?= base_url('plan-your-visit') ?>">Plan your visit</a></li>
                    <li><a href="<?= base_url('guidelines') ?>">Guidelines</a></li>
                    <li><a href="<?= base_url('contact-us') ?>">Contact us</a></li>
                    <li><a href="<?= base_url('book-your-visit') ?>">Book your visit</a></li>
                    <li>
                        <ul>
                            <li><a href="https://www.facebook.com/khalifauniversity" target="_blank"><img src="<?= base_url() ?>assets/images/icons/fb.png" alt=""></a></li>
                            <li><a href="https://www.instagram.com/khalifauniversity" target="_blank"><img src="<?= base_url() ?>assets/images/icons/insta.png"></a></li>
                            <li><a href="https://twitter.com/KhalifaUni" target="_blank"><img src="<?= base_url() ?>assets/images/icons/twitter.png"></a></li>
                        </ul>
                    </li>
                </ul>
                <p>Copyrighted © 2023 Khalifa University. ALL RIGHTS RESERVED</p>
            </div>
            <div class="right_blk inner">
                <img src="<?= base_url() ?>assets/body_museum/images/footer_back.png" alt="">
            </div>
        </div>
        <img class="main" src="<?= base_url() ?>assets/body_museum/images/hm_footer.png" alt="">
        
    </div>
</div>

<script>
    $('.banner-owl').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        items: 1,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 1500,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    })

    if (window.innerWidth > 700) {
        $('.exhibits-owl').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            items: 2,
            center: true,
        })
    } else {
        $('.exhibits-owl').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            items: 1,
            center: false,
        })
    }

    // $('.banner-owl').on('changed.owl.carousel', function(event) {
    //     // your animation reset code here
    //     $('#home #banner .content .right_blk .animated').removeClass('animated');
    //     setTimeout(function() {
    //         $('#home #banner .content .right_blk .animated').addClass('animated');
    //     }, 100);
    // });

    $(document).ready(function() {
        if (window.innerWidth > 700) {
            var min_highestSection = 0;
            $('#mis_vis .left_blk .blks .mission .inner_blk').each(function() {
                if ($(this).height() > min_highestSection) {
                    min_highestSection = $(this).height();
                }
            });
            $('#mis_vis .left_blk .blks .mission .inner_blk').height(min_highestSection + 50);
        }

        if (window.innerWidth > 700) {
            var min_highestSection = 0;
            $('#mis_vis .left_blk .blks .vision .inner_blk').each(function() {
                if ($(this).height() > min_highestSection) {
                    min_highestSection = $(this).height();
                }
            });
            $('#mis_vis .left_blk .blks .vision .inner_blk').height(min_highestSection);
        }

        if (window.innerWidth > 700) {
            var min_highestSection = 0;
            $('#footer .dbl_blk .inner').each(function() {
                if ($(this).height() > min_highestSection) {
                    min_highestSection = $(this).height();
                }
            });
            $('#footer .dbl_blk .inner').height(min_highestSection);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</body>

</html>