 <?php

require_once 'config.php';

// Ensure the PDO connection is available from config.php
if (!isset($pdo) || !$pdo instanceof PDO) {
    die("Database connection failed. Make sure config.php provides a valid PDO object named \$pdo.");
}

// --- Fetching latest updates ---
try {
    $sql_updates = "SELECT * FROM updates ORDER BY created_at DESC LIMIT 3";
    $stmt_updates = $pdo->prepare($sql_updates);
    $stmt_updates->execute();
    $updates = $stmt_updates->fetchAll();
} catch (PDOException $e) {
    error_log("Error fetching updates: " . $e->getMessage());
    $updates = []; // Default to empty array on error
}

// --- Fetching partners ---
try {
    $sql_partners = "SELECT name, image_url FROM partners ORDER BY created_at ASC"; // Order by creation date
    $stmt_partners = $pdo->prepare($sql_partners);
    $stmt_partners->execute();
    $partners = $stmt_partners->fetchAll();

    // Initialize an empty string to build the partners HTML
    $partners_html = '';
    if ($partners) {
        foreach ($partners as $partner) {
            // htmlspecialchars() is crucial for security to prevent XSS
            $partners_html .= '<img src="' . htmlspecialchars($partner["image_url"]) . '" alt="' . htmlspecialchars($partner["name"]) . '">';
        }
    } else {
        $partners_html = '<p>No partners found yet. Please add some from the <a href="admin.php">admin page</a>.</p>';
    }
} catch (PDOException $e) {
    error_log("Error fetching partners: " . $e->getMessage());
    $partners_html = '<p>Could not load partners at this time. Please try again later.</p>'; // User-friendly message on error
}


// --- Fetching a single banner image ---
// Initialize with default values in case fetching fails or no banner is found
$fetched_banner_image_url = 'https://placehold.co/1200x400/cccccc/333333?text=Default+Banner'; // A placeholder image
$fetched_banner_alt_text = 'Default banner image';

