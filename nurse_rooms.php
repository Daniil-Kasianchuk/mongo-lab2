<?php
require_once __DIR__ . "/vendor/autoload.php";
include("connection.php");
echo "<link rel='stylesheet' href='style.css'> <script src='./script.js'></script>";

$nurse = $_GET['nurse'];

$cursor = $collection->find(['nurses' => $nurse], ['projection' => ['nurses' => 0, '_id'=>0]]);

$shifts = iterator_to_array($cursor);

echo "<h2>Палати, де чергує медсестра/медбрат: $nurse</h2>";

if (count($shifts) == 0) {
    echo("<p>Не було таких чергувань.</p>");
} else {
    echo "<table border='1'>";
    echo "<tr><th>Зміна</th><th>Дата</th><th>Відділення</th><th>Палати</th></tr>";

    foreach ($shifts  as $shift) {
        $rooms = "";
        foreach ($shift['rooms'] as $room){
            $rooms .= (strlen($rooms) == 0 ? "" : ", ") . $room;
        }
        
        echo "<tr>
            <td>{$shift['shift']}</td>
            <td>{$shift['date']}</td>
            <td>{$shift['department']}</td>
            <td>$rooms</td>
            </tr>";
    }
    
    echo "</table> <br> <h3>Дані збережені в localstorage:</h3>";
}

$dataToSave = json_encode($shifts);

echo "<script>showFromLocalStorage('$nurse', 'table');</script>";
echo "<script>saveToLocalStorage('$nurse', $dataToSave);</script>";

?>
