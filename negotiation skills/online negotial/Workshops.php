<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop Update Form</title>
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
<h1>Workshops </h1>
<form id="updateForm" method="post">
    <label for="WorkshopID">Workshop ID:</label>
    <input type="number" id="WorkshopID" name="WorkshopID" required><br><br>

    <label for="WorkshopTitle">Workshop Title:</label>
    <input type="text" id="WorkshopTitle" name="WorkshopTitle" required><br><br>

    <label for="Description">Description:</label>
    <textarea id="Description" name="Description" rows="4" cols="50" required></textarea><br><br>

    <label for="InstructorID">Instructor ID:</label>
    <input type="number" id="InstructorID" name="InstructorID" required><br><br>

    <label for="Date">Date:</label>
    <input type="date" id="Date" name="Date" required><br><br>

    <label for="Duration">Duration:</label>
    <input type="number" id="Duration" name="Duration" required><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>WorkshopID</th>
        <th>WorkshopTitle</th>
        <th>Description</th>
        <th>InstructorID</th>
        <th>Date</th>
        <th>Duration</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php
    // Connection details
    include 'database.php';

    // Check if the form is submitted for Insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Insert'])) {
        // Insert section
        $WorkshopID = $_POST['WorkshopID'];
        $WorkshopTitle = $_POST['WorkshopTitle'];
        $Description = $_POST['Description'];
        $InstructorID = $_POST['InstructorID'];
        $Date = $_POST['Date'];
        $Duration = $_POST['Duration'];

        $stmt = $connection->prepare("INSERT INTO Workshops (WorkshopID, WorkshopTitle, Description, InstructorID, Date, Duration) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssi", $WorkshopID, $WorkshopTitle, $Description, $InstructorID, $Date, $Duration);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the Workshops table
    $sql = "SELECT * FROM Workshops";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["WorkshopID"] . "</td>
                <td>" . $row["WorkshopTitle"] . "</td>
                <td>" . $row["Description"] . "</td>
                <td>" . $row["InstructorID"] . "</td>
                <td>" . $row["Date"] . "</td>
                <td>" . $row["Duration"] . "</td>
                <td><a style='padding:4px' href='delete_workshop.php?WorkshopID=" . $row["WorkshopID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_workshop.php?WorkshopID=" . $row["WorkshopID"] . "'>Update</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No data found</td></tr>";
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
