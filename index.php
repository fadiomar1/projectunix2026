<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sum_app";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number1 = $_POST["number1"];
    $number2 = $_POST["number2"];

    if (is_numeric($number1) && is_numeric($number2)) {
        $sum = $number1 + $number2;

        $stmt = $conn->prepare("INSERT INTO calculations (number1, number2, result) VALUES (?, ?, ?)");
        $stmt->bind_param("ddd", $number1, $number2, $sum);
        $stmt->execute();
        $stmt->close();

        $message = "Result: " . $sum;
    } else {
        $message = "Please enter valid numbers.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sum Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Sum Application</h1>
    <p>Enter two numbers and calculate their sum.</p>

    <form method="POST">
        <input type="number" step="any" name="number1" placeholder="Enter first number" required>
        <input type="number" step="any" name="number2" placeholder="Enter second number" required>

        <button type="submit">Calculate Sum</button>
    </form>

    <h2><?php echo $message; ?></h2>
</div>

</body>
</html>
