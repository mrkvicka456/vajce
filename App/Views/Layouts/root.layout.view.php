<?php

/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
$navigation = [
    'home.index' => 'Úvod',
    'home.katalog' => 'Čaje',
    'tea.index' => 'Správa čajov',
    'flavor.index' => 'Správa príchutí',
];
$currentUrl = $link->url([]);
$currentSectionUrl = $link->url('index');
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
                    <?php foreach ($navigation as $route => $label): ?>
                        <?php $url = $link->url($route); ?>
                        <?php $inSection = in_array($route, ['tea.index', 'flavor.index'], true) && $url === $currentSectionUrl; ?>
                        <li><a class="nav-item<?= $inSection ? ' nav-section-active' : '' ?>" href="<?= e($url) ?>"<?= $url === $currentUrl ? ' aria-current="page"' : '' ?>><?= e($label) ?></a></li>
                    <?php endforeach; ?>
                    <li><button class="nav-item" type="button" disabled>Moje objednávky</button></li>
                </ul>
            </nav>

            <div class="account-controls">
                <button class="button button-secondary" type="button" disabled>
                    <img class="icon" src="<?= e($link->asset('images/cart.svg')) ?>" width="24" height="24" alt="">
                    <span>Košík</span>
                </button>
                <span class="account-label">Pripravujeme</span>
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
