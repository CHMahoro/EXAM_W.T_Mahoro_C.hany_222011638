<?php
// Connection details
include 'database.php';

// Check if UserID is set
if (isset($_REQUEST['UserID'])) {
    $UserID = $_REQUEST['UserID'];

    // Retrieve user details for the selected user
    $stmt = $connection->prepare("SELECT * FROM Users WHERE UserID=?");
    $stmt->bind_param("i", $UserID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Username = $row['Username'];
        $Email = $row['Email'];
        $Password = $row['Password'];
        $UserType = $row['UserType'];
    } else {
        echo "User not found.";
    }

    // Close statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>User Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <label for="Username">Username:</label>
        <input type="text" id="Username" name="Username" value="<?php echo isset($Username) ? htmlspecialchars($Username, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" value="<?php echo isset($Email) ? htmlspecialchars($Email, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password" value="<?php echo isset($Password) ? htmlspecialchars($Password, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="UserType">User Type:</label>
        <input type="text" id="UserType" name="UserType" value="<?php echo isset($UserType) ? htmlspecialchars($UserType, ENT_QUOTES) : ''; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $Username = htmlspecialchars($_POST['Username'], ENT_QUOTES);
        $Email = htmlspecialchars($_POST['Email'], ENT_QUOTES);
        $Password = htmlspecialchars($_POST['Password'], ENT_QUOTES);
        $UserType = htmlspecialchars($_POST['UserType'], ENT_QUOTES);

        // Update the user profile in the database
        $stmt = $connection->prepare("UPDATE Users SET Username=?, Email=?, Password=?, UserType=? WHERE UserID=?");
        $stmt->bind_param("ssssi", $Username, $Email, $Password, $UserType, $UserID);
        if ($stmt->execute()) {
            echo "User profile updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "Users.php";</script>';
        } else {
            echo "Error updating user profile: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of users can be added here -->
</section>
<footer>
    <!-- Footer content -->
</footer>
<script>
    function confirmUpdate() {
        return confirm("Are you sure you want to update this record?");
    }
</script>
</body>
</html>
