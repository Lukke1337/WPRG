<?php

echo "Jakiej jestem narodowosci? v1.0\n";
echo "Podaj swoj kraj urodzenia: ";

$kraje = array(
    "Niemcy" => "Niemcem",
    "Polska" => "Polakiem",
    "Francja" => "Francuzem",
);

$kraj = (string)readline("Kraj urodzenia ");

if (array_key_exists($kraj, $kraje)) {
    echo "Jesteś ".$kraje[$kraj]."\n";
} else {
    echo "Coś poszło nie tak o_O";
}

?>