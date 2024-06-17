<?php
    require_once __DIR__ . "/vendor/autoload.php";
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чергування</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Інформація про чергування в лікарні</h1>

    <form action="nurse_rooms.php" method="GET">
        <label for="nurse">Виберіть медсестру:</label>
        <select name="nurse" id="nurse" required>
            <?php
            $nurses = $collection->distinct("nurses");
            foreach ($nurses as $nurse) {
                echo "<option value='$nurse'>$nurse</option>";
            }
            ?>
        </select>
        <input type="submit" value="Отримати список палат">
    </form>

    <form action="department_nurses.php" method="GET">
        <label for="department">Виберіть відділення:</label>
        <select name="department" id="department" required>
            <?php
            $departments = $collection->distinct("department");
            foreach ($departments as $department) {
                echo "<option value='$department'>$department</option>";
            }
            ?>
        </select>
        <input type="submit" value="Отримати список медсестер">
    </form>

    <form action="shift_department.php" method="GET">
        <label for="shift">Виберіть зміну:</label>
        <select name="shift" id="shift" required>
            <?php
            $shifts = $collection->distinct("shift");
            foreach ($shifts as $shift) {
                echo "<option value='$shift'>$shift</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="shift_department">Виберіть відділення:</label>
        <select name="department" id="shift_department" required>
            <?php
            foreach ($departments as $department) {
                echo "<option value='$department'>$department</option>";
            }
            ?>
        </select>
        <input type="submit" value="Отримати чергування">
    </form>
</body>
</html>
