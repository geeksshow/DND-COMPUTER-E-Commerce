<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mice - DND COMPUTERS</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: #fff;
            min-height: 100vh;
        }

        /* Enhanced Transparent Navigation Styles */
        .navbar-custom {
            background: transparent !important;
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 193, 7, 0.1);
        }

        /* Add a subtle background on scroll for better readability */
        .navbar-custom.scrolled {
            background: rgba(0, 0, 0, 0.8) !important;
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 193, 7, 0.2);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: #fff !important;
            text-decoration: none;
            background: linear-gradient(45deg, #ffc107, #ffb400);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        /* Center Navigation */
        .navbar-nav-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 5;
        }

        .navbar-nav-center .nav-link {
            color: #fff !important;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.75rem 1.25rem !important;
            border-radius: 25px;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav-center .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 193, 7, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .navbar-nav-center .nav-link:hover::before {
            left: 100%;
        }

        .navbar-nav-center .nav-link:hover,
        .navbar-nav-center .nav-link.active {
            color: #ffc107 !important;
            background-color: rgba(255, 193, 7, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.2);
        }

        /* Right Side Navigation */
        .navbar-right {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            gap: 1rem;
            z-index: 10;
        }

        /* Icon Wrappers */
        .nav-icon-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .nav-icon {
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.75rem;
            border-radius: 50%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-icon:hover {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
            border-color: rgba(255, 193, 7, 0.3);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ffc107;
            color: #000;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            border: 2px solid #000;
        }

        /* Button Container */
        .nav-button-container {
            display: flex;
            align-items: center;
        }

        .nav-button {
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .login-btn {
            background: linear-gradient(45deg, #ffc107, #ffb400);
            color: #000;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            color: #000;
            text-decoration: none;
        }

        .logout-btn {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: #fff;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
            color: #fff;
            background: linear-gradient(45deg, #c82333, #bd2130);
        }

        /* Dropdown Styling */
        .dropdown-menu {
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid rgba(255, 193, 7, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            margin-top: 0.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .dropdown-header {
            color: #ffc107 !important;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
        }

        .dropdown-item {
            color: #fff !important;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0.25rem 0.5rem;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107 !important;
            transform: translateX(5px);
        }

        .dropdown-divider {
            border-color: rgba(255, 193, 7, 0.2);
            margin: 0.5rem 0;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .navbar-nav-center {
                display: none;
            }
            
            .navbar-custom .container {
                justify-content: space-between;
            }
            
            .navbar-right {
                gap: 0.5rem;
            }
            
            .nav-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }
            
            .nav-button {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
            }
        }

        .main-content {
            padding-top: 100px;
            min-height: 100vh;
        }

        .hero-section {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(45deg, #fff, #ffc107);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .product-card {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            text-align: center;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 193, 7, 0.3);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }

        .product-title {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-brand {
            color: #ffc107;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .product-price {
            color: #ffc107;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .add-to-cart-btn {
            background: linear-gradient(45deg, #ffc107, #ffb400);
            color: #000;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        }

        .coming-soon {
            background: rgba(40, 40, 40, 0.8);
            border-radius: 15px;
            padding: 3rem;
            text-align: center;
            margin: 3rem 0;
        }

        .coming-soon i {
            font-size: 4rem;
            color: #ffc107;
            margin-bottom: 1.5rem;
        }

        .coming-soon h3 {
            color: #fff;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .coming-soon p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .notify-btn {
            background: linear-gradient(45deg, #ffc107, #ffb400);
            color: #000;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .notify-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.4);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <!-- Left Side - Logo -->
            <div class="navbar-brand-container">
                <a class="navbar-brand" href="/">DND COMPUTERS</a>
            </div>

            <!-- Center - Navigation Items -->
            <div class="navbar-nav-center">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/laptops">Laptops</a>
                <a class="nav-link" href="/keyboard">Keyboards</a>
                <a class="nav-link active" href="/mouse">Mice</a>
            </div>

            <!-- Right Side - Icons and Actions -->
            <div class="navbar-right">
                <!-- Search Icon -->
                <div class="nav-icon-wrapper">
                    <span class="nav-icon" data-bs-toggle="tooltip" title="Search">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

                <!-- User Account Section -->
                <div class="nav-icon-wrapper" id="authSection">
                    <span class="nav-icon" data-bs-toggle="tooltip" title="User Account" onclick="window.location.href='{{ route('jwt.login') }}'">
                        <i class="fas fa-user"></i>
                    </span>
                </div>

                <!-- Logged In User Section -->
                <div class="nav-icon-wrapper d-none" id="userSection">
                    <div class="dropdown">
                        <span class="nav-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header" id="userNameHeader">User Menu</h6></li>
                            <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="/orders"><i class="fas fa-shopping-bag me-2"></i>My Orders</a></li>
                            <li><a class="dropdown-item" href="/wishlist"><i class="fas fa-heart me-2"></i>Wishlist</a></li>
                            <li><a class="dropdown-item" href="/settings"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="logout()"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Shopping Cart -->
                <div class="nav-icon-wrapper">
                    <span class="nav-icon" data-bs-toggle="tooltip" title="Shopping Cart" onclick="window.location.href='/cart'">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge" id="cartBadge" style="display: none;">0</span>
                    </span>
                </div>

                <!-- Login/Logout Button -->
                <div class="nav-button-container" id="desktopLoginBtn">
                    <a href="{{ route('jwt.login') }}" class="nav-button login-btn">Login</a>
                </div>
                
                <div class="nav-button-container d-none" id="desktopLogoutBtn">
                    <button onclick="logout()" class="nav-button logout-btn">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Hero Section -->
            <div class="hero-section">
                <h1 class="hero-title">Precision Mice</h1>
                <p class="hero-subtitle">
                    Professional gaming and productivity mice with advanced sensors, customizable buttons, and ergonomic designs.
                </p>
            </div>

            <!-- Coming Soon Section -->
            <div class="coming-soon">
                <i class="fas fa-mouse"></i>
                <h3>Mice Collection Coming Soon!</h3>
                <p>
                    We're preparing an extensive collection of high-precision mice for gaming, design work, and everyday use. 
                    Featuring top brands like Logitech, Razer, SteelSeries, and more with cutting-edge sensors and customizable features.
                </p>
                <button class="notify-btn" onclick="notifyMe()">
                    <i class="fas fa-bell me-2"></i>Notify Me When Available
                </button>
            </div>

            <!-- Sample Products (for demonstration) -->
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-4" style="color: #ffc107; font-weight: 700;">Featured Mouse Categories</h2>
                </div>
            </div>

            <div class="product-grid">
                <div class="product-card">
                    <img src="https://images.pexels.com/photos/2115256/pexels-photo-2115256.jpeg?auto=compress&cs=tinysrgb&w=400" 
                         alt="Gaming Mouse" 
                         class="product-image">
                    <h5 class="product-title">Gaming Mice</h5>
                    <div class="product-brand">High DPI & RGB</div>
                    <div class="product-price">Starting at $59.99</div>
                    <p class="product-description">
                        Ultra-precise gaming mice with high DPI sensors, customizable RGB lighting, and programmable buttons.
                    </p>
                    <button class="add-to-cart-btn" disabled>
                        <i class="fas fa-clock me-2"></i>Coming Soon
                    </button>
                </div>

                <div class="product-card">
                    <img src="https://images.pexels.com/photos/1772123/pexels-photo-1772123.jpeg?auto=compress&cs=tinysrgb&w=400" 
                         alt="Wireless Mouse" 
                         class="product-image">
                    <h5 class="product-title">Wireless Mice</h5>
                    <div class="product-brand">Bluetooth & 2.4GHz</div>
                    <div class="product-price">Starting at $29.99</div>
                    <p class="product-description">
                        Freedom of movement with reliable wireless connectivity and long-lasting battery life.
                    </p>
                    <button class="add-to-cart-btn" disabled>
                        <i class="fas fa-clock me-2"></i>Coming Soon
                    </button>
                </div>

                <div class="product-card">
                    <img src="https://images.pexels.com/photos/1772123/pexels-photo-1772123.jpeg?auto=compress&cs=tinysrgb&w=400" 
                         alt="Ergonomic Mouse" 
                         class="product-image">
                    <h5 class="product-title">Ergonomic Mice</h5>
                    <div class="product-brand">Comfort Design</div>
                    <div class="product-price">Starting at $39.99</div>
                    <p class="product-description">
                        Designed for comfort during long work sessions with ergonomic shapes and smooth tracking.
                    </p>
                    <button class="add-to-cart-btn" disabled>
                        <i class="fas fa-clock me-2"></i>Coming Soon
                    </button>
                </div>

                <div class="product-card">
                    <img src="https://images.pexels.com/photos/2115256/pexels-photo-2115256.jpeg?auto=compress&cs=tinysrgb&w=400" 
                         alt="Professional Mouse" 
                         class="product-image">
                    <h5 class="product-title">Professional Mice</h5>
                    <div class="product-brand">Design & CAD</div>
                    <div class="product-price">Starting at $79.99</div>
                    <p class="product-description">
                        Precision mice for designers and professionals with advanced features and customizable settings.
                    </p>
                    <button class="add-to-cart-btn" disabled>
                        <i class="fas fa-clock me-2"></i>Coming Soon
                    </button>
                </div>
            </div>

            <!-- Newsletter Signup -->
            <div class="coming-soon">
                <h3>Stay Updated</h3>
                <p>Be the first to know when our mouse collection launches!</p>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" id="emailInput" 
                                   style="background: rgba(60, 60, 60, 0.8); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff;">
                            <button class="btn notify-btn" onclick="subscribeNewsletter()">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function notifyMe() {
            showNotification('Thank you! We\'ll notify you when mice are available.', 'success');
        }

        function subscribeNewsletter() {
            const email = document.getElementById('emailInput').value;
            if (!email) {
                showNotification('Please enter your email address.', 'error');
                return;
            }
            
            if (!isValidEmail(email)) {
                showNotification('Please enter a valid email address.', 'error');
                return;
            }

            // Here you would typically send the email to your backend
            showNotification('Thank you for subscribing! We\'ll keep you updated.', 'success');
            document.getElementById('emailInput').value = '';
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} position-fixed`;
            notification.style.cssText = 'top: 100px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Check authentication status
        function checkAuth() {
            const token = localStorage.getItem('jwt_token');
            const user = localStorage.getItem('user');
            
            if (token && user) {
                const userData = JSON.parse(user);
                
                // Update main navbar
                document.getElementById('authSection').classList.add('d-none');
                document.getElementById('userSection').classList.remove('d-none');
                document.getElementById('userNameHeader').textContent = userData.name;
                document.getElementById('desktopLoginBtn').classList.add('d-none');
                document.getElementById('desktopLogoutBtn').classList.remove('d-none');
            } else {
                // User not logged in
                document.getElementById('authSection').classList.remove('d-none');
                document.getElementById('userSection').classList.add('d-none');
                document.getElementById('desktopLoginBtn').classList.remove('d-none');
                document.getElementById('desktopLogoutBtn').classList.add('d-none');
            }
        }

        // Logout function
        function logout() {
            const token = localStorage.getItem('jwt_token');
            
            if (token) {
                fetch('/jwt/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).finally(() => {
                    // Clear local storage
                    localStorage.removeItem('jwt_token');
                    localStorage.removeItem('user');
                    
                    // Refresh the page to update UI
                    location.reload();
                });
            } else {
                // Clear local storage even if no token
                localStorage.removeItem('jwt_token');
                localStorage.removeItem('user');
                location.reload();
            }
        }

        // Initialize authentication check
        document.addEventListener('DOMContentLoaded', function() {
            checkAuth();
        });
    </script>
</body>
</html>