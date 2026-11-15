<?php

// Spúšťa sa iba z terminálu; ukážkové údaje doplní len na vyžiadanie.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}

require __DIR__ . '/../Framework/ClassLoader.php';

$arguments = array_slice($argv, 1);
if ($arguments !== [] && $arguments !== ['--sample-data']) {
    fwrite(STDERR, "Použitie: php docker/update-database.php [--sample-data]\n");
    exit(1);
}

$connection = null;
try {
    $connection = \Framework\DB\Connection::getInstance();
    $executeScript = function (string $file) use ($connection): void {
        $sql = file_get_contents(__DIR__ . '/sql/' . $file);
        if ($sql === false) {
            throw new RuntimeException('SQL skript sa nepodarilo načítať.');
        }
        $connection->exec($sql);
    };

    $executeScript('03_flavors.sql');
    if ($arguments === ['--sample-data']) {
        $connection->beginTransaction();
        $executeScript('02_sample_teas.sql');
        $executeScript('04_sample_flavors.sql');
        $connection->commit();
        echo "Ukážkové čaje, príchute a ich priradenia sú doplnené.\n";
        echo 'Spolu čajov: ' . \App\Models\Tea::getCount()
            . ', príchutí: ' . \App\Models\Flavor::getCount()
            . ', priradení: ' . \App\Models\TeaFlavor::getCount() . ".\n";
    }
    echo "Tabuľky príchutí a ich väzieb sú pripravené. Existujúce údaje zostali zachované.\n";
} catch (Throwable $exception) {
    if ($connection !== null && $connection->inTransaction()) {
        $connection->rollBack();
    }
    fwrite(STDERR, "Aktualizácia sa nepodarila. Overte pripojenie k databáze a dostupnosť SQL skriptov v docker/sql.\n");
    exit(1);
}
