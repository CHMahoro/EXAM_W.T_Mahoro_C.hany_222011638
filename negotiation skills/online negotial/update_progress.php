<?php
// Connection details
include 'database.php';

// Check if ProgressID is set
if (isset($_REQUEST['ProgressID'])) {
    $ProgressID = $_REQUEST['ProgressID'];

    // Retrieve progress details for the selected entry
    $stmt = $connection->prepare("SELECT * FROM ProgressTracking WHERE ProgressID=?");
    $stmt->bind_param("i", $ProgressID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $WorkshopID = $row['WorkshopID'];
        $ModuleCompleted = $row['ModuleCompleted'];
        $QuizScores = $row['QuizScores'];
        $TimeSpent = $row['TimeSpent'];
        $Comments = $row['Comments'];
    } else {
        echo "Entry not found.";
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
    <title>Progress Tracking Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Progress Tracking Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="ProgressID" value="<?php echo isset($ProgressID) ? htmlspecialchars($ProgressID, ENT_QUOTES) : ''; ?>">
        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" value="<?php echo isset($UserID) ? htmlspecialchars($UserID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="WorkshopID">Workshop ID:</label>
        <input type="number" id="WorkshopID" name="WorkshopID" value="<?php echo isset($WorkshopID) ? htmlspecialchars($WorkshopID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="ModuleCompleted">Module Completed:</label>
        <input type="text" id="ModuleCompleted" name="ModuleCompleted" value="<?php echo isset($ModuleCompleted) ? htmlspecialchars($ModuleCompleted, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="QuizScores">Quiz Scores:</label>
        <input type="number" id="QuizScores" name="QuizScores" step="0.01" value="<?php echo isset($QuizScores) ? htmlspecialchars($QuizScores, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="TimeSpent">Time Spent (minutes):</label>
        <input type="number" id="TimeSpent" name="TimeSpent" value="<?php echo isset($TimeSpent) ? htmlspecialchars($TimeSpent, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Comments">Comments:</label>
        <textarea id="Comments" name="Comments" rows="4" cols="50" required><?php echo isset($Comments) ? htmlspecialchars($Comments, ENT_QUOTES) : ''; ?></textarea><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $ProgressID = $_POST['ProgressID'];
        $UserID = htmlspecialchars($_POST['UserID'], ENT_QUOTES);
        $WorkshopID = htmlspecialchars($_POST['WorkshopID'], ENT_QUOTES);
        $ModuleCompleted = htmlspecialchars($_POST['ModuleCompleted'], ENT_QUOTES);
        $QuizScores = htmlspecialchars($_POST['QuizScores'], ENT_QUOTES);
        $TimeSpent = htmlspecialchars($_POST['TimeSpent'], ENT_QUOTES);
        $Comments = htmlspecialchars($_POST['Comments'], ENT_QUOTES);

        // Update the entry in the database
        $stmt = $connection->prepare("UPDATE ProgressTracking SET UserID=?, WorkshopID=?, ModuleCompleted=?, QuizScores=?, TimeSpent=?, Comments=? WHERE ProgressID=?");
        $stmt->bind_param("iissdsi", $UserID, $WorkshopID, $ModuleCompleted, $QuizScores, $TimeSpent, $Comments, $ProgressID);
        if ($stmt->execute()) {
            echo "Entry updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "ProgressTracking.php";</script>';
        } else {
            echo "Error updating entry: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of progress tracking entries can be added here -->
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
