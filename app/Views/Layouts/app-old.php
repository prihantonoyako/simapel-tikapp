<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('App/brand.png') ?>"/>
    <link rel="icon" type="image/png" href="<?= base_url('App/brand.png') ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SIMAPEL-TIKAPP</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="<?= base_url() ?>" />
    <!--  Social tags      -->
    <meta name="keywords" content="internet provider, internet service provider, nodelabyr, network, isp, nap, network access point, nsp, wireless, bts, base transceiver station, network access, network service provider, backbone, backhaul">
    <meta name="description" content="Sistem Informasi Manajemen Pelanggan ISP dan Monitoring Frekuensi BTS Terintegrasi dengan Perangkat Mikrotik">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="SIMAPEL-TIKAPP | NODELABYR">
    <meta itemprop="description" content="Sistem Informasi Manajemen Pelanggan ISP dan Monitoring Frekuensi BTS Terintegrasi dengan Perangkat Mikrotik">
    <meta itemprop="image" content="<?= base_url('App/brand.png')?>">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@nodelabyr">
    <meta name="twitter:title" content="SIMAPEL-TIKAPP | NODELABYR">
    <meta name="twitter:description" content="Sistem Informasi Manajemen Pelanggan ISP dan Monitoring Frekuensi BTS Terintegrasi dengan Perangkat Mikrotik">
    <meta name="twitter:creator" content="@nodelabyr">
    <meta name="twitter:image" content="<?= base_url('App/brand.png')?>">
    <!-- Open Graph data -->
    <meta property="og:title" content="SIMAPEL-TIKAPP | NODELABYR" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:image" content="<?= base_url('App/brand.png')?>" />
    <meta property="og:description" content="Sistem Informasi Manajemen Pelanggan ISP dan Monitoring Frekuensi BTS Terintegrasi dengan Perangkat Mikrotik" />
    <meta property="og:site_name" content="NODELABYR" />
    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url('material-dashboard-pro-master/assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?= base_url('material-dashboard-pro-master/assets/css/material-dashboard.css') ?>" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?= base_url('App/app.css') ?>" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="<?= base_url('material-dashboard-pro-master/assets/css/font-awesome.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('material-dashboard-pro-master/assets/css/google-roboto-300-700.css') ?>" rel="stylesheet" />
    <?= $this->renderSection('head-scripts') ?>
</head>

<body>
<?= $this->renderSection('body') ?>
</body>
<!--   Core JS Files   -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery-3.1.1.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('material-dashboard-pro-master/assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('material-dashboard-pro-master/assets/js/material.min.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('material-dashboard-pro-master/assets/js/perfect-scrollbar.jquery.min.js') ?>" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery.validate.min.js') ?>"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/moment.min.js') ?>"></script>
<!--  Charts Plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/chartist.min.js') ?>"></script>
<!--  Plugin for the Wizard -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery.bootstrap-wizard.js') ?>"></script>
<!--  Notifications Plugin    -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/bootstrap-notify.js') ?>"></script>
<!--   Sharrre Library    -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery.sharrre.js') ?>"></script>
<!-- DateTimePicker Plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/bootstrap-datetimepicker.js') ?>"></script>
<!-- Vector Map plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery-jvectormap.js') ?>"></script>
<!-- Sliders Plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/nouislider.min.js') ?>"></script>
<!--  Google Maps Plugin    -->
<!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->
<!-- Select Plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery.select-bootstrap.js') ?>"></script>
<!--  DataTables.net Plugin    -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery.datatables.js') ?>"></script>
<!-- Sweet Alert 2 plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/sweetalert2.js') ?>"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jasny-bootstrap.min.js') ?>"></script>
<!--  Full Calendar Plugin    -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/fullcalendar.min.js') ?>"></script>
<!-- TagsInput Plugin -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/jquery.tagsinput.js') ?>"></script>
<!-- Material Dashboard javascript methods -->
<script src="<?= base_url('material-dashboard-pro-master/assets/js/material-dashboard.js') ?>"></script>
<!-- SIMAPEL-TIKAPP methods -->
<script src="<?= base_url('App/app.js') ?>"></script>

<?= $this->renderSection('scripts') ?>
</html>