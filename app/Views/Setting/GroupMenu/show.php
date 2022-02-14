<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div class="section">
    <!--Basic Form-->
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 m12 l6">
                <div class="card-panel">
                    <h4 class="header2">Information Detail</h4>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <ul class="collapsible collapsible-accordion" data-collapsible="expandable">
                                <li>
                                    <div class="collapsible-header ">Name</div>
                                    <div class="collapsible-body">
                                        <p><?= $groupMenu->name ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="collapsible-header ">Uniform Resource Locator</div>
                                    <div class="collapsible-body">
                                        <p><?= $groupMenu->url ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="collapsible-header ">Icon</div>
                                    <div class="collapsible-body">
										<div class="row icon-container section">
											<div class="icon-preview col s6 m3">
												<i class="<?= $groupMenu->icon ?>"></i>
												<span><?= $groupMenu->icon ?></span>
											</div>
										</div>
                                    </div>
                                </li>
								<li>
									<div class="collapsible-header">Order Number</div>
									<div class="collapsible-body">
										<p><?= $groupMenu->ordinal ?></p>
									</div>
								</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i> Back</a>
                            <a href="<?= $url_edit ?>" class="btn right"><i class="mdi-editor-mode-edit"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>