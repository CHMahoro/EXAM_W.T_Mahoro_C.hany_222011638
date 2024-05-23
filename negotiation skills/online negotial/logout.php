<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            margin-bottom: 20px;
        }
        button {
            background-color: #ff5733;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #ff6f52;
        }
       #image-slider {
      height: 100vh; /* Adjust height as needed */
      width: 100%; /* Ensure the slider covers the entire viewport */
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1; /* Ensure the slider stays behind other content */
      animation: slideImages 30s infinite;
    }

    @keyframes slideImages {
      0%, 100% {
        background-image: 
          url('workshop 111.jpg');
      }
      33.333% {
        background-image: 
          url('workshop 211.jpg');
      }
      66.666% {
        background-image: 
          url('workshop 51.jpg');
      }
    }

    </style>
</head>
<div id="image-slider"></div>
<body>
    <div class="container">
        <h2>Logout</h2>
        <?php
        // Start the session
        session_start();
        
        // Check if the user is logged in
        if(isset($_SESSION['UserID'])) {
            // If logged in, destroy the session
            session_destroy();
            echo "<p>You have been successfully logged out.</p>";
        } else {
            // If not logged in, display a message
            echo "<p>You are already logged out.</p>";
        }
        ?>
        <script>
            function confirmLogout() {
                var confirmation = confirm("Are you sure you want to logout?");
                if (confirmation) {
                    window.location.href = "index.php"; // Redirect to logout page
                }
            }
        </script>
        <p><button onclick="confirmLogout()">Logout</button></p>
    </div>
</body>
</html>
