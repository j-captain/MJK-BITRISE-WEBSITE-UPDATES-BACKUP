<!-- Footer -->
<style>
  /* Footer Section */
  .footer-section {
    background-color:  #1A2E40;
    color: #ffffff;
    padding: 60px 0 30px;
    font-size: 15px;
  }

  .footer-section h5 {
    font-size: 18px;
    margin-bottom: 20px;
    color: #E74C3C;
    font-weight: bold;
  }

  .footer-section p,
  .footer-section a {
    color: #ffffff;
    line-height: 1.6;
  }

  .footer-section a:hover {
    color: #f1c40f;
    text-decoration: underline;
  }

  /* Social Icons */
  .social-icons a {
    color: #ffffff;
    display: inline-block;
    margin-right: 10px;
    font-size: 18px;
    transition: color 0.3s ease;
  }

  .social-icons a:hover {
    color: #f1c40f;
  }

  /* Quick Links */
  .footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-section ul li {
    margin-bottom: 10px;
  }

  .footer-section ul li a {
    text-decoration: none;
    color: #ffffff;
  }

  .footer-section ul li a:hover {
    color: #f1c40f;
  }
  a{
      text-decoration: none;
  }

  /* Newsletter Form */
  .newsletter-form .form-control {
    border-radius: 0;
    border: none;
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

  @media (max-width: 767px) {
    .footer-section {
      text-align: center;
    }

    .footer-section .col-md-4 {
      margin-bottom: 30px;
    }
  }
</style>

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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('currentYear').textContent = new Date().getFullYear();

        const animateElements = document.querySelectorAll('.animate-on-scroll');
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animateElements.forEach(element => observer.observe(element));

        const alert = document.querySelector('.alert-fixed-top');
        if (alert) {
            setTimeout(() => {
                bootstrap.Alert.getInstance(alert)?.close();
            }, 7000);
        }
    });
</script>
</body>
</html>
