 <?php

require_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>Bitrise Solutions - About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Your existing CSS styles go here */
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
            min-height: 40vh; /* Adjusted for about page */
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

        .partners-section {
            background-color: #f8f9fa;
            padding: 30px 0;
            text-align: center;
        }
        .partners-section h2 {
            color: #1A2E40;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .partners-section .partner-logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 10px;
        }
        .partners-section .partner-logo-container img {
            max-width: 150px;
            height: auto;
            margin: 10px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        .partners-section .partner-logo-container img:hover {
            opacity: 1;
        }

        .efficiency-section {
            background-color: #FFFFFF;
            padding: 80px 0;
        }
        .efficiency-section h3 {
            color: #1A2E40;
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .efficiency-section h2 {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .efficiency-section h2 span {
            color: #E74C3C;
        }
        .efficiency-section p {
            color: #555555;
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .efficiency-section .feature-box {
            background-color: #F8F8F8;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .efficiency-section .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .efficiency-section .feature-box i {
            color: #E74C3C;
            font-size: 24px;
            margin-right: 10px;
        }
        .efficiency-section .feature-box .text {
            font-size: 1.1em;
            font-weight: 600;
            color: #1A2E40;
        }
        .efficiency-section .img-fluid-enhanced { 
            width: 100%;
            height: auto; 
            max-height: 500px; 
            object-fit: contain; 
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        a{
            color: white;
            text-decoration: none;
        }

        /* Projects Section Styles */
        .projects-section {
            background-color: #f0f2f5;
            padding: 80px 0;
            text-align: center;
            position: relative; /* Crucial for absolute positioning of background */
            overflow: hidden; /* Hide overflowing parts of the animated background */
        }
        .projects-section .section-subtitle {
            color: #E74C3C;
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .projects-section .section-title {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 50px;
        }
        .projects-section .section-title span {
            color: #E74C3C;
        }
        .projects-section .project-card {
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            min-height: 350px; /* Ensure consistent card height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative; /* Ensure project cards are above the background */
            z-index: 1; /* Bring cards forward */
        }
        .projects-section .project-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
        .projects-section .project-card .icon-circle {
            background-color: #E74C3C;
            color: #FFFFFF;
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.2em;
            margin: 0 auto 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .projects-section .project-card h4 {
            color: #1A2E40;
            font-size: 1.5em;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .projects-section .project-card p {
            color: #555555;
            font-size: 1em;
            line-height: 1.6;
            margin-bottom: 25px;
            flex-grow: 1; /* Allows description to take up available space */
        }
        .projects-section .project-card .btn-read-more {
            color: #E74C3C;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            display: inline-block;
            margin-top: auto; /* Pushes button to the bottom */
        }
        .projects-section .project-card .btn-read-more:hover {
            color: #C0392B;
        }
        .projects-section .project-card .btn-read-more i {
            margin-left: 8px;
            transition: margin-left 0.3s ease;
        }
        .projects-section .project-card .btn-read-more:hover i {
            margin-left: 12px;
        }

        /* Animated Background for Projects Section */
        .projects-section::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 70%; 
            background-image: url('img/tech.png'); 
            background-size: cover; 
            background-repeat: no-repeat;
            background-position: right center; 
            opacity: 0.1; 
            z-index: 0; 
            animation: backgroundPan 30s linear infinite alternate; 
        }

        @keyframes backgroundPan {
            0% {
                background-position: 100% center; /* Start from the far right */
            }
            100% {
                background-position: 50% center; /* Pan towards the center */
            }
        }

        /* Testimonials Section Styles */
        .testimonials-section {
            background-color: #1A3C6C;
            padding: 80px 0;
            text-align: center;
        }
        .testimonials-section .section-subtitle {
            color: #E74C3C;
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .testimonials-section .section-title {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 50px;
        }
        .testimonials-section .section-title span {
            color: #E74C3C;
        }
        .testimonials-section .testimonial-card {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%; /* Ensure cards are of equal height */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .testimonials-section .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .testimonials-section .testimonial-card .profile-image {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            border: 4px solid #E74C3C;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .testimonials-section .testimonial-card p {
            font-style: italic;
            color: #555555;
            margin-bottom: 20px;
            line-height: 1.6;
            flex-grow: 1; /* Allows testimonial text to take up available space */
        }
        .testimonials-section .testimonial-card .client-name {
            font-weight: 700;
            color: #1A2E40;
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        .testimonials-section .testimonial-card .client-title {
            color: #777777;
            font-size: 0.9em;
        }

        .updates-section {
            position: relative;
            padding: 60px 20px;
            text-align: center;
            overflow: hidden;
        }

        .decorative-shape-right,
        .decorative-shape-left {
            position: absolute;
            top: 0;
            width: 300px;
            opacity: 0.15;
            z-index: 0;
            pointer-events: none;
            animation: float 6s ease-in-out infinite;
        }

        .decorative-shape-right {
            right: 0;
        }

        .decorative-shape-left {
            left: 0;
            transform: scaleX(-1);
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(15px); }
            100% { transform: translateY(0); }
        }

        .section-title {
            color: #0a0a5c;
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .section-subtitle {
            color: #3b82f6;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.9em;
            z-index: 1;
            position: relative;
            letter-spacing: 1px;
        }

        .cards-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .card {
            background: white;
            width: 300px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center;
            display: block;
            border-bottom: 1px solid #eee;
            filter: brightness(1.05) contrast(1.1);
        }

        .card-body {
            padding: 20px;
            text-align: left;
        }

        .card-category {
            font-size: 0.75em;
            color: #6366f1;
            background: #eef2ff;
            padding: 3px 8px;
            border-radius: 5px;
            display: inline-block;
        }

        .card-date {
            font-size: 0.85em;
            margin: 10px 0;
            color: #6b7280;
        }

        .card-title {
            font-size: 1.1em;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .card-content {
            font-size: 0.95em;
            color: #4b5563;
            margin: 10px 0;
        }

        .card-author {
            font-size: 0.85em;
            color: #1A2E40;
            font-weight: 500;
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

        @keyframes fadeInSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
            transition-delay: var(--delay);
        }

        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
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

        /* About Us Page Specific Styles */
        .about-section {
            padding: 80px 0;
            background-color: #ffffff;
        }
        .about-section h2 {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }
        .about-section h2 span {
            color: #E74C3C;
        }
        .about-section p {
            color: #555555;
            font-size: 1.1em;
            line-height: 1.8;
            margin-bottom: 25px;
            text-align: justify;
        }
        .about-section .about-image {
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }

        .mission-vision-section {
            background-color: #f8f9fa;
            padding: 60px 0;
            text-align: center;
        }
        .mission-vision-section .card {
            background-color: #FFFFFF;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .mission-vision-section .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .mission-vision-section .card i {
            color: #E74C3C;
            font-size: 3em;
            margin-bottom: 20px;
        }
        .mission-vision-section .card h4 {
            color: #1A2E40;
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .mission-vision-section .card p {
            color: #555555;
            line-height: 1.6;
        }

        @media (max-width: 767.98px) {
            .mission-vision-section .card {
                width: 100%;
                margin-left: 0;
                margin-right: 0;
                padding: 25px;
            }
            
            .mission-vision-section .col-md-4 {
                padding-left: 15px;
                padding-right: 15px;
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }
            
            .mission-vision-section .row {
                margin-left: 0;
                margin-right: 0;
            }
            
            .mission-vision-section .card i {
                font-size: 2.5em;
            }
        }

        .team-section {
            padding: 80px 0;
            background-color: #ffffff;
            text-align: center;
        }
        .team-section h2 {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 50px;
        }
        .team-section h2 span {
            color: #E74C3C;
        }
        .team-section .team-member-card {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            text-align: center;
        }
        .team-section .team-member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        .team-section .team-member-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #E74C3C;
        }
        .team-section .team-member-card h5 {
            color: #1A2E40;
            font-size: 1.4em;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .team-section .team-member-card p.title {
            color: #777777;
            font-size: 0.95em;
            margin-bottom: 15px;
        }
        .team-section .team-member-card .social-links a {
            color: #1A2E40;
            font-size: 1.2em;
            margin: 0 8px;
            transition: color 0.3s ease;
        }
        .team-section .team-member-card .social-links a:hover {
            color: #E74C3C;
        }

        /* What We Do Section */
        .what-we-do-section {
    padding: 80px 0;
    background-color: #FFFFFF;
}
.what-we-do-section h2 {
    color: #1A2E40;
    font-size: 2.8em;
    font-weight: 700;
    margin-bottom: 50px;
    text-align: center;
}
.what-we-do-section h2 span {
    color: #E74C3C;
}
.what-we-do-section .row {
    gap: 30px; /* Consistent spacing between items */
    justify-content: center;
}
.service-card {
    background-color: #F8F8F8;
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 30px; /* Increased bottom margin */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    border-left: 5px solid #E74C3C;
}
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            background-color: #FFFFFF;
        }
        .service-card i {
            color: #E74C3C;
            font-size: 2em;
            margin-bottom: 20px;
            display: block;
        }
        .service-card h4 {
            color: #1A2E40;
            font-size: 1.5em;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .service-card p {
            color: #555555;
            font-size: 1em;
            line-height: 1.6;
        }

        /* Why Choose Us Section */
        .why-choose-section {
            background-color: #f8f9fa;
            padding: 80px 0;
        }
        .why-choose-section h2 {
            color: #1A2E40;
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
        }
        .why-choose-section h2 span {
            color: #E74C3C;
        }
        .advantage-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        .advantage-icon {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            background-color: #E74C3C;
            color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            margin-right: 20px;
        }
        .advantage-content h4 {
            color: #1A2E40;
            font-size: 1.3em;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .advantage-content p {
            color: #555555;
            font-size: 1em;
            line-height: 1.6;
        }

        @media (max-width: 767.98px) {
            .top-info-bar .info-item {
                justify-content: center;
            }
            .hero-content h1 {
                font-size: 2em;
            }
            .hero-content img {
                margin-top: 30px;
            }
            .partners-section h2 {
                font-size: 2em;
            }
            .partners-section .partner-logo-container img {
                max-width: 100px;
                margin: 5px;
            }
            .efficiency-section h2 {
                font-size: 2em;
            }
            .efficiency-section .col-md-6:first-child {
                order: 2;
            }
            .efficiency-section .col-md-6:last-child {
                order: 1;
            }
            .footer-section .col-md-4, .footer-section .col-md-3 { /* Adjusted for new footer layout */
                margin-bottom: 30px;
            }
            .projects-section::after {
                width: 100%; /* Cover the whole section on smaller screens if desired */
                background-position: center center;
            }
            .about-intro-section .tagline {
                font-size: 1.5em;
            }
            .highlight-card {
                width: 100%;
            }
        }
        @media (min-width: 768px) {
            .top-info-bar .info-item {
                margin-bottom: 0;
            }
            .hero-content h1 {
                text-align: left;
            }
            .hero-content .row {
                align-items: center;
            }
            .hero-content .text-center-md {
                text-align: center !important;
            }
        }

        .aqua-container {
            background-color: rgba(20, 160, 160, 0.1); /* Aqua with 10% opacity */
            backdrop-filter: blur(5px);
            border-radius: 45px;
            padding: 40px;
            border: 1px solid rgba(0, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 255, 255, 0.1);
            margin-bottom: 40px;
        }

      
        .about-intro-section {
            background-color: #1A2E40;
            border-radius:15px;
            color: #E0E7EB;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        .about-intro-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.1) 0%, rgba(26, 46, 64, 0.9) 100%);
            z-index: 0;
        }
        .about-intro-content {
            position: relative;
            z-index: 1;
        }
        .about-intro-section h2 {
            color: #E74C3C;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .about-intro-section .tagline {
            font-size: 1.8em;
            font-weight: 600;
            color: #FFFFFF;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
        }
        .about-intro-section .tagline::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background-color: #E74C3C;
        }
        .about-intro-section .intro-text {
            font-size: 1.2em;
            line-height: 1.8;
            margin-bottom: 30px;
            text-align: center;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }
        .about-highlights {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 50px;
        }
        .highlight-card {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            width: 280px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .highlight-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            background-color: rgba(231, 76, 60, 0.2);
        }
        .highlight-card i {
            font-size: 2.5em;
            color: #E74C3C;
            margin-bottom: 20px;
            display: block;
        }
        .highlight-card h4 {
            color: #FFFFFF;
            font-size: 1.4em;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .highlight-card p {
            color: #E0E7EB;
            font-size: 1em;
            line-height: 1.6;
        }

        @media (max-width: 767.98px) {
            .aqua-container {
                padding: 25px;
                border-radius: 30px;
            }
            .about-intro-section .tagline {
                font-size: 1.5em;
            }
            .highlight-card {
                width: 100%;
            }
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
                        <a class="nav-link active" aria-current="page" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
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
                        <button class="btn btn-custom-quote"><a href="">Request Call</a></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-section">
        <div id="particles-js"></div>
        <div class="container hero-content">
            <h1>About <span>Bitrise Solutions</span></h1>
            <p class="lead text-center">Your trusted partner in innovative software solutions and digital transformation.</p>
        </div>
    </div>

    <!-- New About Intro Section -->
   <section class="about-intro-section">
    <div class="container about-intro-content">
        <div class="animate-on-scroll" style="--delay: 0s;">
            <div class="aqua-container">
                <h2>About Us</h2>
                <div class="tagline">"Designing Ideas. Building Solutions. Empowering Growth."</div>
                <p class="intro-text">
                    At Bitrise Solutions, we deliver forward-thinking digital solutions, empowering businesses to look better, work smarter, and connect deeper with their audience across Kenya to thrive in a connected world. With a passion for innovation and a commitment to excellence, we partner with clients to build secure, efficient, and scalable digital experiences.
                </p>
            </div>
        </div>
        
        <div class="about-highlights">
            <div class="highlight-card animate-on-scroll" style="--delay: 0.1s;">
                <i class="fas fa-lightbulb"></i>
                <h4>Innovative Approach</h4>
                <p>We combine creativity with technology to deliver solutions that stand out in the market and drive real business impact.</p>
            </div>
            
            <div class="highlight-card animate-on-scroll" style="--delay: 0.2s;">
                <i class="fas fa-users"></i>
                <h4>Client-Centric</h4>
                <p>Your success is our priority. We listen, understand, and deliver solutions tailored to your unique business needs.</p>
            </div>
            
            <div class="highlight-card animate-on-scroll" style="--delay: 0.3s;">
                <i class="fas fa-chart-line"></i>
                <h4>Growth Focused</h4>
                <p>Our solutions are designed to scale with your business, ensuring long-term value and continuous improvement.</p>
            </div>
        </div>
    </div>
</section>

    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 animate-on-scroll" style="--delay: 0s;">
                    <img src="img/banner-bitrise.png" alt="About Bitrise Solutions" class="img-fluid about-image">
                </div>
                <div class="col-lg-6 animate-on-scroll" style="--delay: 0.2s;">
                    <h2>Who We <span>Are</span></h2>
                    <p>Founded on a mission to transform businesses through technology, our team combines deep technical expertise with creativity and strategy. Every solution is crafted with precision, from responsive websites to mobile apps, graphic designs to digital marketing campaigns. We believe in building long-term relationships with our clients, grounded in trust, transparency, and shared success.</p>
                    <p>Bitrise Solutions is a leading technology company dedicated to providing cutting-edge software development, IT consulting, and digital solutions. Established with a passion for innovation and a commitment to excellence, we empower businesses of all sizes to thrive in the digital age.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mission-vision-section">
        <div class="container">
            <h2 class="section-title animate-on-scroll" style="--delay: 0s;">Our <span>Foundation</span></h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4 animate-on-scroll" style="--delay: 0.1s;">
                    <div class="card">
                        <i class="fas fa-bullseye"></i>
                        <h4>Our Mission</h4>
                        <p>To deliver innovative, secure, and efficient software solutions that drive operational excellence and sustainable growth for our clients.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate-on-scroll" style="--delay: 0.2s;">
                    <div class="card">
                        <i class="fas fa-eye"></i>
                        <h4>Our Vision</h4>
                        <p>To be Kenya's go-to team for digital transformation; trusted, creative, and always a step ahead.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate-on-scroll" style="--delay: 0.3s;">
                    <div class="card">
                        <i class="fas fa-handshake"></i>
                        <h4>Our Values</h4>
                        <p>Innovation | Integrity | Client-Centricity | Excellence | Collaboration | Continuous Learning</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do Section -->
    <section class="what-we-do-section">
        <div class="container">
            <h2 class="animate-on-scroll" style="--delay: 0s;">What We <span>Do Best</span></h2>
            <div class="row">
                <div class="col-md-4 animate-on-scroll" style="--delay: 0.1s;">
                    <div class="service-card">
                        <i class="fas fa-laptop-code"></i>
                        <h4>Custom Software & Web Development</h4>
                        <p>Responsive, user-focused websites and applications tailored to your specific business requirements.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll" style="--delay: 0.2s;">
                    <div class="service-card">
                        <i class="fas fa-mobile-alt"></i>
                        <h4>Android & Mobile App Development</h4>
                        <p>Native solutions that enhance user experience and drive engagement across all devices.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll" style="--delay: 0.3s;">
                    <div class="service-card">
                        <i class="fas fa-paint-brush"></i>
                        <h4>UI/UX & Graphic Design</h4>
                        <p>Stunning visuals that tell your brand's story and create memorable user experiences.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll" style="--delay: 0.4s;">
                    <div class="service-card">
                        <i class="fas fa-bullhorn"></i>
                        <h4>Digital Marketing & Strategy</h4>
                        <p>Comprehensive communications, branding, and client engagement solutions.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll" style="--delay: 0.5s;">
                    <div class="service-card">
                        <i class="fas fa-headset"></i>
                        <h4>IT Consulting & Support</h4>
                        <p>Solutions that streamline operations and boost productivity across your organization.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll" style="--delay: 0.6s;">
                    <div class="service-card">
                        <i class="fas fa-database"></i>
                        <h4>Database Design & Backend Systems</h4>
                        <p>Scalable architectures supporting long-term growth and business expansion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section">
        <div class="container">
            <h2 class="animate-on-scroll" style="--delay: 0s;">Why <span>Choose Us</span></h2>
            <div class="row">
                <div class="col-lg-6 animate-on-scroll" style="--delay: 0.1s;">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Full-spectrum Expertise</h4>
                            <p>From design and user experience to backend architecture and marketing strategy, we cover all aspects of digital transformation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-on-scroll" style="--delay: 0.2s;">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Client-First Approach</h4>
                            <p>We listen, collaborate, and deliver solutions that truly resonate with your business goals and audience needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-on-scroll" style="--delay: 0.3s;">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Innovative Execution</h4>
                            <p>Creative thinking powered by technical accuracy and efficiency to deliver solutions that give you a competitive edge.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-on-scroll" style="--delay: 0.4s;">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-expand"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Scalable & Secure</h4>
                            <p>Our solutions are built to perform and grow with your business, with security as a fundamental consideration.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-on-scroll" style="--delay: 0.5s;">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Local Insight, Professional Standards</h4>
                            <p>Rooted in Kenya, we understand the local market while maintaining international quality standards. We stay local, but think big.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-on-scroll" style="--delay: 0.6s;">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="advantage-content">
                            <h4>Proven Track Record</h4>
                            <p>We've successfully delivered solutions for businesses across various industries, helping them achieve their digital goals.</p>
                        </div>
                    </div>
                </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <script>
        // Particles.js configuration
        particlesJS("particles-js", {
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

        // Intersection Observer for scroll animations
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll('.animate-on-scroll');

            const observerOptions = {
                root: null, // viewport
                rootMargin: '0px',
                threshold: 0.1 // 10% of the element must be visible
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target); // Stop observing once animated
                    }
                });
            }, observerOptions);

            elements.forEach(element => {
                observer.observe(element);
            });

            // Update copyright year
            document.getElementById('currentYear').textContent = new Date().getFullYear();
        });
    </script>
</body>
</html>