<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="styles.css">
</head>
<style>
  body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f8f8f8;
}

.welcome-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

h1 {
  font-size: 3rem;
  color: #333;
  margin-bottom: 20px;
}

p {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 30px;
  text-align: center;
}

.buttons {
  display: flex;
}

.login-btn, .register-btn {
  padding: 15px 30px;
  font-size: 1.2rem;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.login-btn {
  background-color: #ffbb33;
  color: white;
  margin-right: 20px;
}

.register-btn {
  background-color: #00cc66;
  color: white;
}

.login-btn:hover, .register-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.login-btn:active, .register-btn:active {
  transform: translateY(1px);
  box-shadow: none;
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
<body>
  <div id="image-slider"></div> <!-- Added closing tag for the image-slider div -->
  <div class="welcome-container">
    <h1>Welcome!</h1>
    <p>Please log in or register to access the Online Negotiation Skills Workshop platform.</p>
    <div class="buttons">
      <a href="./login.php"><button class="login-btn">Login</button></a> <!-- Added href attribute -->
      <a href="./register.php"><button class="register-btn">Register</button></a> <!-- Added href attribute -->
    </div>
  </div>
</body>
</html>
