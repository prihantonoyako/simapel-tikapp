<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div id="profile-page" class="section">
	<!-- profile-page-header -->
	<div id="profile-page-header" class="card">
		<div class="card-image waves-effect waves-block waves-light">
			<img class="activator" src="<?= base_url('materialize/v3.1/images/user-profile-bg.jpg') ?>" alt="user background">                    
		</div>
		<figure class="card-profile-image">
			<img src="<?= $avatarRecord ?>" alt="profile image" class="circle z-depth-2 responsive-img activator">
		</figure>
		<div class="card-content">
			<div class="row">                    
				<div class="col s3 offset-s2">                        
					<h4 class="card-title grey-text text-darken-4"><?= $userRecord->username ?></h4>
					<p class="medium-small grey-text"><?= $userRecord->email ?></p>                        
				</div>
				<div class="col s1 right-align">
					<a class="btn-floating activator waves-effect waves-light darken-2 right">
						<i class="mdi-action-perm-identity"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="card-reveal">
			<p>
				<span class="card-title grey-text text-darken-4"><?= $userRecord->username ?> <i class="mdi-navigation-close right"></i></span>
			</p>
			<p><i class="mdi-communication-email cyan-text text-darken-2"></i> <?= $userRecord->email ?></p>
		</div>
	</div>
	<div class="card">
		<div class="col s12 m12 l12">
			<a href="<?= $url_back ?>" class="btn cyan waves-effect waves-light left"><i class="mdi-navigation-arrow-back"></i> Back</a>
			<a href="<?= $url_edit ?>" class="btn blue waves-effect waves-light right"><i class="mdi-editor-mode-edit"></i> Edit</a>
		</div>
	</div>
</div>
<?= $this->endSection() ?>