<html>
<head>
    <title>Lab4 zad1</title>
    <?php

    if(isset($_GET['dzienuro'])) {

        $dateOfBirth = new DateTime($_GET['dzienuro']);
        $dayOfWeek = $dateOfBirth->format('1');

        $wiek = $dateOfBirth->diff(new DateTime())->y;
        $nextBirthday = new DateTime('kolejne urodiny');
        $dayToBirthday = $nextBirthday->diff(new DateTime())->days;

        if ($nextBirthday < new DateTime()) {
            $nextBirthday->modify('+1 year');
            $dayToBirthday = $nextBirthday->diff(new DateTime())->days;
        }
        echo "Twoj dzien narodzin to $dayOfWeek.<br>";
        echo "Masz teraz $wiek lat.<br>";
        echo "Twoje nastepne urodziny sa za $dayToBirthday dni.";
}

    ?>
</head>
    <body>
    <form method="GET">
        <table>
            <tr>
                <td>Data urodzenia: </td>
                <td><INPUT type=date id="dzienuro" name="dzienurodzenia"</td>
            </tr>
        </table>
        <br><BUTTON type="submit">Wyślij formularz</BUTTON>
    </form>

    </body>
</html>