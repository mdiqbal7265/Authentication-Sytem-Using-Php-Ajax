<?php 

//echo bin2hex(random_bytes(10));
$token = "f6bf31c7deb31cb7d74b";
$token = str_shuffle($token);
echo substr($token,0,10);

?>