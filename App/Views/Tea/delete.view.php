<?php

/** @var \App\Models\Tea $tea */
/** @var string $token */
/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="tea-management" aria-labelledby="tea-delete-title">
    <header class="page-intro">
        <h1 id="tea-delete-title">Vymazať čaj</h1>
    </header>
    <form class="tea-form" method="post" action="<?= e($link->url('tea.delete', ['id' => $tea->getId()])) ?>">
        <input type="hidden" name="token" value="<?= e($token) ?>">
        <p>Chcete vymazať <strong><?= e($tea->getName()) ?></strong>? Čaj sa odstráni aj z katalógu.</p>
        <div class="tea-actions">
            <button class="button button-danger" type="submit">Vymazať čaj</button>
            <a class="button button-secondary" href="<?= e($link->url('tea.index')) ?>">Zrušiť</a>
        </div>
    </form>
</section>
