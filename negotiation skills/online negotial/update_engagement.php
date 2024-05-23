<?php
// Connection details
include 'database.php';

// Check if EngagementID is set
if (isset($_REQUEST['EngagementID'])) {
    $EngagementID = $_REQUEST['EngagementID'];

    // Retrieve engagement details for the selected entry
    $stmt = $connection->prepare("SELECT * FROM CommunityEngagement WHERE EngagementID=?");
    $stmt->bind_param("i", $EngagementID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $Topic = $row['Topic'];
        $Thread = $row['Thread'];
        $Comments = $row['Comments'];
        $Likes = $row['Likes'];
        $Replies = $row['Replies'];
        $Timestamp = $row['Timestamp'];
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
    <title>Community Engagement Update Form</title>
    <style>
        /* Include your CSS styles here */
    </style>
</head>
<body>
<header>
    <!-- Header content -->
</header>
<section>
    <h1><u>Community Engagement Update Form</u></h1>
    <form method="post" onsubmit="return confirmUpdate()">
        <input type="hidden" name="EngagementID" value="<?php echo isset($EngagementID) ? htmlspecialchars($EngagementID, ENT_QUOTES) : ''; ?>">
        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" value="<?php echo isset($UserID) ? htmlspecialchars($UserID, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Topic">Topic:</label>
        <input type="text" id="Topic" name="Topic" value="<?php echo isset($Topic) ? htmlspecialchars($Topic, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Thread">Thread:</label>
        <textarea id="Thread" name="Thread" rows="4" cols="50" required><?php echo isset($Thread) ? htmlspecialchars($Thread, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="Comments">Comments:</label>
        <textarea id="Comments" name="Comments" rows="4" cols="50" required><?php echo isset($Comments) ? htmlspecialchars($Comments, ENT_QUOTES) : ''; ?></textarea><br><br>
        <label for="Likes">Likes:</label>
        <input type="number" id="Likes" name="Likes" value="<?php echo isset($Likes) ? htmlspecialchars($Likes, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Replies">Replies:</label>
        <input type="number" id="Replies" name="Replies" value="<?php echo isset($Replies) ? htmlspecialchars($Replies, ENT_QUOTES) : ''; ?>" required><br><br>
        <label for="Timestamp">Timestamp:</label>
        <input type="datetime-local" id="Timestamp" name="Timestamp" value="<?php echo isset($Timestamp) ? htmlspecialchars(date('Y-m-d\TH:i', strtotime($Timestamp)), ENT_QUOTES) : ''; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <?php
    // Handle update operation
    if (isset($_POST['update'])) {
        // Retrieve updated values from the form
        $EngagementID = $_POST['EngagementID'];
        $UserID = htmlspecialchars($_POST['UserID'], ENT_QUOTES);
        $Topic = htmlspecialchars($_POST['Topic'], ENT_QUOTES);
        $Thread = htmlspecialchars($_POST['Thread'], ENT_QUOTES);
        $Comments = htmlspecialchars($_POST['Comments'], ENT_QUOTES);
        $Likes = htmlspecialchars($_POST['Likes'], ENT_QUOTES);
        $Replies = htmlspecialchars($_POST['Replies'], ENT_QUOTES);
        $Timestamp = htmlspecialchars($_POST['Timestamp'], ENT_QUOTES);

        // Update the entry in the database
        $stmt = $connection->prepare("UPDATE CommunityEngagement SET UserID=?, Topic=?, Thread=?, Comments=?, Likes=?, Replies=?, Timestamp=? WHERE EngagementID=?");
        $stmt->bind_param("issiisii", $UserID, $Topic, $Thread, $Comments, $Likes, $Replies, $Timestamp, $EngagementID);
        if ($stmt->execute()) {
            echo "Entry updated successfully.";
            // Redirect to appropriate page
            echo '<script>window.location.href = "CommunityEngagement.php";</script>';
        } else {
            echo "Error updating entry: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>
    <!-- Additional content or table of community engagement entries can be added here -->
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
