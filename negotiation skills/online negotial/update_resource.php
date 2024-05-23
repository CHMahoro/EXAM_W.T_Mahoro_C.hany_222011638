<?php
// Connection details
include 'database.php';

// Check if ResourceID is set
if (isset($_REQUEST['ResourceID'])) {
    $ResourceID = $_REQUEST['ResourceID'];

    // Retrieve resource details for the selected resource
    $stmt = $connection->prepare("SELECT * FROM NegotiationResources WHERE ResourceID=?");
    $stmt->bind_param("i", $ResourceID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ResourceTitle = $row['ResourceTitle'];
        $ResourceType = $row['ResourceType'];
        $Description = $row['Description'];
        $Link = $row['Link'];
    } else {
        echo "Resource not found.";
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
    <title>Negotiation Resource Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Negotiation Resource Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="ResourceID" value="<?php echo isset($ResourceID) ? htmlspecialchars($ResourceID, ENT_QUOTES) : ''; ?>">
        <label for="ResourceTitle">Resource Title:</label>
        <input type="text" id="ResourceTitle" name="ResourceTitle" value="<?php echo isset($ResourceTitle) ? htmlspecialchars($ResourceTitle, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="ResourceType">Resource Type:</label>
        <input type="text" id="ResourceType" name="ResourceType" value="<?php echo isset($ResourceType) ? htmlspecialchars($ResourceType, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Description">Description:</label>
        <textarea id="Description" name="Description" rows="4" cols="50" required><?php echo isset($Description) ? htmlspecialchars($Description, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="Link">Link:</label>
        <input type="text" id="Link" name="Link" value="<?php echo isset($Link) ? htmlspecialchars($Link, ENT_QUOTES) : ''; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $ResourceID = $_POST['ResourceID'];
        $ResourceTitle = htmlspecialchars($_POST['ResourceTitle'], ENT_QUOTES);
        $ResourceType = htmlspecialchars($_POST['ResourceType'], ENT_QUOTES);
        $Description = htmlspecialchars($_POST['Description'], ENT_QUOTES);
        $Link = htmlspecialchars($_POST['Link'], ENT_QUOTES);

        // Update the resource in the database
        $stmt = $connection->prepare("UPDATE NegotiationResources SET ResourceTitle=?, ResourceType=?, Description=?, Link=? WHERE ResourceID=?");
        $stmt->bind_param("ssssi", $ResourceTitle, $ResourceType, $Description, $Link, $ResourceID);
        if ($stmt->execute()) {
            echo "Resource updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "NegotiationResources.php";</script>';
        } else {
            echo "Error updating resource: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of negotiation resources can be added here -->
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
