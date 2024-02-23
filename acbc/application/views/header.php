<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>UAE ACB Conference | Khalifa University</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/icons/favicon.png">

	<!--fonts-->

	<!--styles-->
	<link href="assets/scss/reset_css.css?v=1.0" type="text/css" rel="stylesheet" />
	<link href="assets/scss/style.css?v=1.0" type="text/css" rel="stylesheet" />
	<link href="assets/scss/inside.css?v=1.0" type="text/css" rel="stylesheet" />
	<link href="assets/scss/responsive/style-responsive.css?v=1.0" type="text/css" rel="stylesheet" />

	<!-- Include the jQuery library (local or CDN) -->
	<script src="assets/js/jquery-latest.min.js"></script>

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jqueryConfirm/css/jquery-confirm.custom.min.css" />
	<script src="<?= base_url() ?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.js"></script>


	<link rel="stylesheet" href="assets/plugins/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/plugins/owlcarousel/assets/owl.theme.default.min.css">

	<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

	<link rel="stylesheet" href="assets/plugins/fancybox/dist/jquery.fancybox.min.css" />
	<script src="https://unpkg.com/gsap@3.9.2/dist/gsap.min.js"></script>


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
				<!-- <li class="active">
					<span><a href="#">Normal Option</a></span>
				</li> -->
				<li><a onclick="scrollToSection('banner', 500)">Home</a></li>
				<li><a onclick="scrollToSection('second_blk', 500)">About</a></li>
				<li><a onclick="scrollToSection('committee', 500)">Committee</a></li>
				<li><a onclick="scrollToSection('schedule', 500)">Program</a></li>
				<li><a onclick="scrollToSection('contact', 500)">Contact</a></li>
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

			$('.slide-menu > ul > li').on('click', function() {
				$('#slide-menu').toggleClass('active');
				$('#toggle-menu').toggleClass('active');
			});

			$('.sub-menu li.has-sub').click(function() {
				$(this).children('ul').slideToggle();
				$(this).toggleClass('active');
			});
		});
	</script>