try {
    // Fetch the most recently added banner image
    $sql_banner = "SELECT image_url, alt_text FROM banner_images ORDER BY created_at DESC LIMIT 1";
    $stmt_banner = $pdo->prepare($sql_banner);
    $stmt_banner->execute();
    $banner_data = $stmt_banner->fetch(PDO::FETCH_ASSOC);

    if ($banner_data) {
        $fetched_banner_image_url = htmlspecialchars($banner_data['image_url']);
        $fetched_banner_alt_text = htmlspecialchars($banner_data['alt_text']);
    }
} catch (PDOException $e) {
    error_log("Error fetching banner image: " . $e->getMessage());
    // The default values will remain if an error occurs
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitrise Solutions - Home</title>
    <link rel="icon" type="image/x-icon" href="img/icon.png">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        
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

        /* ================== ENHANCED HERO SECTION ================== */
        .hero-section {
            position: relative;
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1A2E40 0%, #2A4050 50%, #1A2E40 100%);
            background-size: 200% 200%;
            animation: gradientBG 15s ease infinite;
            overflow: hidden;
            padding-top: 50px;
            padding-bottom: 50px;
            color: #FFFFFF;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Text gradient effect */
        .text-gradient {
            background: linear-gradient(90deg, #E74C3C, #FF7F50);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline;
        }

        /* Hero image styling */
        .hero-image-container {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.5s ease;
        }

        .hero-image-container:hover {
            transform: perspective(1000px) rotateY(0deg);
        }

        .hero-image {
            border-radius: 15px;
            transition: transform 0.5s ease;
            width: 100%;
            height: auto;
        }

        .floating-badge {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255,255,255,0.9);
            color: #1A2E40;
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .achievements {
            margin-top: 30px;
        }

        .achievement-item {
            text-align: center;
        }

        .achievement-item .number {
            font-size: 2rem;
            font-weight: 700;
            color: #E74C3C;
            line-height: 1;
        }

        .achievement-item .label {
            font-size: 0.9rem;
            color: #E0E7EB;
            opacity: 0.8;
        }

        /* Hero decorations */
        .hero-decorations {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.15;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            background: #E74C3C;
            top: 20%;
            left: 10%;
            animation: float 15s ease-in-out infinite;
        }

        .circle-2 {
            width: 400px;
            height: 400px;
            background: #1A2E40;
            bottom: 10%;
            right: 10%;
            animation: float 18s ease-in-out infinite reverse;
        }

        .circle-3 {
            width: 200px;
            height: 200px;
            background: #FFFFFF;
            top: 50%;
            right: 20%;
            animation: float 12s ease-in-out infinite 2s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(50px, 50px) rotate(180deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        /* ================== END ENHANCED HERO SECTION ================== */

        /* ================== NEW SERVICES SECTION ================== */
        .services-section {
            position: relative;
            padding: 100px 0;
            background: url('https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80') no-repeat center center;
            background-size: cover;
            color: #fff;
            overflow: hidden;
        }

        .services-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 46, 64, 0.85);
            z-index: 1;
        }

        .services-container {
            position: relative;
            z-index: 2;
        }

        .services-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .services-header h2 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #fff;
        }

        .services-header p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            color: rgba(255, 255, 255, 0.9);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.2) 0%, rgba(26, 46, 64, 0.7) 100%);
            z-index: -1;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            border-color: rgba(231, 76, 60, 0.5);
        }

        .service-card:hover::before {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.4) 0%, rgba(26, 46, 64, 0.9) 100%);
        }

        .service-icon {
            font-size: 2.5rem;
            color: #E74C3C;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.2);
            color: #fff;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
        }

        .service-card h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background: #E74C3C;
            transition: all 0.3s ease;
        }

        .service-card:hover h3::after {
            width: 80px;
            background: #fff;
        }

        .service-card p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .learn-more-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 20px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .learn-more-btn:hover {
            background: #E74C3C;
            border-color: #E74C3C;
            color: #fff;
            transform: translateY(-3px);
        }
        /* ================== END NEW SERVICES SECTION ================== */

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
            color: #FFFFFF;
            text-align: center;
            padding: 20px;
            max-width: 1200px;
        }
        .hero-content h1 {
            font-size: 2.8em;
            line-height: 1.3em;
            margin-bottom: 20px;
            font-weight: 700;
            color: #FFFFFF;
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
        
        /* phone float left */
/* Floating Button */
.phone-float {
    position: fixed;
    bottom: 20px;
    left: 20px; /* Changed to left */
    background-color: #1A3C6C; /* WhatsApp green */
    color: white;
    padding: 15px 20px;
    border-radius: 50px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease;
    cursor: pointer; /* Indicate it's clickable */
}

.phone-float:hover {
    background-color: #E74C3C; 
}

.phone-float i {
    margin-right: 8px;
}

/* Modal Styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1001; /* Sit on top, higher than the button */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
    justify-content: center;
    align-items: center;
    padding-top: 50px; /* Space from the top */
}

.modal-content {
    background-color: #fefefe;
    margin: auto; /* Centered */
    padding: 30px;
    border: 1px solid #888;
    width: 80%; /* Could be more specific, e.g., 400px */
    max-width: 500px; /* Max width for larger screens */
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    position: relative; /* For positioning the close button */
    animation: fadeIn 0.3s ease-out; /* Simple fade-in effect */
}

.close-button {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
}

.close-button:hover,
.close-button:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Form Styles inside Modal */
.modal-content h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

.form-group input[type="text"],
.form-group input[type="tel"] {
    width: calc(100% - 20px); /* Adjust for padding */
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.modal-content button[type="submit"] {
    background-color: #1A3C6C; /* Green submit button */
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 17px;
    width: 100%;
    margin-top: 20px;
    transition: background-color 0.3s ease;
}

.modal-content button[type="submit"]:hover {
    background-color: #E74C3C; 
}

#formMessage {
    text-align: center;
    margin-top: 15px;
    font-weight: bold;
}

