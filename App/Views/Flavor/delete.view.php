<?php

/** @var \App\Models\Flavor $flavor */
/** @var string $token */
/** @var \Framework\Support\LinkGenerator $link */
$teas = $flavor->getTeas();
?>
<section class="tea-management" aria-labelledby="flavor-delete-title">
    <header class="page-intro">
        <h1 id="flavor-delete-title">Vymazať príchuť</h1>
    </header>
    <form class="tea-form" method="post" action="<?= e($link->url('flavor.delete', ['id' => $flavor->getId()])) ?>">
        <input type="hidden" name="token" value="<?= e($token) ?>">
        <p>Chcete vymazať príchuť <strong><?= e($flavor->getName()) ?></strong>?</p>
        <p class="delete-explanation">Odstránia sa aj jej priradenia k čajom. Samotné čaje zostanú zachované.</p>
        <?php if ($teas !== []): ?>
            <p class="relation-heading">Dotknuté čaje: <?= e(count($teas)) ?></p>
            <ul class="relation-tags">
                <?php foreach ($teas as $tea): ?>
                    <li><?= e($tea->getName()) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="tea-actions">
            <button class="button button-danger" type="submit">Vymazať príchuť</button>
            <a class="button button-secondary" href="<?= e($link->url('flavor.index')) ?>">Zrušiť</a>
        </div>
    </form>
</section>
