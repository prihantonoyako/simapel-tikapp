<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m12 l6">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m8 l9">
                        <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header "><?= $log->title ?></div>
                                <div class="collapsible-body">
                                    <p><?= $log->description ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12">
                        <a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i> Back</a>
                        <a href="<?= $url_edit ?>" class="btn right"><i class="mdi-editor-mode-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(!(is_null(session()->getFlashdata('errors'))&&is_null(session()->getFlashdata('conflict')))): ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<?php if (! is_null(session()->getFlashdata('errors'))) : ?>
				<h4 class="header2">ERROR</h4>
				<div class="row">
				<div class="col s12 m12 l12">
					<ul class="collapsible collapsible-accordion" data-collapsible="expandable">
						<?php foreach (session()->getFlashdata('errors') as $field => $error) : ?>
						<li>
							<div class="collapsible-header "><?= strtoupper($field) ?></div>
							<div class="collapsible-body"><p><?= $error ?></p></div>
						</li>
						<?php endforeach ?>
					</ul>
				</div>
				</div>
				<div class="divider"></div>
				<?php endif ?>
				<?php if (! is_null(session()->getFlashdata('conflict'))) : ?>
				<h4 class="header2">Message</h4>
				<div class="row">
					<div id="card-alert" class="card red s12 m12 l12">
						<div class="card-content white-text">
							<p><?= session()->getFlashdata('conflict') ?></p>
						</div>
					</div>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
<?= $this->endSection() ?>