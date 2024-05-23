<?php
// Connection details
include 'database.php';

// Check if ResultID is set
if (isset($_REQUEST['ResultID'])) {
    $ResultID = $_REQUEST['ResultID'];

    // Retrieve result details for the selected result
    $stmt = $connection->prepare("SELECT * FROM AssessmentResults WHERE ResultID=?");
    $stmt->bind_param("i", $ResultID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $AssessmentDate = $row['AssessmentDate'];
        $AssessmentScore = $row['AssessmentScore'];
        $Strengths = $row['Strengths'];
        $Weaknesses = $row['Weaknesses'];
        $Recommendations = $row['Recommendations'];
    } else {
        echo "Result not found.";
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
    <title>Assessment Result Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Assessment Result Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="ResultID" value="<?php echo isset($ResultID) ? htmlspecialchars($ResultID, ENT_QUOTES) : ''; ?>">
        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" value="<?php echo isset($UserID) ? htmlspecialchars($UserID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="AssessmentDate">Assessment Date:</label>
        <input type="date" id="AssessmentDate" name="AssessmentDate" value="<?php echo isset($AssessmentDate) ? htmlspecialchars($AssessmentDate, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="AssessmentScore">Assessment Score:</label>
        <input type="number" id="AssessmentScore" name="AssessmentScore" step="0.01" value="<?php echo isset($AssessmentScore) ? htmlspecialchars($AssessmentScore, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Strengths">Strengths:</label>
        <textarea id="Strengths" name="Strengths" rows="4" cols="50" required><?php echo isset($Strengths) ? htmlspecialchars($Strengths, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="Weaknesses">Weaknesses:</label>
        <textarea id="Weaknesses" name="Weaknesses" rows="4" cols="50" required><?php echo isset($Weaknesses) ? htmlspecialchars($Weaknesses, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="Recommendations">Recommendations:</label>
        <textarea id="Recommendations" name="Recommendations" rows="4" cols="50" required><?php echo isset($Recommendations) ? htmlspecialchars($Recommendations, ENT_QUOTES) : ''; ?></textarea><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $ResultID = $_POST['ResultID'];
        $UserID = htmlspecialchars($_POST['UserID'], ENT_QUOTES);
        $AssessmentDate = htmlspecialchars($_POST['AssessmentDate'], ENT_QUOTES);
        $AssessmentScore = htmlspecialchars($_POST['AssessmentScore'], ENT_QUOTES);
        $Strengths = htmlspecialchars($_POST['Strengths'], ENT_QUOTES);
        $Weaknesses = htmlspecialchars($_POST['Weaknesses'], ENT_QUOTES);
        $Recommendations = htmlspecialchars($_POST['Recommendations'], ENT_QUOTES);

        // Update the result in the database
        $stmt = $connection->prepare("UPDATE AssessmentResults SET UserID=?, AssessmentDate=?, AssessmentScore=?, Strengths=?, Weaknesses=?, Recommendations=? WHERE ResultID=?");
        $stmt->bind_param("issdssi", $UserID, $AssessmentDate, $AssessmentScore, $Strengths, $Weaknesses, $Recommendations, $ResultID);
        if ($stmt->execute()) {
            echo "Result updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "AssessmentResults.php";</script>';
        } else {
            echo "Error updating result: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of assessment results can be added here -->
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
