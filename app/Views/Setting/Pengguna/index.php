<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m3 l2">
            <a href="<?= $newRecord ?>" class="btn blue"><i class="mdi-content-add"></i> Add</a>
        </div>
        <div class="col s12 m4 l3">
            <a href="<?= $recycleRecord ?>" class="btn red"><i class="mdi-action-delete"></i> Recycle Bin</a>
        </div>
    </div>
    <div class="divider"></div>
        <div class="row">
            <div class="col s12 m12 l12">
                <table id="user-table" class="responsive-table bordered">
                    <thead>
                        <tr>
                            <th data-field="index">No</th>
                            <th data-field="username">Username</th>
							<th data-field="email">Email</th>
							<th data-field="active">Active</th>
                            <th data-field="action">Action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Username</th>						
							<th>Email</th>
							<th>Active</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php foreach($userRecord as $item): ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->username ?></td>
							<td><?= $item->email ?></td>
							<td>
							<?php if(strcmp($item->active,'1')==0): ?>
								<button class="btn green"></button>
							<?php else: ?>
								<button class="btn red"></button>
							<?php endif; ?>
							</td>
                            <td>
                                <a href="#" class="btn red remove-record"><i class="mdi-action-delete"></i></a>
                                <a href="<?= $editRecord."/".$item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
                            </td>
                        </tr>
						<?php $recordNumber++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('user','data_table') ?>
            </div>
        </div>	
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" sr="<? base_url('js/custom/manipulate-record.js') ?>"></script>
<script type="text/javascript">
    let callback = function() {
        let get_record_id = function() {
            let tr = this.closest('tr').getAttribute('id');
            let url = '<?= esc($deleteRecord,'js') ?>';
            let deleteRecord = delete_record_temporary(url +'/' +tr,tr);
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