<?php

/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Tea[] $teas */
/** @var array $categories */
/** @var array $counts */
/** @var string $search */
/** @var string $category */
?>
<section class="page-catalog" aria-labelledby="katalog-title">
    <header class="page-intro">
        <h1 id="katalog-title">Vyberte si svoj čaj</h1>
        <p>Objednajte si čaj na osobný odber. Zaplatíte pri prevzatí.</p>
    </header>

    <form class="catalog-form" action="<?= e($link->url('home.katalog')) ?>" method="get" aria-label="Vyhľadávanie a filtrovanie čajov">
        <input type="hidden" name="c" value="home">
        <input type="hidden" name="a" value="katalog">
        <label class="search-label" for="hladany-caj">Vyhľadať čaj</label>
        <div class="search-row">
            <div class="search-field">
                <img class="icon" src="<?= e($link->asset('images/search.svg')) ?>" width="24" height="24" alt="">
                <input type="search" id="hladany-caj" name="q" value="<?= e($search) ?>"
                       placeholder="Hľadať čaj podľa názvu…" maxlength="100">
            </div>
            <button class="button" type="submit">Vyhľadať</button>
        </div>

        <div class="catalog-layout">
            <aside class="filters" aria-label="Filter podľa kategórie">
                <fieldset>
                    <legend>Kategórie</legend>
                    <div class="category-options">
                        <?php foreach ($categories as $key => $label): ?>
                            <label class="category-option">
                                <input type="radio" name="kategoria" value="<?= e($key) ?>" <?= $key === $category ? 'checked' : '' ?>>
                                <span><?= e($label) ?></span>
                                <span class="category-count" aria-label="Počet čajov: <?= e($counts[$key]) ?>"><?= e($counts[$key]) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
                <div class="filter-actions">
                    <button class="button" type="submit">Použiť filtre</button>
                    <a class="button button-secondary" href="<?= e($link->url('home.katalog')) ?>">Zrušiť filtre</a>
                </div>
            </aside>

            <section class="products" aria-labelledby="nadpis-produktov">
                <div class="results-heading">
                    <h2 id="nadpis-produktov"><?= $search === '' && $category === 'vsetky' ? 'Všetky čaje' : 'Nájdené čaje' ?></h2>
                    <p>Počet čajov: <?= e(count($teas)) ?></p>
                </div>

                <?php if ($teas === []): ?>
                    <p class="tea-notice">Nenašli sa žiadne čaje.</p>
                <?php else: ?>
                    <div class="product-grid">
                        <?php foreach ($teas as $tea): ?>
                            <article class="product-card" aria-labelledby="caj-<?= e($tea->getId()) ?>">
                                <img class="product-image" src="<?= e($link->asset('images/caj-placeholder.svg')) ?>"
                                     width="640" height="224" alt="">
                                <p class="product-category"><?= e($tea->getCategoryLabel()) ?></p>
                                <h3 id="caj-<?= e($tea->getId()) ?>"><?= e($tea->getName()) ?></h3>
                                <p class="product-meta"><?= e($tea->getOrigin()) ?> · <?= e($tea->getWeight()) ?>&nbsp;g</p>
                                <p class="product-description"><?= e($tea->getDescription()) ?></p>
                                <div class="product-bottom">
                                    <div>
                                        <data class="price" value="<?= e($tea->getPrice()) ?>"><?= e($tea->getFormattedPrice()) ?>&nbsp;€</data>
                                        <button class="detail-button" type="button" aria-label="Zobraziť detail: <?= e($tea->getName()) ?>">Zobraziť detail</button>
                                    </div>
                                    <button class="button" type="button" aria-label="Pridať do košíka: <?= e($tea->getName()) ?>">Do košíka</button>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </form>
</section>
