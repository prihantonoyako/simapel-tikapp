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
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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
    <link href="<?= base_url('materialize/v3.1/css/materialize.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/css/style.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="<?= base_url('materialize/v3.1/js/plugins/prism/prism.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/perfect-scrollbar/perfect-scrollbar.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/data-tables/css/jquery.dataTables.min.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/jvectormap/jquery-jvectormap.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="<?= base_url('materialize/v3.1/js/plugins/sweetalert/sweetalert.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
    <?= $this->renderSection('styles') ?>
</head>
<body>
<div id="invoice">
            <div class="invoice-header">
              <div class="row section">
                <div class="col s12 m6 l6">
                  <img src="<?= base_url('materialize/v3.1/images/generic-logo.png') ?>" alt="company logo">
                  <p>To,
                    <br>
                    <span class="strong">Jonathan Doe</span>
                    <br>
                    <span>125, ABC Street,</span>
                    <br>
                    <span>New Yourk, USA</span>
                    <br>
                    <span>+91-(444)-(333)-(221)</span>
                  </p>
                </div>

                <div class="col s12 m6 l6">
                  <div class="invoce-company-address right-align">
                    <span class="invoice-icon"><i class="mdi-social-location-city cyan-text"></i></span>

                    <p><span class="strong">Company Name LLC</span>
                      <br>
                      <span>125, ABC Street,</span>
                      <br>
                      <span>New Yourk, USA</span>
                      <br>
                      <span>+91-(444)-(333)-(221)</span>
                    </p>
                  </div>

                  <div class="invoce-company-contact right-align">
                    <span class="invoice-icon"><i class="mdi-communication-quick-contacts-mail cyan-text"></i></span>
                    <p><span class="strong">www.exampledomain.com</span>
                      <br>
                      <span>info@exampledomain.com</span>
                      <br>
                      <span>admin@exampledomain.com</span>
                    </p>
                  </div>

                </div>
              </div>
            </div>

            <div class="invoice-lable">
              <div class="row">
                <div class="col s12 m3 l3 cyan">
                  <h4 class="white-text invoice-text">INVOICE</h4>
                </div>
                <div class="col s12 m9 l9 invoice-brief cyan white-text">
                  <div class="row">
                    <div class="col s12 m3 l3">
                      <p class="strong">Total Due</p>
                      <h4 class="header">$ 3,600.00</h4>
                    </div>
                    <div class="col s12 m3 l3">
                      <p class="strong">Invoice No</p>
                      <h4 class="header">MT_A_124563</h4>
                    </div>
                    <div class="col s12 m3 l3">
                      <p class="strong">Due Date</p>
                      <h4 class="header">22.05.2015</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="invoice-table">
              <div class="row">
                <div class="col s12 m12 l12">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th data-field="no">No</th>
                        <th data-field="item">Item</th>
                        <th data-field="uprice">Unit Price</th>
                        <th data-field="price">Unit</th>
                        <th data-field="price">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>MacBook Pro</td>
                        <td>$ 1,299.00</td>
                        <td>2</td>
                        <td>$ 1,100.00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>iMAC</td>
                        <td>$ 1,099.00</td>
                        <td>2</td>
                        <td>$ 2,198.00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>iPhone</td>
                        <td>$ 299.00</td>
                        <td>5</td>
                        <td>$ 1,495.00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>iPad 3</td>
                        <td>$399.00</td>
                        <td>1</td>
                        <td>$ 399.00</td>  
                      </tr>
                      <tr>
                        <td>5.</td>
                        <td>iPod</td>
                        <td>$49.00</td>
                        <td>2</td>
                        <td>$ 98.00</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Sub Total:</td>
                        <td>$ 5,290.00</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td>Service Tax</td>
                        <td>11.00%</td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td class="cyan white-text">Grand Total</td>
                        <td class="cyan strong white-text">$ 5,871.90</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
            
            <div class="invoice-footer">
              <div class="row">
                <div class="col s12 m6 l6">
                  <p class="strong">Payment Method</p>
                  <p>Please make the cheque to: AMANDA ORTON</p>
                  <p class="strong">Terms & Condition</p>
                  <ul>
                    <li>You know, being a test pilot isn't always the healthiest business in the world.</li>
                    <li>We predict too much for the next year and yet far too little for the next 10.</li>
                  </ul>
                </div>
                <div class="col s12 m6 l6 center-align">
                  <p>Approved By</p>
                  <img src="images\signature-scan.png" alt="signature">
                  <p class="header">AMANDA ORTON</p>
                  <p>Managing Director</p>
                </div>
              </div>
            </div>
            
          </div>

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
    <!-- chartjs -->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/chartjs/chart.min.js') ?>"></script>
    <!--sweetalert -->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
    <!-- sparkline -->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/sparkline/sparkline-script.js') ?>"></script> 
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins.min.js') ?>"></script>
   
    <?= $this->renderSection('scripts') ?>
</body>

</html>