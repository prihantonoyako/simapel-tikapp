<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<div class="row">
					<div class="col s12 m12 l12">
						<ul class="collapsible collapsible-accordion" data-collapsible="expandable">
							<li>
								<div class="collapsible-header">Customer Information</div>
								<div class="collapsible-body">
									<table class="bordered">
										<thead>
											<tr>
												<th data-field="Info">Info</th>
												<th data-field="data">Data</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>First Name</td>
												<td><?= $customer->first_name ?></td>
											</tr>
											<tr>
												<td>Last Name</td>
												<td><?= $customer->last_name ?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td><?= $customer->email ?></td>
											</tr>
										</tbody>
									</table>
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
<?= $this->endSection() ?>