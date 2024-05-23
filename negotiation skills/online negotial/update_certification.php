<?php
// Connection details
include 'database.php';

// Check if CertificationID is set
if (isset($_REQUEST['CertificationID'])) {
    $CertificationID = $_REQUEST['CertificationID'];

    // Retrieve certification details for the selected certification
    $stmt = $connection->prepare("SELECT * FROM CertificationAchievements WHERE CertificationID=?");
    $stmt->bind_param("i", $CertificationID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $CertificationName = $row['CertificationName'];
        $DateAchieved = $row['DateAchieved'];
    } else {
        echo "Certification not found.";
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
    <title>Certification Achievements Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Certification Achievements Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="CertificationID" value="<?php echo isset($CertificationID) ? htmlspecialchars($CertificationID, ENT_QUOTES) : ''; ?>">
        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" value="<?php echo isset($UserID) ? htmlspecialchars($UserID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="CertificationName">Certification Name:</label>
        <input type="text" id="CertificationName" name="CertificationName" value="<?php echo isset($CertificationName) ? htmlspecialchars($CertificationName, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="DateAchieved">Date Achieved:</label>
        <input type="date" id="DateAchieved" name="DateAchieved" value="<?php echo isset($DateAchieved) ? htmlspecialchars($DateAchieved, ENT_QUOTES) : ''; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $CertificationID = $_POST['CertificationID'];
        $UserID = htmlspecialchars($_POST['UserID'], ENT_QUOTES);
        $CertificationName = htmlspecialchars($_POST['CertificationName'], ENT_QUOTES);
        $DateAchieved = htmlspecialchars($_POST['DateAchieved'], ENT_QUOTES);

        // Update the certification in the database
        $stmt = $connection->prepare("UPDATE CertificationAchievements SET UserID=?, CertificationName=?, DateAchieved=? WHERE CertificationID=?");
        $stmt->bind_param("issi", $UserID, $CertificationName, $DateAchieved, $CertificationID);
        if ($stmt->execute()) {
            echo "Certification updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "CertificationAchievements.php";</script>';
        } else {
            echo "Error updating certification: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of certifications can be added here -->
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
