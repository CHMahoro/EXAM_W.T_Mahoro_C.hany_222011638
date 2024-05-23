<?php
// Connection details
include 'database.php';

// Check if InstructorID is set
if (isset($_REQUEST['InstructorID'])) {
    $InstructorID = $_REQUEST['InstructorID'];

    // Retrieve instructor details for the selected instructor
    $stmt = $connection->prepare("SELECT * FROM Instructors WHERE InstructorID=?");
    $stmt->bind_param("i", $InstructorID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $ExpertiseArea = $row['ExpertiseArea'];
        $Bio = $row['Bio'];
    } else {
        echo "Instructor not found.";
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
    <title>Instructor Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Instructor Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="InstructorID" value="<?php echo isset($InstructorID) ? htmlspecialchars($InstructorID, ENT_QUOTES) : ''; ?>">
        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" value="<?php echo isset($UserID) ? htmlspecialchars($UserID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="ExpertiseArea">Expertise Area:</label>
        <input type="text" id="ExpertiseArea" name="ExpertiseArea" value="<?php echo isset($ExpertiseArea) ? htmlspecialchars($ExpertiseArea, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Bio">Bio:</label>
        <textarea id="Bio" name="Bio" rows="4" cols="50" required><?php echo isset($Bio) ? htmlspecialchars($Bio, ENT_QUOTES) : ''; ?></textarea><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $InstructorID = $_POST['InstructorID'];
        $UserID = htmlspecialchars($_POST['UserID'], ENT_QUOTES);
        $ExpertiseArea = htmlspecialchars($_POST['ExpertiseArea'], ENT_QUOTES);
        $Bio = htmlspecialchars($_POST['Bio'], ENT_QUOTES);

        // Update the instructor in the database
        $stmt = $connection->prepare("UPDATE Instructors SET UserID=?, ExpertiseArea=?, Bio=? WHERE InstructorID=?");
        $stmt->bind_param("issi", $UserID, $ExpertiseArea, $Bio, $InstructorID);
        if ($stmt->execute()) {
            echo "Instructor profile updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "Instructors.php";</script>';
        } else {
            echo "Error updating instructor profile: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of instructors can be added here -->
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
