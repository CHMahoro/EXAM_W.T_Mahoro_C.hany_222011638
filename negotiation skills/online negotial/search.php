<?php
if (isset($_GET['query'])) {
    include 'database.php'; // Include your database connection file

    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Query for Users Table
    $sql_users = "SELECT * FROM Users WHERE UserID LIKE '%$searchTerm%' OR Username LIKE '%$searchTerm%' OR Email LIKE '%$searchTerm%' OR UserType LIKE '%$searchTerm%'";
    $result_users = $connection->query($sql_users);

    // Query for Instructors Table
    $sql_instructors = "SELECT * FROM Instructors WHERE InstructorID LIKE '%$searchTerm%' OR UserID LIKE '%$searchTerm%' OR ExpertiseArea LIKE '%$searchTerm%' OR Bio LIKE '%$searchTerm%'";
    $result_instructors = $connection->query($sql_instructors);

    // Query for Workshops Table
    $sql_workshops = "SELECT * FROM Workshops WHERE WorkshopID LIKE '%$searchTerm%' OR WorkshopTitle LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%' OR InstructorID LIKE '%$searchTerm%' OR Date LIKE '%$searchTerm%' OR Duration LIKE '%$searchTerm%'";
    $result_workshops = $connection->query($sql_workshops);

    // Query for Attendees Table
    $sql_attendees = "SELECT * FROM Attendees WHERE AttendeeID LIKE '%$searchTerm%' OR UserID LIKE '%$searchTerm%' OR WorkshopID LIKE '%$searchTerm%' OR AttendanceStatus LIKE '%$searchTerm%'";
    $result_attendees = $connection->query($sql_attendees);

    // Query for NegotiationResources Table
    $sql_resources = "SELECT * FROM NegotiationResources WHERE ResourceID LIKE '%$searchTerm%' OR ResourceTitle LIKE '%$searchTerm%' OR ResourceType LIKE '%$searchTerm%' OR Description LIKE '%$searchTerm%' OR Link LIKE '%$searchTerm%'";
    $result_resources = $connection->query($sql_resources);

    // Query for AssessmentResults Table
    $sql_assessments = "SELECT * FROM AssessmentResults WHERE ResultID LIKE '%$searchTerm%' OR UserID LIKE '%$searchTerm%' OR AssessmentDate LIKE '%$searchTerm%' OR AssessmentScore LIKE '%$searchTerm%' OR Strengths LIKE '%$searchTerm%' OR Weaknesses LIKE '%$searchTerm%' OR Recommendations LIKE '%$searchTerm%'";
    $result_assessments = $connection->query($sql_assessments);

    // Query for ProgressTracking Table
    $sql_progress = "SELECT * FROM ProgressTracking WHERE ProgressID LIKE '%$searchTerm%' OR UserID LIKE '%$searchTerm%' OR WorkshopID LIKE '%$searchTerm%' OR ModuleCompleted LIKE '%$searchTerm%' OR QuizScores LIKE '%$searchTerm%' OR TimeSpent LIKE '%$searchTerm%' OR Comments LIKE '%$searchTerm%'";
    $result_progress = $connection->query($sql_progress);

    // Query for CommunityEngagement Table
    $sql_community = "SELECT * FROM CommunityEngagement WHERE EngagementID LIKE '%$searchTerm%' OR UserID LIKE '%$searchTerm%' OR Topic LIKE '%$searchTerm%' OR Thread LIKE '%$searchTerm%' OR Comments LIKE '%$searchTerm%' OR Likes LIKE '%$searchTerm%' OR Replies LIKE '%$searchTerm%' OR Timestamp LIKE '%$searchTerm%'";
    $result_community = $connection->query($sql_community);

    // Query for FeedbackEvaluation Table
    $sql_feedback = "SELECT * FROM FeedbackEvaluation WHERE FeedbackID LIKE '%$searchTerm%' OR UserID LIKE '%$searchTerm%' OR WorkshopID LIKE '%$searchTerm%' OR Rating LIKE '%$searchTerm%' OR Comments LIKE '%$searchTerm%' OR Suggestions LIKE '%$searchTerm%' OR Timestamp LIKE '%$searchTerm%'";
    $result_feedback = $connection->query($sql_feedback);

    // Query for CertificationAchievements Table
    $sql_certifications = "SELECT * FROM CertificationAchievements WHERE CertificationID LIKE '%$searchTerm%' OR UserID LIKE '%$searchTerm%' OR CertificationName LIKE '%$searchTerm%' OR DateAchieved LIKE '%$searchTerm%'";
    $result_certifications = $connection->query($sql_certifications);

    echo "<h2><u>Search Results:</u></h2>";

    // Displaying results for each table
    // You can customize the output as needed
    echo "<h3>Users Table:</h3>";
    // Example output for Users Table
    if ($result_users->num_rows > 0) {
        while ($row = $result_users->fetch_assoc()) {
            echo "<p>User ID: " . $row['UserID'] . ", Username: " . $row['Username'] . ", Email: " . $row['Email'] . ", UserType: " . $row['UserType'] . "</p>";
        }
    } else {
        echo "<p>No users found matching the search term: " . $searchTerm . "</p>";
    }

    // Repeat the above pattern for each table

    // Close the database connection
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
