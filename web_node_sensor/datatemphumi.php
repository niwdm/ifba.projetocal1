<?php
$conn = mysqli_connect("123.123.123.123","user", "password", 

"dht22");
 
if (!$conn) {
  die('Could not connect: ' . mysql_error());
}
 
$sth = $conn->query("SELECT temp FROM temphumi");
$rows = array();
$rows['name'] = 'temp';
while($r = mysqli_fetch_array($sth)) {
  $rows['data'][] = $r['temp'];
}
 
$sth = $conn->query("SELECT humi FROM temphumi");
$rows2 = array();
$rows2['name'] = 'humi';
while($rrrr = mysqli_fetch_array($sth)) {
  $rows2['data'][] = $rrrr['humi'];
}
 
$sth = $conn->query("SELECT date FROM temphumi");
$rows1 = array();
$rows1['name'] = 'Date';
while($rr = mysqli_fetch_array($sth)) {
  $rows1['data'][] = $rr['date'];
}
 
$result = array();
 
array_push($result,$rows);
array_push($result,$rows1);
array_push($result,$rows2);
 
print json_encode($result, JSON_NUMERIC_CHECK);
 
mysqli_close($conn);
?>
