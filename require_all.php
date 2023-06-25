<?php
// Pobranie wszystkich nazw ścieżek z folderu "klasy" i robi "require_once" dla każdego z tych plików
    $files = glob( 'klasy/*.php');
    foreach ($files as $file) {
    require_once($file);
}