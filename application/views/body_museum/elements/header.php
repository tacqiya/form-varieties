<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Body Museum</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/icons/favicon.png">

    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,500;0,6..96,600;0,6..96,700;0,6..96,800;0,6..96,900;1,6..96,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Display&display=swap" rel="stylesheet">

    <!--styles-->
    <link href="<?= base_url() ?>assets/body_museum/scss/reset_css.css?v=1.1" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/body_museum/scss/style.css?v=1.1" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/body_museum/scss/home.css?v=1.1" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/body_museum/scss/inside-pages.css?v=1.1" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/body_museum/scss/responsive/style-responsive.css?v=1.1" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/body_museum/scss/responsive/inside-responsive.css?v=1.1" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Include the jQuery library (local or CDN) -->
    <script src="assets/body_museum/js/jquery-latest.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>assets/body_museum/plugins/jqueryConfirm/dist/jquery-confirm.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/body_museum/plugins/jqueryConfirm/css/jquery-confirm.custom.min.css" />
    <script src="<?= base_url() ?>assets/body_museum/plugins/jqueryConfirm/dist/jquery-confirm.min.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>assets/body_museum/plugins/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/body_museum/plugins/owlcarousel/assets/owl.theme.default.min.css">

    <script src="assets/body_museum/plugins/owlcarousel/owl.carousel.min.js"></script>


</head>

<body>
    <header>
        <div class="toggle-menu" id="toggle-menu">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="slide-menu" id="slide-menu">
            <ul>
                <li>
                    <span><a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/body_museum/images/body-logo.png" alt=""></a></span>
                </li>
                <li class="active">
                    <span><a href="<?= base_url('about') ?>">ABOUT</a></span>
                </li>
                <li>
                    <span><a href="<?= base_url('plastination') ?>">PLASTINATION</a></span>
                </li>
                <li>
                    <span><a href="<?= base_url('exhibits') ?>">EXHIBIT</a></span>
                </li>
                <li>
                    <span><a href="<?= base_url('plan-your-visit') ?>">PLAN YOUR VISIT</a></span>
                </li>
                <li>
                    <span><a href="<?= base_url('guidelines') ?>">GUIDELINES</a></span>
                </li>
                <li>
                    <span><a href="<?= base_url('contact-us') ?>">CONTACT US</a></span>
                </li>
                <li>
                    <span><a href="<?= base_url('book-your-visit') ?>">BOOK YOUR VISIT</a></span>
                </li>
                <!--                    <li class="has-sub">
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
                    </li>                    -->
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

    <div id="<?= $page ?>">

        <div id="<?= ($page == 'visit' || $page == 'contact') ? 'visit' : 'banner'; ?>">