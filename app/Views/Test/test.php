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
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Forms Layouts | Materialize - Material Design Admin Template</title>

  <!-- Favicons-->
  <link rel="icon" href="images\favicon\favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images\favicon\apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css\materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css\style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">


  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js\plugins\prism\prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js\plugins\perfect-scrollbar\perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="js\plugins\chartist-js\chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
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
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.htm" class="brand-logo darken-1"><img src="images\materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1></li>
                    </ul>
                    <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
                    </div>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown"><img src="images\flag-icons\United-States.png" alt="USA"></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">5</small></i>
                        
                        </a>
                        </li>                        
                        <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li>
                    </ul>
                    <!-- translation-button -->
                    <ul id="translation-dropdown" class="dropdown-content">
                      <li>
                        <a href="#!"><img src="images\flag-icons\United-States.png" alt="English">  <span class="language-select">English</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images\flag-icons\France.png" alt="French">  <span class="language-select">French</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images\flag-icons\China.png" alt="Chinese">  <span class="language-select">Chinese</span></a>
                      </li>
                      <li>
                        <a href="#!"><img src="images\flag-icons\Germany.png" alt="German">  <span class="language-select">German</span></a>
                      </li>
                      
                    </ul>
                    <!-- notifications-dropdown -->
                    <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS <span class="new badge">5</span></h5>
                      </li>
                      <li class="divider"></li>
                      <li>
                        <a href="#!"><i class="mdi-action-add-shopping-cart"></i> A new order has been placed!</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-stars"></i> Completed the task</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-settings"></i> Settings updated</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-editor-insert-invitation"></i> Director meeting started</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
                      </li>
                      <li>
                        <a href="#!"><i class="mdi-action-trending-up"></i> Generate monthly report</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
                      </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images\avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                </div>
                <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="#"><i class="mdi-action-face-unlock"></i> Profile</a>
                        </li>
                        <li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
                        </li>
                        <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="mdi-action-lock-outline"></i> Lock</a>
                        </li>
                        <li><a href="#"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">John Doe<i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal">Administrator</p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="index.htm" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Layouts</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="layout-fullscreen.htm">Full Screen</a>
                                </li>
                                <li><a href="layout-horizontal-menu.htm">Horizontal Menu</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="bold"><a href="app-email.htm" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Mailbox <span class="new badge">4</span></a>
            </li>
            <li class="bold"><a href="app-calendar.htm" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Calender</a>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-invert-colors"></i> CSS</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="css-typography.htm">Typography</a>
                                </li>
                                <li><a href="css-icons.htm">Icons</a>
                                </li>
                                <li><a href="css-animations.htm">Animations</a>
                                </li>
                                <li><a href="css-shadow.htm">Shadow</a>
                                </li>
                                <li><a href="css-media.htm">Media</a>
                                </li>
                                <li><a href="css-sass.htm">Sass</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-image-palette"></i> UI Elements</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="ui-alerts.htm">Alerts</a>
                                </li>
                                <li><a href="ui-buttons.htm">Buttons</a>
                                </li>
                                <li><a href="ui-badges.htm">Badges</a>
                                </li>
                                <li><a href="ui-breadcrumbs.htm">Breadcrumbs</a>
                                </li>
                                <li><a href="ui-collections.htm">Collections</a>
                                </li>
                                <li><a href="ui-collapsibles.htm">Collapsibles</a>
                                </li>
                                <li><a href="ui-tabs.htm">Tabs</a>
                                </li>
                                <li><a href="ui-navbar.htm">Navbar</a>
                                </li>
                                <li><a href="ui-pagination.htm">Pagination</a>
                                </li>
                                <li><a href="ui-preloader.htm">Preloader</a>
                                </li>
                                <li><a href="ui-toasts.htm">Toasts</a>
                                </li>
                                <li><a href="ui-tooltip.htm">Tooltip</a>
                                </li>
                                <li><a href="ui-waves.htm">Waves</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-av-queue"></i> Advanced UI <span class="new badge"></span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="advanced-ui-chips.htm">Chips</a>
                                </li>
                                <li><a href="advanced-ui-cards.htm">Cards</a>
                                </li>
                                <li><a href="advanced-ui-modals.htm">Modals</a>
                                </li>
                                <li><a href="advanced-ui-media.htm">Media</a>
                                </li>
                                <li><a href="advanced-ui-range-slider.htm">Range Slider</a>
                                </li>
                                <li><a href="advanced-ui-sweetalert.htm">SweetAlert</a>
                                </li>
                                <li><a href="advanced-ui-nestable.htm">Shortable & Nestable</a>
                                </li>
                                <li><a href="advanced-ui-translation.htm">Language Translation</a>
                                </li>
                                <li><a href="advanced-ui-highlight.htm">Highlight</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a href="app-widget.htm" class="waves-effect waves-cyan"><i class="mdi-device-now-widgets"></i> Widgets</a>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-border-all"></i> Tables</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="table-basic.htm">Basic Tables</a>
                                </li>
                                <li><a href="table-data.htm">Data Tables</a>
                                </li>
                                <li><a href="table-jsgrid.htm">jsGrid</a>
                                </li>
                                <li><a href="table-editable.htm">Editable Table</a>
                                </li>
                                <li><a href="table-floatThead.htm">floatThead</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan active"><i class="mdi-editor-insert-comment"></i> Forms <span class="new badge"></span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="form-elements.htm">Form Elements</a>
                                </li>
                                <li class="active"><a href="form-layouts.htm">Form Layouts</a>
                                </li>
                                <li><a href="form-validation.htm">Form Validations</a>
                                </li>
                                <li><a href="form-masks.htm">Form Masks</a>
                                </li>
                                <li><a href="form-file-uploads.htm">File Uploads</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-social-pages"></i> Pages</a>
                        <div class="collapsible-body">
                            <ul>                                        
                                <li><a href="page-contact.htm">Contact Page</a>
                                </li>
                                <li><a href="page-todo.htm">ToDos</a>
                                </li>
                                <li><a href="page-blog-1.htm">Blog Type 1</a>
                                </li>
                                <li><a href="page-blog-2.htm">Blog Type 2</a>
                                </li>
                                <li><a href="page-404.htm">404</a>
                                </li>
                                <li><a href="page-500.htm">500</a>
                                </li>
                                <li><a href="page-blank.htm">Blank</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-shopping-cart"></i> eCommers</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="eCommerce-products-page.htm">Products Page</a>
                                </li>                                        
                                <li><a href="eCommerce-pricing.htm">Pricing Table</a>
                                </li>
                                <li><a href="eCommerce-invoice.htm">Invoice</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-image-image"></i> Medias</a>
                        <div class="collapsible-body">
                            <ul>                                        
                                <li><a href="media-gallary-page.htm">Gallery Page</a>
                                </li>
                                <li><a href="media-hover-effects.htm">Image Hover Effects</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-circle"></i> User</a>
                        <div class="collapsible-body">
                            <ul>     
                                <li><a href="user-profile-page.htm">User Profile</a>
                                </li>                                   
                                <li><a href="user-login.htm">Login</a>
                                </li>                                        
                                <li><a href="user-register.htm">Register</a>
                                </li>
                                <li><a href="user-forgot-password.htm">Forgot Password</a>
                                </li>
                                <li><a href="user-lock-screen.htm">Lock Screen</a>
                                </li>                                        
                                
                            </ul>
                        </div>
                    </li>
                    
                    <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-chart"></i> Charts</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="charts-chartjs.htm">Chart JS</a>
                                </li>
                                <li><a href="charts-chartist.htm">Chartist</a>
                                </li>
                                <li><a href="charts-morris.htm">Morris Charts</a>
                                </li>
                                <li><a href="charts-xcharts.htm">xCharts</a>
                                </li>
                                <li><a href="charts-flotcharts.htm">Flot Charts</a>
                                </li>
                                <li><a href="charts-sparklines.htm">Sparkline Charts</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="li-hover"><div class="divider"></div></li>
            <li class="li-hover"><p class="ultra-small margin more-text">MORE</p></li>
            <li><a href="angular-ui.htm"><i class="mdi-action-verified-user"></i> Angular UI  <span class="new badge"></span></a>
            </li>
            <li><a href="css-grid.htm"><i class="mdi-image-grid-on"></i> Grid</a>
            </li>
            <li><a href="css-color.htm"><i class="mdi-editor-format-color-fill"></i> Color</a>
            </li>
            <li><a href="css-helpers.htm"><i class="mdi-communication-live-help"></i> Helpers</a>
            </li>
            <li><a href="changelogs.htm"><i class="mdi-action-swap-vert-circle"></i> Changelogs</a>
            </li>                    
            <li class="li-hover"><div class="divider"></div></li>
            <li class="li-hover"><p class="ultra-small margin more-text">Daily Sales</p></li>
            <li class="li-hover">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="sample-chart-wrapper">                            
                            <div class="ct-chart ct-golden-section" id="ct2-chart"></div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Forms</h5>
                <ol class="breadcrumbs">
                  <li><a href="index.htm">Dashboard</a>
                  </li>
                  <li><a href="#">Forms</a>
                  </li>
                  <li class="active">Forms Layouts</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <div class="section">

            <p class="caption">Includes predefined classes for easy layout options.</p>

            <div class="divider"></div>
            <!--Basic Form-->
            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 l6">
                  <div class="card-panel">
                    <h4 class="header2">Basic Form</h4>
                    <div class="row">
                      <form class="col s12">
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="name" type="text">
                            <label for="first_name">Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="email" type="email">
                            <label for="email">Email</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="password" type="password">
                            <label for="password">Password</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <textarea id="message" class="materialize-textarea"></textarea>
                            <label for="message">Message</label>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Form with placeholder -->
                <div class="col s12 m12 l6">
                  <div class="card-panel">
                    <h4 class="header2">Form with placeholder</h4>
                    <div class="row">
                      <form class="col s12">
                        <div class="row">
                          <div class="input-field col s12">
                            <input placeholder="John Doe" id="name2" type="text">
                            <label for="first_name">Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input placeholder="john@domainname.com" id="email2" type="email">
                            <label for="email">Email</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input placeholder="YourPassword" id="password2" type="password">
                            <label for="password">Password</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <textarea placeholder="Oh WoW! Let me check this one too." id="message2" class="materialize-textarea"></textarea>
                            <label for="message">Message</label>
                          </div>
                          <div class="row">
                            <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="mdi-content-send right"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Form with icon prefixes -->
            <div class="row">
              <div class="col s12 m12 l6">
                <div class="card-panel">
                  <h4 class="header2">Form with icon prefixes</h4>
                  <div class="row">
                    <form class="col s12">
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-account-circle prefix"></i>
                          <input id="name3" type="text">
                          <label for="first_name">Name</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-communication-email prefix"></i>
                          <input id="email3" type="email">
                          <label for="email">Email</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-lock-outline prefix"></i>
                          <input id="password3" type="password">
                          <label for="password">Password</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-question-answer prefix"></i>
                          <textarea id="message3" class="materialize-textarea"></textarea>
                          <label for="message">Message</label>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Form with validation -->
              <div class="col s12 m12 l6">
                <div class="card-panel">
                  <h4 class="header2">Form with validation</h4>
                  <div class="row">
                    <form class="col s12">
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-account-circle prefix"></i>
                          <input id="name4" type="text" class="validate">
                          <label for="first_name">Name</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-communication-email prefix"></i>
                          <input id="email4" type="email" class="validate">
                          <label for="email">Email</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-lock-outline prefix"></i>
                          <input id="password5" type="password" class="validate">
                          <label for="password">Password</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <i class="mdi-action-question-answer prefix"></i>
                          <textarea id="message4" class="materialize-textarea validate" length="120"></textarea>
                          <label for="message">Message</label>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                              <i class="mdi-content-send right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Inline Form -->
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <div class="row">
                <form class="col s12">
                  <h4 class="header2">Inline form</h4>
                  <div class="row">
                    <div class="input-field col s4">
                      <i class="mdi-action-account-circle prefix"></i>
                      <input id="icon_prefix" type="text" class="validate">
                      <label for="icon_prefix">First Name</label>
                    </div>
                    <div class="input-field col s4">
                      <i class="mdi-action-lock-outline prefix"></i>
                      <input id="icon_password" type="password" class="validate">
                      <label for="icon_password">Password</label>
                    </div>
                    <div class="input-field col s4">
                      <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light" type="submit" name="action"><i class="mdi-action-lock-open"></i> Login</button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Inline form with placeholder -->
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <div class="row">
                <form class="col s12">
                  <h4 class="header2">Inline form with placeholder</h4>
                  <div class="row">
                    <div class="input-field col s4">
                      <i class="mdi-action-account-circle prefix"></i>
                      <input placeholder="John Doe" id="icon_prefix2" type="text" class="validate">
                      <label for="icon_prefix">First Name</label>
                    </div>
                    <div class="input-field col s4">
                      <i class="mdi-communication-email prefix"></i>
                      <input placeholder="john@mydomain.com" id="icon_email" type="email" class="validate">
                      <label for="icon_email">Email</label>
                    </div>
                    <div class="input-field col s4">
                      <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light" type="submit" name="action"><i class="mdi-action-perm-identity"></i> Register</button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>

          <!--Form Advance-->          
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2">Form Advance</h4>
                <div class="row">
                  <form class="col s12">
                    <div class="row">
                      <div class="input-field col s6">
                        <input id="first_name" type="text">
                        <label for="first_name">First Name</label>
                      </div>
                    
                      <div class="input-field col s6">
                        <input id="last_name" type="text">
                        <label for="last_name">Last Name</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="email5" type="email">
                        <label for="email">Email</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="password6" type="password">
                        <label for="password">Password</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s6">
                        <select>
                          <option value="" disabled="" selected="">Choose your profile
                          <option value="1">Manager
                          <option value="2">Developer
                          <option value="3">Business
                        </select>
                        <label>Select Profile</label>
                      </div>                        
                      <div class="input-field col s6">
                        <input type="date" class="datepicker">
                        <label for="dob">DOB</label>
                      </div>
                      
                    </div>
                    
                    <div class="row">
                      <div class="file-field input-field col s6">
                        <input class="file-path validate" type="text">
                        <div class="btn">
                          <span>Age</span>
                          <input type="file">
                        </div>
                      </div>
                      <div class="input-field col s6">                          
                         <span>Image</span>
                         <p class="range-field">
                          <input type="range" id="test5" min="0" max="100">
                        </p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="message5" class="materialize-textarea" length="120"></textarea>
                        <label for="message">Message</label>
                      </div>
                      <div class="row">
                        <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                            <i class="mdi-content-send right"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
  </section>
  <!-- END CONTENT -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->
  <!-- START RIGHT SIDEBAR NAV-->
  <aside id="right-sidebar-nav">
        <ul id="chat-out" class="side-nav rightside-navigation">
            <li class="li-hover">
            <a href="#" data-activates="chat-out" class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>
            <div id="right-search" class="row">
                <form class="col s12">
                    <div class="input-field">
                        <i class="mdi-action-search prefix"></i>
                        <input id="icon_prefix3" type="text" class="validate">
                        <label for="icon_prefix">Search</label>
                    </div>
                </form>
            </div>
            </li>
            <li class="li-hover">
                <ul class="chat-collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header teal white-text active"><i class="mdi-social-whatshot"></i>Recent Activity</div>
                    <div class="collapsible-body recent-activity">
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-add-shopping-cart"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">just now</a>
                                <p>Jim Doe Purchased new equipments for zonal office.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-device-airplanemode-on"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Yesterday</a>
                                <p>Your Next flight for USA will be on 15th August 2015.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-store"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">Last Week</a>
                                <p>Jessy Jay open a new store at S.G Road.</p>
                            </div>
                        </div>
                        <div class="recent-activity-list chat-out-list row">
                            <div class="col s3 recent-activity-list-icon"><i class="mdi-action-settings-voice"></i>
                            </div>
                            <div class="col s9 recent-activity-list-text">
                                <a href="#">5 Days Ago</a>
                                <p>Natalya Parker Send you a voice mail for next conference.</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header light-blue white-text active"><i class="mdi-editor-attach-money"></i>Sales Repoart</div>
                    <div class="collapsible-body sales-repoart">
                        <div class="sales-repoart-list  chat-out-list row">
                            <div class="col s8">Target Salse</div>
                            <div class="col s4"><span id="sales-line-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Payment Due</div>
                            <div class="col s4"><span id="sales-bar-1"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Delivery</div>
                            <div class="col s4"><span id="sales-line-2"></span>
                            </div>
                        </div>
                        <div class="sales-repoart-list chat-out-list row">
                            <div class="col s8">Total Progress</div>
                            <div class="col s4"><span id="sales-bar-2"></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header red white-text"><i class="mdi-action-stars"></i>Favorite Associates</div>
                    <div class="collapsible-body favorite-associates">
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Eileen Sideways</p>
                                <p class="place">Los Angeles, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Zaham Sindil</p>
                                <p class="place">San Francisco, CA</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Renov Leongal</p>
                                <p class="place">Cebu City, Philippines</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img online-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Weno Carasbong</p>
                                <p>Tokyo, Japan</p>
                            </div>
                        </div>
                        <div class="favorite-associate-list chat-out-list row">
                            <div class="col s4"><img src="images\avatar.jpg" alt="" class="circle responsive-img offline-user valign profile-image">
                            </div>
                            <div class="col s8">
                                <p>Nusja Nawancali</p>
                                <p class="place">Bangkok, Thailand</p>
                            </div>
                        </div>
                    </div>
                </li>
                </ul>
            </li>
        </ul>
      </aside>
  <!-- LEFT RIGHT SIDEBAR NAV-->

  </div>
  <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
      <div class="container">
        <span>Copyright © 2015 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">GeeksLabs</a> All rights reserved.</span>
        <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
        </div>
    </div>
  </footer>
  <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js\plugins\jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="js\materialize.min.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js\plugins\prism\prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js\plugins\perfect-scrollbar\perfect-scrollbar.min.js"></script>
    <!-- chartist -->
    <script type="text/javascript" src="js\plugins\chartist-js\chartist.min.js"></script>   
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js\plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js\custom-script.js"></script>
    
</body>

</html>