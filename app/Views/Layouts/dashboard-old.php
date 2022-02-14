<?= $this->extend('Layouts/app') ?>
<?= $this->section('body') ?>
<div class="wrapper">
    <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="<?= base_url('material-dashboard-pro-master/assets/img/sidebar-1.jpg') ?>">
        <div class="logo">
            <a href="http://www.creative-tim.com/" class="simple-text">
                SIMAPEL-TIKAPP
            </a>
        </div>
        <div class="logo logo-mini">
            <a href="http://www.creative-tim.com/" class="simple-text">
                ST
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="<?= base_url($avatar) ?>" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <?= $usernamePengguna ?>
                        <b class="caret"></b>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#">My Profile</a>
                            </li>
                            <li>
                                <a href="#">Edit Profile</a>
                            </li>
                            <li>
                                <a href="#">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav">
                <li class="active">
                    <a href="/web/logout"><i class="material-icons">power_settings_new</i>LOGOUT</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard <?= $active_role->name ?></p>
                    </a>
                </li>
                
                
                <?php foreach ($group_menu as $item_group) : ?>
                    <li>
                    <a data-toggle="collapse" href="#<?= $item_group->id ?>">
                        <i class="material-icons"><?= $item_group->icon ?></i>
                        <p><?= $item_group->name ?>
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="<?= $item_group->id ?>">
                        <ul class="nav">
                            <?php foreach ($menu as $item_menu) : ?>
                                <?php if ($item_group->id == $item_menu->id_group) : ?>
                                    <li>
          
                                        <a href="<?= base_url('web' . "/" . $item_group->url . "/" . $item_menu->url_menu) ?>">
                                        <i class="material-icons"><?= $item_menu->icon_menu ?></i> <?= $item_menu->name_menu ?>
                                        </a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                        <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                        <i class="material-icons visible-on-sidebar-mini">view_list</i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> SISTEM INFORMASI MANAJEMEN PELANGGAN ISP (MIKROTIK)</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#role" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">people_alt</i>
                                <p class="hidden-lg hidden-md alert ">Profile</p>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($role as $item) : ?>
                                        <li>
                                            <a href="<?= base_url("web/"."/dashboard"."/".$item->url) ?>"><?= $item->name ?></a>
                                        </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://www.creative-tim.com/">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>
<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title"> Sidebar Filters</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                    <div class="badge-colors text-center">
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-rose active" data-color="rose"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Sidebar Background</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="text-center">
                        <span class="badge filter badge-white" data-color="white"></span>
                        <span class="badge filter badge-black active" data-color="black"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Sidebar Mini</p>
                    <div class="togglebutton switch-sidebar-mini">
                        <label>
                            <input type="checkbox" unchecked="">
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Sidebar Image</p>
                    <div class="togglebutton switch-sidebar-image">
                        <label>
                            <input type="checkbox" checked="">
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Images</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('material-dashboard-pro-master/assets/img/sidebar-1.jpg') ?>" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('material-dashboard-pro-master/assets/img/sidebar-2.jpg') ?>" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('material-dashboard-pro-master/assets/img/sidebar-3.jpg') ?>" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="<?= base_url('material-dashboard-pro-master/assets/img/sidebar-4.jpg') ?>" alt="" />
                </a>
            </li>
        </ul>
    </div>
</div>
<?= $this->endsection() ?>