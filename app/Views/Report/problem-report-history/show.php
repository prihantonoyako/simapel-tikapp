<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s4 m2 l2">
            <a href="<?= $newRecord ?>" class="btn blue"><i class="mdi-content-add"></i> Add</a>
        </div>
	</div>
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<div class="row">
					<div class="col s12 m12 l12">
						<ul class="collection">
							<?php foreach($histories as $history): ?>
								<?php if(intval($history->active) === 1): ?>
									<li class="collection-item active"><?= $history->title ?>
									<a href="<?= $url_log . "/" . $history->log ?>" class="secondary-content"><i class="mdi-content-send"></i></a>
									</li>
								<?php else: ?>
									<li class="collection-item"><?= $history->title ?><a href="<?= $url_log . "/" . $history->log ?>" class="secondary-content"><i class="mdi-content-send"></i></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="col s12 m12 l12">
					<div class="row">
						<div class="input-field col s12">
							<a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								</div>
								</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection() ?>