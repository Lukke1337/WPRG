<html>
<head>
    <title>Kalkulator</title>
    <?php
    if (isset($_POST['liczba1']) && isset($_POST['liczba2']) && isset($_POST['dzialanie'])) {
        $liczba1 = $_POST['liczba1'];
        $liczba2 = $_POST['liczba2'];
        $dzialanie = $_POST['dzialanie'];

        switch ($dzialanie) {
            case 'dodawanie':
                $wynik = $liczba1 + $liczba2;
                break;
            case 'odejmowanie':
                $wynik = $liczba1 - $liczba2;
                break;
            case 'mnozenie':
                $wynik = $liczba1 * $liczba2;
                break;
            case 'dzielenie':
                if ($liczba2 != 0) {
                    $wynik = $liczba1 / $liczba2;
                } else {
                    $wynik = "Nie można dzielić przez zero!";
                }
                break;
            default:
                $wynik = "Nieznane działanie!";
                break;
        }

        echo "<p>Wynik: $wynik</p>";
    }

    if (isset($_POST['liczba1']) && isset($_POST['operacja'])) {
        $liczba3 = $_POST['liczba1'];
        $operacja = $_POST['operacja'];

        switch ($operacja) {
            case 'sin':
                $wynik = sin($liczba3);
                break;
            case 'cos':
                $wynik = cos($liczba3);
                break;
            case 'tg':
                $wynik = tan($liczba3);
                break;
            case 'cos':
                $wynik = cos($liczba3);
                break;
            case 'binarned':
                $wynik = bindec($liczba3);
                break;
            case 'dziesietneb':
                $wynik = decbin($liczba3);
                break;
            case 'dziesietnehex':
                $wynik = dechex($liczba3);
                break;
            case 'hexdziesietne':
                $wynik = hexdec($liczba3);
                break;
            case 'stopnierad':
                $wynik = deg2rad($liczba3);
                break;
            case 'radstopnie':
                $wynik = rad2deg($liczba3);
                break;
            default:
                $wynik = "Nieznana operacja!";
                break;
        }

        echo "<p><b>Wynik dzialania to: $wynik</b></p>";
    }
    ?>
</head>
<body>

    <h2>Kalkulator prosty</h2>

    <form method="post">
        <input type="number" name="liczba1" placeholder="Wpisz liczbę a"><br>
            <input type="radio" name="dzialanie" value="dodawanie">
            <label for="dodawanie">+</label>
            <input type="radio" name="dzialanie" value="odejmowanie">
            <label for="odejmowanie">-</label>
            <input type="radio" name="dzialanie" value="mnozenie">
            <label for="mnozenie">*</label>
            <input type="radio" name="dzialanie" value="dzielenie">
            <label for="dzielenie">/</label><br>
        <input type="number" name="liczba2" placeholder="Wpisz liczbę b"><br>
        <br><input type="submit" value="Oblicz">
    </form>


    <h2>Kalkulator zaawansowany</h2>

    <form method="post">
        <input type="number" name="liczba1" placeholder="Wpisz liczbę a">
<!--        <input type="number" name="liczba2" placeholder="Wpisz liczbę b"><br>-->

        <br>Własności trygonometryczne:<br>
            <input type="radio" name="operacja" value="sin">
            <label for="sin">sin</label>

            <input type="radio" name="operacja" value="cos">
            <label for="cos">cos</label>

            <input type="radio" name="operacja" value="sin">
            <label for="tan">tg</label>

            <input type="radio" name="operacja" value="cos">
            <label for="cos">cos</label>
        <br>
        <br>Konwerter:<br>
            <input type="radio" name="operacja" value="binarned">
            <label for="binarned">Binarne -> Dziesietne</label><br>

            <input type="radio" name="operacja" value="dziesietneb">
            <label for="dziesietneb">Dziesietne -> Binarne</label><br>

            <input type="radio" name="operacja" value="dziesietnehex">
            <label for="dziesietnehex">Dziesietne -> Hex</label><br>

            <input type="radio" name="operacja" value="hexdziesietne">
            <label for="hexdziesietne">Hex -> Dziesietne</label><br>

            <input type="radio" name="operacja" value="stopnierad">
            <label for="stopnierad">Stopnie -> Rad</label><br>

            <input type="radio" name="operacja" value="radstopnie">
            <label for="radstopnie">Rad -> Stopnie</label><br>
        <br>
        <input type="submit" value="Oblicz">
    </form>
</body>
</html>