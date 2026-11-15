<?php

/** @var \Framework\Support\LinkGenerator $link */
?>
<section class="page-home" aria-labelledby="nadpis-uvodu">
    <div class="layout-placeholder">
        <div class="placeholder-copy">
            <p class="eyebrow">Čaje na osobný odber</p>
            <h1 id="nadpis-uvodu">Vitajte v predajni čaju</h1>
            <p>Prezrite si ponuku sypaných čajov na osobný odber v predajni.</p>
            <a class="button" href="<?= e($link->url('home.katalog')) ?>">Prejsť do katalógu</a>
        </div>
    </div>
</section>
