<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Tracking Update Form</title>
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
<h1>Progress Tracking </h1>
<form id="updateForm" method="post">
    <label for="ProgressID">Progress ID:</label>
    <input type="number" id="ProgressID" name="ProgressID" required><br><br>

    <label for="UserID">User ID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="WorkshopID">Workshop ID:</label>
    <input type="number" id="WorkshopID" name="WorkshopID" required><br><br>

    <label for="ModuleCompleted">Module Completed:</label>
    <input type="text" id="ModuleCompleted" name="ModuleCompleted" required><br><br>

    <label for="QuizScores">Quiz Scores:</label>
    <input type="number" id="QuizScores" name="QuizScores" step="0.01" required><br><br>

    <label for="TimeSpent">Time Spent (minutes):</label>
    <input type="number" id="TimeSpent" name="TimeSpent" required><br><br>

    <label for="Comments">Comments:</label>
    <textarea id="Comments" name="Comments" rows="4" cols="50" required></textarea><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>ProgressID</th>
        <th>UserID</th>
        <th>WorkshopID</th>
        <th>ModuleCompleted</th>
        <th>QuizScores</th>
        <th>TimeSpent</th>
        <th>Comments</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php
    // Connection details
    include 'database.php';

    // Check if the form is submitted for Insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Insert'])) {
        // Insert section
        $ProgressID = $_POST['ProgressID'];
        $UserID = $_POST['UserID'];
        $WorkshopID = $_POST['WorkshopID'];
        $ModuleCompleted = $_POST['ModuleCompleted'];
        $QuizScores = $_POST['QuizScores'];
        $TimeSpent = $_POST['TimeSpent'];
        $Comments = $_POST['Comments'];

        $stmt = $connection->prepare("INSERT INTO ProgressTracking (ProgressID, UserID, WorkshopID, ModuleCompleted, QuizScores, TimeSpent, Comments) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisdis", $ProgressID, $UserID, $WorkshopID, $ModuleCompleted, $QuizScores, $TimeSpent, $Comments);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the ProgressTracking table
    $sql = "SELECT * FROM ProgressTracking";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["ProgressID"] . "</td>
                <td>" . $row["UserID"] . "</td>
                <td>" . $row["WorkshopID"] . "</td>
                <td>" . $row["ModuleCompleted"] . "</td>
                <td>" . $row["QuizScores"] . "</td>
                <td>" . $row["TimeSpent"] . "</td>
                <td>" . $row["Comments"] . "</td>
                <td><a style='padding:4px' href='delete_progress.php?ProgressID=" . $row["ProgressID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_progress.php?ProgressID=" . $row["ProgressID"] . "'>Update</a></td>
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
