<?php
error_reporting(E_ALL); // Enable for debugging
ini_set('display_errors', 1); // Enable for debugging

require_once 'config.php'; // Ensure this correctly connects to $pdo

$message_saved = false; // Changed variable name to reflect database saving, not email sending
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Honeypot check for spam prevention
    if (!empty($_POST['website'])) {
        exit; // Silently exit for spam bots
    }

    // Sanitize and validate inputs
    // For modern PHP, trimming and then using prepared statements (as done below) is the recommended secure approach.
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST['subject']);
    $message_content = trim($_POST['message']); // Renamed to avoid conflict with former PHPMailer's $message

    // Basic server-side validation
    if (empty($name) || empty($email) || empty($subject) || empty($message_content)) {
        $error_message = "All fields are required. Please fill them out.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format. Please enter a valid email address.";
    } else {
        // All inputs are good, now attempt to save to the database
        try {
            // Ensure $pdo is available from config.php
            if (!isset($pdo)) {
                // If $pdo isn't established, throw an exception
                throw new Exception("Database connection not established. Please check config.php.");
            }

            // Prepare the SQL INSERT statement using named placeholders for security
            $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (:name, :email, :subject, :message_content)");

            // Bind the sanitized values to the placeholders
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message_content', $message_content); // Use message_content

            // Execute the prepared statement
            $stmt->execute();

            // Database insertion was successful
            $message_saved = true;

            // Clear form fields after successful submission for a clean form
            $_POST = array();

        } catch (PDOException $e) {
            // Catch specific database errors (e.g., connection issues, table problems)
            error_log("Failed to save contact message to database: " . $e->getMessage());
            $error_message = "There was an issue saving your message. Please try again later.";
        } catch (Exception $e) {
            // Catch any other unexpected errors
            error_log("An unexpected error occurred: " . $e->getMessage());
            $error_message = "An unexpected error occurred. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitrise Solutions - Contact Us</title>
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        /* Re-use styles from your index.php or link to an external CSS file */
        .top-info-bar {
            background-color: #1A2E40;
            color: #E0E7EB;
            font-size: 0.85rem;
            padding: 8px 0;
        }
        .top-info-bar .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .top-info-bar .info-item i {
            margin-right: 8px;
            color: #E74C3C;
        }
        .navbar-custom {
            background-color: #FFFFFF;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #e0e0e0;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .navbar-custom .navbar-brand img {
            max-height: 130px;
            width: auto;
            border-radius: 8px;
            margin-right: 10px;
        }
        .navbar-custom .navbar-brand .text-dark-blue {
            color: #1A2E40;
            font-weight: bold;
        }
        .navbar-custom .nav-link {
            color: #1A2E40;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 8px 15px;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #E74C3C;
        }
        .btn-custom-quote {
            background-color: #E74C3C;
            border-color: #E74C3C;
            color: #FFFFFF;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-custom-quote:hover {
            background-color: #C0392B;
            border-color: #C0392B;
        }
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.75rem;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%231A2E40' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: white;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            padding: 10px;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .whatsapp-float:hover {
            background-color: #1DA851;
            transform: scale(1.05);
            cursor: pointer;
        }
        .whatsapp-float i {
            color: white;
        }

        /* Contact Section Specific Styles */
        .contact-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }
        .contact-section h2 {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }
        .contact-section h2 span {
            color: #E74C3C;
        }
        .contact-info-card {
            background-color: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .contact-info-card i {
            color: #E74C3C;
            font-size: 3em;
            margin-bottom: 20px;
        }
        .contact-info-card h4 {
            color: #1A2E40;
            font-size: 1.5em;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .contact-info-card p,
        .contact-info-card a {
            color: #555555;
            font-size: 1.1em;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .contact-info-card a:hover {
            color: #E74C3C;
        }

        .contact-form-card {
            background-color: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        .contact-form-card .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 12px 15px;
            margin-bottom: 20px;
        }
        .contact-form-card .form-control:focus {
            border-color: #E74C3C;
            box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
        }
        .contact-form-card textarea {
            min-height: 150px;
            resize: vertical;
        }
        .contact-form-card .btn-submit {
            background-color: #E74C3C;
            border-color: #E74C3C;
            color: #FFFFFF;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 25px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            width: 100%;
        }
        .contact-form-card .btn-submit:hover {
            background-color: #C0392B;
            border-color: #C0392B;
        }
        .google-map-section {
            padding: 50px 0;
            background-color: #fff;
        }
        .google-map-section iframe {
            width: 100%;
            height: 450px;
            border-radius: 15px;
            border: 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Footer Styles (Copied from your index.php) */
        .footer-section {
            background-color: #1A2E40;
            color: #E0E7EB;
            padding: 60px 0 20px;
            font-size: 0.95rem;
        }
        .footer-section h5 {
            color: #E74C3C;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer-section h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: #E74C3C;
        }
        .footer-section p, .footer-section li {
            color: #E0E7EB;
            line-height: 1.8;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        .footer-section ul li a {
            color: #E0E7EB;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-section ul li a:hover {
            color: #E74C3C;
        }
        .footer-section .social-icons a {
            color: #E0E7EB;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        .footer-section .social-icons a:hover {
            color: #E74C3C;
        }
        .footer-section .newsletter-form .form-control {
            border-radius: 25px;
            border: 1px solid #445D73;
            background-color: #2A4050;
            color: #E0E7EB;
            padding: 10px 20px;
        }
        .footer-section .newsletter-form .form-control::placeholder {
            color: #A0B2C0;
        }
        .footer-section .newsletter-form .btn-subscribe {
            background-color: #E74C3C;
            border-color: #E74C3C;
            color: #FFFFFF;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .footer-section .newsletter-form .btn-subscribe:hover {
            background-color: #C0392B;
            border-color: #C0392B;
        }
        .footer-bottom {
            border-top: 1px solid #334D63;
            padding-top: 20px;
            margin-top: 40px;
            text-align: center;
            font-size: 0.85rem;
            color: #A0B2C0;
        }

        a{
            color: white;
            text-decoration: none;
        }
        .email-info:hover{
        font-style:italic;
        color:green:
        }

        /* Media queries (Copied from your index.php) */
        @media (max-width: 767.98px) {
            .top-info-bar .info-item {
                justify-content: center;
            }
            /* ... other media queries from your index.php ... */
        }
        @media (min-width: 768px) {
            .top-info-bar .info-item {
                margin-bottom: 0;
            }
            /* ... other media queries from your index.php ... */
        }
        /* Alert styles */
        .alert-fixed-top {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050; /* Above navbar */
            width: auto;
            min-width: 300px;
            max-width: 90%;
            text-align: center;
            border-radius: .5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
        }


        /* Enhanced WhatsApp Floating Button with Dropdown */
    .whatsapp-container {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .whatsapp-float {
        background: linear-gradient(135deg, #25D366, #128C7E);
        color: white;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 6px 15px rgba(37, 211, 102, 0.3);
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative;
        overflow: hidden;
        z-index: 2;
    }

    .whatsapp-float::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: scale(0);
        transition: transform 0.3s ease;
    }

    .whatsapp-float:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
    }

    .whatsapp-float:hover::before {
        transform: scale(1);
    }

    .whatsapp-float:active {
        transform: scale(0.95);
    }

    .whatsapp-dropdown {
        position: absolute;
        bottom: 70px;
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        width: 220px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(15px);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
        z-index: 1;
    }

    .whatsapp-container:hover .whatsapp-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .whatsapp-option {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        color: #333;
        text-decoration: none;
        transition: all 0.2s ease;
        background: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .whatsapp-option i {
        margin-right: 12px;
        color: #25D366;
        font-size: 22px;
        transition: transform 0.2s ease;
    }

    .whatsapp-option .option-text {
        flex: 1;
        font-weight: 500;
        font-size: 15px;
    }

    .whatsapp-option .option-subtext {
        font-size: 12px;
        color: #777;
        margin-top: 2px;
    }

    .whatsapp-option:hover {
        background: #f8f8f8;
        color: #25D366;
    }

    .whatsapp-option:hover i {
        transform: scale(1.1);
    }

    .whatsapp-option:first-child {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .whatsapp-option:last-child {
        border-bottom: none;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    /* Pulse animation */
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
        70% { box-shadow: 0 0 0 12px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .whatsapp-dropdown {
            width: 200px;
            font-size: 14px;
        }
        
        .whatsapp-option {
            padding: 12px 15px;
        }
    }

        
    </style>
</head>
<body>

    <div class="top-info-bar d-none d-md-block">
        <div class="container-fluid container-xxl">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex justify-content-start">
                    <span class="info-item me-4"><i class="fas fa-phone-alt"></i><a href="tel:+254112054071">+254 11205 4071</a> </span>
                    <span class="info-item"><i class="fas fa-map-marker-alt"></i> Nakuru - Egerton; Nairobi, Imaara Daima</span>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <span class="info-item me-4"><i class="fas fa-envelope"></i> info@bitrisesolutions.co.ke</span>
                    <span class="info-item"><i class="fas fa-clock"></i> Mon-Fri: 09:00am - 05:00pm</span>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid container-xxl">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="https://bitrisesolutions.co.ke/img/logo-b.png" alt="Bitrise Solutions Logo" width="90vh" height="70vh" class="d-inline-block align-text-top me-2">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a> </li>
                    <li class="nav-item">
                        <a class="nav-link" href="portfolio.php">Our Experts</a> </li>
                          </li>
                       <li class="nav-item">
                        <a class="nav-link" href="pay/index.php">Pay/Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn btn-custom-quote">Get a Quote</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

   
<!-- Enhanced WhatsApp Float -->
<div class="whatsapp-container">
    <button class="whatsapp-float pulse-animation" aria-label="WhatsApp Chat">
        <i class="fab fa-whatsapp"></i>
    </button>
    <div class="whatsapp-dropdown">
        <a href="https://wa.me/+254112054071" target="_blank" class="whatsapp-option">
            <i class="fab fa-whatsapp"></i>
            <div>
                <div class="option-text">Support Team 1</div>
                <div class="option-subtext">Joel - Sales</div>
            </div>
        </a>
        <a href="https://wa.me/+254714500555" target="_blank" class="whatsapp-option">
            <i class="fab fa-whatsapp"></i>
            <div>
                <div class="option-text">Support Team 2</div>
                <div class="option-subtext">Josphat - Technical</div>
            </div>
        </a>
    </div>
</div>

    <?php if ($message_saved): ?>
        <div class="alert alert-success alert-fixed-top alert-dismissible fade show" role="alert">
            Thank you! Your message has been  successfully Received, we shall get in touch with soon.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (!empty($error_message)): ?>
        <div class="alert alert-danger alert-fixed-top alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($error_message); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <section class="contact-section">
        <div class="container container-xxl">
            <h2 class="animate-on-scroll" style="--delay: 0s;">Get in <span>Touch</span></h2>
            <p class="text-center mb-5 animate-on-scroll" style="--delay: 0.1s; color: #555;">We'd love to hear from you! Fill out the form below or use the contact details provided.</p>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll" style="--delay: 0.2s;">
                    <div class="contact-info-card">
                        <i class="fas fa-map-marker-alt"></i>
                        <h4>Our Location</h4>
                        <p>Nakuru - Egerton; Nairobi, Imaara Daima</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll" style="--delay: 0.3s;">
                    <div class="contact-info-card">
                        <i class="fas fa-envelope"></i>
                        <h4>Email Us</h4>
                        <div class="email-info">
                        <p><a href="mailto:info@bitrisesolutions.co.ke">info@bitrisesolutions.co.ke</a></p>
    </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll" style="--delay: 0.4s;">
                    <div class="contact-info-card">
                        <i class="fas fa-phone-alt"></i>
                        <h4>Call Us</h4>
                        <p><a href="tel:+254112054071">0748700546 | 0112054071</a></p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-8 col-md-10 animate-on-scroll" style="--delay: 0.5s;">
                    <div class="contact-form-card">
                        <h4 class="text-center mb-4" style="color: #1A2E40;">Send Us a Message</h4>
                        <form action="contact.php" method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your Message" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                            </div>
                            <div style="position: absolute; left: -9999px; opacity: 0;">
                                <input type="text" name="website" tabindex="-1" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="google-map-section animate-on-scroll" style="--delay: 0.6s;">
        <div class="container container-xxl">
            <h2 class="text-center mb-4" style="color: #1A2E40;">Find Us on the <span>Map</span></h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.176410499628!2d36.00288867499696!3d-0.3444453996711765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182bb19782a2e5d9%3A0x1d5f81c9e8e04e9c!2sEgerton%20University%20Main%20Campus!5e0!3m2!1sen!2ske!4v1718556816508!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

   <footer class="footer-section" id="footer">
    <div class="container container-xxl">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <h5>About Bitrise Solutions</h5>
                <p>
                    Bitrise Solutions is dedicated to empowering organizations with cutting-edge technology. We specialize in innovative software solutions that boost efficiency and drive business growth across all industries.
                </p>
                <div class="social-icons mt-4">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="portfolio.php">Our Experts</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="#">Get a Quote</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-3">
                <h5>Contact Us</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>Nakuru - Egerton; Nairobi, Imaara Daima</p>
                <p style="margin-bottom: 0;">
                    <i class="fas fa-phone-alt me-2"></i>
                    <a href="tel:+254748700546" 
                       onmouseover="this.style.color='#25D366'; this.style.fontStyle='italic'; this.style.transform='scale(1.05)'" 
                       onmouseout="this.style.color='inherit'; this.style.fontStyle='normal'; this.style.transform='scale(1)'" 
                       style="color: inherit; text-decoration: none; transition: all 0.3s ease; display: inline-block;">
                        0748 700 546
                    </a>
                    <span style="margin: 0 5px;">|</span>
                    <a href="tel:+254112054071" 
                       onmouseover="this.style.color='#25D366'; this.style.fontStyle='italic'; this.style.transform='scale(1.05)'" 
                       onmouseout="this.style.color='inherit'; this.style.fontStyle='normal'; this.style.transform='scale(1)'" 
                       style="color: inherit; text-decoration: none; transition: all 0.3s ease; display: inline-block;">
                        0112 054 071
                    </a>
                </p>
                <p><i class="fas fa-envelope me-2"></i><a href="mailto:info@bitrisesolutions.co.ke" style="color: inherit;">info@bitrisesolutions.co.ke</a></p>
                <p><i class="fas fa-clock me-2"></i>Mon-Fri: 09:00am - 05:00pm</p>
            </div>
            <div class="col-md-4 col-lg-3">
                <h5>Newsletter</h5>
                <p>Stay updated with our latest news and offers.</p>
                <form action="subscribe.php" method="POST" class="newsletter-form">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your email address" aria-label="Your email address" required>
                        <button class="btn btn-subscribe" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <span id="currentYear"></span> Bitrise Solutions. All rights reserved.
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        // Smooth scroll and animation logic (copied from your index.php if it uses it)
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.animate-on-scroll');

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 }); // Adjust threshold as needed

            animateElements.forEach(element => {
                observer.observe(element);
            });

            // Set current year in the footer
            document.getElementById('currentYear').textContent = new Date().getFullYear();
        });

        // Auto-hide alerts after a few seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert-fixed-top');
            if (alert) {
                setTimeout(function() {
                    bootstrap.Alert.getInstance(alert)?.close();
                }, 7000); // Hide after 7 seconds
            }
        });
    </script>
</body>
</html>