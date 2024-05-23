<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negotiation Resource Update Form</title>
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
<h1>Negotiation Resource </h1>
<form id="updateForm" method="post">
    <label for="ResourceID">Resource ID:</label>
    <input type="number" id="ResourceID" name="ResourceID" required><br><br>

    <label for="ResourceTitle">Resource Title:</label>
    <input type="text" id="ResourceTitle" name="ResourceTitle" required><br><br>

    <label for="ResourceType">Resource Type:</label>
    <input type="text" id="ResourceType" name="ResourceType" required><br><br>

    <label for="Description">Description:</label>
    <textarea id="Description" name="Description" rows="4" cols="50" required></textarea><br><br>

    <label for="Link">Link:</label>
    <input type="text" id="Link" name="Link" required><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>ResourceID</th>
        <th>ResourceTitle</th>
        <th>ResourceType</th>
        <th>Description</th>
        <th>Link</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php
    // Connection details
    include 'database.php';

    // Check if the form is submitted for Insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Insert'])) {
        // Insert section
        $ResourceID = $_POST['ResourceID'];
        $ResourceTitle = $_POST['ResourceTitle'];
        $ResourceType = $_POST['ResourceType'];
        $Description = $_POST['Description'];
        $Link = $_POST['Link'];

        $stmt = $connection->prepare("INSERT INTO NegotiationResources (ResourceID, ResourceTitle, ResourceType, Description, Link) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $ResourceID, $ResourceTitle, $ResourceType, $Description, $Link);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the NegotiationResources table
    $sql = "SELECT * FROM NegotiationResources";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["ResourceID"] . "</td>
                <td>" . $row["ResourceTitle"] . "</td>
                <td>" . $row["ResourceType"] . "</td>
                <td>" . $row["Description"] . "</td>
                <td>" . $row["Link"] . "</td>
                <td><a style='padding:4px' href='delete_resource.php?ResourceID=" . $row["ResourceID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_resource.php?ResourceID=" . $row["ResourceID"] . "'>Update</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
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
