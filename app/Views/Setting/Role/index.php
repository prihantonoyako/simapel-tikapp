<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <h4 class="header">Role</h4>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12 m12 l3">
            <a href="<?= $newRecord ?>" class="btn-large blue"><i class="mdi-content-add"></i> Add Menu</a>
        </div>
        <div class="col s12 m12 l3">
            <a href="<?= $recycleRecord ?>" class="btn-large red"><i class="mdi-action-delete"></i> Recycle Bin</a>
        </div>
    </div>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="role-table" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach ($roleRecord as $item) : ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->url ?></td>
                            <td>
                                <?php if (strcmp($item->active, '1') == 0) : ?>
                                    <a href="#" class="btn green accent-3"></a>
                                <?php else : ?>
                                    <a href="#" class=" btn red accent-3"></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" class="btn red remove-app-record"><i class="mdi-action-delete"></i></a>
                                <a href="<?= $editRecord . "/" . $item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
                                <a href="<?= $showRecord . "/" . $item->id ?>" class="btn cyan"><i class="mdi-action-visibility"></i></a>
                            </td>
                        </tr>
                        <?php $recordNumber++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('role', 'data_table') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>