<?php

class Home 
{
    public function index()
    {
        $filename = '../view/home.view.php';
        require $filename;
    }
}

$obj = new Home;
$obj->index();
