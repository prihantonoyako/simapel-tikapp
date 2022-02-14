<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m12 l3">
            <a href="<?= $newRecord ?>" class="btn blue"><i class="mdi-content-add"></i> Add Password</a>
        </div>
        <div class="col s12 m12 l4">
            <a href="<?= $recycleRecord ?>" class="btn red"><i class="mdi-action-delete"></i> Recycle Bin</a>
        </div>
    </div>
    <div class="divider"></div>
        <div class="row">
            <div class="col s12 m12 l12">
                <table id="master-password-table" class="responsive-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php foreach($passwords as $item): ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->username ?></td>
                            <td><?= str_repeat("*", strlen($item->password)) ?></td>
                            <td>
                                <a href="#" class="btn red remove-record"><i class="mdi-action-delete"></i></a>
                                <a href="<?= $editRecord."/".$item->id ?>" class="waves-effect waves-light btn blue accent-3"><i class="mdi-editor-mode-edit"></i></a>
                                <a href="<?= $showRecord."/".$item->id ?>" class="waves-effect waves-light btn cyan accent-3"><i class="mdi-action-visibility"></i></a>
                            </td>
                        </tr>
						<?php $recordNumber++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('group', 'data_table') ?>
            </div>
        </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url('js/custom/manipulate-record.js') ?>"></script>
<script>
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