<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification Achievements</title>
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
<h1>Certification Achievements </h1>
<form id="updateForm" method="post">
    <label for="CertificationID">Certification ID:</label>
    <input type="number" id="CertificationID" name="CertificationID" required><br><br>

    <label for="UserID">User ID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="CertificationName">Certification Name:</label>
    <input type="text" id="CertificationName" name="CertificationName" required><br><br>

    <label for="DateAchieved">Date Achieved:</label>
    <input type="date" id="DateAchieved" name="DateAchieved" required><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>CertificationID</th>
        <th>UserID</th>
        <th>CertificationName</th>
        <th>DateAchieved</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php
    // Connection details
    include 'database.php';

    // Check if the form is submitted for Insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Insert'])) {
        // Insert section
        $CertificationID = $_POST['CertificationID'];
        $UserID = $_POST['UserID'];
        $CertificationName = $_POST['CertificationName'];
        $DateAchieved = $_POST['DateAchieved'];

        $stmt = $connection->prepare("INSERT INTO CertificationAchievements (CertificationID, UserID, CertificationName, DateAchieved) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $CertificationID, $UserID, $CertificationName, $DateAchieved);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the CertificationAchievements table
    $sql = "SELECT * FROM CertificationAchievements";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["CertificationID"] . "</td>
                <td>" . $row["UserID"] . "</td>
                <td>" . $row["CertificationName"] . "</td>
                <td>" . $row["DateAchieved"] . "</td>
                <td><a style='padding:4px' href='delete_certification.php?CertificationID=" . $row["CertificationID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_certification.php?CertificationID=" . $row["CertificationID"] . "'>Update</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>";
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
