<?php

echo "url: " . $_SERVER['QUERY_STRING'];
echo "hi";

require "../Core/Router.php";
echo "hi1";
$router=new Router();
echo "hi2";
echo "class:" . get_class($router);


?>