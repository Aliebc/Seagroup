#!/usr/bin/php
<?php
    include 'src/functions.php';
    config_init();
    $res=Addmembers(2020011629,2020011857);//这里替换成起始学号和结束学号，之后直接运行程序即可
    EchoAddInfo($res);
    echo "\n";
?>
