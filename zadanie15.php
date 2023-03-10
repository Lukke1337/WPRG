<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Zadanie1.5</title>
    <?php
    echo "Podaj rodzaj figury (K -Kwadrat, T -Trojkat, Tr -Trapez): ";
    $pole = (string)readline("Podaj rodzaj figury: ");
    switch ($pole){
        case 'K':
            echo "Podaj dlugosc boku: ";
            $a = (float)readline("Podaj dllugosc boku a: ");
            echo "Pole kwadratu wynosi ".$a*$a;
        break;
        case 'T':
            echo "Podaj dlugosc boku: ";
            $a = (float)readline("Podaj dllugosc boku a: ");
            echo "Podaj wysokosc: ";
            $h = (float)readline("Podaj wysokosc: ");
            echo "Pole trójkąta wynosi ".($a*$h)/2;
        break;
        case 'Tr':
            echo "Podaj dlugosc boku a: ";
            $a = (float)readline("Podaj dllugosc boku a: ");
            echo "Podaj dlugosc boku b: ";
            $b = (float)readline("Podaj dllugosc boku b: ");
            echo "Podaj wysokosc: ";
            $h = (float)readline("Podaj wysokosc: ");
            echo "Pole trapezu wynosi ".(($a+$b)*$h)/2;
        break;
        default: echo "BŁĄD";}
    echo " ";
    ?>
</head>
<body>

</body>
</html>