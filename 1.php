<?php
$today  = mktime( date("H") , date("i"), date("s"), date("m")  , date("d"), date("Y"));
$today_encode=base64_encode($today);


$tomorrow  = mktime( date("H") , date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
$a1=base64_encode($today);
$a2=base64_decode($a1);

echo $today."\n".$a1."\n".$a2."\n";

?>