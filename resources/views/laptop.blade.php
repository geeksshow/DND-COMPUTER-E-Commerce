<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laptops - DND COMPUTERS</title>
    
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

        .filters-section {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .filter-group {
            margin-bottom: 1.5rem;
        }

        .filter-label {
            color: #ffc107;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .filter-select, .filter-input {
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: #fff;
            padding: 0.5rem 1rem;
            width: 100%;
        }

        .filter-select:focus, .filter-input:focus {
            border-color: #ffc107;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 193, 7, 0.2);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(45deg, #ffc107, #ffb400);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .product-card:hover::before {
            transform: scaleX(1);
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
            line-height: 1.3;
        }

        .product-brand {
            color: #ffc107;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .product-specs {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }

        .product-price {
            color: #ffc107;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-stock {
            color: #28a745;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }

        .product-stock.low {
            color: #ffc107;
        }

        .product-stock.out {
            color: #dc3545;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        }

        .add-to-cart-btn:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .search-section {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .search-input {
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: #fff;
            padding: 1rem 2rem;
            width: 100%;
            font-size: 1.1rem;
        }

        .search-input:focus {
            border-color: #ffc107;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
        }

        .sort-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .sort-label {
            color: #ffc107;
            font-weight: 600;
        }

        .sort-select {
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: #fff;
            padding: 0.5rem 1rem;
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
                <a class="nav-link active" href="/laptops">Laptops</a>
                <a class="nav-link" href="/keyboard">Keyboards</a>
                <a class="nav-link" href="/mouse">Mice</a>
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

  
</body>
</html>