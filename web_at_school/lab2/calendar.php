<!DOCTYPE html>
<html>
<head>
    <title>Simple Calendar</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Simple Calendar</h1>

<form method="get" action="calendar.php">
    <!-- get hiển thị trên URL phù hơpj với thông tin không cần bảo mật -->
    <label for="month">Month:</label>
    <select name="month" id="month">
        <?php
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        $currentMonth = date('n') - 1; // date('n') returns 1-12
        foreach ($months as $index => $month) {
            $selected = $index == $currentMonth ? 'selected' : '';
            echo "<option value=\"$index\" $selected>$month</option>";
        }
        ?>
    </select>

    <label for="year">Year:</label>
    <select name="year" id="year">
        <?php
        $currentYear = date('Y');
        for ($year = $currentYear - 10; $year <= $currentYear + 10; $year++) {
            $selected = $year == $currentYear ? 'selected' : '';
            echo "<option value=\"$year\" $selected>$year</option>";
        }
        ?>
    </select>

    <button type="submit">Go!</button>
</form>

<?php
if (isset($_GET['month'], $_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];

    $firstDay = date('w', mktime(0, 0, 0, $month + 1, 1, $year));
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month + 1, $year);

    echo "<table>";
    echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

    $dayCounter = 1;
    echo "<tr>";
    for ($i = 0; $i < 7; $i++) {
        if ($i < $firstDay) {
            echo "<td></td>";
        } else {
            echo "<td>$dayCounter</td>";
            $dayCounter++;
        }
    }
    echo "</tr>";
    while ($dayCounter <= $daysInMonth) {
        echo "<tr>";
        for ($i = 0; $i < 7; $i++) {
            if ($dayCounter <= $daysInMonth) {
                echo "<td>$dayCounter</td>";
                $dayCounter++;
            } else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>
</body>
</html>