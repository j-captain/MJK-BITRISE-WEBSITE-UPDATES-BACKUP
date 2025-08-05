<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitrise Solutions - Pay</title>
  <link rel="icon" type="image/x-icon" href="img/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  <style>
    /* Top Info Bar */
    .top-info-bar {
      background-color:  #1A2E40;
      color: white;
      font-size: 14px;
      padding: 8px 0;
    }
    .top-info-bar .info-item i {
      margin-right: 5px;
      color:  #E74C3C;
    }
    .top-info-bar a {
      color: white;
      text-decoration: none;
    }
    .top-info-bar a:hover {
      text-decoration: underline;
    }

    /* Navbar */
    .navbar-custom {
      background-color: #ffffff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      transition: background-color 0.3s ease;
    }
    .navbar-custom .nav-link {
      color: #2c3e50;
      font-weight: 500;
      margin-right: 15px;
    }
    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link.active {
      color: #0a3d62;
    }
    .btn-custom-quote {
      background-color: #0a3d62;
      color: white;
      border-radius: 20px;
      padding: 6px 16px;
      font-size: 14px;
      font-weight: 600;
    }
    .btn-custom-quote:hover {
      background-color: #073357;
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

<!-- Top Info Bar -->
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container-fluid container-xxl">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="https://bitrisesolutions.co.ke/img/logo-b.png" alt="Bitrise Solutions Logo" width="100vh" height="70vh" class="d-inline-block align-text-top me-2">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="../about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="../services.php">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="../portfolio.php">Our Experts</a></li>
         <li class="nav-item"><a class="nav-link" href="index.php">Pay/Support</a></li>
        <li class="nav-item"><a class="nav-link" href="../contact.php">Contact</a></li>
        
        <li class="nav-item ms-lg-3"><button class="btn btn-custom-quote">Get a Quote</button></li>
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

</body>
</html>