<ul class="pagination">
    <?php if ($Paginator->has_previous_page()) : ?>
        <li>
            <a class="btn cyan" href="<?= $Paginator->get_first_page() ?>" aria-label="<?= lang('Pager.first') ?>">
                <span aria-hidden="true"><?= lang('ManualPaginator.first') ?></span>
            </a>
        </li>
        <li class="waves-effect">
            <a href="<?= $Paginator->get_previous_page() ?>">
                <i class="mdi-navigation-chevron-left"></i>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($Paginator->links() as $link) : ?>
        <li <?= $link['active'] ? 'class="active"' : '' ?>>
            <a href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($Paginator->has_next_page()) : ?>
        <li class="waves-effect">
            <a href="<?= $Paginator->get_next_page() ?>">
                <i class="mdi-navigation-chevron-right"></i>
            </a>
        </li>
        <li>
            <a class="btn cyan" href="<?= $Paginator->get_last_page() ?>" aria-label="<?= lang('Pager.last') ?>">
                <span aria-hidden="true"><?= lang('ManualPaginator.last') ?></span>
            </a>
        </li>
    <?php endif ?>
</ul>