<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m12 l3">
            <a href="<?= $newRecord ?>" class="btn blue"><i class="mdi-content-add"></i> Add</a>
        </div>
        <div class="col s12 m12 l4">
            <a href="<?= $recycleRecord ?>" class="btn red"><i class="mdi-action-delete"></i> Recycle Bin</a>
        </div>
    </div>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="district-table" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th data-field="index">No</th>
                        <th data-field="name">Name</th>
                        <th data-field="city">City</th>
                        <th data-field="province">Province</th>
                        <th data-field="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($districts as $district) : ?>
                        <tr id="<?= $district->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $district->name ?></td>
                            <td><?= $district->city ?></td>                            
                            <td><?= $district->province ?></td>
                            <td>
                                <a href="#" class="btn red remove-record"><i class="mdi-action-delete"></i></a>
                                <a href="<?= $editRecord . "/" . $district->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
                            </td>
                        </tr>
                        <?php $recordNumber++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('district', 'data_table') ?>
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