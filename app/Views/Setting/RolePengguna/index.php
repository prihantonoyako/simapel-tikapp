<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
    <h4 class="header">User Role</h4>
    <div class="divider"></div>
    <div class="row">
        <div class="col s12 m12 l12">
            <table id="role-table" class="responsive-table bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach ($userRecord as $item) : ?>
                        <tr id="<?= $item->id ?>">
                            <td><?= $recordIndex ?></td>
                            <td><?= $item->username ?></td>
                            <td>
                                <?php foreach ($userRoleRecord[$item->id] as $role) : ?>
                                    <a href="#" class="btn cyan"><?= $role ?></a>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <a href="<?= $editRecord . "/" . $item->id ?>" class="btn blue"><i class="mdi-editor-mode-edit"></i></a>
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