<?= $this->extend('Layouts/app') ?>

<?= $this->section('content') ?>
<section id="content">
	<?php if (!(is_null(session()->getFlashdata('error_messages')))) : ?>
		<div class="container">
			<div id="card-alert" class="card red">
				<div class="card-content white-text">
					<p><?= session()->getFlashdata('error_messages') ?></p>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if(!(is_null(session()->getFlashdata('success_messages')))) : ?>
		<div class="container">
			<div id="card-alert" class="card green">
				<div class="card-content white-text">
					<p><?= session()->getFlashdata('success_messages') ?></p>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div id="breadcrumbs-wrapper">
		<div class="container">
			<div class="row">
				<div class="col s12 m12 l12">
					<br>
					<nav>
						<div class="nav-wrapper">
							<div class="col s12">
								<?php foreach ($currentNavigation as $item) : ?>
									<a href="#" class="breadcrumb"><?= $item ?></a>
								<?php endforeach; ?>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--breadcrumbs end-->

	<!--start container-->
	<div class="container">

		<?= $this->renderSection('dashboard-content') ?>

	</div>
	<!--end container-->
</section>
<?= $this->endSection() ?>