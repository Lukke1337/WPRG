    <?php
    $dlugosc = 21;

    // Initialize an empty array
    $liczby=array();

    // Generate random numbers and add them to the array
    for ($i = 0; $i < $dlugosc; $i++) {
        $liczby[] = rand(1, 10);
    }
    // print_r($liczby);
    echo "Wpisz element tablicy od 0 do 20: ";
    $wartosc = readline();

    if ($wartosc >= 0 && $wartosc < count($liczby)) {
        $liczba=$liczby[$wartosc];
        echo "Wartosc elementu na miejscu $wartosc wynosi $liczba \n";
    } else {
        echo "Nie ma elementu dla podanej wartosci \n";
    }

    ?>