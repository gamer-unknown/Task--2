<?php

require '../model/Database.php';

session_start();

function splitURL()
{
    $URL=$_GET['url'] ?? 'home';
    $URL=explode('/',$URL);
    return $URL;
}

function getController()
{
    $URL=splitURL();
    $filename='../controller/'.ucfirst($URL[0]).'.php';
    if(file_exists($filename)){
        require $filename;
    }
    else
    {
        echo "Controller not Found";
    }
}

getController();