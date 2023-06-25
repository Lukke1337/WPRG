<?php
    function fibb_sequence_recursive(int $element) {
        if($element == 0)
            return 0;
        else if($element < 3)
            return 1;
        return fibb_sequence_recursive($element-1) + fibb_sequence_recursive($element-2);
    }

    function fibb_sequence($element) {
        if($element == 0)
            return 0;
        else if($element < 3)
            return 1;
        $n1 = 1; $n2 = 1; $n3 = 0;
        for($i = 3; $i <= $element; $i++) {
            $n3 = $n2 + $n1;
            $n1 = $n2;
            $n2 = $n3;
        }
        return $n3;
    }
    $argument = readline("Enter argument: ");

    $time_rec = hrtime(true);
    fibb_sequence_recursive($argument);
    $time_rec = hrtime(true) - $time_rec;

    $time = hrtime(true);
    fibb_sequence($argument);
    $time = hrtime(true) - $time;

    if($time_rec > $time) {
        echo "Recursive function jest wolniejsza o " . $time_rec - $time . " nanosekund";
    }
    else
        echo "Recursive function jest szybsza o " . $time - $time_rec . " nanosekund";
        ?>