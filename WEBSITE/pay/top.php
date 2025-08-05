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

<!-- WhatsApp Float -->
<a href="https://wa.me/254112054071" class="whatsapp-float" target="_blank" aria-label="Chat on WhatsApp">
  <i class="fab fa-whatsapp"></i>
</a>

</body>
</html>
