<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electric Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .result-box {
            border: 1px solid #d1e7ff;
            padding: 20px;
            margin-top: 20px;
            font-weight: bold;
            color: #0d6efd;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
<div class="container mt-5 mb-5 p-4 border rounded bg-light">
    <h2 class="text-center">Calculator</h2>
    <form method="post" class="mb-4">
        <div class="form-group">
            <label for="voltage">Voltage </label>
            <input type="number" step="any" class="form-control" id="voltage" name="voltage" required>
            <label for="voltagev">Voltage (V) </label>
        </div>
        <div class="form-group">
            <label for="current">Current </label>
            <input type="number" step="any" class="form-control" id="current" name="current" required>
            <label for="ampere">Ampere (A) </label>
        </div>
        <div class="form-group">
            <label for="rate">Current Rate </label>
            <input type="number" step="any" class="form-control" id="rate" name="rate" required>
            <label for="sen">sen/kWh </label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Calculate</button>
    </form>
    <br>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the input values
        $voltage = floatval($_POST['voltage']);
        $current = floatval($_POST['current']);
        $rate = floatval($_POST['rate']);
        
        
        $power = ($voltage * $current) / 1000; 
        
        
        echo "<div class='result-box'>";
        echo "<p>POWER : " . number_format($power, 5) . "kw</p>";
        echo "<p>RATE : RM " . number_format($rate / 100, 5) . "</p>";
        echo "</div>";
        
        
        echo "<table class='table table-bordered table-hover mt-4'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th class='p-3'>Hour</th>";
        echo "<th class='p-3'>Energy (kWh)</th>";
        echo "<th class='p-3'>Total (RM)</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        for ($hour = 1; $hour <= 24; $hour++) {
            
            $energy = $power * $hour; 
            
            $total_charge = $energy * ($rate / 100);
            
            
            echo "<tr>";
            echo "<td class='p-3'>$hour</td>";
            echo "<td class='p-3'>" . number_format($energy, 5) . "</td>";
            echo "<td class='p-3'>" . number_format($total_charge, 2) . "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
    }
    ?>
</div>
</body>
</html>
