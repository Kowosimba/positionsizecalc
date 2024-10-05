<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forex Position Size Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Forex Position Size Calculator</h1>
        <form method="POST" action="">
            <label for="forexPair">Select Forex Pair:</label>
            <select id="forexPair" name="forexPair" required>
                <option value="EUR/USD">EUR/USD</option>
                <option value="USD/JPY">USD/JPY</option>
                <option value="GBP/USD">GBP/USD</option>
                <option value="AUD/USD">AUD/USD</option>
                <option value="USD/CAD">USD/CAD</option>
            </select>

            <label for="accountSize">Enter Account Size ($):</label>
            <input type="number" id="accountSize" name="accountSize" required>

            <label for="riskAmount">Enter Risk Amount ($ ):</label>
            <input type="text" id="riskAmount" name="riskAmount" placeholder="Amount " required>

            <label for="stopLoss">Enter your stop loss in pips ($):</label>
            <input type="number" id="stopLoss" name="stopLoss" required>

            <button type="submit">Calculate Position Size</button>
        </form>

        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountSize = $_POST['accountSize'];
    $riskAmount = $_POST['riskAmount'];
    $forexPair = $_POST['forexPair'];
    $stopLoss = $_POST['stopLoss'];

    // Check if pipValue is set; if not, assign a default value
    $pipValue = isset($_POST['pipValue']) ? (float)$_POST['pipValue'] : 10; // Default pip value

    // Handle risk amount, assuming it can be a percentage
    if (strpos($riskAmount, '%') !== false) {
        $riskAmount = (float) str_replace('%', '', $riskAmount) / 100 * $accountSize;
    } else {
        $riskAmount = (float) $riskAmount;
    }

    // Calculate position size
    $positionSize = $riskAmount / ($stopLoss * $pipValue); // Calculate position size
    echo "<div class='result'>";
    echo "<h2>Calculated Position Size:</h2>";
    echo "<p>For <strong>" . htmlspecialchars($forexPair) . "</strong>, you can trade <strong>" . round($positionSize, 2) . "</strong> standard lots.</p>";
    echo "</div>";
}
?>
    </div>
</body>
</html>

<style> 
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #4facfe, #00f2fe);
    color: #fff;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background: rgba(0, 0, 0, 0.7);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}

h1 {
    text-align: center;
}

label {
    display: block;
    margin: 10px 0 5px;
}

select,
input {
    width: 100%;
    padding: 5px;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #00f2fe;
    border: none;
    border-radius: 5px;
    color: #000;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #4facfe;
}

.result {
    margin-top: 20px;
    text-align: center;
}

</style>