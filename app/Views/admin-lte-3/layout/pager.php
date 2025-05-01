<!--<ul class="pagination pagination-sm float-right">
    <li class="page-item"><a class="page-link" href="#">«</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">»</a></li>
</ul>-->
<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<ul class="pagination pagination-sm float-right">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" class="page-link">
                &laquo;
            </a>
        </li>
        <li class="page-item">
            <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>" class="page-link">
                &lsaquo;
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li class="page-item">
            <a href="<?= $link['uri'] ?>" class="page-link<?= $link['active'] ? ' text-dark' : '' ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="page-item">
            <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
                &rsaquo;
            </a>
        </li>
        <li class="page-item">
            <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" class="page-link">
                &raquo;
            </a>
        </li>
    <?php endif ?>
</ul>