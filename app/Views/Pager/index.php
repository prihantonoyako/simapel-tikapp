<ul class="pagination">
    <?php if ($pager->hasPreviousPage()) : ?>
        <li>
            <a class="btn cyan" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                <span aria-hidden="true"><?= lang('Pager.first') ?></span>
            </a>
        </li>
        <li class="waves-effect">
            <a href="<?= $pager->getPreviousPage() ?>">
                <i class="mdi-navigation-chevron-left"></i>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li <?= $link['active'] ? 'class="active"' : '' ?>>
            <a href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNextPage()) : ?>
        <li class="waves-effect">
            <a href="<?= $pager->getNextPage() ?>">
                <i class="mdi-navigation-chevron-right"></i>
            </a>
        </li>
        <li>
            <a class="btn cyan" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                <span aria-hidden="true"><?= lang('Pager.last') ?></span>
            </a>
        </li>
    <?php endif ?>
</ul>