<?php
require_once __DIR__ . "/vendor/autoload.php";
include("connection.php");
echo "<link rel='stylesheet' href='style.css'> <script src='./script.js'></script>";

$selectedShift = $_GET['shift'];
$department = $_GET['department'];

$cursor = $collection->find(['shift' => $selectedShift, 'department' => $department], ['projection' => [ '_id'=>0]]);

$shifts = iterator_to_array($cursor);

echo "<h2>Чергування у зміну: $selectedShift, Відділення: $department</h2>";

if (count($shifts) == 0) {
    echo("<p>Не було таких чергувань.</p>");
} else {
    echo "<table border='1'>";
    echo "<tr><th>Зміна</th><th>Дата</th><th>Медсестри</th><th>Відділення</th><th>Палати</th></tr>";

    foreach ($shifts as $shift) {
        $nurses = "";
        foreach ($shift['nurses'] as $nurse) {
            $nurses .= (strlen($nurses) == 0 ? "" : ", ") . $nurse;
        }
        
        $rooms = "";
        foreach ($shift['rooms'] as $room){
            $rooms .= (strlen($rooms) == 0 ? "" : ", ") . $room;
        }
    
        echo "<tr>
            <td>{$shift['shift']}</td>
            <td>{$shift['date']}</td>
            <td>$nurses</td>
            <td>{$shift['department']}</td>
            <td>$rooms</td>
            </tr>";
    }
    
    echo "</table> <br> <h3>Дані збережені в localstorage:</h3>";
}

$dataToSave = json_encode($shifts);
$key = "$selectedShift,$department";

echo "<script>showFromLocalStorage('$key', 'table');</script>";
echo "<script>saveToLocalStorage('$key', $dataToSave);</script>";
?>
