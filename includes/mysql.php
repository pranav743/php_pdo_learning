<?php

$host = "localhost";
$port = "3306";
$dbname = "test";
$user = "root";
$password = "";

ob_start(); // Start output buffering

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $table = "products";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM $table";
    $stmt = $pdo->query($query);

    if ($stmt->rowCount() > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Price</th></tr>'; 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>'; 
            echo '<td>' . $row['name'] . '</td>'; 
            echo '<td>' . $row['price'] . '</td>'; 
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No data found';
    }

    $pdo = null;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$output = ob_get_clean(); 
echo $output; 

?>
