<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: transparent;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
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
    <script>
        function validateForm() {
            // Validate email format
            var email = document.getElementById("email").value;
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Validate password length
            var password = document.getElementById("password").value;
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            // Ask for confirmation before submitting the form
            var confirmation = confirm("Are you sure you want to submit?");
            if (confirmation) {
                return true; // User confirmed, proceed with form submission
            } else {
                return false; // User canceled, do not submit the form
            }
        }
    </script>
</head>
<div id="image-slider"></div>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <?php
        // Connection details
        include 'database.php';

        // Handling POST request
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the required fields are set
            $required_fields = ['fname', 'lname', 'idNumber', 'phone', 'martialstatus', 'DoB', 'email', 'password', 'gender'];
            $missing_fields = array_diff($required_fields, array_keys($_POST));

            if (!empty($missing_fields)) {
                // Handle missing fields error
                echo "Error: The following fields are missing: " . implode(', ', $missing_fields);
                exit();
            }

            // Retrieving form data
            $fname  = $_POST['fname'];
            $lname = $_POST['lname'];
            $id_number = $_POST['idNumber'];
            $phone = $_POST['phone'];
            $martial_status = $_POST['martialstatus'];
            $dob = $_POST['DoB'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Store password in plain text
            $gender = $_POST['gender'];

            // Preparing SQL query
            $sql = "INSERT INTO admin (fname, lname, idNumber, phone, martialstatus, DoB, email, password, gender) VALUES ('$fname','$lname','$id_number', '$phone', '$martial_status','$dob','$email','$password','$gender')";

            // Executing SQL query
            if ($connection->query($sql) === TRUE) {
                // Redirecting to login page on successful registration
                header("Location: login.php");
                exit();
            } else {
                // Displaying error message if query execution fails
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }

        // Closing database connection
        $connection->close();
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateForm()">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="idNumber">ID Number:</label>
            <input type="text" id="idNumber" name="idNumber" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="martialstatus">Marital Status:</label>
            <select id="martialstatus" name="martialstatus" required>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>

            <label for="DoB">Date of Birth:</label>
            <input type="date" id="DoB" name="DoB" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
