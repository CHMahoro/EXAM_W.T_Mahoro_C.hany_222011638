<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            color: #333;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        p {
            color: #666;
            margin-top: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
         
#image-slider {
      height: 100vh; /* Adjust height as needed */
      width: 100%; /* Ensure the slider covers the entire viewport */
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1; /* Ensure the slider stays behind other content */
      animation: slideImages 30s infinite;
    }

    @keyframes slideImages {
      0%, 100% {
        background-image: 
          url('workshop 111.jpg');
      }
      33.333% {
        background-image: 
          url('workshop 211.jpg');
      }
      66.666% {
        background-image: 
          url('workshop 51.jpg');
      }
    }
    </style>
</head>
<div id="image-slider"></div>

<body>
    <div class="container">
        <h2>Admin Login Form</h2>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
        <script>
            // JavaScript confirmation prompt before submitting the form
            document.getElementById("loginForm").addEventListener("submit", function(event) {
                var confirmLogin = confirm("Do you want to login?");
                if (!confirmLogin) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            });
        </script>
        
<?php
session_start();

// Connection details
include 'database.php';
$error = ""; // Initialize error variable

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    // Sanitize user input
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Prepare and execute SQL statement to prevent SQL injection
    $sql = "SELECT email, password FROM admin WHERE email=?";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the hashed password
            if ($password == $row['password']) {

                $_SESSION['UserID'] = $row['id']; // Use lowercase 'id' for consistency
                header("Location: home.php"); // Redirect to home page after successful login
                exit();
            } else {
                $error = "Invalid email or password"; // Set error message if password is incorrect
            }
        } else {
            $error = "User not found"; // Set error message if user does not exist
        }
    } else {
        // Error handling for prepared statement failure
        $error = "Database error: " . $connection->error;
    }

    // Close statement
    
} else {
    // Handling case when form is not submitted
    $error = "Please fill out the login form";
}

// Perform additional SQL query to fetch data from 'admin' table
$sql_admin = "SELECT * FROM `admin`";
$result_admin = $connection->query($sql_admin);

// Check if the query was successful
if ($result_admin) {
    // Fetching the data
    while ($row_admin = $result_admin->fetch_assoc()) {
        // Process or output the data as needed
        // For example:
        // echo "Admin ID: " . $row_admin["id"] . ", Admin Email: " . $row_admin["email"] . "<br>";
    }
} else {
    // Output an error message if the query fails
    // echo "Error executing query: " . $connection->error;
}

// Close connection
$connection->close();
?>
        <p>Not registered yet? <a href="register.php">Register here</a></p>
        <p>Do you want to logout? <a href="logout.php">Logout here</a></p>
    </div>
</body>
</html>
