<?php

function randomInt($min, $max) {
    return rand($min, $max);
}

// Function to generate a random name
function randomName() {
    $names = ['Pranav', 'Vishal', 'Darshit', 'Mustafa', 'Vardhan', 'Sakshaat', 'Taniya', 'Rutuja', 'Sharayu', 'Purav', 'Dheer', 'Arpan'];
    return $names[array_rand($names)];
}

// Function to generate a random location
function randomLocation() {
    $locations = ['Mumbai', 'Delhi', 'Bangalore', 'Chennai', 'Kolkata', 'Hyderabad', 'Pune', 'Ahmedabad'];
    return $locations[array_rand($locations)];
}

// Function to generate a random salary
function randomSalary() {
    return rand(80000, 120000);
}

$host = "localhost";
$port = "5432";
$dbname = "practice";
$user = "postgres";
$password = "pranav07042003";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $table = "employee";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define the data to be inserted for one row
    $rowData = [randomInt(100, 100000), randomName(), randomLocation(), randomInt(1, 20), randomSalary()];

    // Prepare and execute the INSERT query for the single row
    $insertQuery = "INSERT INTO $table (emp_id, emp_name, emp_location, experience, emp_salary) 
                    VALUES (?, ?, ?, ?, ?)";
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
