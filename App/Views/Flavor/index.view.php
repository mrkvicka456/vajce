<?php

/** @var \App\Models\Flavor[] $flavors */
/** @var ?string $message */
/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="tea-management" aria-labelledby="sprava-prichuti">
    <header class="page-intro management-intro">
        <div>
            <h1 id="sprava-prichuti">Správa príchutí</h1>
            <p>Pridávajte príchute a vyberajte čaje, ku ktorým patria.</p>
        </div>
        <a class="button" href="<?= e($link->url('flavor.create')) ?>">Pridať príchuť</a>
    </header>

    <?php if ($message !== null): ?>
        <p class="tea-notice" role="status"><?= e($message) ?></p>
    <?php endif; ?>

    <?php if ($flavors === []): ?>
        <p class="tea-notice">Zatiaľ nie sú vytvorené žiadne príchute. Pridajte prvú príchuť.</p>
    <?php else: ?>
        <ul class="tea-list" aria-label="Zoznam príchutí">
            <?php foreach ($flavors as $flavor): ?>
                <?php $teas = $flavor->getTeas(); ?>
                <li class="tea-record flavor-record">
                    <div class="tea-record-name">
                        <p class="eyebrow">Príchuť #<?= e($flavor->getId()) ?></p>
                        <h2><?= e($flavor->getName()) ?></h2>
                        <?php if ($flavor->getDescription() !== ''): ?>
                            <p><?= e($flavor->getDescription()) ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="relation-heading">Priradené čaje: <?= e(count($teas)) ?></p>
                        <?php if ($teas === []): ?>
                            <p class="field-hint">Zatiaľ bez priradenia.</p>
                        <?php else: ?>
                            <ul class="relation-tags" aria-label="Čaje s príchuťou <?= e($flavor->getName()) ?>">
                                <?php foreach ($teas as $tea): ?>
                                    <li><a href="<?= e($link->url('tea.edit', ['id' => $tea->getId()])) ?>"><?= e($tea->getName()) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="tea-actions">
                        <a class="button button-secondary" href="<?= e($link->url('flavor.edit', ['id' => $flavor->getId()])) ?>"
                           aria-label="Upraviť príchuť: <?= e($flavor->getName()) ?>">Upraviť</a>
                        <a class="button button-danger-outline" href="<?= e($link->url('flavor.delete', ['id' => $flavor->getId()])) ?>"
                           aria-label="Vymazať príchuť: <?= e($flavor->getName()) ?>">Vymazať</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>
