<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m12 l3">
            <a href="<?= $listRecord ?>" class="btn blue"><i class="mdi-action-view-list"></i> List Province</a>
        </div>
        <div class="col s12 m12 l4">
            <a href="<?= $purgeRecycle ?>" class="btn red"><i class="mdi-action-delete"></i> Empty Recycle Bin</a>
        </div>
    </div>
    <div class="divider"></div>
        <div class="row">
            <div class="col s12 m12 l12">
                <table id="recycle-bin-table" class="responsive-table">
                    <thead>
                        <tr>
                            <th data-field="index">No</th>
                            <th data-field="name">Name</th>
                            <th data-field="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recycleRecord as $item): ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->name ?></td>
                            <td>
                                <button class="btn red remove-record"><i class="mdi-action-delete"></i></button>
                                <button class="btn green restore-record"><i class="mdi-action-history"></i></button>
                            </td>
                        </tr>
                        <?php $recordNumber++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('province','data_table') ?>
            </div>
        </div>
		<br/>
    <br>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url('js/custom/manipulate-record.js') ?>"></script>
<script type="text/javascript">
    let get_record_id = function() {
            let tr = this.closest('tr').getAttribute('id');
            let recordIndex = this.parentNode.parentNode.rowIndex;
            let table = this.closest('#recycle-bin-table');
            let url = '<?= esc($deleteRecord,'js') ?>';
            let deleteRecord = delete_record(url +'/' +tr,tr,true);
            if(deleteRecord) {
                 table.deleteRow(recordIndex);
            }
        }

        let restore_record_id = function() {
            let tr = this.closest('tr').getAttribute('id');
            let recordIndex = this.parentNode.parentNode.rowIndex;
            let table = this.closest('#recycle-bin-table');
            let url = '<?= esc($restoreRecord,'js') ?>';
            let restoreRecord = restore_record(url +'/' +tr,tr);
            if(restoreRecord) {
                 table.deleteRow(recordIndex);
            }
        }

        let buttonDelete = document.getElementsByClassName('remove-record');
        let buttonRestore = document.getElementsByClassName('restore-record');
        for (let i = 0; i < buttonDelete.length; i++) {
            buttonDelete[i].addEventListener('click', get_record_id.bind(buttonDelete[i]));
        }
        for (let i = 0; i < buttonRestore.length; i++) {
            buttonRestore[i].addEventListener('click',restore_record_id.bind(buttonRestore[i]));
        }
</script>
<!-- <script type="text/javascript">
    let callback = function() {
        let get_record_id = function() {
            let tr = this.closest('tr').getAttribute('id');
            let recordIndex = this.parentNode.parentNode.rowIndex;
            let table = this.closest('#recycle-bin-table');
            let url = '<?= esc($deleteRecord,'js') ?>';
            let deleteRecord = delete_record(url +'/' +tr,tr,true);
            if(deleteRecord) {
                 table.deleteRow(recordIndex);
            }
        }

        let restore_record_id = function() {
            let tr = this.closest('tr').getAttribute('id');
            let recordIndex = this.parentNode.parentNode.rowIndex;
            let table = this.closest('#recycle-bin-table');
            let url = '<?= esc($restoreRecord,'js') ?>';
            let restoreRecord = restore_record(url +'/' +tr,tr);
            if(restoreRecord) {
                 table.deleteRow(recordIndex);
            }
        }

        let buttonDelete = document.getElementsByClassName('remove-record');
        let buttonRestore = document.getElementsByClassName('restore-record');
        for (let i = 0; i < buttonDelete.length; i++) {
            buttonDelete[i].addEventListener('click', get_record_id.bind(buttonDelete[i]));
        }
        for (let i = 0; i < buttonRestore.length; i++) {
            buttonRestore[i].addEventListener('click',restore_record_id.bind(buttonRestore[i]));
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
</script> -->
<?= $this->endSection() ?>