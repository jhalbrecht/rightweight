<?php

// content="text/plain; charset=utf-8"
ini_set('display_errors', 'On');
require_once ("incMyRightWeight.php");               // get db name login etc.

$path = $_SERVER['DOCUMENT_ROOT'];
// echo $host, $user, $pw, $ddb;
@$db = new mysqli($host, $user, $pw, $ddb);
if (mysqli_connect_errno ()) {
    echo 'Error: Could not connect to database.  Please try again later.';
    exit;
}

// looking for the last seven days. 
// $result = $db->query("select weight, unix_timestamp(weighedDate) as weighed from weight");

// $result = $db->query("select weight, unix_timestamp(weighedDate) as weighed from  weight where weighedDate between date_sub(current_date(), interval 7 day) and current_date()+1;");

$result = $db->query("select weight, unix_timestamp(weighedDate) as weighed from weight where weighedDate between date_sub(current_date(), interval 7 day) and date_add(current_date(), interval 1 day);");

// $result = $db->query("select weight, unix_timestamp(weighedDate) as weighed from  weight;");


if (!$result) {
    die("Database access failed: " . mysql_error());
}
$dataSet1 = array();

while ($row = $result->fetch_object()) {
    //echo "when " . $row->time . " temperature: " . $row->temperature0 . '<br>';
    $dataSet1[] = array(
        //$row->jname,
        1000 * (int)$row->weighed,
        (float)$row->weight
    );
}
echo json_encode($dataSet1);
?>
