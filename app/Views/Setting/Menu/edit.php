<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div id="basic-form" class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<div class="row">
					<form class="col s12" method="POST" action="<?= $url_action ?>">
					<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col s12">
								<select name="group">
									<?php foreach($groupMenu as $item): ?>
									<?php if ($item->id==$menuRecord->group): ?>
										<option value="<?= $item->id ?>" selected><?= $item->name ?></option>
									<?php else: ?>
										<option value="<?= $item->id ?>"><?= $item->name ?></option>
									<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="name" value="<?= $menuRecord->name ?>" type="text">
								<label for="name">Name</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="url" value="<?= $menuRecord->url ?>" type="text">
								<label for="url">Uniform Resource Locator</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="icon" name="icon" value="<?= $menuRecord->icon ?>" type="text">
								<label for="icon">Icon</label>
							</div>
						</div>
						<div class="row">
							<div class="col s12">
								<a href="#" id="check-icon-availability" class="btn blue waves-effect waves-light">CHECK ICON</a>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="ordinal" value="<?= $menuRecord->ordinal ?>" type="number" min=1>
								<label for="ordinal">Order Number</label>
							</div>
						</div>
						<div class="row">
						<?php if(strcmp($menuRecord->active,'1')==0): ?>
							<div class="switch">
								Active : <label>Off<input type="checkbox" name="active" checked><span class="lever"></span> On</label>
							</div>
						<?php else: ?>
							<div class="switch">
								Active : <label>Off<input type="checkbox" name="active"><span class="lever"></span> On</label>
							</div>
						<?php endif; ?>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								<button class="btn right" type="submit" name="action">SUBMIT<i class="mdi-content-send right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<h4 class="header2">RESERVED ORDER</h4>
				<div class="row">
				<?php $i = 1; ?>
				<?php $delimit = count($allMenu); ?>
				<?php foreach($allMenu as $item): ?>
				<?php if($i == 1 || ($i-1)%6 ==0): ?>
				<div class="row">
				<?php endif; ?>
				<div class="col s2 m2 l2">
					<?php if($item->ordinal==$menuRecord->ordinal): ?>
					<button class="btn blue"><?= $item->ordinal ?></button>
					<?php else: ?>
						<button class="btn red"><?= $item->ordinal ?></button>
					<?php endif; ?>
				</div>
				<?php if($i % 6 == 0 || $i == $delimit ): ?>
				</div>
				<br>
				<?php endif; ?>
				<?php $i++ ?>
				<?php endforeach; ?>
				</div>
				<div class="divider"></div>
				<h4 class="header2">ICON PREVIEW</h4>
				<div class="row">
					<div id="action" class="row icon-container section">
						<div class="icon-preview col s6 m3">
							<i id="icon-preview" class="<?= $menuRecord->icon ?>"></i>
						</div>
					</div>
				</div>
				<?php if(!(is_null(session()->getFlashdata('errors'))&&is_null(session()->getFlashdata('conflict')))): ?>
				<div class="divider"></div>
				<h4 class="header2">ERROR</h4>
				<div class="row">
				<?php if (! empty($errors)) : ?>
				<?php foreach ($errors as $field => $error) : ?>
				<div id="card-alert" class="card light-blue col s12 grid-example">
					<div class="card-content white-text">
						<span class="flow-text"><p><?= $error ?></p></span>
					</div>
				</div>
				<?php endforeach ?>
				<?php endif ?>
				</div>
				<div class="divider"></div>
				<h4 class="header2">Message</h4>
				<div class="row">
				<?php if (! empty($conflict)) : ?>
				<div id="card-alert" class="card light-blue col s12 grid-example">
					<div class="card-content white-text">
						<span class="flow-text"><p><?= $conflict ?></p></span>
					</div>
				</div>
				<?php endif ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
$(document).ready(function() {
	$('#check-icon-availability').click(function() {
		let newIcon = $('#icon').val();
		let oldIcon = $('#icon-preview').attr('class');
		$('#icon-preview').removeClass(oldIcon).addClass(newIcon);
	});
});
// </script>
<?= $this->endSection() ?>