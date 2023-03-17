<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Zadanie1.3</title>

        <?php 
            $censorar = arra("kurkawodna","cholipka");
            $replace = "YIKES!";
            readline();
            foreach($censorar as $replace){
                if (preg_match("$replace"));
                {
                    echo "HOLA!";
                }
            }

        ?>
    </head>
    <body>

    </body>
</html>