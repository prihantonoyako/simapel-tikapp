<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <?php if (isset($newRecord, $recycleRecord)) : ?>
            <div class="col s2 m2 l2">
                <a href="<?= $newRecord ?>" class="btn blue"><i class="mdi-content-add"></i> Add</a>
            </div>
            <div class="col s2 m3 l2">
                <a href="<?= $recycleRecord ?>" class="btn red"><i class="mdi-action-delete"></i> Recycle Bin</a>
            </div>
        <?php elseif (isset($listRecord, $purgeRecord)) : ?>
            <div class="col s2 m2 l2">
                <a href="<?= $listRecord ?>" class="btn blue"><i class="mdi-action-list"></i> List Record</a>
            </div>
            <div class="col s2 m3 l2">
                <a href="<?= $purgeRecord ?>" class="btn red"><i class="mdi-action-delete"></i> Empty Recycle Bin</a>
            </div>
        <?php else : ?>
            No Action
        <?php endif; ?>
    </div>    
    <div class="divider"></div>
        <div class="row">
            <div class="col s12 m12 l12">
                <table id="item-table" class="responsive-table display" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
							<th>Vendor</th>
							<th>Type</th>
                            <th>Quantity</th>
                            <th>Used</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($items as $item): ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->vendor ?></td>
							<td>
                                <?php if($item->is_bts === 1): ?>
                                    BTS
                                <?php else: ?>
                                    Non BTS
                                <?php endif; ?>
                            </td>
							<td><?= $item->quantity ?></td>
                            <td><?= $item->used ?></td>
                            <td>
                                <a href="#" class="btn red remove-record"><i class="mdi-action-delete"></i></a>
                                <?php if (isset($editRecord)) : ?>
                                    <a href="<?= $editRecord . "/" . $item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
                                <?php elseif (isset($restoreRecord)) : ?>
                                    <button class="btn green restore-record"><i class="mdi-action-history"></i></a>
                                    <?php else : ?>
                                        No Action
                                <?php endif; ?>
                            </td>
                        </tr>
						<?php $recordNumber++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('item', 'data_table') ?>
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
            let deleteRecord = delete_record(url +'/' +tr,tr, <?= esc($flagDelete, 'js') ?>);
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
<?php if (isset($restoreRecord)) : ?>
    <script type="text/javascript">
        let restore_record_id = function() {
            let tr = this.closest('tr').getAttribute('id');
            let recordIndex = this.parentNode.parentNode.rowIndex;
            let table = this.closest('#item-table');
            let url = '<?= esc($restoreRecord, 'js') ?>';
            let restoreRecord = restore_record(url + '/' + tr, tr);
            if (restoreRecord) {
                table.deleteRow(recordIndex);
            }
        }
        let buttonRestore = document.getElementsByClassName('restore-record');
        for (let i = 0; i < buttonRestore.length; i++) {
            buttonRestore[i].addEventListener('click', restore_record_id.bind(buttonRestore[i]));
        }
    </script>
<?php endif; ?>
<?= $this->endSection() ?>