/* Animation for modal */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
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
            color:  #1A2E40;
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
        
     .btn-navy {
  background-color: #001f3f;
  margin-left:-50%;
  color: white;
}

.btn-navy:hover {
  background-color: #E74C3C;
}


        /* --- Custom Bits Loader CSS --- */
.bits-loader {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%; /* Ensures it takes height if parent has it */
}

.bits-loader > div {
    width: 15px;
    height: 15px;
    border-radius: 50%; /* Make them circles */
    margin: 0 5px; /* Spacing between bits */
    animation: bounce 1.2s infinite ease-in-out both; /* Animation properties */
}

.bits-loader .bit-red {
    background-color: var(--bitwise-red-accent); /* Assumes --bitwise-red-accent is defined */
}

.bits-loader .bit-blue {
    background-color: var(--bitwise-dark-blue); /* Assumes --bitwise-dark-blue is defined */
    animation-delay: -0.3s; /* Delay for staggered animation */
}

.bits-loader .bit-grey {
    background-color: var(--bitwise-medium-grey); /* Assumes --bitwise-medium-grey is defined */
    animation-delay: -0.6s; /* Further delay */
}
        .search-form {
            display: flex;
            align-items: center;
            margin-left: 15px; /* Adjust spacing as needed */
        }
        .search-form .form-control {
            border-radius: 0.25rem; /* Bootstrap default */
            border-color: #ced4da;
        }
        .search-form .btn {
            margin-left: 5px;
        }

        /* Styles for highlighting search results */
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }


