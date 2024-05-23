<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Results</title>
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
<h1>Assessment Result </h1>
<form id="updateForm" method="post">
    <label for="ResultID">Result ID:</label>
    <input type="number" id="ResultID" name="ResultID" required><br><br>

    <label for="UserID">User ID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="AssessmentDate">Assessment Date:</label>
    <input type="date" id="AssessmentDate" name="AssessmentDate" required><br><br>

    <label for="AssessmentScore">Assessment Score:</label>
    <input type="number" id="AssessmentScore" name="AssessmentScore" step="0.01" required><br><br>

    <label for="Strengths">Strengths:</label>
    <textarea id="Strengths" name="Strengths" rows="4" cols="50" required></textarea><br><br>

    <label for="Weaknesses">Weaknesses:</label>
    <textarea id="Weaknesses" name="Weaknesses" rows="4" cols="50" required></textarea><br><br>

    <label for="Recommendations">Recommendations:</label>
    <textarea id="Recommendations" name="Recommendations" rows="4" cols="50" required></textarea><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>ResultID</th>
        <th>UserID</th>
        <th>AssessmentDate</th>
        <th>AssessmentScore</th>
        <th>Strengths</th>
        <th>Weaknesses</th>
        <th>Recommendations</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php
    // Connection details
    include 'database.php';

    // Check if the form is submitted for Insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Insert'])) {
        // Insert section
        $ResultID = $_POST['ResultID'];
        $UserID = $_POST['UserID'];
        $AssessmentDate = $_POST['AssessmentDate'];
        $AssessmentScore = $_POST['AssessmentScore'];
        $Strengths = $_POST['Strengths'];
        $Weaknesses = $_POST['Weaknesses'];
        $Recommendations = $_POST['Recommendations'];

        $stmt = $connection->prepare("INSERT INTO AssessmentResults (ResultID, UserID, AssessmentDate, AssessmentScore, Strengths, Weaknesses, Recommendations) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssss", $ResultID, $UserID, $AssessmentDate, $AssessmentScore, $Strengths, $Weaknesses, $Recommendations);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the AssessmentResults table
    $sql = "SELECT * FROM AssessmentResults";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["ResultID"] . "</td>
                <td>" . $row["UserID"] . "</td>
                <td>" . $row["AssessmentDate"] . "</td>
                <td>" . $row["AssessmentScore"] . "</td>
                <td>" . $row["Strengths"] . "</td>
                <td>" . $row["Weaknesses"] . "</td>
                <td>" . $row["Recommendations"] . "</td>
                <td><a style='padding:4px' href='delete_result.php?ResultID=" . $row["ResultID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_result.php?ResultID=" . $row["ResultID"] . "'>Update</a></td>
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
