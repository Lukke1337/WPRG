<?php
    function is_special_ip() : bool {
        if(!file_exists('./zd4 content/ip addresses.txt'))
            return false;
        $file = fopen('./zd4 content/ip addresses.txt', 'r');
        while(!feof($file))
            if($_SERVER['REMOTE_ADDR'] == fgets($file)) {
                fclose($file);
                return true;
            }
        fclose($file);
        return false;
    }

    if(is_special_ip())
        require('./zd4 content/special_page.html');
    else
        require('./zd4 content/regular_page.html');