<?php
// Connection details
include 'database.php';

// Check if AttendeeID is set
if (isset($_REQUEST['AttendeeID'])) {
    $AttendeeID = $_REQUEST['AttendeeID'];

    // Retrieve attendee details for the selected attendee
    $stmt = $connection->prepare("SELECT * FROM Attendees WHERE AttendeeID=?");
    $stmt->bind_param("i", $AttendeeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $WorkshopID = $row['WorkshopID'];
        $AttendanceStatus = $row['AttendanceStatus'];
    } else {
        echo "Attendee not found.";
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
    <title>Attendee Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Attendee Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="AttendeeID" value="<?php echo isset($AttendeeID) ? htmlspecialchars($AttendeeID, ENT_QUOTES) : ''; ?>">
        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" value="<?php echo isset($UserID) ? htmlspecialchars($UserID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="WorkshopID">Workshop ID:</label>
        <input type="number" id="WorkshopID" name="WorkshopID" value="<?php echo isset($WorkshopID) ? htmlspecialchars($WorkshopID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="AttendanceStatus">Attendance Status:</label>
        <input type="text" id="AttendanceStatus" name="AttendanceStatus" value="<?php echo isset($AttendanceStatus) ? htmlspecialchars($AttendanceStatus, ENT_QUOTES) : ''; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $AttendeeID = $_POST['AttendeeID'];
        $UserID = htmlspecialchars($_POST['UserID'], ENT_QUOTES);
        $WorkshopID = htmlspecialchars($_POST['WorkshopID'], ENT_QUOTES);
        $AttendanceStatus = htmlspecialchars($_POST['AttendanceStatus'], ENT_QUOTES);

        // Update the attendee in the database
        $stmt = $connection->prepare("UPDATE Attendees SET UserID=?, WorkshopID=?, AttendanceStatus=? WHERE AttendeeID=?");
        $stmt->bind_param("iisi", $UserID, $WorkshopID, $AttendanceStatus, $AttendeeID);
        if ($stmt->execute()) {
            echo "Attendee updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "Attendees.php";</script>';
        } else {
            echo "Error updating attendee: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of attendees can be added here -->
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
