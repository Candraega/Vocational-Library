<?php
    $conx = mysqli_connect("localhost","root","","library");
    if(!$conx){
        echo 'Connection Failed';
    }
