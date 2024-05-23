<?php
// Connection details
include 'database.php';

// Check if ResultID is set
if (isset($_REQUEST['ResultID'])) {
    $ResultID = $_REQUEST['ResultID'];

    // JavaScript confirmation for deletion
    echo '<script>
            function confirmDelete() {
              return confirm("Are you sure you want to delete this record?");
            }
          </script>';

    // Prepare and execute the DELETE statement after confirmation
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        $stmt = $connection->prepare("DELETE FROM AssessmentResults WHERE ResultID=?");
        $stmt->bind_param("i", $ResultID);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "AssessmentResults.php";</script>';
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Display confirmation form
        echo '<form method="post" onsubmit="return confirmDelete()">
                <input type="hidden" name="ResultID" value="' . $ResultID . '">
                Are you sure you want to delete this record?<br>
                <input type="submit" name="confirm_delete" value="yes">
                <input type="button" value="no" onclick="window.location.href=\'AssessmentResults.php\'">
              </form>';
    }
}
?>
