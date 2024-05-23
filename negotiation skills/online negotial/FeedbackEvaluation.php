<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Evaluation </title>
</head>
<style>
    .button {
        border: 5px solid;
        background-color: green;
    }
</style>
<body bgcolor="cyan">
<nav>
        <ul>
    <li style="display: inline; margin-right: 5px;"><a href="./Users.php" style="padding: 5px; color: white; background-color: green; text-decoration: none; margin-right: 5px;">Users</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./Instructors.php" style="padding: 5px; color: white; background-color: green; text-decoration: none; margin-right: 5px;">Instructors</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./Workshops.php" style="padding: 5px; color: white; background-color:green; text-decoration: none; margin-right: 5px;">Workshops</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./Attendees.php" style="padding: 5px; color: white; background-color: green; text-decoration: none; margin-right: 5px;">Attendees</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./NegotiationResources.php" style="padding: 5px; color: white; background-color:green; text-decoration: none; margin-right: 5px;">NegotiationResources</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./AssessmentResults.php" style="padding: 5px; color: white; background-color:green; text-decoration: none; margin-right: 5px;">AssessmentResults</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./ProgressTracking.php" style="padding: 5px; color: white; background-color:green; text-decoration: none; margin-right: 5px;">ProgressTracking</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./CommunityEngagement.php" style="padding: 5px; color: white; background-color:green; text-decoration: none; margin-right: 5px;">CommunityEngagement</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./FeedbackEvaluation.php" style="padding: 5px; color: white; background-color:green; text-decoration: none; margin-right: 5px;">FeedbackEvaluation</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./CertificationAchievements.php" style="padding: 5px; color: white; background-color:green; text-decoration: none; margin-right: 5px;">CertificationAchievements</a></li>
</ul>
</nav>
<h1>Feedback Evaluation </h1>
<form id="updateForm" method="post">
    <label for="FeedbackID">Feedback ID:</label>
    <input type="number" id="FeedbackID" name="FeedbackID" required><br><br>

    <label for="UserID">User ID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="WorkshopID">Workshop ID:</label>
    <input type="number" id="WorkshopID" name="WorkshopID" required><br><br>

    <label for="Rating">Rating:</label>
    <input type="number" id="Rating" name="Rating" step="0.1" min="0" max="5" required><br><br>

    <label for="Comments">Comments:</label>
    <textarea id="Comments" name="Comments" rows="4" cols="50" required></textarea><br><br>

    <label for="Suggestions">Suggestions:</label>
    <textarea id="Suggestions" name="Suggestions" rows="4" cols="50" required></textarea><br><br>

    <label for="Timestamp">Timestamp:</label>
    <input type="datetime-local" id="Timestamp" name="Timestamp" required><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>FeedbackID</th>
        <th>UserID</th>
        <th>WorkshopID</th>
        <th>Rating</th>
        <th>Comments</th>
        <th>Suggestions</th>
        <th>Timestamp</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php
    // Connection details
    include 'database.php';

    // Check if the form is submitted for Insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Insert'])) {
        // Insert section
        $FeedbackID = $_POST['FeedbackID'];
        $UserID = $_POST['UserID'];
        $WorkshopID = $_POST['WorkshopID'];
        $Rating = $_POST['Rating'];
        $Comments = $_POST['Comments'];
        $Suggestions = $_POST['Suggestions'];
        $Timestamp = $_POST['Timestamp'];

        $stmt = $connection->prepare("INSERT INTO FeedbackEvaluation (FeedbackID, UserID, WorkshopID, Rating, Comments, Suggestions, Timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiissss", $FeedbackID, $UserID, $WorkshopID, $Rating, $Comments, $Suggestions, $Timestamp);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the FeedbackEvaluation table
    $sql = "SELECT * FROM FeedbackEvaluation";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["FeedbackID"] . "</td>
                <td>" . $row["UserID"] . "</td>
                <td>" . $row["WorkshopID"] . "</td>
                <td>" . $row["Rating"] . "</td>
                <td>" . $row["Comments"] . "</td>
                <td>" . $row["Suggestions"] . "</td>
                <td>" . $row["Timestamp"] . "</td>
                <td><a style='padding:4px' href='delete_feedback.php?FeedbackID=" . $row["FeedbackID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_feedback.php?FeedbackID=" . $row["FeedbackID"] . "'>Update</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No data found</td></tr>";
    }

    // Close connection
    $connection->close();
    ?>
</table>

<footer>
    <h2>Online Negotiation Skills Workshop Platform &copy; 2024 &222011638; Designed by: MAHORO Chany</h2>
</footer>

<script>
    function confirmInsert() {
        return confirm("Are you sure you want to Insert this record?");
    }
</script>
</body>
</html>
