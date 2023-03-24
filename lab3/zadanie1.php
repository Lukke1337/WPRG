<html>

<?php




?>
    <body>
    <form action="zadanie1.php">
        <table>
            <tr>
                <td>Imie i nazwisko * </td>
                <td><INPUT name="imie i nazwisko"></td>
            </tr>
            <tr>
                <td>Adres e-mail * </td>
                <td><INPUT type=email name="Twój adres e-mail"</td>
            </tr>
            <tr>
                <td>Telefon kontaktowy </td>
                <td><INPUT name="telefon"</td>
            </tr>
            <tr>
                <td>Wybierz temat * </td>
                <td>
                    <select name="Temat">
                        <option>Wykonanie strony internetowej</option>
                        <option>Inne</option>
                    </select><br>
                </td>
            </tr>

            <tr><br></tr>
            <tr>
                <td>
                    <INPUT type="text" name="message" placeholder="Tutaj wpisz wiadomosc"><br>
                </td>
            </tr>
            <tr><br></tr>
            <tr>
                <td>Preferowana forma kontaktu<br>
                <INPUT type="checkbox" name="email">
                <label for="email">E-mail</label><br>
                <INPUT type="checkbox" name="telefon">
                <label for="telefon">Tekefon</label><br>
                </td>
            </tr>
            <tr>
                <td>
                    <br>Posiadasz już stronę www?<br>
                    <input type="radio" name="strona" value="Tak">
                    <label for="Tak">Tak</label><br>
                    <input type="radio" name="strona" value="Nie">
                    <label for="Nie">Nie</label>
                </td>
            </tr>
            <tr>
                <td>Załączniki<br>
                    <INPUT type="file">
                </td>
            </tr>
        </table>
        <br><INPUT type="submit" name="Wyślij formularz">
    </form>
    </body>
</html>