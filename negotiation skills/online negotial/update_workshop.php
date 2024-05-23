<?php
// Connection details
include 'database.php';

// Check if WorkshopID is set
if (isset($_REQUEST['WorkshopID'])) {
    $WorkshopID = $_REQUEST['WorkshopID'];

    // Retrieve workshop details for the selected workshop
    $stmt = $connection->prepare("SELECT * FROM Workshops WHERE WorkshopID=?");
    $stmt->bind_param("i", $WorkshopID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $WorkshopTitle = $row['WorkshopTitle'];
        $Description = $row['Description'];
        $InstructorID = $row['InstructorID'];
        $Date = $row['Date'];
        $Duration = $row['Duration'];
    } else {
        echo "Workshop not found.";
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
    <title>Workshop Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Workshop Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="WorkshopID" value="<?php echo isset($WorkshopID) ? htmlspecialchars($WorkshopID, ENT_QUOTES) : ''; ?>">
        <label for="WorkshopTitle">Workshop Title:</label>
        <input type="text" id="WorkshopTitle" name="WorkshopTitle" value="<?php echo isset($WorkshopTitle) ? htmlspecialchars($WorkshopTitle, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Description">Description:</label>
        <textarea id="Description" name="Description" rows="4" cols="50" required><?php echo isset($Description) ? htmlspecialchars($Description, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="InstructorID">Instructor ID:</label>
        <input type="number" id="InstructorID" name="InstructorID" value="<?php echo isset($InstructorID) ? htmlspecialchars($InstructorID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Date">Date:</label>
        <input type="date" id="Date" name="Date" value="<?php echo isset($Date) ? htmlspecialchars($Date, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Duration">Duration:</label>
        <input type="number" id="Duration" name="Duration" value="<?php echo isset($Duration) ? htmlspecialchars($Duration, ENT_QUOTES) : ''; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $WorkshopID = $_POST['WorkshopID'];
        $WorkshopTitle = htmlspecialchars($_POST['WorkshopTitle'], ENT_QUOTES);
        $Description = htmlspecialchars($_POST['Description'], ENT_QUOTES);
        $InstructorID = htmlspecialchars($_POST['InstructorID'], ENT_QUOTES);
        $Date = htmlspecialchars($_POST['Date'], ENT_QUOTES);
        $Duration = htmlspecialchars($_POST['Duration'], ENT_QUOTES);

        // Update the workshop in the database
        $stmt = $connection->prepare("UPDATE Workshops SET WorkshopTitle=?, Description=?, InstructorID=?, Date=?, Duration=? WHERE WorkshopID=?");
        $stmt->bind_param("sssisi", $WorkshopTitle, $Description, $InstructorID, $Date, $Duration, $WorkshopID);
        if ($stmt->execute()) {
            echo "Workshop updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "Workshops.php";</script>';
        } else {
            echo "Error updating workshop: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of workshops can be added here -->
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
