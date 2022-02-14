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
    <meta name="description" content="Sistem Informasi Manajemen Pelanggan ISP dan Monitoring Frekuensi BTS Terintegrasi dengan Perangkat Mikrotik ">
    <meta name="keywords" content="internet provider, internet service provider, nodelabyr, network, isp, nap, network access point, nsp, wireless, bts, base transceiver station, network access, network service provider, backbone, backhaul">
    <title>SIMAPEL-TIKAPP | <?= $title ?></title>

    <!-- Favicons-->
    <link rel="icon" href="<?= base_url('App/company-brand-logo.png') ?>" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('App/company-brand-logo.png') ?>">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="<?= base_url('App/company-brand-logo.png') ?>">
    <!-- For Windows Phone -->

    <!-- CORE CSS-->    
    <link href="<?= base_url('materialize/v3.1/css/materialize.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/css/style.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    
    <!-- Custome CSS-->    
    <link href="<?= base_url('materialize/v3.1/css/custom/custom.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?= base_url('materialize/v3.1/js/plugins/prism/prism.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/perfect-scrollbar/perfect-scrollbar.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/data-tables/css/jquery.dataTables.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/jvectormap/jquery-jvectormap.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/chartist-js/chartist.min.css" type="text/css') ?>" rel="stylesheet" media="screen,projection">

    <?= $this->renderSection('styles') ?>
</head>

<body>
    <!-- Start Page Loading -->
    <!-- <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div> -->
    <!-- End Page Loading -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START HEADER -->
    <?= $this->include('Layouts/Navigations/header') ?>
    <!-- END HEADER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">

            <!-- START LEFT SIDEBAR NAV-->
            <?= $this->include('Layouts/Navigations/left-side-navbar') ?>
            <!-- END LEFT SIDEBAR NAV-->

            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START CONTENT -->
            <?= $this->renderSection('content') ?>
            <!-- END CONTENT -->

            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- START RIGHT SIDEBAR NAV-->
          
            <!-- END RIGHT SIDEBAR NAV-->

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <?= $this->include('Layouts/Navigations/footer') ?>
    <!-- END FOOTER -->

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
    
    <!-- data-tables -->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/data-tables/js/jquery.dataTables.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/data-tables/data-tables-script.js') ?>"></script>
    
    <!-- chartist -->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/chartist-js/chartist.min.js') ?>"></script>   
    
    <!-- chartjs -->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/chartjs/chart.min.js') ?>"></script>
    
    
    <!-- sparkline -->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/sparkline/sparkline-script.js') ?>"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins.min.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/custom-script.js') ?>"></script>
    <script type="text/javascript">
        /*Show entries on click hide*/
        $(document).ready(function(){
            $(".dropdown-content.select-dropdown li").on( "click", function() {
                var that = this;
                setTimeout(function(){
                if($(that).parent().hasClass('active')){
                        $(that).parent().removeClass('active');
                        $(that).parent().hide();
                }
                },100);
            });
        });
    </script>
</body>

</html>