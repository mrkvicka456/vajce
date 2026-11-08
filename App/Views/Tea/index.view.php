<?php

/** @var \App\Models\Tea[] $teas */
/** @var ?string $message */
/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="tea-management" aria-labelledby="sprava-cajov">
    <header class="page-intro management-intro">
        <div>
            <h1 id="sprava-cajov">Správa čajov</h1>
            <p>Pridávajte čaje a upravujte ich údaje v katalógu.</p>
        </div>
        <a class="button" href="<?= e($link->url('tea.create')) ?>">Pridať čaj</a>
    </header>

    <?php if ($message !== null): ?>
        <p class="tea-notice" role="status"><?= e($message) ?></p>
    <?php endif; ?>

    <?php if ($teas === []): ?>
        <p class="tea-notice">V ponuke zatiaľ nie sú žiadne čaje. Pridajte prvý čaj.</p>
    <?php else: ?>
        <ul class="tea-list" aria-label="Zoznam čajov">
            <?php foreach ($teas as $tea): ?>
                <li class="tea-record">
                    <div class="tea-record-name">
                        <p class="eyebrow">Čaj #<?= e($tea->getId()) ?></p>
                        <h2><?= e($tea->getName()) ?></h2>
                        <?php if ($tea->getDescription() !== ''): ?>
                            <p><?= e($tea->getDescription()) ?></p>
                        <?php endif; ?>
                    </div>
                    <dl class="tea-record-data">
                        <div><dt>Kategória</dt><dd><?= e($tea->getCategoryLabel()) ?></dd></div>
                        <div><dt>Pôvod</dt><dd><?= e($tea->getOrigin()) ?></dd></div>
                        <div><dt>Gramáž</dt><dd><?= e($tea->getWeight()) ?>&nbsp;g</dd></div>
                        <div><dt>Cena</dt><dd><?= e($tea->getFormattedPrice()) ?>&nbsp;€</dd></div>
                    </dl>
                    <div class="tea-actions">
                        <a class="button button-secondary" href="<?= e($link->url('tea.edit', ['id' => $tea->getId()])) ?>"
                           aria-label="Upraviť: <?= e($tea->getName()) ?>">Upraviť</a>
                        <a class="button button-danger-outline" href="<?= e($link->url('tea.delete', ['id' => $tea->getId()])) ?>"
                           aria-label="Vymazať: <?= e($tea->getName()) ?>">Vymazať</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>
