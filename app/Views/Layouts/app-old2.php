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
    <link rel="icon" href="<?= base_url('icon/favicon-32x32.ico') ?>" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('icon/apple-touch-icon-152x152.ico') ?>">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="<?= base_url('icon/favicon-32x32.ico') ?>">
    <!-- For Windows Phone -->

    <!-- CORE CSS-->    
    <link href="<?= base_url('css/materialize/v3.1/materialize.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('css/materialize/v3.1/style.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?= base_url('css/materialize/v3.1/plugins/prism.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('css/materialize/v3.1/plugins/perfect-scrollbar.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('css/materialize/v3.1/plugins/jquery.dataTables.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('css/materialize/v3.1/plugins/jquery-jvectormap.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('css/materialize/v3.1/plugins/sweetalert.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <?= $this->renderSection('styles') ?>
</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
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
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/jquery-1.11.2.min.js') ?>"></script>
    
    <!--materialize js-->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/materialize.js') ?>"></script>
    
    <!--prism-->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/prism.js') ?>"></script>
    
    <!--scrollbar-->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/perfect-scrollbar.min.js') ?>"></script>
    
    <!-- data-tables -->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/jquery.dataTables.min.js') ?>"></script>
    
    
    <!-- chartjs -->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/chart.min.js') ?>"></script>
    
    <!--sweetalert -->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/sweetalert.min.js') ?>"></script>
    
    <!-- sparkline -->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/jquery.sparkline.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/sparkline-script.js') ?>"></script>

    
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins.min.js') ?>"></script>

    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="<?= base_url('js/custom/custom-script.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
    <script type="text/javascript">
        /*Show entries on click hide*/
        // $(document).ready(function(){
        //     $(".dropdown-content.select-dropdown li").on( "click", function() {
        //         var that = this;
        //         setTimeout(function(){
        //         if($(that).parent().hasClass('active')){
        //                 $(that).parent().removeClass('active');
        //                 $(that).parent().hide();
        //         }
        //         },100);
        //     });
        // });
    </script>
</body>

</html>