<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
		<div class="col s12 m12 l2">
            <a href="<?= $newRecord ?>" class="btn blue"><i class="mdi-content-add"></i> ADD</a>
        </div>
        <div class="col s12 m12 l3">
            <a href="<?= $recycleRecord ?>" class="btn red"><i class="mdi-action-delete"></i> Recycle Bin</a>
        </div>
    </div>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="tabel-data" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th data-field="index">No</th>
                        <th data-field="title">Title</th>
                        <th data-field="category">Category</th>
						<th data-field="ammount">Ammount</th>
                        <th data-field="date">Date</th>
                        <th data-field="is_income">Income/Expense</th>
                        <th data-field="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $item) : ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->title ?></td>
                            <td><?= $item->category->name ?></td>
                            <td>Rp. <?= number_format($item->ammount) ?></td>
							<td><?= $item->date ?></td>
                        <td>
							<?php if(intval($item->category->is_income) == 1): ?>
								Income
							<?php else: ?>
								Expense
							<?php endif; ?>
						</td>
                            <td>
                                <a href="#" class="btn red remove-record"><i class="mdi-action-delete"></i></a>
                                <a href="<?= $editRecord . "/" . $item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
                            </td>
                        </tr>
                        <?php $recordNumber++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('category', 'data_table') ?>
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