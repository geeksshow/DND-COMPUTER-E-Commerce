<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - DND COMPUTERS</title>
    
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

        .profile-card {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ffc107, #ffb400);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 3rem;
            color: #000;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(255, 193, 7, 0.3);
        }

        .edit-avatar-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #fff;
            color: #000;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #000;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-avatar-btn:hover {
            background: #ffc107;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: #ffc107;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-input {
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: #fff;
            padding: 0.8rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #ffc107;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
        }

        .btn-primary {
            background: linear-gradient(45deg, #ffc107, #ffb400);
            color: #000;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.4);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(40, 40, 40, 0.8);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 193, 7, 0.3);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #ffc107;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
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
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                        <div class="edit-avatar-btn">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <h1 class="text-white text-3xl font-bold mb-2">John Doe</h1>
                    <p class="text-gray-400">Premium Member since 2023</p>
                </div>

                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Wishlist Items</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">$2,450</div>
                        <div class="stat-label">Total Spent</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">Gold</div>
                        <div class="stat-label">Member Status</div>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="profile-card">
                        <h2 class="text-white text-2xl font-bold mb-4">
                            <i class="fas fa-user-edit text-yellow-400 mr-3"></i>Personal Information
                        </h2>
                        
                        <form id="profileForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-input" value="John" placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-input" value="Doe" placeholder="Enter last name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-input" value="john@example.com" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-input" value="+1 234 567 8900" placeholder="Enter phone number">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <textarea class="form-input" rows="3" placeholder="Enter your address">123 Main Street, City, State 12345</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-input" value="1990-01-01">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Gender</label>
                                        <select class="form-input">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                            <option>Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save mr-2"></i>Save Changes
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Security Settings -->
                    <div class="profile-card">
                        <h3 class="text-white text-xl font-bold mb-4">
                            <i class="fas fa-shield-alt text-green-400 mr-3"></i>Security
                        </h3>
                        
                        <div class="d-grid gap-3">
                            <div class="d-flex justify-content-between align-items-center p-3 rounded-lg" style="background: rgba(60, 60, 60, 0.8);">
                                <div>
                                    <div class="text-white fw-medium">Two-Factor Auth</div>
                                    <div class="text-muted small">Extra security layer</div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="twoFactorSwitch" style="background-color: #ffc107; border-color: #ffc107;">
                                </div>
                            </div>

                            <button class="btn w-100 text-white p-3 rounded-lg" style="background: rgba(60, 60, 60, 0.8); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(80, 80, 80, 0.8)'" onmouseout="this.style.background='rgba(60, 60, 60, 0.8)'">
                                <i class="fas fa-key me-2"></i>Change Password
                            </button>

                            <button class="btn w-100 text-white p-3 rounded-lg" style="background: rgba(60, 60, 60, 0.8); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(80, 80, 80, 0.8)'" onmouseout="this.style.background='rgba(60, 60, 60, 0.8)'">
                                <i class="fas fa-mobile-alt me-2"></i>Manage Devices
                            </button>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="profile-card">
                        <h3 class="text-white text-xl font-bold mb-4">
                            <i class="fas fa-bolt text-blue-400 mr-3"></i>Quick Actions
                        </h3>
                        
                        <div class="d-grid gap-3">
                            <a href="/orders" class="btn text-white p-3 rounded-lg text-decoration-none" style="background: rgba(60, 60, 60, 0.8); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(80, 80, 80, 0.8)'" onmouseout="this.style.background='rgba(60, 60, 60, 0.8)'">
                                <i class="fas fa-shopping-bag me-2"></i>View Orders
                            </a>
                            <a href="/wishlist" class="btn text-white p-3 rounded-lg text-decoration-none" style="background: rgba(60, 60, 60, 0.8); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(80, 80, 80, 0.8)'" onmouseout="this.style.background='rgba(60, 60, 60, 0.8)'">
                                <i class="fas fa-heart me-2"></i>My Wishlist
                            </a>
                            <a href="/settings" class="btn text-white p-3 rounded-lg text-decoration-none" style="background: rgba(60, 60, 60, 0.8); border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(80, 80, 80, 0.8)'" onmouseout="this.style.background='rgba(60, 60, 60, 0.8)'">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success message
            const notification = document.createElement('div');
            notification.className = 'alert alert-success position-fixed';
            notification.style.cssText = 'top: 100px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-check-circle me-2"></i>
                Profile updated successfully!
                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        });
    </script>
</body>
</html>