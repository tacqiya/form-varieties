<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ALUMNI | Khalifa University</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/icons/favicon.png">

    <!--fonts-->
    <link rel="preload" href="DINNextLTPro-Black.woff2" as="font" type="font/woff2" crossorigin>

    <!--styles-->
    <link href="<?= base_url() ?>assets/scss/reset_css.css?v=2.5" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/scss/style.css?v=2.5" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/scss/responsive/style-responsive.css?v=1.5" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/scss/login.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/scss/responsive/login_res.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/scss/download.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/scss/responsive/download_res.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?= base_url() ?>assets/scss/imagecrop.css" rel="stylesheet" type="text/css" /> -->

    <!-- Include the jQuery library (local or CDN) -->
    <script src="<?= base_url() ?>assets/js/jquery-latest.min.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqueryConfirm/css/jquery-confirm.custom.min.css" />
    <script src="<?= base_url() ?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.js"></script>

    <!-- <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
    <script src="https://unpkg.com/cropperjs"></script> -->

    <link href="<?= base_url() ?>assets/plugins/croppie/css/bootstrap.css" rel="stylesheet"/>
    <script src="<?= base_url() ?>assets/plugins/croppie/js/bootstrap.js"></script>
    <link href="<?= base_url() ?>assets/plugins/croppie/croppie.css" rel="stylesheet"/>
    <script src="<?= base_url() ?>assets/plugins/croppie/croppie.js"></script>
    
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/owlcarousel/assets/owl.theme.default.min.css">

    <script src="<?= base_url() ?>assets/plugins/owlcarousel/owl.carousel.min.js"></script>

    <script src="<?= base_url() ?>assets/plugins/datepicker/datepicker.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker.min.css" />


    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fancybox/dist/jquery.fancybox.min.css" />


</head>

<body class="<?php if ($page == "index") {
                    echo "index";
                } ?>">
    <header>
        <div class="toggle-menu" id="toggle-menu">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="slide-menu" id="slide-menu">
            <ul>
                <li class="active">
                    <span><a href="#">Normal Option</a></span>
                </li>
                <li class="has-sub">
                    <span class="tab"><a>Option With sub</a></span>
                    <div class="sub-menu">
                        <ul class="main">
                            <li><a href="#">Sub option</a></li>
                            <li><a href="#">Sub option</a></li>
                            <li class="has-sub">
                                <span><a href="#">Sub option with sub</a></span>
                                <ul>
                                    <li><a href="#">sub of sub's sub</a></li>
                                    <li><a href="#">sub of sub's sub</a></li>
                                    <li><a href="#">sub of sub's sub</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Sub option</a></li>
                            <li><a href="#">Sub option</a></li>
                            <li class="has-sub">
                                <span><a href="#">Sub option with sub</a></span>
                                <ul>
                                    <li><a href="#">sub of sub's sub</a></li>
                                    <li><a href="#">sub of sub's sub</a></li>
                                    <li><a href="#">sub of sub's sub</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Sub option</a></li>
                            <li><a href="#">Sub option</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <script>
        $(document).ready(function() {
            $('#toggle-menu').click(function() {
                $(this).toggleClass('active');
                $('#slide-menu').toggleClass('active');
            });

            $('.slide-menu > ul > li.has-sub .tab').on('click', function() {
                $(this).siblings('.sub-menu').slideToggle();
                $(this).parent('li').toggleClass('active');
            });

            $('.sub-menu li.has-sub').click(function() {
                $(this).children('ul').slideToggle();
                $(this).toggleClass('active');
            });
        });
    </script>