<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update Form</title>
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
<h1>Users </h1>
<form id="updateForm" method="post">
    <label for="UserID">User ID:</label>
    <input type="number" id="UserID" name="UserID" required><br><br>

    <label for="Username">Username:</label>
    <input type="text" id="Username" name="Username" required><br><br>

    <label for="Email">Email:</label>
    <input type="email" id="Email" name="Email" required><br><br>

    <label for="Password">Password:</label>
    <input type="password" id="Password" name="Password" required><br><br>

    <label for="UserType">User Type:</label>
    <input type="text" id="UserType" name="UserType" required><br><br>

    <input type="submit" name="Insert" value="Insert" onclick="return confirmInsert()"><br><br>
    <a class="button" href='home.php'>Back to home</a>
</form><br><br>
<table border="1">
    <tr>
        <th>UserID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Password</th>
        <th>UserType</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php
    // Connection details
    include 'database.php';

    // Check if the form is submitted for Insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Insert'])) {
        // Insert section
        $UserID = $_POST['UserID'];
        $Username = $_POST['Username'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $UserType = $_POST['UserType'];

        $stmt = $connection->prepare("INSERT INTO Users (UserID, Username, Email, Password, UserType) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $UserID, $Username, $Email, $Password, $UserType);

        if ($stmt->execute()) {
            echo "Record Inserted successfully.<br><br>
                 <a href='home.php'>Back to Form</a>";
        } else {
            echo "Error Inserting record: " . $stmt->error;
        }

        $stmt->close();
    }

    // Fetching data from the Users table
    $sql = "SELECT * FROM Users";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["UserID"] . "</td>
                <td>" . $row["Username"] . "</td>
                <td>" . $row["Email"] . "</td>
                <td>" . $row["Password"] . "</td>
                <td>" . $row["UserType"] . "</td>
                <td><a style='padding:4px' href='delete_user.php?UserID=" . $row["UserID"] . "'>Delete</a></td>
                <td><a style='padding:4px' href='update_user.php?UserID=" . $row["UserID"] . "'>Update</a></td>
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
