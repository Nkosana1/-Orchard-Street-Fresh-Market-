<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find us at Orchard Street Fresh Market - Visit our store in NYC's Lower East Side or get in touch">
    <title>Find Us - Orchard Street Fresh Market</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Orchard St. Market</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">Our Story</a></li>
                <li><a href="vegetables.html">Fresh Vegetables</a></li>
                <li><a href="fruits.html">Seasonal Fruits</a></li>
                <li><a href="contact.php">Find Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Find Us</h2>
            <article>
                <p>Visit us at our location in the heart of NYC's Lower East Side. We're here to serve you with the freshest produce and friendly service.</p>
            </article>
            
            <section class="contact-section">
                <h2>Get in Touch</h2>
                <p>Have a question, special request, or just want to say hello? Fill out the form below and we'll get back to you as soon as possible!</p>
                
                <?php if (isset($_GET['status'])): ?>
                    <div class="alert <?php echo $_GET['status'] === 'success' ? 'alert-success' : 'alert-error'; ?>">
                        <?php 
                        if ($_GET['status'] === 'success') {
                            echo 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.';
                        } else {
                            echo 'Sorry, there was an error sending your message. Please try again or call us directly.';
                        }
                        ?>
                    </div>
                <?php endif; ?>
                
                <form action="send_telegram.php" method="POST" class="contact-form">
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" required placeholder="Your full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required placeholder="your.email@example.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="(212) 555-0123">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message <span class="required">*</span></label>
                        <textarea id="message" name="message" rows="6" required placeholder="Tell us how we can help you..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-submit">Send Message</button>
                </form>
            </section>
        </section>
    </main>

    <footer>
        <address>
            <p>45 Orchard St, New York, NY 10002</p>
            <p>Phone: (212) 555-0123</p>
        </address>
        <div class="social-media">
            <a href="#" aria-label="Facebook"><span class="social-icon">Facebook</span></a>
            <a href="#" aria-label="Instagram"><span class="social-icon">Instagram</span></a>
            <a href="#" aria-label="Twitter"><span class="social-icon">Twitter</span></a>
        </div>
        <p>&copy; 2025 Orchard Street Fresh Market. All rights reserved.</p>
    </footer>
</body>
</html>

