<?php

$host = "localhost";
$port = "5432";
$dbname = "practice";
$user = "postgres";
$password = "pranav07042003";
$server =  "Server_1";

ob_start(); // Start output buffering

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $table = "employee";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM $table";
    $stmt = $pdo->query($query);

    if ($stmt->rowCount() > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Location</th><th>Salary</th></tr>'; // Replace with your column names

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['emp_id'] . '</td>'; // Replace 'column1' with your column names
            echo '<td>' . $row['emp_name'] . '</td>'; // Replace 'column2' with your column names
            echo '<td>' . $row['emp_location'] . '</td>'; // Replace 'column3' with your column names
            echo '<td>' . $row['emp_salary'] . '</td>';
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

$output = ob_get_clean(); // Capture the output and clear the buffer
echo $output; // Return the captured HTML table as the response

?>
