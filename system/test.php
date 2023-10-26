<?php

$fd = fopen("test.txt", "a");
    $str = "test 123\n";
    fwrite($fd, $str . "\n");
    fclose($fd);
    
    