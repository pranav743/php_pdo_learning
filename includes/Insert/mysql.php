<?php

function randomInt($min, $max) {
    return rand($min, $max);
}

// Function to generate a random name
function randomName() {
    $names = ["Desktop", "CPU", "Laptop", "Cooler", "AC", "Table", "TV", "Washing Machine", "Chair", "VR set"];
    return $names[array_rand($names)];
}



$host = "localhost";
$port = "3306"; // Default MySQL port
$dbname = "test";
$user = "root"; // MySQL username
$password = ""; // MySQL password

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $table = "products";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define the data to be inserted for one row
    $rowData = [randomInt(100, 100000), randomName(), randomInt(1000, 100000)];

    // Prepare and execute the INSERT query for the single row
    $insertQuery = "INSERT INTO $table (id, name, price) 
                    VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute($rowData);

    if ($stmt->rowCount() > 0) {
        $response = ["status" => "success", "message" => "Data inserted successfully."];
    } else {
        $response = ["status" => "error", "message" => "Data insertion failed."];
    }

    $pdo = null;

    header('Content-Type: application/json');

    echo json_encode($response);
    
} catch (PDOException $e) {
    $response = ["status" => "error", "message" => "Error: " . $e->getMessage()];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
