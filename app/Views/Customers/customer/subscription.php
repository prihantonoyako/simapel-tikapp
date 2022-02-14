<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s4 m2 l2">
            <a href="<?= $addSubscription ?>" class="btn blue"><i class="mdi-content-add"></i> Add</a>
        </div>
		<div class="col s4 m2 l2">
			<a href="<?= $listCustomer ?>" class="btn blue"><i class="mdi-action-view-list"></i> List Customer</a>
		</div>
		<div class="col s12">
			<div class="divider"></div>
			<h4 class="header">Subscriptions</h4>
		</div>

		<section class="plans-container" id="plans">
			<?php foreach($subscriptions as $subscription): ?>
			<article class="col s12 m6 l4">
				<div class="card z-depth-1">
					<div class="card-image light-blue waves-effect">
						<div class="card-title"><?= $subscription->internet_plan->name ?></div>
						<div class="price"><sup>IDR</sup><?= number_format($subscription->internet_plan->price) ?><sub>/month</sub></div>
						<div class="price-desc">
							<?php if(intval($subscription->internet_plan->dedicated) == 1): ?>
								Dedicated Internet Bandwidth
							<?php else: ?>
								Shared Internet Bandwidth
							<?php endif; ?>
						</div>
					</div>
					<div class="card-content">
						<ul class="collection">
							<li class="collection-item"><?= $subscription->internet_plan->download . " " .$subscription->internet_plan->download_unit."bps"?> Download</li>
							<li class="collection-item"><?= $subscription->internet_plan->upload . " " .$subscription->internet_plan->upload_unit."bps" ?> Upload</li>
						</ul>
					</div>
					<div class="card-action center-align">
						<a href="<?= $url_edit ."/".$subscription->id ?>" class="waves-effect waves-light light-blue btn">Edit</a>
					</div>
				</div>
			</article>
			<?php endforeach; ?>
		</section>
	</div>
</div>
<?= $this->endSection() ?>