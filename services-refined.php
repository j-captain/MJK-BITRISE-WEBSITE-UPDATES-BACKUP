<?php

require_once 'config.php';

$services = []; // Initialize as an empty array

// Fetch services from the database
try {
    // Prepare the SQL statement to select all services, ordered by display_order
    $sql_services = "SELECT id, title, description, icon_class, image, display_order FROM services ORDER BY display_order ASC";
    $stmt_services = $pdo->prepare($sql_services);
    
    // Execute the statement
    $stmt_services->execute();
    
    // Fetch all results as an associative array
    $services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Handle database errors: log the error and display a friendly message (optional for production)
    error_log("Database error fetching services: " . $e->getMessage());
    // In a real application, you might redirect to an error page or show a generic message to the user
    // For now, we'll just ensure $services remains empty on error.
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>Bitrise Solutions - Our Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" xintegrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      
            .elevate-container {
            max-width: 600px;
            margin: 30px auto 0;
            background: rgba(255, 255, 255, 0.9);
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            box-shadow: 0 10px 30px rgba(26, 46, 64, 0.15);
            padding: 2px;
            position: relative;
            overflow: hidden;
            }
            
            .elevate-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #E74C3C, #1A2E40);
            }
            
            .elevate-content {
                padding: 20px;
                text-align: center;
                background: white;
                border-top-right-radius: 28px;
                border-bottom-left-radius: 28px;
            }
            
            .elevate-content i {
                font-size: 2.5rem;
                color: #E74C3C;
                margin-bottom: 15px;
                display: inline-block;
            }
            
            .elevate-content p {
                color: #1A2E40;
                font-size: 1.1rem;
                margin: 0;
                font-weight: 500;
            }
            
            @media (max-width: 768px) {
                .elevate-container {
                    max-width: 90%;
                }
                
                .elevate-content p {
                    font-size: 1rem;
                }
            }
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

        a{
            color: white;
            text-decoration: none;
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

        .hero-section {
            position: relative;
            min-height: 40vh; 
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #FFFFFF;
            overflow: hidden;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
            top: 0;
            left: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
            color: #1A2E40;
            text-align: center;
            padding: 20px;
            max-width: 1200px;
        }
        .hero-content h1 {
            font-size: 2.8em;
            line-height: 1.3em;
            margin-bottom: 20px;
            font-weight: 700;
            color: #1A2E40;
        }
        .hero-content h1 span {
            color: #E74C3C;
        }
        .hero-content img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        

        /* Services Page Specific Styles */
        .services-section {
            padding: 80px 0;
            background-color: #f8f9fa;
            text-align: center;
        }
        .services-section h2 {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 50px;
        }
        .services-section h2 span {
            color: #E74C3C;
        }
        .services-section .service-card {
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%; /* Ensure consistent card height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }
        .services-section .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .services-section .service-card .icon-circle {
            background-color: #E74C3C;
            color: #FFFFFF;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3em;
            margin: 0 auto 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .services-section .service-card img.service-image {
            width: 100%;
            max-height: 200px; 
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .services-section .service-card h5 {
            color: #1A2E40;
            font-size: 1.6em;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .services-section .service-card p {
            color: #555555;
            font-size: 1.0em;
            line-height: 1.6;
            flex-grow: 1; /* Allow description to take available space */
        }
        .services-section .service-card .btn-details {
            color: #E74C3C;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            display: inline-block;
            margin-top: auto; /* Push button to the bottom */
        }
        .services-section .service-card .btn-details:hover {
            color: #C0392B;
        }

        
    
            /* Services Grid with visible aqua effect */
    
        .services-grid-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .service-category {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        .service-category::before,
        .service-category::after {
            content: '';
            position: absolute;
            z-index: -1;
            transition: all 0.5s ease;
        }
        /* Red left border - more prominent */
        .service-category::before {
            top: 0;
            left: 0;
            width: 6px;
            height: 0;
            background: #E74C3C;
            transition: height 0.4s cubic-bezier(0.65, 0, 0.35, 1);
        }
        /* Subtle aqua diagonal effect */
        .service-category::after {
            bottom: 0;
            right: 0;
            width: 0;
            height: 0;
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.1), rgba(0, 200, 200, 0.2));
            transform-origin: bottom right;
            transform: skew(-30deg);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.1);
        }
        .service-category:hover::before {
            height: 100%;
        }
        .service-category:hover::after {
            width: 150%;
            height: 150%;
            opacity: 0.5;
        }
        .service-category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .service-category-header {
            padding: 20px;
            background: #1A2E40;
            color: white;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .service-category-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: rgba(0, 255, 255, 0.3);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease;
        }
        .service-category:hover .service-category-header::before {
            transform: scaleX(1);
            transform-origin: left;
        }
        .service-category-header i {
            font-size: 2rem;
            margin-right: 15px;
            color: #E74C3C;
            transition: all 0.4s ease;
        }
        .service-category:hover .service-category-header i {
            transform: rotate(15deg) scale(1.1);
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.3);
        }
        .service-category-header h3 {
            margin: 0;
            font-size: 1.5rem;
            transition: text-shadow 0.3s ease;
        }
        .service-category:hover .service-category-header h3 {
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
        }
        .service-category-content {
            padding: 20px;
            position: relative;
        }
        .service-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
            transition: all 0.3s ease;
        }
        .service-item:hover {
            padding-left: 10px;
            background: rgba(0, 255, 255, 0.02);
        }
        .service-item:last-child {
            border-bottom: none;
        }
        .service-item i {
            color: #E74C3C;
            margin-right: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .service-item:hover i {
            color: #00aaaa;
            transform: scale(1.2);
        }
        .service-item span {
            color: #555;
            transition: all 0.3s ease;
        }
        .service-item:hover span {
            color: #1A2E40;
            font-weight: 500;
        }
        .service-description {
            font-style: italic;
            color: #E74C3C;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #E74C3C;
        }
                
        /* Footer Styles */
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

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .hero-content h1 {
                font-size: 2em;
            }
            .service-category-header {
                flex-direction: column;
                text-align: center;
            }
            .service-category-header i {
                margin-right: 0;
                margin-bottom: 10px;
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
            <a class="navbar-brand d-flex align-items-center" href="/">
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
                        <a class="nav-link active" aria-current="page" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="portfolio.php">Our Experts</a>
                    </li>
                     </li>
                       <li class="nav-item">
                        <a class="nav-link" href="pay/index.php">Pay/Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <button class="btn btn-custom-quote">Get a Quote</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-section">
    <div id="particles-js"></div>
    <div class="container hero-content">
        <h1>Our Core <span>Services</span></h1>
        <p class="lead text-center">Turning Ideas Into Bold Digital Solutions
.</p>
        
        <!-- New styled container -->
        <div class="elevate-container">
            <div class="elevate-content">
                <i class="fas fa-lightbulb"></i>
                <p>At Bitrise Solutions, we offer a full stack of creative and technical services. From custom websites to mobile apps, branding, marketing, and beyond. Whether you're a startup, a growing business, or an established enterprise, we tailor every solution to fit your vision and goals.

</p>
            </div>
        </div>
    </div>
</div>

    <!-- New Services Grid Section -->
    <div class="services-grid-container">
        <div class="container">
            <div class="row">
                <!-- Web Design & Development -->
                <div class="col-md-6">
                    <div class="service-category">
                        <div class="service-category-header">
                            <i class="fas fa-code"></i>
                            <h3>Web Design & Development</h3>
                        </div>
                        <div class="service-category-content">
                            <p class="service-description">We create responsive, high-performance websites that deliver exceptional user experiences and drive business growth.</p>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Frontend Development</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Backend development</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>CMS development (WordPress, Joomla, Drupal)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>E-commerce development (Shopify, Woocommerce, Magento)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Web app development (Dashboards, Portals)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Hosting setup & Domain Registration</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Website maintenance & Support</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Graphics Design -->
                <div class="col-md-6">
                    <div class="service-category">
                        <div class="service-category-header">
                            <i class="fas fa-paint-brush"></i>
                            <h3>Graphics Design</h3>
                        </div>
                        <div class="service-category-content">
                            <p class="service-description">We craft visually stunning designs that communicate your brand identity and captivate your target audience.</p>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Logo designs</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Brand identity Design (business cards, letterheads...)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Social media Graphics</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Posters, Flyers & Banners</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Infographics</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>UI elements (icons & buttons)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Brochures & Company profiles</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Product packaging designs</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Motion graphics</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile App Development -->
                <div class="col-md-6">
                    <div class="service-category">
                        <div class="service-category-header">
                            <i class="fas fa-mobile-alt"></i>
                            <h3>Mobile App Development</h3>
                        </div>
                        <div class="service-category-content">
                            <p class="service-description">We build intuitive, feature-rich mobile applications that engage users and solve real business challenges.</p>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Native App development</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Cross-platform App development</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>UI/UX design for mobile apps</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>App prototyping & MVP development</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>API integrations into mobile apps</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>App store development</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>App testing</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>App maintenance & Update</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Digital Marketing -->
                <div class="col-md-6">
                    <div class="service-category">
                        <div class="service-category-header">
                            <i class="fas fa-bullhorn"></i>
                            <h3>Digital Marketing</h3>
                        </div>
                        <div class="service-category-content">
                            <p class="service-description">We develop data-driven marketing strategies that amplify your online presence and generate measurable results.</p>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Social media marketing (SMM)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Search Engine Marketing (SEM) ads</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Content marketing (blogs, newsletters, articles)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Email Marketing</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Influencer marketing</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Video marketing (reels, YouTube, TikTok)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Online Reputation Management (ORM)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Analytics & Reporting</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- SEO Services -->
                <div class="col-md-6">
                    <div class="service-category">
                        <div class="service-category-header">
                            <i class="fas fa-search"></i>
                            <h3>SEO (Search Engine Optimization) Services</h3>
                        </div>
                        <div class="service-category-content">
                            <p class="service-description">We optimize your digital assets to improve search rankings, drive organic traffic, and increase conversions.</p>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>On-Page SEO (keyword optimization, meta tags, headings, image alt texts)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Off-page SEO (backlink building, guest posting)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Technical SEO (site speed, mobile-friendliness, sitemap)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Local SEO (Google business profile optimization)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Keyword search</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Competitor analysis</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>SEO audits & reports</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>SEO content writing</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- API Integration -->
                <div class="col-md-6">
                    <div class="service-category">
                        <div class="service-category-header">
                            <i class="fas fa-plug"></i>
                            <h3>API Integration</h3>
                        </div>
                        <div class="service-category-content">
                            <p class="service-description">We seamlessly connect systems and applications to streamline operations and enhance functionality.</p>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Payment gateway integration (Mpesa, PayPal, stripe)</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Sms gateway integration</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Social media API integration</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Third party software integration</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Mobile app backend integration</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Custom API development</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Data synchronization</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>API documentation & testing</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Security implementation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     
    <div class="whatsapp-float">
        <a href="https://wa.me/254112054071" target="_blank" aria-label="Chat on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
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
                    <p><i class="fas fa-phone-alt me-2"></i><a href="tel:+254112054071" style="color: inherit;">+254 11205 4071</a></p>
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
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        // Particles.js initialization (from your original file)
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#cccccc"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#cccccc",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "grab"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 140,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>