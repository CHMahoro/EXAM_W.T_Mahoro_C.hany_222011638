<?php
// Connection details
include 'database.php';

// Check if FeedbackID is set
if (isset($_REQUEST['FeedbackID'])) {
    $FeedbackID = $_REQUEST['FeedbackID'];

    // Retrieve feedback details for the selected feedback
    $stmt = $connection->prepare("SELECT * FROM FeedbackEvaluation WHERE FeedbackID=?");
    $stmt->bind_param("i", $FeedbackID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $WorkshopID = $row['WorkshopID'];
        $Rating = $row['Rating'];
        $Comments = $row['Comments'];
        $Suggestions = $row['Suggestions'];
        $Timestamp = $row['Timestamp'];
    } else {
        echo "Feedback not found.";
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
    <title>Feedback Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Feedback Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="FeedbackID" value="<?php echo isset($FeedbackID) ? htmlspecialchars($FeedbackID, ENT_QUOTES) : ''; ?>">
        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" value="<?php echo isset($UserID) ? htmlspecialchars($UserID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="WorkshopID">Workshop ID:</label>
        <input type="number" id="WorkshopID" name="WorkshopID" value="<?php echo isset($WorkshopID) ? htmlspecialchars($WorkshopID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Rating">Rating:</label>
        <input type="number" id="Rating" name="Rating" step="0.1" min="0" max="5" value="<?php echo isset($Rating) ? htmlspecialchars($Rating, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Comments">Comments:</label>
        <textarea id="Comments" name="Comments" rows="4" cols="50" required><?php echo isset($Comments) ? htmlspecialchars($Comments, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="Suggestions">Suggestions:</label>
        <textarea id="Suggestions" name="Suggestions" rows="4" cols="50" required><?php echo isset($Suggestions) ? htmlspecialchars($Suggestions, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="Timestamp">Timestamp:</label>
        <input type="datetime-local" id="Timestamp" name="Timestamp" value="<?php echo isset($Timestamp) ? htmlspecialchars(date('Y-m-d\TH:i', strtotime($Timestamp)), ENT_QUOTES) : ''; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $FeedbackID = $_POST['FeedbackID'];
        $UserID = htmlspecialchars($_POST['UserID'], ENT_QUOTES);
        $WorkshopID = htmlspecialchars($_POST['WorkshopID'], ENT_QUOTES);
        $Rating = htmlspecialchars($_POST['Rating'], ENT_QUOTES);
        $Comments = htmlspecialchars($_POST['Comments'], ENT_QUOTES);
        $Suggestions = htmlspecialchars($_POST['Suggestions'], ENT_QUOTES);
        $Timestamp = htmlspecialchars($_POST['Timestamp'], ENT_QUOTES);

        // Update the feedback in the database
        $stmt = $connection->prepare("UPDATE FeedbackEvaluation SET UserID=?, WorkshopID=?, Rating=?, Comments=?, Suggestions=?, Timestamp=? WHERE FeedbackID=?");
        $stmt->bind_param("iissssi", $UserID, $WorkshopID, $Rating, $Comments, $Suggestions, $Timestamp, $FeedbackID);
        if ($stmt->execute()) {
            echo "Feedback updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "FeedbackEvaluation.php";</script>';
        } else {
            echo "Error updating feedback: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of feedbacks can be added here -->
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
