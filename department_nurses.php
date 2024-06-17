<?php
require_once __DIR__ . "/vendor/autoload.php";
include("connection.php");
echo "<link rel='stylesheet' href='style.css'> <script src='./script.js'></script>";

$department = $_GET['department'];

$nurses = $collection->distinct("nurses", ["department" => $department]);

echo "<h2>Медсестри, які чергували у відділенні: $department</h2>";
echo "<ul>";
foreach ($nurses as $nurse) {
    echo "<li>$nurse</li>";
}
echo "</ul> <br> <h3>Дані збережені в localstorage:</h3>";

$dataToSave = json_encode($nurses);

echo "<script>showFromLocalStorage('$department', 'list');</script>";
echo "<script>saveToLocalStorage('$department', $dataToSave);</script>";
?>
