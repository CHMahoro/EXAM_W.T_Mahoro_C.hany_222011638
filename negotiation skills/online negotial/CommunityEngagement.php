<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Engagement</title>
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
<h1>Community Engagement </h1>
<form id="updateForm" method="post">
    <label for="EngagementID">Engagement ID:</label>
    <input type="number" id="EngagementID" name="EngagementID" required><br><br>

    <label for="UserID">User ID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="Topic">Topic:</label>
    <input type="text" id="Topic" name="Topic" required><br><br>

    <label for="Thread">Thread:</label>
    <textarea id="Thread" name="Thread" rows="4" cols="50" required></textarea><br><br>

    <label for="Comments">Comments:</label>
    <textarea id="Comments" name="Comments" rows="4" cols="50" required></textarea><br><br>

    <label for="Likes">Likes:</label>
    <input type="number" id="Likes" name="Likes" required><br><br>

    <label for="Replies">Replies:</label>
    <input type="number" id="Replies" name="Replies" required><br><br>

    <label for="Timestamp">Timestamp:</label>
    <input type="datetime-local" id="Timestamp" name="Timestamp" required><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>EngagementID</th>
        <th>UserID</th>
        <th>Topic</th>
        <th>Thread</th>
        <th>Comments</th>
        <th>Likes</th>
        <th>Replies</th>
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
        $EngagementID = $_POST['EngagementID'];
        $UserID = $_POST['UserID'];
        $Topic = $_POST['Topic'];
        $Thread = $_POST['Thread'];
        $Comments = $_POST['Comments'];
        $Likes = $_POST['Likes'];
        $Replies = $_POST['Replies'];
        $Timestamp = $_POST['Timestamp'];

        $stmt = $connection->prepare("INSERT INTO CommunityEngagement (EngagementID, UserID, Topic, Thread, Comments, Likes, Replies, Timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssiis", $EngagementID, $UserID, $Topic, $Thread, $Comments, $Likes, $Replies, $Timestamp);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the CommunityEngagement table
    $sql = "SELECT * FROM CommunityEngagement";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["EngagementID"] . "</td>
                <td>" . $row["UserID"] . "</td>
                <td>" . $row["Topic"] . "</td>
                <td>" . $row["Thread"] . "</td>
                <td>" . $row["Comments"] . "</td>
                <td>" . $row["Likes"] . "</td>
                <td>" . $row["Replies"] . "</td>
                <td>" . $row["Timestamp"] . "</td>
                <td><a style='padding:4px' href='delete_engagement.php?EngagementID=" . $row["EngagementID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_engagement.php?EngagementID=" . $row["EngagementID"] . "'>Update</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No data found</td></tr>";
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
