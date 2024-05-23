<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Online Negotiation Skills Workshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
            /* Global Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 30px;
      background-image: linear-gradient(299deg, #3e3e3e, #0e1118);
    }

    .header .logo h1 {
      color: white;
    }

    .header .navigation-menu a {
      text-decoration: none;
      font-size: 16px;
      color: white;
      margin-right: 30px;
    }

    .header .navigation-menu a.home-btn {
      border-bottom: 2px solid white;
    }

    .header .btn button {
      padding: 10px 30px;
      border-radius: 30px;
      border: none;
      cursor: pointer;
      background-color: greenyellow;
    }

    .header .btn .login {
      background-color: white;
      color: black;
    }

    /* Hero Section */
    .hero-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 30px;
      background-color: white;
    }

    .hero-section .cta-button a {
      padding: 10px 30px;
      border-radius: 30px;
      border: none;
      cursor: pointer;
      background-color: greenyellow;
      text-decoration: none;
      color: black;
    }

    /* Featured Workshops */
    .featured-workshops {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px 30px;
    }

    .featured-workshops .workshop {
      max-width: 300px;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
    }

    .featured-workshops .workshop h2 {
      margin-bottom: 10px;
    }

    /* About Section */
    .about-section {
      padding: 20px 30px;
    }

    /* Workshops Section */
    .workshops-section {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px 30px;
    }

    .workshops-section .workshop {
      max-width: 300px;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
    }

    .workshops-section .workshop h3 {
      margin-bottom: 10px;
    }

    /* Testimonials Section */
    .testimonials-section {
      padding: 20px 30px;
    }

    /* Contact Section */
    .contact-section {
      padding: 20px 30px;
    }

    /* Footer */
    .footer {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: black;
      color: white;
      padding: 20px 30px;
    }

    .footer .footer-links a {
      text-decoration: none;
      color: white;
      margin-right: 20px;
    }

   
    .footer .copy {
      margin-top: 20px;
    }

    /* Animation */
    @keyframes slideImages {
      0%, 100% {
          background-image: url('workshop 111.jpg');
      }
      33.33% {
          background-image: url('workshop 211.jpg');
      }
      66.66% {
          background-image: url('workshop 51.jpg');
      }
    }

    /* Animation */
    @keyframes move {
      0% { transform: translateY(-50%); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    .moving-text {
      animation: move 10s infinite alternate;
    }
.dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: green;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: skyblue;
  }
  
    /* Explore Button */
    .explore-button {
      padding: 10px 20px;
      border-radius: 30px;
      border: none;
      cursor: pointer;
      background-color: greenyellow;
      color: black;
      font-size: 16px;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }

    .explore-button:hover {
      background-color: yellowgreen;
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
.logo {
    font-size: 24px;
    font-weight: bold;
    color: red; /* Customize color to red */
}

/* Style the logo as an iconic logo */
.logo::before {
    content: "\f0a4"; /* Unicode value of the desired Font Awesome icon */
    font-family: "Font Awesome 5 Free"; /* Specify the Font Awesome font family */
    margin-right: 10px; /* Adjust spacing between the icon and text */
    color: inherit; /* Inherit color from the parent .logo class */
}

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
        }

        header {
            background-color: #ff6600;
            color: white;
            padding: 1em;
            display: flex;
            align-items: center;
        }

        h1 {
            margin: 0;
            flex-grow: 1;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle {
            font-size: 1.5em;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        .site-icon {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .side-menu {
            width: 250px;
            background-color: #333;
            color: white;
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 60px;
        }

        .side-menu ul {
            list-style-type: none;
            padding: 0;
        }

        .side-menu ul li {
            padding: 10px;
            text-align: left;
        }

        .side-menu ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .side-menu ul li a .icon {
            margin-right: 10px;
        }

        .side-menu-close {
            text-align: center;
            margin-top: 20px;
        }

        main {
            margin-left: 20px;
            padding: 20px;
            color: white;
            text-shadow: 2px 2px 4px #000000;
        }

        main section {
            margin-bottom: 20px;
        }

        .show-menu {
            left: 0;
        }
    </style>
</head>
<body>
    <div id="image-slider"></div>
    <header>
        <button id="menuToggle" class="menu-toggle">&#9776;</button>
        <h1>
            <svg class="site-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="white">
                <circle cx="32" cy="32" r="32" fill="#ff6600"/>
                <text x="32" y="37" text-anchor="middle" font-size="24" font-family="Arial" fill="white">HO</text>
            </svg>
            <nav class="header">
  <div class="logo" id="logo">
            <i class="fas fa-balance-scale"></i> Online Negotiation Skills Workshop Platform
        </div>
    </nav>
        </h1>
    </header>
    <nav id="sideMenu" class="side-menu">
        
         <div class="side-menu-close">
            <button id="closeMenu">Close Menu</button>
        </div>
        <ul>
            <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="workshop.php"><i class="fas fa-tools"></i> Workshops</a></li>
    <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
    <div class="dropdown">
      <li><a href="#" style="padding: 10px; color: white; background-color:GREEN; text-decoration: none; margin-right: 15px;">Settings</a></li>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
       
    </nav>
    <form method="GET" class="d-flex" role="search" action="search.php" style="padding: 20px 30px;">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>

<a href="explore.php"> <button class="explore-button">Explore tables</button></a>
<section class="workshops-section">
  <h2 class="moving-text">Online Negotiation Skills Workshop</h2>
  <p class="moving-text">Master the art of negotiation and unlock your potential for success with our Online Negotiation Skills Workshop. Whether you're a seasoned professional aiming to sharpen your negotiation prowess or a newcomer eager to learn the ropes, this workshop offers invaluable insights and practical strategies to thrive in diverse negotiation scenarios.</p>
  
  <div class="workshop">
    <img src="negotiation 11.jpg" alt="Negotiation Skills Workshop">
    <h3>Negotiation Mastery: From Theory to Practice</h3>
    <p>Join us for an immersive journey into the fundamentals of negotiation. Led by seasoned negotiators with extensive real-world experience, this workshop covers essential negotiation concepts, including strategy development, effective communication, and conflict resolution techniques.</p>
    <p>Duration: 2 days</p>
    <p>Price: $199.99</p>
    <a href="workshop.php" class="cta">Learn More</a>
  </div>
  
  <div class="workshop">
    <img src="good image11.jpg" alt="Negotiation Workshop Participants">
    <h3>Advanced Negotiation Techniques: Navigating Complex Deals</h3>
    <p>Dive deeper into the intricacies of negotiation with our Advanced Negotiation Techniques workshop. Explore nuanced negotiation scenarios, such as multi-party negotiations, cross-cultural dynamics, and high-stakes deal-making, and equip yourself with the tools to navigate them with confidence.</p>
    <p>Duration: 3 days</p>
    <p>Price: $299.99</p>
    <a href="workshop.php" class="cta">Learn More</a>
  </div>
  
  <div class="workshop">
    <img src="good image21.jpg" alt="Negotiation Workshop Facilitator">
    <h3>Negotiation Leadership: Influence and Persuasion Strategies</h3>
    <p>Unlock the secrets of negotiation leadership and elevate your influence with our Negotiation Leadership workshop. Discover powerful persuasion techniques, ethical negotiation practices, and leadership principles that empower you to lead negotiations with authority and integrity.</p>
    <p>Duration: 2 days</p>
    <p>Price: $249.99</p>
    <a href="workshop.php" class="cta">Learn More</a>
  </div>
</section>


<section class="about-section">
  <h2 class="moving-text">About Us</h2>
  <p class="moving-text">Our platform is dedicated to empowering individuals and organizations through comprehensive negotiation education and training. We believe in the transformative power of effective negotiation skills to drive success and foster mutually beneficial relationships in both personal and professional realms.</p>
  <p class="moving-text">Our mission is to provide accessible, high-quality negotiation workshops and resources that equip our participants with the knowledge, strategies, and confidence to excel in negotiations of all kinds. We strive to create a supportive learning environment that fosters growth, collaboration, and innovation.</p>
  <p class="moving-text">At our core, we envision a world where every individual has the skills and mindset to negotiate effectively, advocate for their interests, and achieve their goals with integrity and empathy. We aspire to be a catalyst for positive change, empowering individuals and organizations to navigate complex negotiations with skill, grace, and ethical leadership.</p>
</section>



<section class="testimonials-section">
  <h2>Testimonials</h2>
  <div class="testimonial">
    <p>"The negotiation skills workshop provided me with invaluable insights into effective communication strategies and conflict resolution techniques. I highly recommend it to anyone looking to enhance their negotiation abilities."</p>
    <p>- John Doe</p>
  </div>
  <div class="testimonial">
    <p>"Attending the advanced negotiation techniques workshop was a game-changer for me. The instructors were knowledgeable, and the interactive sessions helped me gain confidence in handling complex negotiation scenarios."</p>
    <p>- Jane Smith</p>
  </div>
  <!-- Add more testimonials if needed -->
</section>

<footer class="footer">
  <!-- Links to Privacy Policy, Terms of Service, Social Media Icons -->
  <div class="footer-links">
    <a href="/privacy-policy">Privacy Policy</a>
    <a href="/terms-of-service">Terms of Service</a>
  </div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="social-media-icons">
    <a href="https://instagram.com/Online Negotiation Skills Workshop Platform"><i class="fab fa-instagram" aria-hidden="true"></i></a>
    <a href="https://youtube.com/channel/UCRP4Jpze0hKUy5kVNCr5RMw"><i class="fab fa-youtube" aria-hidden="true"></i></a>
    <a href="https://apple.comOnline Negotiation Skills Workshop Platform"><i class="fab fa-apple" aria-hidden="true"></i></a>
    <a href="https://tiktok.com/Online Negotiation Skills Workshop Platform"><i class="fab fa-tiktok" aria-hidden="true"></i></a>
    <a href="https://www.snapchat.com/add/Online Negotiation Skills Workshop Platform"><i class="fab fa-snapchat" aria-hidden="true"></i></a>
     <a href="https://www.whatsapp.com/Online Negotiation Skills Workshop Platform"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
    <!-- Add more social media icons if needed -->
</div>

</footer>

    <script>
        document.getElementById('menuToggle').addEventListener('click', function() {
            const sideMenu = document.getElementById('sideMenu');
            sideMenu.classList.toggle('show-menu');
        });

        document.getElementById('closeMenu').addEventListener('click', function() {
            const sideMenu = document.getElementById('sideMenu');
            sideMenu.classList.remove('show-menu');
        });

        // Background image slider
        const images = [
            'url(negotiation 11.jpg)',
            'url(good image11.jpg)',
            'url(good image21.jpg)'
        ]
        let currentImageIndex = 0;
        const body = document.body;

        function changeBackgroundImage() {
            body.style.backgroundImage = images[currentImageIndex];
            currentImageIndex = (currentImageIndex + 1) % images.length;
        }

        setInterval(changeBackgroundImage, 5000); // Change image every 5 seconds

        // Cancel background image slider
        let sliderActive = true;
        body.addEventListener('click', function() {
            if (sliderActive) {
                clearInterval(backgroundSlider);
                sliderActive = false;
            }
        });

        const backgroundSlider = setInterval(changeBackgroundImage, 5000); // Change image every 5 seconds
    </script>
</body>
</html>
