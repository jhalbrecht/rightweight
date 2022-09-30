<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ("incMyRightWeight.php");
echo "<h3>Hello world. adding current weight and date/time</h3>";
echo "Today is ".date("l").". ";

$jname      = $_POST['jname'];
$jweight    = $_POST['jweight'];
$jweighed   = $_POST['jweighed'];
$goal       = $_POST['goal'];

echo "Adding: ".$jname." ".$jweight." ".$jweighed."<hr>";
echo "Target weight (goal) is: $goal <hr>";

@ $db = new mysqli($host,$user,$pw,$ddb);
if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.  Please try again later.';
    exit;
}
$result = $db->query("insert into jpounds (name, weight, weighedDate) values ('$name', '$weight', current_timestamp)");

// $query  = "insert into jlbs values  (
// $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
//$result = $db->query("insert into jlbs values ("jeffa","321"," ")");
//$num_results = $result->num_rows;
//echo "result num rows ".$num_results."<br>";
?>
Return to: <a href="index.html">main rwWeight index</a>

