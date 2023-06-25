<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lab4z1</title>
</head>
<body>
    <h1>Urodziny</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label for="birthday">Wprowadz date urodzin </label>
        <input type="date" name="birthday" id="birthday"> <br>
        <input type="submit" value="Submit">
    </form>
<?php
    if(isset($_GET['birthday']) && $_GET['birthday'] != null) {
        $birthday = strtotime($_GET['birthday']);
        $now = strtotime("now");
        $age = date('Y') - date('Y', $birthday);
        if(date('m') < date('m', $birthday) ||
            date('m') == date('m', $birthday) && date('j') < date('j', $birthday))
            $age--;
        $number_of_days = date('z', $birthday);
        if($number_of_days >= date('z'))
            $number_of_days -= date('z');
        else
            $number_of_days += 365 - date('z');
        echo "Dzien tygodnia: " . date('l', $birthday) . "<br>";
        echo "Wiek: " . $age . "<br>";
        echo "Dni do kolejnych urodzin: " . $number_of_days;




    }
?>

</body>
</html>