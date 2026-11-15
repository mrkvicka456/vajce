<?php

/** @var \App\Models\Flavor $flavor */
/** @var bool $isEdit */
/** @var array $values */
/** @var array $errors */
/** @var \App\Models\Tea[] $teas */
/** @var int[] $selectedTeaIds */
/** @var string $token */
/** @var \Framework\Support\LinkGenerator $link */
$action = $isEdit ? $link->url('flavor.edit', ['id' => $flavor->getId()]) : $link->url('flavor.create');
?>
<section class="tea-management" aria-labelledby="flavor-form-title">
    <header class="page-intro">
        <h1 id="flavor-form-title"><?= $isEdit ? 'Upraviť príchuť' : 'Pridať príchuť' ?></h1>
        <p>Pomenujte príchuť a priraďte ju k ľubovoľnému počtu čajov.</p>
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
            <div class="tea-field tea-field-wide">
                <label for="flavor-name">Názov príchute</label>
                <input id="flavor-name" name="name" value="<?= e($values['name']) ?>" maxlength="60" required>
            </div>
            <div class="tea-field tea-field-wide">
                <label for="flavor-description">Popis <span>(nepovinné)</span></label>
                <textarea id="flavor-description" name="description" rows="3" maxlength="240"><?= e($values['description']) ?></textarea>
            </div>
        </div>

        <fieldset class="relation-picker" aria-describedby="tea-selection-help">
            <legend>Priradené čaje</legend>
            <p class="field-hint" id="tea-selection-help">Označte čaje, ku ktorým príchuť patrí. Zrušením označenia odstránite priradenie. Výber môže zostať prázdny.</p>
            <?php if ($teas === []): ?>
                <p>V ponuke zatiaľ nie sú čaje. Príchuť môžete uložiť a čaje k nej priradiť neskôr.</p>
            <?php else: ?>
                <div class="relation-options">
                    <?php foreach ($teas as $tea): ?>
                        <label class="relation-option">
                            <input type="checkbox" name="tea_ids[]" value="<?= e($tea->getId()) ?>"
                                   <?= in_array($tea->getId(), $selectedTeaIds, true) ? 'checked' : '' ?>>
                            <span><?= e($tea->getName()) ?><small><?= e($tea->getCategoryLabel()) ?> · <?= e($tea->getWeight()) ?>&nbsp;g</small></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </fieldset>

        <div class="tea-actions">
            <button class="button" type="submit"><?= $isEdit ? 'Uložiť zmeny' : 'Pridať príchuť' ?></button>
            <a class="button button-secondary" href="<?= e($link->url('flavor.index')) ?>">Zrušiť</a>
        </div>
    </form>
</section>
