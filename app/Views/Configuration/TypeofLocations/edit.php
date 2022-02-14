<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div id="basic-form" class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<h4 class="header2">EDIT ITEM TYPE</h4>
				<div class="row">
					<form class="col s12" method="POST" action="<?= $url_action ?>">
						<div class="row">
							<div class="input-field col s12">
								<input name="name" value="<?= $typeofItem->name ?>" type="text">
								<label for="name">Name</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								 <textarea id="description" class="materialize-textarea" name="description" length="255"></textarea>
								<label id="description-label" for="description">Description</label>
							</div>
						</div>			
						<div class="row">
							<div class="input-field col s12">
								<a href="<?= $url_back ?>" class="btn cyan waves-effect waves-light left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								<button class="btn cyan waves-effect waves-light right" type="submit" name="action">SUBMIT<i class="mdi-content-send right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<h4 class="header2">ERROR</h4>
				<div class="row">
				<?php if (! is_null(session()->getFlashdata('errors'))) : ?>
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
				<?php endif ?>
				</div>
				<div class="divider"></div>
				<h4 class="header2">Message</h4>
				<div class="row">
					<?php if (! is_null(session()->getFlashdata('conflict'))) : ?>
					<div id="card-alert" class="card red s12 m12 l12">
						<div class="card-content white-text">
							<p><?= session()->getFlashdata('conflict') ?></p>
						</div>
					</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
let contentReady = function() {
	let descriptionLabel = document.getElementById("description-label");
	descriptionLabel.classList.add("active");
	document.getElementById("description").defaultValue = "<?= esc($typeofItem->description,'js') ?>";
}
if(document.readyState === "complete"||
	(document.readyState !== "loading" && !document.documentElement.doScroll)
) {
	contentReady;
} else {
	document.addEventListener("DOMContentLoaded",contentReady);
}
</script>
<?= $this->endSection() ?>