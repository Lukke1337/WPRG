<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Zadanie1.2</title>

    <?php
//    echo "Podaj PESEL: ";
//    $pesel = (float)readline("Podaj PESEL: ");
    $pesel = 99010400053;
    $dd = ([4].$pesel)+([5].$pesel);
    $mm = ([2].$pesel)+([3].$pesel);
    $rr = ([0].$pesel)+([1].$pesel);
    $data = $dd."-".$mm."-".$rr;
    echo "Data urodzenia tej osoby to".$data;
    ?>
</head>
<body>

</body>
</html>