<?php
// Connection details
include 'database.php';

// Check if ResourceID is set
if (isset($_REQUEST['ResourceID'])) {
    $ResourceID = $_REQUEST['ResourceID'];

    // JavaScript confirmation for deletion
    echo '<script>
            function confirmDelete() {
              return confirm("Are you sure you want to delete this record?");
            }
          </script>';

    // Prepare and execute the DELETE statement after confirmation
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        $stmt = $connection->prepare("DELETE FROM NegotiationResources WHERE ResourceID=?");
        $stmt->bind_param("i", $ResourceID);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "NegotiationResources.php";</script>';
        } else {
            echo "Error deleting record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        // Display confirmation form
        echo '<form method="post" onsubmit="return confirmDelete()">
                <input type="hidden" name="ResourceID" value="' . $ResourceID . '">
                Are you sure you want to delete this record?<br>
                <input type="submit" name="confirm_delete" value="yes">
                <input type="button" value="no" onclick="window.location.href=\'NegotiationResources.php\'">
              </form>';
    }
}
?>
