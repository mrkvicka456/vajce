<?php

/** @var \App\Models\Tea $tea */
/** @var bool $isEdit */
/** @var array $values */
/** @var array $errors */
/** @var array $categories */
/** @var string $token */
/** @var \Framework\Support\LinkGenerator $link */
$action = $isEdit ? $link->url('tea.edit', ['id' => $tea->getId()]) : $link->url('tea.create');
?>
<section class="tea-management" aria-labelledby="caj-form-title">
    <header class="page-intro">
        <h1 id="caj-form-title"><?= $isEdit ? 'Upraviť čaj' : 'Pridať čaj' ?></h1>
        <p>Vyplňte údaje, ktoré sa zobrazia v katalógu.</p>
    </header>

    <form class="tea-form" action="<?= e($action) ?>" method="post">
        <input type="hidden" name="token" value="<?= e($token) ?>">
        <?php if ($errors !== []): ?>
            <div class="tea-notice tea-errors" role="alert">
                <p><strong>Skontrolujte zadané údaje.</strong></p>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="tea-form-fields">
            <div class="tea-field">
                <label for="tea-name">Názov čaju</label>
                <input id="tea-name" name="name" value="<?= e($values['name']) ?>" maxlength="80" required>
            </div>
            <div class="tea-field">
                <label for="tea-category">Kategória</label>
                <select id="tea-category" name="category" required>
                    <option value="">Vyberte kategóriu</option>
                    <?php foreach ($categories as $key => $label): ?>
                        <option value="<?= e($key) ?>" <?= $values['category'] === $key ? 'selected' : '' ?>><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="tea-field">
                <label for="tea-origin">Pôvod</label>
                <input id="tea-origin" name="origin" value="<?= e($values['origin']) ?>" maxlength="60" required>
            </div>
            <div class="tea-field">
                <label for="tea-weight">Gramáž (g)</label>
                <input id="tea-weight" name="weight" type="number" min="1" max="10000" step="1"
                       value="<?= e($values['weight']) ?>" required>
            </div>
            <div class="tea-field">
                <label for="tea-price">Cena (€)</label>
                <input id="tea-price" name="price" inputmode="decimal" value="<?= e($values['price']) ?>"
                       placeholder="5,90" maxlength="8" required>
            </div>
            <div class="tea-field tea-field-wide">
                <label for="tea-description">Popis <span>(nepovinné)</span></label>
                <textarea id="tea-description" name="description" rows="4" maxlength="240"><?= e($values['description']) ?></textarea>
            </div>
        </div>

        <div class="tea-actions">
            <button class="button" type="submit"><?= $isEdit ? 'Uložiť zmeny' : 'Pridať čaj' ?></button>
            <a class="button button-secondary" href="<?= e($link->url('tea.index')) ?>">Zrušiť</a>
        </div>
    </form>
</section>
