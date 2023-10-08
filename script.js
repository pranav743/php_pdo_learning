
const codeBlock = document.getElementById("codeSnippet");
const output = document.getElementById("output");
const codeBlock2 = document.getElementById("output2");

const getdata = (index) => {
    const xhr = new XMLHttpRequest();
    let db = ['postgres.php', 'mysql.php'];
 
    const phpScriptURL = "includes/"+db[index];

    xhr.open("GET", phpScriptURL, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
         
            output.innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}

const putdata = (index) => {
    const xhr = new XMLHttpRequest();

    let db = ['postgres.php', 'mysql.php'];


    // Define the PHP script URL
    const phpScriptURL = "includes/Insert/" + db[index];

    xhr.open("GET", phpScriptURL, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
         
            let data = JSON.parse(xhr.responseText);
            console.log(data.message);
            output.innerHTML = `<h1 style="color: #333">${data.message}</h1>`
            
        }
    };

    xhr.send();
}

const changeSnippet = (index) => {
    codeBlock.textContent = code_snippets[index];
    getdata(index);
}

const onInsert = (index) => {
    codeBlock2.textContent = insert_code_snippets[index];
    putdata(index);
}
//From ENV
postgres_password = PG_PASS;

pgsql_snippet = `
<?php

$host = "localhost";
$port = "5432";
$dbname = "practice";
$user = "postgres";
$password = "password";
$server =  "Server_1";

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
?>
`

mysql_snippet = `
<?php

$host = "localhost";
$port = "3306";
$dbname = "test";
$user = "root";
$password = "password";

ob_start();

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
`

var code_snippets = [
    pgsql_snippet,
    mysql_snippet
]

const insert_code_snippets =[
`<?php

    $host = "localhost";
    $port = "5432";
    $dbname = "practice";
    $user = "postgres";
    $password = "password";
    
    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
        $table = "employee";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      
        $rowData = [randomInt(100, 100000), randomName(), randomLocation(), randomInt(1, 20), randomSalary()];
    
       
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
    `,
    `<?php

    function randomInt($min, $max) {
        return rand($min, $max);
    }
    
    // Function to generate a random name
    function randomName() {
        $names = ["Desktop", "CPU", "Laptop", "Cooler", "AC", "Table", "TV", "Washing Machine", "Chair", "VR set"];
        return $names[array_rand($names)];
    }
    
    
    
    $host = "localhost";
    $port = "3306"; 
    $dbname = "test";
    $user = "root"; 
    $password = "password"; 
    
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
    `
]