@keyframes bounce {
    0%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-20px); /* Bounce height */
    }
}
/* --- End Custom Bits Loader CSS --- */

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
            
            /* Mobile adjustments for enhanced hero section */
            .hero-section {
                min-height: auto;
                padding: 60px 0;
            }
            .hero-content h1 {
                font-size: 2rem;
                text-align: center;
            }
            .hero-image-container {
                margin-top: 30px;
                transform: none !important;
            }
            .achievements {
                justify-content: center;
            }
            .floating-circle {
                display: none; /* Hide decorative circles on mobile */
            }
            
            /* Mobile adjustments for services section */
            .services-section {
                padding: 60px 0;
            }
            .services-header h2 {
                font-size: 2rem;
            }
            .services-header p {
                font-size: 1rem;
            }
            .services-grid {
                grid-template-columns: 1fr;
            }
            .service-card {
                padding: 20px;
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

        /* WhatsApp Floating Button with Dropdown */
        .whatsapp-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .whatsapp-float {
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            background-color: #1DA851;
            transform: scale(1.05);
        }

        .whatsapp-dropdown {
            position: absolute;
            bottom: 70px;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .whatsapp-container:hover .whatsapp-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .whatsapp-option {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            transition: background 0.2s ease;
        }

        .whatsapp-option i {
            margin-right: 10px;
            color: #25D366;
            font-size: 20px;
        }

        .whatsapp-option:hover {
            background: #f5f5f5;
            color: #25D366;
        }

        .whatsapp-option:first-child {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .whatsapp-option:last-child {
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .whatsapp-dropdown {
                width: 160px;
                font-size: 14px;
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
                    <span class="info-item me-4"><i class="fas fa-envelope"></i> <a href="mailto:info@bitrisesolutions.co.ke">info@bitrisesolutions.co.ke</a></span>
                    <span class="info-item"><i class="fas fa-clock"></i> Mon-Fri: 09:00am - 05:00pm</span>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid container-xxl">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://bitrisesolutions.co.ke/img/logo-b.png" alt="Bitrise Solutions Logo" width="100%" height="70vh" class="d-inline-block align-text-top me-2">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="portfolio.php">Our Experts</a>
                    </li>
                       <li class="nav-item">
                        <a class="nav-link" href="pay/index.php">Pay/Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
    <!--                <li class="nav-item ms-lg-3">-->
                        <!--<button class="btn btn-custom-quote">Request Call</button>-->
                        
    <!--                    <a href="#" class="btn btn-custom-quote" aria-label="Request Call" id="">-->
    <!--     Request Call-->
    <!--</a>-->
    <!--                </li>-->
                    
                    
                </ul>
                
                   <form class="d-flex search-form" role="search">
                    <input class="form-control me-2" type="search" placeholder="Projects..." aria-label="Search" id="pageSearchInput">
                    <button class="btn btn-outline-success" style="background-color: #1A2E40;" type="button" id="pageSearchButton">Search</button>
                </form>
            </div>
        </div>
    </nav>

<div id="pageContet">
    
    
 <!--ENHANCED HERO SECTION  -->
    <section class="services-section">
        
        <div id="particles-js"></div>
        <div class="hero-decorations">
            <div class="floating-circle circle-1"></div>
            <div class="floating-circle circle-2"></div>
            <div class="floating-circle circle-3"></div>
        </div>
        
        <div class="container services-container">
            <div class="services-header animate-on-scroll" style="--delay: 0.1s;">
                <h2>Powering Organizations & Businesses Through Technology</h2>
                <p>We provide comprehensive digital solutions to help your business thrive in the digital landscape</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card animate-on-scroll" style="--delay: 0.2s;">
                    <div class="service-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Web Design & Development</h3>
                    <p>Custom websites that are visually stunning, responsive, and optimized for performance and user experience.</p>
                    <a href="services.php" class="learn-more-btn">Learn More</a>
                </div>
                
                <div class="service-card animate-on-scroll" style="--delay: 0.3s;">
                    <div class="service-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3>Digital Marketing</h3>
                    <p>Strategic marketing solutions to increase your online visibility and drive targeted traffic to your business.</p>
                    <a href="services.php" class="learn-more-btn">Learn More</a>
                </div>
                
                <div class="service-card animate-on-scroll" style="--delay: 0.4s;">
                    <div class="service-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>SEO Services</h3>
                    <p>Optimize your website to rank higher in search results and attract more organic traffic.</p>
                    <a href="services.php" class="learn-more-btn">Learn More</a>
                </div>
                
                <div class="service-card animate-on-scroll" style="--delay: 0.5s;">
                    <div class="service-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile App Development</h3>
                    <p>Native and cross-platform mobile applications designed to engage users and drive business growth.</p>
                    <a href="services.php" class="learn-more-btn">Learn More</a>
                </div>
                
                <div class="service-card animate-on-scroll" style="--delay: 0.6s;">
                    <div class="service-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3>Graphics Design</h3>
                    <p>Creative visual solutions that communicate your brand message effectively and professionally.</p>
                    <a href="services.php" class="learn-more-btn">Learn More</a>
                </div>
                
                <div class="service-card animate-on-scroll" style="--delay: 0.7s;">
                    <div class="service-icon">
                        <i class="fas fa-plug"></i>
                    </div>
                    <h3>API Integration</h3>
                    <p>Seamless integration of third-party services and APIs to enhance your system's functionality.</p>
                    <a href="services.php" class="learn-more-btn">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    </section>
    
    <!--  END OF ENHANCED HERO SECTION -->

    <section class="efficiency-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 animate-on-scroll" style="--delay: 0s;">
                <img src="<?php echo $fetched_banner_image_url; ?>"
                     alt="<?php echo $fetched_banner_alt_text; ?>"
                     class="img-fluid-enhanced animate-on-scroll" style="--delay: 0.1s;">
            </div>
                <div class="col-md-6 animate-on-scroll" style="--delay: 0.2s;">
                    <h3>INNOVATIVE SOFTWARE SOLUTIONS</h3>
                    <h2>Enhancing Efficiency &<br><span>Business Growth</span></h2>
                    <p>At Bitrise Solutions, we aim to create innovative solutions that enhance how businesses operate. From feedback collection to communication automation and payment method integrations, we utilize modern technology to boost operational efficiency while prioritizing security. Our solutions cuts across all industries.</p>
                    <div class="row">
                        <div class="col-sm-6 animate-on-scroll" style="--delay: 0.4s;">
                            <div class="feature-box d-flex align-items-center">
                                <i class="fas fa-chart-line"></i>
                                <div class="text">Innovative Solutions</div>
                            </div>
                        </div>
                        <div class="col-sm-6 animate-on-scroll" style="--delay: 0.6s;">
                            <div class="feature-box d-flex align-items-center">
                                <i class="fas fa-shield-alt"></i>
                                <div class="text">Security-Driven Design</div>
                            </div>
                        </div>
                        <div class="col-sm-6 animate-on-scroll" style="--delay: 0.8s;">
                            <div class="feature-box d-flex align-items-center">
                                <i class="fas fa-cogs"></i>
                                <div class="text">98% Automation & Efficiency</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 <section class="partners-section">
        <div class="container">
            <h2>Trusted By</h2>
            <div class="partner-logo-container">
                <?php echo $partners_html;  ?>
            </div>
        </div>
    </section>
    
<section class="projects-section">
    <div class="container container-xxl">
        <div class="section-subtitle animate-on-scroll" style="--delay: 0s;">WHAT WE'VE BUILT</div>
        <h2 class="section-title animate-on-scroll" style="--delay: 0.1s;">Discover some of our <span>Projects</span></h2>
        <div class="row justify-content-center">
            <?php
            try {
                // Ensure $pdo is initialized and connected to your database here.
                // For example: include 'path/to/your/database_connection.php';

                // Fetch projects from the database, including the 'id'
                // Assume your 'projects' table has an 'id' column (primary key).
                $stmt = $pdo->query("SELECT id, icon, title, description FROM projects ORDER BY created_at DESC");
                $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($projects as $index => $project) {
                    $delay = 0.2 + ($index * 0.1); // Adjust delay for staggered animation

                    // Construct the URL to the dedicated project details page (blog1.php).
                    // We pass the 'id' as a query parameter (e.g., blog1.php?id=123).
                    $projectDetailsUrl = 'blog1.php?id=' . htmlspecialchars($project['id']);

                    echo '<div class="col-md-4 col-sm-6 mb-4 animate-on-scroll" style="--delay: ' . $delay . 's;">';
                    echo '    <div class="project-card">';
                    echo '        <div class="icon-circle">';
                    echo '            <i class="fas ' . htmlspecialchars($project['icon']) . '"></i>';
                    echo '        </div>';
                    echo '        <h4>' . htmlspecialchars($project['title']) . '</h4>';
                    echo '        <p>' . htmlspecialchars($project['description']) . '</p>';
                    // FIX: Use the $projectDetailsUrl variable for the "READ MORE" button's href
                    echo '        <a href="' . $projectDetailsUrl . '" class="btn-read-more">READ MORE <i class="fas fa-arrow-right"></i></a>';
                    echo '    </div>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                // Log the error for debugging purposes (check your server's error logs)
                error_log("Failed to fetch projects: " . $e->getMessage());
                echo '<p class="text-danger animate-on-scroll" style="--delay: 0.2s;">Could not load projects at this time. Please try again later.</p>';
            }
            ?>
            
            
        </div>
    </div>
</section>


    <section class="testimonials-section">
        <div class="container container-xxl">
            <div class="section-subtitle animate-on-scroll" style="--delay: 0s;">WHAT OUR CLIENTS SAY</div>
            <h2 class="section-title animate-on-scroll" style="--delay: 0.1s; color: #ffff;">Hear from our <span>Happy Clients</span></h2>
            <div class="row justify-content-center">
                <?php
                try {
                  
                    $stmt = $pdo->query("SELECT image_url, review_text, client_name, client_title FROM testimonials ORDER BY created_at DESC");
                    $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($testimonials) > 0) {
                        foreach ($testimonials as $index => $testimonial) {
                            $delay = 0.2 + ($index * 0.1); // Staggered animation delay
                            echo '<div class="col-lg-4 col-md-6 mb-4 animate-on-scroll" style="--delay: ' . $delay . 's;">';
                            echo '    <div class="testimonial-card">';
                            echo '        <img src="' . htmlspecialchars($testimonial['image_url']) . '" class="profile-image" alt="' . htmlspecialchars($testimonial['client_name']) . '" >';
                            echo '        <p>"' . htmlspecialchars($testimonial['review_text']) . '"</p>';
                            echo '        <div class="client-info">';
                            echo '            <h5 class="client-name">' . htmlspecialchars($testimonial['client_name']) . '</h5>';
                            echo '            <span class="client-title">' . htmlspecialchars($testimonial['client_title']) . '</span>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-info animate-on-scroll" style="--delay: 0.2s;">No testimonials available yet. Check back soon!</p>';
                    }
                } catch (PDOException $e) {
                    error_log("Failed to fetch testimonials: " . $e->getMessage(), 0);
                    echo '<p class="text-danger animate-on-scroll" style="--delay: 0.2s;">Could not load testimonials at this time. Please try again later.</p>';
                }
                ?>
            </div>
        </div>
    </section>

<section class="updates-section">
    <!-- Decorative Background Images -->
    <img src="https://bitwise.co.ke/assets/img/images/h3_blog_shape02.png" alt="Shape Right" class="decorative-shape-right">
    <img src="https://bitwise.co.ke/assets/img/images/h3_blog_shape02.png" alt="Shape Left" class="decorative-shape-left">

    <!-- Section Titles -->
    <p class="section-subtitle">LATEST UPDATE</p>
    <h2 class="section-title">From Our Desk</h2>

    <!-- Updates Cards -->
    <div class="cards-container">
        <?php if (count($updates) > 0): ?>
            <?php foreach ($updates as $row): ?>
                <div class="card">
                   <img src="<?= htmlspecialchars($row['image_url']) ?>" 
     alt="Update image: <?= htmlspecialchars($row['title']) ?>" 
     class="card-img" 
     loading="lazy"
     onerror="this.onerror=null; this.src='img/fallback1.png';">

                    <div class="card-body">
                        <span class="card-category"><?= htmlspecialchars($row['category'] ?? 'Update') ?></span>
                        <div class="card-date">📅 <?= date('M d, Y', strtotime($row['created_at'])) ?></div>
                        <h3 class="card-title"><?= htmlspecialchars($row['title']) ?></h3>
                        <p class="card-content"><?= htmlspecialchars(substr(strip_tags($row['content']), 0, 100)) ?>...</p>
                       <p class="card-author"><i class="fas fa-user"></i> By <a href="" style="color: blue";>Bitrise</a></p>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No updates found.</p>
        <?php endif; ?>
    </div>
</section>
    

<div class="whatsapp-container">
    <button class="whatsapp-float" aria-label="WhatsApp Chat">
        <i class="fab fa-whatsapp"></i>
    </button>
    <div class="whatsapp-dropdown">
        <a href="https://wa.me/+254112054071" target="_blank" class="whatsapp-option">
            <i class="fab fa-whatsapp"></i> Support 1: Joel
        </a>
        <a href="https://wa.me/+254714500555" target="_blank" class="whatsapp-option">
            <i class="fab fa-whatsapp"></i> Support 2: Josphat
        </a>
    </div>
</div>

<a href="#" class="phone-float" aria-label="Request Call" id="openCallModal">
        Request Call <i class="fas fa-phone-alt"></i> 
    </a>

    <div id="callModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Request a Call</h2>
            <form id="callRequestForm">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <button type="submit">Submit Request</button>
                <p id="formMessage"></p>
            </form>
        </div>
    </div>

      
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
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

    <script>
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const whatsappContainer = document.querySelector('.whatsapp-container');
        if (!whatsappContainer.contains(event.target)) {
            document.querySelector('.whatsapp-dropdown').style.opacity = '0';
            document.querySelector('.whatsapp-dropdown').style.visibility = 'hidden';
            document.querySelector('.whatsapp-dropdown').style.transform = 'translateY(10px)';
        }
    });
    </script>

    <script>
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
                    "value": ["#E74C3C", "#FFFFFF", "#1A2E40"]
                },
                "shape": {
                    "type": ["circle", "edge", "triangle"],
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 2,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#E74C3C",
                    "opacity": 0.3,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": true,
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
                            "opacity": 0.8
                        }
                    },
                    "push": {
                        "particles_nb": 4
                    }
                }
            },
            "retina_detect": true
        });

        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.animate-on-scroll').forEach(element => {
                observer.observe(element);
            });

            // Set current year for copyright
            document.getElementById('currentYear').textContent = new Date().getFullYear();

            // Handle newsletter subscription status messages
            const urlParams = new URLSearchParams(window.location.search);
            const subscribeStatus = urlParams.get('subscribe_status');
            const message = urlParams.get('message');
            const footerElement = document.getElementById('footer'); // Make sure your footer has this ID

            if (subscribeStatus) {
                let alertMessage = '';
                let alertClass = 'alert-info';

                if (subscribeStatus === 'success') {
                    alertMessage = 'Thank you for subscribing to our newsletter!';
                    alertClass = 'alert-success';
                } else if (subscribeStatus === 'error') {
                    switch (message) {
                        case 'empty_email':
                            alertMessage = 'Please enter your email address.';
                            alertClass = 'alert-warning';
                            break;
                        case 'invalid_email':
                            alertMessage = 'Please enter a valid email format.';
                            alertClass = 'alert-warning';
                            break;
                        case 'db_error':
                            alertMessage = 'Subscription failed. You might already be subscribed or there was a system error. Please try again.';
                            alertClass = 'alert-danger';
                            break;
                        case 'db_exception':
                            alertMessage = 'An unexpected error occurred during subscription. Please try again later.';
                            alertClass = 'alert-danger';
                            break;
                        default:
                            alertMessage = 'An error occurred during subscription. Please try again.';
                            alertClass = 'alert-danger';
                    }
                }

                // Create and append the alert
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert ${alertClass} alert-dismissible fade show alert-fixed-top`;
                alertDiv.setAttribute('role', 'alert');
                alertDiv.innerHTML = `
                    ${alertMessage}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                document.body.prepend(alertDiv);

                // Auto-hide the alert after 5 seconds
                setTimeout(() => {
                    const bootstrapAlert = bootstrap.Alert.getInstance(alertDiv);
                    if (bootstrapAlert) {
                        bootstrapAlert.dispose();
                    } else {
                        alertDiv.remove();
                    }
                }, 5000);

                // Scroll to the footer if it's a newsletter message
                if (subscribeStatus === 'success' || subscribeStatus === 'error') {
                    footerElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    </script>

    <script>
        // Function to load content into a specified area via AJAX
// This function will first display the loader, then fetch new content,
// and finally replace the loader with the fetched content.
function loadContent(url) {
    const mainContentArea = document.getElementById('main-content'); // Ensure your target element has this ID

    if (!mainContentArea) {
        console.error("Target content area with ID 'main-content' not found!");
        return;
    }

    // 1. Show the custom bits loader
    // This immediately replaces the current content of 'main-content' with the loader.
    mainContentArea.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
            <div class="bits-loader">
                <div class="bit-red"></div>
                <div class="bit-blue"></div>
                <div class="bit-grey"></div>
            </div>
        </div>
    `;

    // 2. Fetch the new content from the specified URL
    fetch(url)
        .then(response => {
            if (!response.ok) {
                // If the HTTP response status is not OK (e.g., 404, 500), throw an error.
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text(); // Get the response body as text
        })
        .then(html => {
            // 3. Replace the loader with the fetched HTML content
            // This part checks if the fetched content is a full HTML page.
            // If it is, it attempts to extract only the <body> content to avoid
            // nesting full documents, which can lead to invalid HTML and issues.
            if (html.includes('<!DOCTYPE html>') || html.includes('<html')) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const bodyContent = doc.querySelector('body')?.innerHTML || html; // Get <body> content or fallback
                mainContentArea.innerHTML = bodyContent; // Inject extracted content
                console.warn(`Warning: Loaded a full HTML page for "${url}". For better performance and valid HTML, please ensure your content files only return partial HTML meant for injection.`);
            } else {
                mainContentArea.innerHTML = html; // Inject directly if it's partial HTML
            }
        })
        .catch(error => {
            // 4. Handle any errors during the fetch operation
            console.error('Error loading content:', error);
            mainContentArea.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    <strong>Error:</strong> Failed to load content for "${url}". Please ensure the file exists and is accessible.
                    <br>Details: ${error.message}
                </div>
            `;
        });
}

