<?php
$result = mysql_connect("123.123.123.123", "user", "password");
$temp = $_GET["temp"];
$humi = $_GET["humi"];
$sqlt = "insert into dht22.temphumi (temp,humi) values ($temp,$humi)";
mysql_query($sqlt);
?>
