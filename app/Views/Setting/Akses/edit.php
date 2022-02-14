<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l4">
			<div class="card-panel">
				<h4 class="header2">EDIT ACCESS <?= $roleRecord->name ?></h4>
				<div class="row">
					<form class="col s12" action="<?= $url_action ?>" method="POST">
					<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col s12">
								<input type="text" name="role" value="<?= $roleRecord->id ?>" readonly>
								<label for="role">ID ROLE</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<select name="menu">
									<?php foreach($possibleAccesses as $item): ?>
									<option value="<?= $item->id ?>"><?= $item->group.".".$item->name ?></option>
									<?php endforeach; ?>
								</select>
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
		<div class="col s12 m12 l8">
			<div class="card-panel">
				<h4 class="header2">ACCESS</h4>
				<div class="row">
					<?php foreach($accesses as $item): ?>
					<a href="#" id="<?= $item->id ?>" class="btn cyan col s12 m12 l3 delete-access"><?= $item->group . "." . $item->name ?></a>
					<?php endforeach; ?>
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
<?= $this->section('scripts') ?>
<script type"text/javascript">
	$(document).ready(function() {
		let access = $('.delete-access');
		access.click(function() {
			let accessDelete = $(this).attr('id');
			let url = "<?= esc($uri,'js') ?>" + "/delete" +"/"+"<?= esc($roleRecord->id,'js')?>";
			swal({
                title: "Are you sure?",
                text: "You will not be able to recover this data!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it!",  
                closeOnConfirm: false,   
                showLoaderOnConfirm: true, 
            },function() {
				$.ajax({
                    url: url,
                    accepts: {
                        json: 'application/json'
                    },
                    type: "POST",
                    dataType: 'json',
                    data: {
                        accessDelete: accessDelete,
						permanent: false
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(result) {
                        swal({
                            title: 'Deleted!',
                            text: result.status,
                            type: 'success',
                            confirmButtonClass: "btn btn-success",
                            buttonsStyling: false
                        });
						$("#"+accessDelete).remove();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: "Oops!",
                            text: jqXHR.responseText,
                            type: "error",
                            timer: 5000
                        });
                    }
                });
			});
		});
	});
</script>
<?= $this->endSection() ?>
