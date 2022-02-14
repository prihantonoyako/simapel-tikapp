<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <h4 class="header">Menu</h4>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12 m12 l3">
            <a href="<?= $listRecord ?>" class="btn-large blue"><i class="mdi-content-add"></i> List Menu</a>
        </div>
        <div class="col s12 m12 l3">
            <a href="<?= $purgeRecycle ?>" class="btn-large red"><i class="mdi-action-delete"></i> Empty Recycle Bin</a>
        </div>
    </div>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="menu-table" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach ($menuRecord as $item) : ?>
                        <tr id="<?= $item->menu_id ?>">
                            <td><?= $recordIndex ?></td>
                            <td><?= $item->menu_name ?></td>
                            <td><?= $item->group_menu_name ?></td>
                            <td><?= $item->menu_url ?></td>
                            <td><?= $item->menu_icon ?></td>
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
            let table = this.closest('#menu-table');
            let url = '<?= esc($deleteRecord,'js') ?>';
            let deleteRecord = delete_record(url +'/' +tr,tr,true);
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