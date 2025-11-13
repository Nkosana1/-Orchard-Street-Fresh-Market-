<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>Contact Us - Orchard Street Fresh Market | 45 Orchard St, NYC Lower East Side</title>
    <meta name="description" content="Visit Orchard Street Fresh Market at 45 Orchard St, New York, NY 10002. Contact us for questions, special orders, or just to say hello. Open daily in NYC's Lower East Side.">
    <meta name="keywords" content="Orchard Street Fresh Market contact, produce market Lower East Side, fresh market NYC address, contact produce store New York, 45 Orchard Street NYC">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="https://orchardstreetfreshmarket.com/contact.php">
    
    <!-- Open Graph Meta Tags for Social Sharing -->
    <meta property="og:title" content="Contact Us - Orchard Street Fresh Market | NYC Lower East Side">
    <meta property="og:description" content="Visit Orchard Street Fresh Market at 45 Orchard St, New York, NY 10002. Contact us for questions, special orders, or just to say hello. Open daily in NYC's Lower East Side.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200&auto=format&fit=crop">
    <meta property="og:url" content="https://orchardstreetfreshmarket.com/contact.php">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Orchard Street Fresh Market">
    
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

