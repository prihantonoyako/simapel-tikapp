<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="bill-table" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Subscriptions</th>
                        <th>Month</th>
						<th>Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($bills as $item) : ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $i ?></td>
                            <td><?= $item->plan ?></td>
                            <td><?= $item->month ?></td>
                            <td><?= $item->year ?></td>
							<td>
                                <?php if (intval($item->active) == 1) : ?>
                                   Aktif
                                <?php else : ?>
                                    Lunas
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= $editRecord . "/" . $item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
            let recordIndex = this.parentNode.parentNode.rowIndex;
            let table = this.closest('#bill-table');
            let url = '<?= esc($deleteRecord,'js') ?>';
            let deleteRecord = delete_record(url +'/' +tr,tr,false);
            console.log(deleteRecord);
            console.log(typeof(deleteRecord));
            if(deleteRecord) {
                 table.deleteRow(recordIndex);
            }
            else{
            }
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