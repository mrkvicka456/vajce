<?php

/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="page-catalog" aria-label="Katalóg čajov">
    <header class="page-intro">
        <h1>Vyberte si svoj čaj</h1>
        <p>Objednajte si čaj na osobný odber. Zaplatíte pri prevzatí.</p>
    </header>

    <!-- Vyhľadávanie a kategórie sú zatiaľ len vizuálny návrh.
         Reset funguje natívne v HTML; tlačidlá type="button" formulár neodosielajú. -->
    <form class="catalog-form" action="<?= e($link->url('home.katalog')) ?>" method="get" aria-label="Vyhľadávanie a filtrovanie čajov">
        <input type="hidden" name="c" value="home">
        <input type="hidden" name="a" value="katalog">
        <label class="search-label" for="hladany-caj">Vyhľadať čaj</label>
        <div class="search-row">
            <div class="search-field">
                <img class="icon" src="<?= e($link->asset('images/search.svg')) ?>" width="24" height="24" alt="">
                <input type="search" id="hladany-caj" name="q" placeholder="Hľadať čaj podľa názvu…" maxlength="100">
            </div>
            <button class="button" type="button">Vyhľadať</button>
        </div>

        <div class="catalog-layout">
            <aside class="filters" aria-label="Filter podľa kategórie">
                <fieldset>
                    <legend>Kategórie</legend>
                    <div class="category-options">
                        <label class="category-option">
                            <input type="radio" name="kategoria" value="vsetky" checked>
                            <span>Všetky čaje</span>
                            <span class="category-count" aria-label="počet čajov: 6">6</span>
                        </label>
                        <label class="category-option">
                            <input type="radio" name="kategoria" value="zelene">
                            <span>Zelené</span>
                            <span class="category-count" aria-label="počet čajov: 2">2</span>
                        </label>
                        <label class="category-option">
                            <input type="radio" name="kategoria" value="cierne">
                            <span>Čierne</span>
                            <span class="category-count" aria-label="počet čajov: 1">1</span>
                        </label>
                        <label class="category-option">
                            <input type="radio" name="kategoria" value="bylinne">
                            <span>Bylinné</span>
                            <span class="category-count" aria-label="počet čajov: 1">1</span>
                        </label>
                        <label class="category-option">
                            <input type="radio" name="kategoria" value="ovocne">
                            <span>Ovocné</span>
                            <span class="category-count" aria-label="počet čajov: 1">1</span>
                        </label>
                        <label class="category-option">
                            <input type="radio" name="kategoria" value="rooibos">
                            <span>Rooibos</span>
                            <span class="category-count" aria-label="počet čajov: 1">1</span>
                        </label>
                    </div>
                </fieldset>
                <div class="filter-actions">
                    <button class="button button-secondary" type="reset">Zrušiť filtre</button>
                </div>
            </aside>

            <section class="products" aria-labelledby="nadpis-produktov">
                <div class="results-heading">
                    <h2 id="nadpis-produktov">Všetky čaje</h2>
                    <p>6 produktov</p>
                </div>
                <div class="product-grid">
                    <article class="product-card" aria-labelledby="caj-sencha">
                        <!-- Placeholder môžete neskôr nahradiť vlastnou fotografiou a doplniť alt. -->
                        <img class="product-image" src="<?= e($link->asset('images/caj-placeholder.svg')) ?>" width="640" height="224" alt="">
                        <p class="product-category">Zelený čaj</p>
                        <h3 id="caj-sencha">Sencha</h3>
                        <p class="product-meta">Japonsko · 100 g</p>
                        <p class="product-description">Jemná, svieža chuť</p>
                        <div class="product-bottom">
                            <div>
                                <data class="price" value="5.90">5,90&nbsp;€</data>
                                <button class="detail-button" type="button" aria-label="Zobraziť detail: Sencha">Zobraziť detail</button>
                            </div>
                            <button class="button" type="button" aria-label="Pridať do košíka: Sencha">Do košíka</button>
                        </div>
                    </article>
                    <article class="product-card" aria-labelledby="caj-earl-grey">
                        <!-- Placeholder môžete neskôr nahradiť vlastnou fotografiou a doplniť alt. -->
                        <img class="product-image" src="<?= e($link->asset('images/caj-placeholder.svg')) ?>" width="640" height="224" alt="">
                        <p class="product-category">Čierny čaj</p>
                        <h3 id="caj-earl-grey">Earl Grey</h3>
                        <p class="product-meta">Srí Lanka · 100 g</p>
                        <p class="product-description">Príchuť: bergamot</p>
                        <div class="product-bottom">
                            <div>
                                <data class="price" value="4.80">4,80&nbsp;€</data>
                                <button class="detail-button" type="button" aria-label="Zobraziť detail: Earl Grey">Zobraziť detail</button>
                            </div>
                            <button class="button" type="button" aria-label="Pridať do košíka: Earl Grey">Do košíka</button>
                        </div>
                    </article>
                    <article class="product-card" aria-labelledby="caj-rooibos">
                        <!-- Placeholder môžete neskôr nahradiť vlastnou fotografiou a doplniť alt. -->
                        <img class="product-image" src="<?= e($link->asset('images/caj-placeholder.svg')) ?>" width="640" height="224" alt="">
                        <p class="product-category">Rooibos</p>
                        <h3 id="caj-rooibos">Rooibos vanilka</h3>
                        <p class="product-meta">Južná Afrika · 100 g</p>
                        <p class="product-description">Príchuť: vanilka</p>
                        <div class="product-bottom">
                            <div>
                                <data class="price" value="5.20">5,20&nbsp;€</data>
                                <button class="detail-button" type="button" aria-label="Zobraziť detail: Rooibos vanilka">Zobraziť detail</button>
                            </div>
                            <button class="button" type="button" aria-label="Pridať do košíka: Rooibos vanilka">Do košíka</button>
                        </div>
                    </article>
                    <article class="product-card" aria-labelledby="caj-mata">
                        <!-- Placeholder môžete neskôr nahradiť vlastnou fotografiou a doplniť alt. -->
                        <img class="product-image" src="<?= e($link->asset('images/caj-placeholder.svg')) ?>" width="640" height="224" alt="">
                        <p class="product-category">Bylinný čaj</p>
                        <h3 id="caj-mata">Mätový čaj</h3>
                        <p class="product-meta">Slovensko · 50 g</p>
                        <p class="product-description">Príchuť: mäta</p>
                        <div class="product-bottom">
                            <div>
                                <data class="price" value="3.50">3,50&nbsp;€</data>
                                <button class="detail-button" type="button" aria-label="Zobraziť detail: Mätový čaj">Zobraziť detail</button>
                            </div>
                            <button class="button" type="button" aria-label="Pridať do košíka: Mätový čaj">Do košíka</button>
                        </div>
                    </article>
                    <article class="product-card" aria-labelledby="caj-jazmin">
                        <!-- Placeholder môžete neskôr nahradiť vlastnou fotografiou a doplniť alt. -->
                        <img class="product-image" src="<?= e($link->asset('images/caj-placeholder.svg')) ?>" width="640" height="224" alt="">
                        <p class="product-category">Zelený čaj</p>
                        <h3 id="caj-jazmin">Jazmínový čaj</h3>
                        <p class="product-meta">Čína · 100 g</p>
                        <p class="product-description">Príchuť: jazmín</p>
                        <div class="product-bottom">
                            <div>
                                <data class="price" value="6.50">6,50&nbsp;€</data>
                                <button class="detail-button" type="button" aria-label="Zobraziť detail: Jazmínový čaj">Zobraziť detail</button>
                            </div>
                            <button class="button" type="button" aria-label="Pridať do košíka: Jazmínový čaj">Do košíka</button>
                        </div>
                    </article>
                    <article class="product-card" aria-labelledby="caj-ovocie">
                        <!-- Placeholder môžete neskôr nahradiť vlastnou fotografiou a doplniť alt. -->
                        <img class="product-image" src="<?= e($link->asset('images/caj-placeholder.svg')) ?>" width="640" height="224" alt="">
                        <p class="product-category">Ovocný čaj</p>
                        <h3 id="caj-ovocie">Lesné ovocie</h3>
                        <p class="product-meta">Slovensko · 100 g</p>
                        <p class="product-description">Príchute: malina, jahoda</p>
                        <div class="product-bottom">
                            <div>
                                <data class="price" value="4.90">4,90&nbsp;€</data>
                                <button class="detail-button" type="button" aria-label="Zobraziť detail: Lesné ovocie">Zobraziť detail</button>
                            </div>
                            <button class="button" type="button" aria-label="Pridať do košíka: Lesné ovocie">Do košíka</button>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </form>
</section>
