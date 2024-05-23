<?php
// Connection details
include 'database.php';

// Check if FeedbackID is set
if (isset($_REQUEST['FeedbackID'])) {
    $FeedbackID = $_REQUEST['FeedbackID'];

    // JavaScript confirmation for deletion
    echo '<script>
            function confirmDelete() {
              return confirm("Are you sure you want to delete this record?");
            }
          </script>';

    // Prepare and execute the DELETE statement after confirmation
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        $stmt = $connection->prepare("DELETE FROM FeedbackEvaluation WHERE FeedbackID=?");
        $stmt->bind_param("i", $FeedbackID);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "FeedbackEvaluation.php";</script>';
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Display confirmation form
        echo '<form method="post" onsubmit="return confirmDelete()">
                <input type="hidden" name="FeedbackID" value="' . $FeedbackID . '">
                Are you sure you want to delete this record?<br>
                <input type="submit" name="confirm_delete" value="yes">
                <input type="button" value="no" onclick="window.location.href=\'FeedbackEvaluation.php\'">
              </form>';
    }
}
?>
