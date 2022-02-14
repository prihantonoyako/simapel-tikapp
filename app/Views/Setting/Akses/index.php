<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="access-table" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Access</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Access</th>
                        <th>Action</th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach ($rolesRecord as $item) : ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordNumber ?></td>
                            <td><?= $item->name ?></td>
                            <td>
                                <div class="container">
                                    <div class="row">
                                    <?php foreach ($item->access as $key => $access) : ?>
                                            <div class="col s3 center">
                                                <a href="#" class="btn cyan"><?= $access ?></a>
                                            </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="<?= $editRecord . "/" . $item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
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