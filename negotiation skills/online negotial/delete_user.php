<?php
// Connection details
include 'database.php';

// Check if UserID is set
if (isset($_REQUEST['UserID'])) {
    $UserID = $_REQUEST['UserID'];

    // JavaScript confirmation for deletion
    echo '<script>
            function confirmdelete() {
              return confirm("Are you sure you want to delete this record?");
            }
          </script>';

    // Prepare and execute the DELETE statement after confirmation
    if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
        $stmt = $connection->prepare("DELETE FROM Users WHERE UserID=?");
        $stmt->bind_param("i", $UserID);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "Users.php";</script>';
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Display confirmation dialog
        echo '<form method="post" onsubmit="return confirmdelete()">
                <input type="hidden" name="confirm_delete" value="yes">
                <input type="submit" value="Delete Record">
              </form>';
    }
} else {
    echo "UserID is not set.";
}

$connection->close();
?>
