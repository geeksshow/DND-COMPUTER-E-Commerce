<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Orders - DND COMPUTERS</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            color: #fff;
            min-height: 100vh;
        }

        .navbar-custom {
            background: rgba(0, 0, 0, 0.95) !important;
            backdrop-filter: blur(20px);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 193, 7, 0.2);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 2rem;
            color: #fff !important;
            text-decoration: none;
            background: linear-gradient(45deg, #ffc107, #ffb400);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .main-content {
            padding-top: 100px;
            min-height: 100vh;
        }

        .page-header {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(45deg, #fff, #ffc107);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .order-card {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 193, 7, 0.3);
        }

        .order-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .order-number {
            color: #ffc107;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .order-status {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .status-pending { background: #ffc107; color: #000; }
        .status-processing { background: #17a2b8; color: #fff; }
        .status-shipped { background: #fd7e14; color: #fff; }
        .status-delivered { background: #28a745; color: #fff; }
        .status-cancelled { background: #dc3545; color: #fff; }

        .order-items {
            margin-bottom: 1.5rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: rgba(40, 40, 40, 0.5);
            border-radius: 15px;
            margin-bottom: 1rem;
        }

        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 1rem;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            color: #fff;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .item-specs {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .item-price {
            color: #ffc107;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .order-total {
            text-align: right;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .total-amount {
            color: #ffc107;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            background: rgba(40, 40, 40, 0.8);
            color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-tab.active,
        .filter-tab:hover {
            background: linear-gradient(45deg, #ffc107, #ffb400);
            color: #000;
            border-color: transparent;
            transform: translateY(-2px);
        }

        .empty-orders {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .empty-orders i {
            font-size: 4rem;
            color: #ffc107;
            margin-bottom: 1.5rem;
        }

        .track-btn {
            background: linear-gradient(45deg, #17a2b8, #138496);
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .track-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">DND COMPUTERS</a>
            <div class="navbar-nav d-none d-lg-flex mx-auto">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/laptops">Laptops</a>
                <a class="nav-link" href="/keyboard">Keyboards</a>
                <a class="nav-link" href="/mouse">Mice</a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-white cursor-pointer hover:text-yellow-400 transition-colors">
                    <i class="fas fa-search text-xl"></i>
                </span>
                <span class="text-white cursor-pointer hover:text-yellow-400 transition-colors" onclick="window.location.href='/cart'">
                    <i class="fas fa-shopping-cart text-xl"></i>
                </span>
                <a href="/" class="text-white hover:text-yellow-400 transition-colors">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-shopping-bag text-green-400 mr-3"></i>My Orders
                </h1>
                <p class="text-gray-400 text-lg">Track and manage your orders</p>
            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <div class="filter-tab active" onclick="filterOrders('all')">
                    <i class="fas fa-list mr-2"></i>All Orders
                </div>
                <div class="filter-tab" onclick="filterOrders('pending')">
                    <i class="fas fa-clock mr-2"></i>Pending
                </div>
                <div class="filter-tab" onclick="filterOrders('processing')">
                    <i class="fas fa-cog mr-2"></i>Processing
                </div>
                <div class="filter-tab" onclick="filterOrders('shipped')">
                    <i class="fas fa-truck mr-2"></i>Shipped
                </div>
                <div class="filter-tab" onclick="filterOrders('delivered')">
                    <i class="fas fa-check-circle mr-2"></i>Delivered
                </div>
            </div>

            <!-- Orders List -->
            <div id="ordersList">
                <!-- Sample Order 1 -->
                <div class="order-card" data-status="delivered">
                    <div class="order-header">
                        <div>
                            <div class="order-number">Order #DND-2024-001</div>
                            <div class="text-gray-400 text-sm">Placed on January 15, 2024</div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="order-status status-delivered">Delivered</span>
                            <button class="track-btn">
                                <i class="fas fa-map-marker-alt mr-2"></i>Track
                            </button>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <img src="https://images.pexels.com/photos/205421/pexels-photo-205421.jpeg?auto=compress&cs=tinysrgb&w=200" 
                                 alt="MacBook Pro" class="item-image">
                            <div class="item-details">
                                <div class="item-name">MacBook Pro 14-inch M3 Pro</div>
                                <div class="item-specs">Apple M3 Pro • 18GB RAM • 512GB SSD</div>
                            </div>
                            <div class="item-price">$1,999.00</div>
                        </div>
                    </div>

                    <div class="order-total">
                        <div class="text-gray-400 mb-1">Total Amount</div>
                        <div class="total-amount">$2,098.90</div>
                    </div>
                </div>

                <!-- Sample Order 2 -->
                <div class="order-card" data-status="shipped">
                    <div class="order-header">
                        <div>
                            <div class="order-number">Order #DND-2024-002</div>
                            <div class="text-gray-400 text-sm">Placed on January 20, 2024</div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="order-status status-shipped">Shipped</span>
                            <button class="track-btn">
                                <i class="fas fa-map-marker-alt mr-2"></i>Track
                            </button>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <img src="https://images.pexels.com/photos/1772123/pexels-photo-1772123.jpeg?auto=compress&cs=tinysrgb&w=200" 
                                 alt="Dell XPS" class="item-image">
                            <div class="item-details">
                                <div class="item-name">Dell XPS 13 Plus</div>
                                <div class="item-specs">Intel Core i7 • 16GB RAM • 512GB SSD</div>
                            </div>
                            <div class="item-price">$1,499.00</div>
                        </div>
                        <div class="order-item">
                            <img src="https://images.pexels.com/photos/2115256/pexels-photo-2115256.jpeg?auto=compress&cs=tinysrgb&w=200" 
                                 alt="Gaming Mouse" class="item-image">
                            <div class="item-details">
                                <div class="item-name">Gaming Mouse Pro</div>
                                <div class="item-specs">RGB • 16000 DPI • Wireless</div>
                            </div>
                            <div class="item-price">$89.99</div>
                        </div>
                    </div>

                    <div class="order-total">
                        <div class="text-gray-400 mb-1">Total Amount</div>
                        <div class="total-amount">$1,688.89</div>
                    </div>
                </div>

                <!-- Sample Order 3 -->
                <div class="order-card" data-status="processing">
                    <div class="order-header">
                        <div>
                            <div class="order-number">Order #DND-2024-003</div>
                            <div class="text-gray-400 text-sm">Placed on January 22, 2024</div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="order-status status-processing">Processing</span>
                            <button class="track-btn">
                                <i class="fas fa-map-marker-alt mr-2"></i>Track
                            </button>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="order-item">
                            <img src="https://images.pexels.com/photos/2115256/pexels-photo-2115256.jpeg?auto=compress&cs=tinysrgb&w=200" 
                                 alt="Gaming Laptop" class="item-image">
                            <div class="item-details">
                                <div class="item-name">ASUS ROG Zephyrus G14</div>
                                <div class="item-specs">AMD Ryzen 9 • 32GB RAM • 1TB SSD • RTX 4060</div>
                            </div>
                            <div class="item-price">$1,599.00</div>
                        </div>
                    </div>

                    <div class="order-total">
                        <div class="text-gray-400 mb-1">Total Amount</div>
                        <div class="total-amount">$1,698.90</div>
                    </div>
                </div>
            </div>

            <!-- Empty State (hidden by default) -->
            <div class="empty-orders d-none" id="emptyOrders">
                <i class="fas fa-shopping-bag"></i>
                <h3 class="text-white text-2xl font-bold mb-3">No orders found</h3>
                <p class="text-gray-400 mb-4">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                <a href="/laptops" class="btn btn-warning">
                    <i class="fas fa-shopping-cart mr-2"></i>Start Shopping
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterOrders(status) {
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter orders
            const orders = document.querySelectorAll('.order-card');
            let visibleCount = 0;

            orders.forEach(order => {
                const orderStatus = order.getAttribute('data-status');
                if (status === 'all' || orderStatus === status) {
                    order.style.display = 'block';
                    visibleCount++;
                } else {
                    order.style.display = 'none';
                }
            });

            // Show empty state if no orders
            const emptyState = document.getElementById('emptyOrders');
            const ordersList = document.getElementById('ordersList');
            
            if (visibleCount === 0) {
                ordersList.style.display = 'none';
                emptyState.classList.remove('d-none');
            } else {
                ordersList.style.display = 'block';
                emptyState.classList.add('d-none');
            }
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
    </script>
</body>
</html>