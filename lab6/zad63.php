<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
    if(!isset($_COOKIE['counter'])) {
        setCookie('counter', 1, time() + 60*60*24*365);
        $counter = 1;
    }
    else
        $counter = $_COOKIE['counter'];

    if(!isset($_COOKIE['this_session'])) {
        $counter++;
        setCookie('counter', $counter, time() + 60*60*24*365);
        setCookie('this_session', 1);
    }
    echo '<h1>Counter: ' . $counter . '</h1>';
?>
</body>
</html>