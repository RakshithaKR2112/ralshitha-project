<?php
// Database connection settings
$host = "localhost";
$dbname = "kr_tutorials";
$username = "root";
$password = "Root@123";

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    // Validate input
    if (empty($name) || empty($email) || empty($phone)) {
        echo "All fields are required.";
    } else {
        try {
            // Insert data into the database
            $stmt = $conn->prepare("INSERT INTO registrations (name, email, phone) VALUES (:name, :email, :phone)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();

            echo "Registration successful!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
