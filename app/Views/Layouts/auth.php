<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="keywords" content="internet provider, internet service provider, nodelabyr, network, isp, nap, network access point, nsp, wireless, bts, base transceiver station, network access, network service provider, backbone, backhaul">
	<meta name="description" content="Sistem Informasi Manajemen Pelanggan ISP dan Monitoring Frekuensi BTS Terintegrasi dengan Perangkat Mikrotik">
	<title>SIMAPEL-TIKAPP | LOGIN PAGE</title>

	<!-- Favicons-->
	<link rel="icon" type="image/png" href="<?= base_url('icon/favicon-32x32.ico') ?>" sizes="32x32"/>
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= base_url('icon/apple-touch-icon-152x152.ico') ?>"/>

	<meta name="msapplication-TileColor" content="#00bcd4">
	<meta name="msapplication-TileImage" content="<?= base_url('icon/favicon-32x32.ico') ?>">
	<!-- For Windows Phone -->

	<!-- CORE CSS-->
	<link href="<?= base_url('materialize/v3.1/css/materialize.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?= base_url('materialize/v3.1/css/style.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
	<!-- Custome CSS-->	
	<link href="<?= base_url('materialize/v3.1/css/layouts/page-center.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">

	<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
	<link href="<?= base_url('materialize/v3.1/js/plugins/prism/prism.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?= base_url('materialize/v3.1/js/plugins/perfect-scrollbar/perfect-scrollbar.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body class="cyan">
	<!-- Start Page Loading -->
	<div id="loader-wrapper">
		<div id="loader"></div>	
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	<!-- End Page Loading -->

	<?= $this->renderSection('content') ?>

	<!-- ================================================
	Scripts
	================================================ -->

	<!-- jQuery Library -->
	<script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/jquery-1.11.2.min.js') ?>"></script>
	<!--materialize js-->
	<script type="text/javascript" src="<?= base_url('materialize/v3.1/js/materialize.min.js') ?>"></script>
	<!--prism-->
	<script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/prism/prism.js') ?>"></script>
	<!--scrollbar-->
	<script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
	<!--plugins.js - Some Specific JS codes for Plugin Settings-->
	<script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins.min.js') ?>"></script>

</body>

</html>