<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form submission
    // Example code to send email or save to database can be added here
    // For demonstration purpose, let's display a confirmation message
    echo "<p>Thank you for your message! We will get back to you soon.</p>";
    echo "<a href='contact.php' class='button'>Back to Contact Page</a>";
}
?>