<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s4 m2 l2">
            <a href="<?= $newRecord ?>" class="btn blue"><i class="mdi-content-add"></i> ADD</a>
        </div>
        <div class="col s4 m3 l3">
            <a href="<?= $recycleRecord ?>" class="btn red"><i class="mdi-action-delete"></i> RECYCLE BIN</a>
        </div>
		<div class="col s4 m3 l2">
			<a href="<?= $synchronizeBts ?>" class="btn green"><i class="mdi-action-settings-input-antenna"></i> SYNC</a>
		</div>
    </div>
    <div class="divider"></div>
        <div class="row">
            <div class="col s12 m12 l12">
                <table id="base-transceiver-station-table" class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th data-field="index">No</th>
                            <th data-field="name">Name</th>
							<th data-field="radio_name">Radio Name</th>
                            <th data-field="location">Location</th>
                            <th data-field="ip_address">IP Address</th>
							<th data-field="active">Active</th>
                            <th data-field="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($baseTransceiverStations as $item): ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->name ?></td>
							<td><?= $item->radio_name ?></td>
                            <td><?= $item->location ?></td>
                            <td><?= $item->ip_address ?></td>
							<td>
							<?php if(strcmp($item->active,'1')==0): ?>
								<a href="#" class="btn green"></a>
							<?php else: ?>
								<a href="#" class="btn red"></a>
							<?php endif; ?>
							</td>
                            <td>
                            <a href="#" class="btn red remove-record"><i class="mdi-action-delete"></i></a>
                                <a href="<?= $editRecord . "/" . $item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
                                <a href="<?= $showRecord . "/" . $item->id ?>" class="btn cyan"><i class="mdi-action-visibility"></i></a>
                            </td>
                        </tr>
						<?php $recordNumber++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('location', 'data_table') ?>
            </div>
        </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url('js/custom/manipulate-record.js') ?>"></script>
<script type="text/javascript">
    let callback = function() {
        let get_record_id = function() {
            let tr = this.closest('tr').getAttribute('id');
            let url = '<?= esc($deleteRecord,'js') ?>';
            let deleteRecord = delete_record(url +'/' +tr,tr,false);
        }
        
        let buttonDelete = document.getElementsByClassName('remove-record');
        for (let i = 0; i < buttonDelete.length; i++) {
            buttonDelete[i].addEventListener('click', get_record_id.bind(buttonDelete[i]));
        }
    }
    if (
        document.readyState === "complete" ||
        (document.readyState !== "loading" && !document.documentElement.doScroll)
    ) {
        callback();
    } else {
        document.addEventListener("DOMContentLoaded", callback);
    }
</script>
<?= $this->endSection() ?>