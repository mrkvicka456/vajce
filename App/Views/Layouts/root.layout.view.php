<?php

/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Predajňa čaju – ponuka sypaných čajov na osobný odber a platbu pri prevzatí.">
    <title><?= e(App\Configuration::APP_NAME) ?></title>
    <link rel="icon" href="<?= e($link->asset('images/logo.svg')) ?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?= e($link->asset('css/style.css')) ?>">
</head>
<body>
    <a class="skip-link" href="#obsah">Preskočiť na hlavný obsah</a>

    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="<?= e($link->url('home.index')) ?>" aria-label="Predajňa čaju – úvodná stránka">
                <img src="<?= e($link->asset('images/logo.svg')) ?>" width="48" height="48" alt="">
                <span>
                    <span class="brand-name">Predajňa čaju</span>
                    <span class="brand-tagline">Čaje na osobný odber</span>
                </span>
            </a>

            <nav class="main-nav" aria-label="Hlavná navigácia">
                <ul class="nav-list">
                    <li><a class="nav-item" href="<?= e($link->url('home.index')) ?>">Úvod</a></li>
                    <li><a class="nav-item" href="<?= e($link->url('home.katalog')) ?>">Čaje</a></li>
                    <li><a class="nav-item" href="<?= e($link->url('tea.index')) ?>">Správa čajov</a></li>
                    <!-- Táto stránka zatiaľ nie je súčasťou zadania, preto ide o vizuálne tlačidlo. -->
                    <li><button class="nav-item" type="button">Moje objednávky</button></li>
                </ul>
            </nav>

            <div class="account-controls">
                <button class="button button-secondary" type="button" aria-label="Košík, 0 položiek">
                    <img class="icon" src="<?= e($link->asset('images/cart.svg')) ?>" width="24" height="24" alt="">
                    <span>Košík (0)</span>
                </button>
                <span class="account-label">Zákazník</span>
                <button class="button button-secondary" type="button">Odhlásiť</button>
            </div>
        </div>
    </header>

    <main id="obsah" class="container" tabindex="-1">
        <?= $contentHTML ?>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <a class="footer-brand" href="<?= e($link->url('home.index')) ?>">Predajňa čaju</a>
            <p>Osobný odber v predajni</p>
            <p>Platba pri prevzatí</p>
        </div>
    </footer>
</body>
</html>
