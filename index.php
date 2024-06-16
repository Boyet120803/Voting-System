<?php 

session_start();
if(isset($_SESSION['ID']) && isset($_SESSION['email'])){
    header('location: dashboard.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
   
    <link rel="stylesheet" href="homepage.css">
</head>
<body>
    <header>
        <div class="logo">Voting Website</div>
        <nav>
            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact Us</a>
            <a href="login-form.php">Login</a>  
            <a href="signup-form.php">Sign Up</a>        
        </nav>
    </header>
    <div id="home" class="hero">
        <h1>Welcome to Voting Website</h1>
        <p>Your Trusted Voting Platform</p>
        <div class="cta-buttons">
          
          
        </div>
    </div>

    <div  class="section features">
        <div class="feature">
            <h2>Secure Voting</h2>
            <p>Ensuring the safety and privacy of your vote.</p>
        </div>
        <div class="feature">
            <h2>Real-Time Results</h2>
            <p>Get instant updates on voting outcomes.</p>
        </div>
        <div class="feature">
            <h2>User-Friendly Interface</h2>
            <p>Easy and intuitive voting process.</p>
        </div>
        <div class="feature">
            <h2>Anonymous Voting</h2>
            <p>Your identity is protected.</p>
        </div>
    </div>
<div class="lahi">
    <div id="about" class="section1">
        <hr>
        <h2>About Us</h2>
        <p>At Voting Website, our mission is to deliver a secure, transparent, and user-friendly voting platform that empowers individuals and organizations to participate in the democratic process. We leverage cutting-edge technology to ensure the integrity and accessibility of every vote.</p>
        
        <p><strong>Our Vision:</strong> To revolutionize voting by making it more inclusive, efficient, and trustworthy.</p>
        
        <p><strong>Our Mission:</strong> To provide a seamless voting experience through:</p>
        
            <li>Accessible and intuitive solutions</li>
            <li>Robust security measures</li>
            <li>Real-time result transparency</li>
            <li>Continuous platform improvements</li>
     
        
        <p><strong>Our Values:</strong> Integrity, Innovation, Inclusivity, Security, and Transparency guide all our efforts.</p>
        
        <p>Our team comprises experienced professionals dedicated to enhancing the democratic process. Contact us to learn more about how we can support your voting needs.</p>
    </div>

    <div id="contact" class="section2">
        <hr>
    <h2>Contact Us</h2>
    <p>Thank you for your interest in our voting platform. If you have any questions, feedback, or concerns, please feel free to get in touch with us. We are here to assist you!</p>
    <div class="contact-details">
        <h3>Contact Information</h3>
    
            <li>Email: info@votingwebsite.com</li>
            <li>Phone: 0937272837</li>
            <li>Address:Hilongos Leyte</li>
        
    </div>
    <div class="contact-form">
        <h3>Send us a Message</h3>
        <form action="#" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br>
            <button type="submit">Send</button>
        </form>
 </div>
</div>
</div>

    <div class="footer">
        <p>&copy; 2024 Voting Website. All rights reserved.</p>
    </div>

    <script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
</body>
</html>