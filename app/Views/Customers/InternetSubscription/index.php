<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="record-data-table" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Internet Plan</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($recordData as $item) : ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordIndex ?></td>
                            <td><?= $item->first_name ?> <?= $item->last_name ?></td>
                            <td><?= $item->packet_name ?></td>
                            <td>
                                <?php if (strcmp($item->active, '1') == 0) : ?>
                                    <a href="#" class="btn green"></a>
                                <?php else : ?>
                                    <a href="#" class="btn red"></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" class="btn red remove-record"><i class="mdi-action-delete"></i></a>
                            </td>
                        </tr>
                        <?php $recordIndex++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->include('Pager/manual') ?>
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
            let table = this.closest('#record-data-table');
            let url = '<?= esc($deleteRecord,'js') ?>';
            let deleteRecord = delete_record(url +'/' +tr,tr,false);
            console.log(deleteRecord);
            console.log(typeof(deleteRecord));
            if(deleteRecord) {
                console.log('masuk job done');
                 table.deleteRow(recordIndex);
            }
            else{
                console.log('masuk job failed');
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