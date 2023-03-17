    <?php
    function peseldata($pesel) {

        # Mocno wzorowane na tym, co było w internecie
    $rok = substr($pesel, 0, 2);
    $miesiac = substr($pesel, 2, 2);
        $dzien = substr($pesel, 4, 2);

    if ($miesiac >= 1 && $miesiac <= 12) {
        $wiek = '19';
    } elseif ($miesiac >= 21 && $miesiac <= 32) {
        $wiek = '20';
        $miesiac -= 20;
    } elseif ($miesiac >= 41 && $miesiac <= 52) {
        $wiek = '21';
        $miesiac -= 40;
    } elseif ($miesiac >= 61 && $miesiac <= 72) {
        $wiek = '22';
        $miesiac -= 60;
    } elseif ($miesiac >= 81 && $miesiac <= 92) {
        $wiek = '18';
        $miesiac -= 80;
    }

        $data=$dzien.'-'.str_pad($miesiac,2,'0',STR_PAD_LEFT).'-'.$wiek.$rok;

    return $data;
    }
    echo "Podaj PESEL (11 cyfr): ";
    $pesel=readline("Podaj PESEL: ");
    $data=peseldata($pesel);
    echo "Data urodzenia osoby o tym numerze PESEL to $data \n";
    ?>