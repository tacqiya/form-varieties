<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>VEGP | Khalifa University</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/icons/favicon.png">

    <!--fonts-->

    <!--styles-->
    <link href="<?= base_url() ?>assets/submit_simple/scss/reset_css.css?v=1.0" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/submit_simple/scss/style.css?v=2.0" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/submit_simple/scss/inside.css?v=1.0" type="text/css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/submit_simple/scss/responsive/style-responsive.css?v=1.0" type="text/css" rel="stylesheet" />

    <!-- Include the jQuery library (local or CDN) -->
    <script src="<?= base_url() ?>assets/submit_simple/js/jquery-latest.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>assets/submit_simple/plugins/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/submit_simple/plugins/owlcarousel/assets/owl.theme.default.min.css">

    <script src="<?= base_url() ?>assets/submit_simple/plugins/owlcarousel/owl.carousel.min.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>assets/submit_simple/plugins/fancybox/dist/jquery.fancybox.min.css" />


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
                <li class="active">
                    <span><a href="#">Normal Option</a></span>
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