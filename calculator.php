<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .result { margin-top: 20px; font-size: 1.2em; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Calculator</h1>
    <form method="post" action="">
        <div>
            <label for="number1">Number 1:</label>
            <input type="number" id="number1" name="number1" required>
        </div>
        <div>
            <label for="number2">Number 2:</label>
            <input type="number" id="number2" name="number2" required>
        </div>
        <div>
            <label for="operation">Operation:</label>
            <select id="operation" name="operation" required>
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
        </div>
        <div>
            <button type="submit">Calculate</button>
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize input values
        $number1 = filter_input(INPUT_POST, 'number1', FILTER_VALIDATE_FLOAT);
        $number2 = filter_input(INPUT_POST, 'number2', FILTER_VALIDATE_FLOAT);
        $operation = filter_input(INPUT_POST, 'operation', FILTER_SANITIZE_STRING);

        $error = null;
        $result = null;

        if ($number1 === false || $number2 === false) {
            $error = "Invalid input. Please enter valid numbers.";
        } elseif ($operation == "/" && $number2 == 0) {
            $error = "Division by zero is not allowed.";
        } else {
            switch ($operation) {
                case "+":
                    $result = $number1 + $number2;
                    break;
                case "-":
                    $result = $number1 - $number2;
                    break;
                case "*":
                    $result = $number1 * $number2;
                    break;
                case "/":
                    $result = $number1 / $number2;
                    break;
                default:
                    $error = "Invalid operation.";
            }
        }

        if ($error) {
            echo "<div class='error'>$error</div>";
        } else {
            echo "<div class='result'>Result: $result</div>";
        }
    }
    ?>
</body>
</html>
