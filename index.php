<?php
include('funcs.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eye of Africa Charity Organization</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <link rel="icon" href="favicon.ico">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#donate">Donate</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>
    </header> 
    <div class="head">
    <h3 id="head">Eye of Africa Charity Organization</h3>
    <p id="head">Empowering the vulnerable, enriching lives.</p>
</div>
    <main>
        <section id="home">
            <p>Proverbs 19:17 <br>
            Whoever is kind to the poor lends to the Lord, and he will reward them for what they have done.</p>
            <img src="images.jpeg" alt="Hero Image">
        
            <br><br>
        
            <button><a href="#donate">Donate Now</a></button>

        <section id="about">
            <div class="kk"style> 
            <h2>About Us</h2>
            <p style="color: brown;">We support the needy and disabled through compassionate care and sustainable solutions.</p>
            <div class="carousel">
            <img src="image 2.jpeg" alt="About Image">
            <img src="imag1.jpeg" alt="">
            <img src="images wh.jpeg" alt="">i
        </div>
        </div>
            <h3>Our Mission</h3>
            <p>To provide essential resources and services to those in need.</p>
            <h3>Our Team</h3>
            <ul>
                <li>Richard Ogwal, Founder</li>
                <li>Jane Smith, Director</li>
                <li>Bob Johnson, Program Manager</li>
            </ul>
        </section>

        <section id="donate">
            <h2>Donate Now</h2>
            <p>Every gift counts. Make a secure online donation.</p>
            <form action="" method="post">
                <input type="hidden" name="cmd" value="_donations">
                <input type="hidden" name="business" value="eyeofafricacharity.org@gmail.com">
                <input type="hidden" name="item_name" value="Donation to Eye of Africa Charity">
                <input type="hidden" name="currency_code" value="USD">
                <input type="email" value = "<?php if(post_exisits('email')) {echo $_POST['email'] ;} ?>"name="email"  id="">
                <input type="number"  value = "<?php if(post_exisits('amount')) {echo $_POST['amount'] ;} ?>"name="amount" placeholder="Enter amount">
                <input type="submit" value="Donate" name="donate_butt">
            </form>
            <?php donate();  ?>
            <p>Or donate via bank transfer:</p>
<p>Kindly use our count:<br><br> 1029102915875-richard Ogwal</p>
 <!-- WhatsApp Button Integration -->
 
        <section id="contact">
            <h2>Contact Us</h2>
            <p>Get in touch with us.</p>
          
            <form action="https://formspree.io/f/xwpegnlg" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                
                <input type="submit" value="Send">
            </form>
            
           
<h3>WhatsApp us Now for Inquiries</h3>
<div class="wha">
            <a href="https://wa.me/0782174975?text=Hello!%20I%20would%20like%20to%20know%20more%20about%20Eye%20of%20Africa%20Charity." target="_blank" id="whatsapp-button">
            <img src="images/wha.png" alt="WhatsApp" style="width:50px; height:50px;">
           
           </a>
        </div>
            <p>Phone: +256787860378<br>Email us now: <button><a href="mailto:info@">eyeofafricacharity.org@gmail.com</a></button><b></b><br>Address: 123 Main St, Kampala, Uganda</p>
        </section>
    </main>
<!-- Back to Top Button -->
<button id="backToTopBtn">⬆ Back to Top</button>

    <footer>
        <p>&copy;2024 Eye of Africa Charity Organization. All rights reserved.</p>
        <ul>
            <li><a href="https://www.facebook.com/eyeofafricacharity" target="_blank">Facebook</a></li>
            <li><a href="https://www.twitter.com/eyeofafricacharity" target="_blank">Twitter</a></li>
            <li><a href="https://www.instagram.com/eyeofafricacharity" target="_blank">Instagram</a></li>
        </ul>
        
    </footer>

   
     <script defer src="script.js"></script> 
</body>

</html>
