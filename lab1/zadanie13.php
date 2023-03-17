<?php

$wulgaryzmy = array("kurde", "dupa", "Kurde", "Dupa");

echo "Wpisz zdanie do ocenzurowania: \n";

$zdanie = readline();
$cenzura = cenzura($zdanie, $wulgaryzmy);

echo $cenzura;

function cenzura($zdanie, $wulgaryzmy) {
    $slowa = explode(" ", $zdanie);

    foreach ($slowa as $key => $slowo) {
        if (in_array($slowo, $wulgaryzmy)) {
            $slowa[$key] = str_repeat("*", strlen($slowo));
        }
    }
    $cenzura = implode(" ", $slowa);
    return $cenzura;
}
?>