// Example of how you might call loadContent initially or on a link click:
document.addEventListener('DOMContentLoaded', function() {
    
});
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const openCallModalBtn = document.getElementById('openCallModal');
    const callModal = document.getElementById('callModal');
    const closeButton = document.querySelector('.close-button');
    const callRequestForm = document.getElementById('callRequestForm');
    const formMessage = document.getElementById('formMessage');

    // Function to open the modal
    openCallModalBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
        callModal.style.display = 'flex'; // Use flex to center content
        formMessage.textContent = ''; // Clear previous messages
        callRequestForm.reset(); // Reset form fields
    });

    // Function to close the modal
    closeButton.addEventListener('click', function() {
        callModal.style.display = 'none';
    });

    // Close the modal if the user clicks outside of the modal content
    window.addEventListener('click', function(event) {
        if (event.target == callModal) {
            callModal.style.display = 'none';
        }
    });

    // Handle form submission
    callRequestForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;

        // Basic validation
        if (name.trim() === '' || phone.trim() === '') {
            formMessage.textContent = 'Please fill in all fields.';
            formMessage.style.color = 'red';
            return;
        }

        // Send data to PHP script using Fetch API
        fetch('request.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&phone=${encodeURIComponent(phone)}`
        })
        .then(response => response.text()) // Get response as text
        .then(data => {
            if (data === 'success') {
                formMessage.textContent = 'Request submitted successfully! We will call you soon.';
                formMessage.style.color = 'green';
                callRequestForm.reset(); // Clear the form
                setTimeout(() => {
                    callModal.style.display = 'none'; // Close modal after success
                }, 3000); // Close after 3 seconds
            } else {
                formMessage.textContent = 'There was an error submitting your request. Please try again.';
                formMessage.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            formMessage.textContent = 'Network error. Please try again later.';
            formMessage.style.color = 'red';
        });
    });
});
    </script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('pageSearchInput');
        const pageContent = document.getElementById('pageContent');
        const originalPageContentNode = pageContent.cloneNode(true);

        function highlightText(text, term) {
            if (!term) return text;

            const escapedTerm = term.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const regex = new RegExp(`(${escapedTerm})`, 'gi');
            return text.replace(regex, '<span class="highlight">$1</span>');
        }

        function performPageSearch() {
            const searchTerm = searchInput.value.trim();

            pageContent.innerHTML = originalPageContentNode.innerHTML;

            if (searchTerm === "") {
                return;
            }

            let firstMatchFound = false;
            let firstHighlightedElement = null;

            const elementsToSearch = pageContent.querySelectorAll('p, h2, h3, h4, h5, h6');

            elementsToSearch.forEach(element => {
                const originalHTML = element.innerHTML;
                const originalText = element.textContent;

                if (originalText.toLowerCase().includes(searchTerm.toLowerCase())) {
                    element.innerHTML = highlightText(originalHTML, searchTerm);

                    if (!firstMatchFound) {
                        const highlightedSpans = element.querySelectorAll('.highlight');
                        if (highlightedSpans.length > 0) {
                            firstHighlightedElement = highlightedSpans[0];
                            firstMatchFound = true;
                        }
                    }
                }
            });

            if (firstHighlightedElement) {
                firstHighlightedElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter' || this.value.length > 2 || this.value === "") {
                performPageSearch();
            }
        });

        document.getElementById('pageSearchButton').addEventListener('click', performPageSearch);
    });
</script>
</body>
</html>