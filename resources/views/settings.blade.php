<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Settings - DND COMPUTERS</title>
    
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

        .settings-card {
            background: rgba(20, 20, 20, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .settings-card:hover {
            border-color: rgba(255, 193, 7, 0.3);
        }

        .settings-section-title {
            color: #ffc107;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .setting-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 1.5rem;
            background: rgba(40, 40, 40, 0.5);
            border-radius: 15px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .setting-item:hover {
            background: rgba(40, 40, 40, 0.8);
            transform: translateX(5px);
        }

        .setting-info {
            flex: 1;
        }

        .setting-title {
            color: #fff;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .setting-description {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
            background: #374151;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-switch.active {
            background: #ffc107;
        }

        .toggle-slider {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .toggle-switch.active .toggle-slider {
            transform: translateX(30px);
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

        .form-input, .form-select {
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: #fff;
            padding: 0.8rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-select:focus {
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

        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: #fff;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
        }

        .danger-zone {
            border: 2px solid #dc3545;
            border-radius: 15px;
            padding: 2rem;
            background: rgba(220, 53, 69, 0.1);
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
                    <i class="fas fa-cog text-purple-400 mr-3"></i>Settings
                </h1>
                <p class="text-gray-400 text-lg">Manage your preferences and account settings</p>
            </div>

            <div class="row">
                <!-- Notifications Settings -->
                <div class="col-lg-6">
                    <div class="settings-card">
                        <h3 class="settings-section-title">
                            <i class="fas fa-bell text-blue-400"></i>
                            Notifications
                        </h3>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Email Notifications</div>
                                <div class="setting-description">Receive order updates via email</div>
                            </div>
                            <div class="toggle-switch active" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">SMS Notifications</div>
                                <div class="setting-description">Get text messages for important updates</div>
                            </div>
                            <div class="toggle-switch" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Marketing Emails</div>
                                <div class="setting-description">Receive promotional offers and deals</div>
                            </div>
                            <div class="toggle-switch active" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Push Notifications</div>
                                <div class="setting-description">Browser notifications for real-time updates</div>
                            </div>
                            <div class="toggle-switch" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Privacy Settings -->
                <div class="col-lg-6">
                    <div class="settings-card">
                        <h3 class="settings-section-title">
                            <i class="fas fa-shield-alt text-green-400"></i>
                            Privacy & Security
                        </h3>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Two-Factor Authentication</div>
                                <div class="setting-description">Add extra security to your account</div>
                            </div>
                            <div class="toggle-switch" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Profile Visibility</div>
                                <div class="setting-description">Make your profile visible to others</div>
                            </div>
                            <div class="toggle-switch active" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Data Analytics</div>
                                <div class="setting-description">Help us improve with usage analytics</div>
                            </div>
                            <div class="toggle-switch active" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Cookie Preferences</div>
                                <div class="setting-description">Manage cookie settings</div>
                            </div>
                            <button class="btn btn-outline-light btn-sm">
                                <i class="fas fa-cookie-bite mr-2"></i>Manage
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="col-lg-6">
                    <div class="settings-card">
                        <h3 class="settings-section-title">
                            <i class="fas fa-user-cog text-indigo-400"></i>
                            Account Settings
                        </h3>

                        <form id="accountForm">
                            <div class="form-group">
                                <label class="form-label">Language</label>
                                <select class="form-select">
                                    <option value="en" selected>English</option>
                                    <option value="si">Sinhala</option>
                                    <option value="ta">Tamil</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Currency</label>
                                <select class="form-select">
                                    <option value="usd" selected>USD ($)</option>
                                    <option value="lkr">LKR (Rs.)</option>
                                    <option value="eur">EUR (€)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Time Zone</label>
                                <select class="form-select">
                                    <option value="utc">UTC</option>
                                    <option value="asia/colombo" selected>Asia/Colombo</option>
                                    <option value="america/new_york">America/New_York</option>
                                </select>
                            </div>

                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save mr-2"></i>Save Changes
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Display Settings -->
                <div class="col-lg-6">
                    <div class="settings-card">
                        <h3 class="settings-section-title">
                            <i class="fas fa-palette text-pink-400"></i>
                            Display Settings
                        </h3>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Dark Mode</div>
                                <div class="setting-description">Use dark theme for better viewing</div>
                            </div>
                            <div class="toggle-switch active" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Animations</div>
                                <div class="setting-description">Enable smooth animations</div>
                            </div>
                            <div class="toggle-switch active" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Compact View</div>
                                <div class="setting-description">Show more content in less space</div>
                            </div>
                            <div class="toggle-switch" onclick="toggleSetting(this)">
                                <div class="toggle-slider"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Items per Page</label>
                            <select class="form-select">
                                <option value="12" selected>12 items</option>
                                <option value="24">24 items</option>
                                <option value="48">48 items</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="col-12">
                    <div class="settings-card">
                        <h3 class="settings-section-title">
                            <i class="fas fa-lock text-red-400"></i>
                            Security Settings
                        </h3>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-input" placeholder="Enter current password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-input" placeholder="Enter new password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-input" placeholder="Confirm new password">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="button" class="btn-primary w-100" onclick="changePassword()">
                                    <i class="fas fa-key mr-2"></i>Change Password
                                </button>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5 class="text-white mb-3">Active Sessions</h5>
                                <div class="bg-gray-800/50 rounded-lg p-3 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-white font-medium">Current Device</div>
                                            <div class="text-gray-400 text-sm">Chrome on Windows • Active now</div>
                                        </div>
                                        <span class="badge bg-success">Current</span>
                                    </div>
                                </div>
                                <div class="bg-gray-800/50 rounded-lg p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-white font-medium">Mobile Device</div>
                                            <div class="text-gray-400 text-sm">Safari on iPhone • 2 hours ago</div>
                                        </div>
                                        <button class="btn btn-outline-danger btn-sm">Revoke</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-white mb-3">Login History</h5>
                                <div class="bg-gray-800/50 rounded-lg p-3 mb-2">
                                    <div class="text-white font-medium">Successful Login</div>
                                    <div class="text-gray-400 text-sm">Today at 2:30 PM • Chrome on Windows</div>
                                </div>
                                <div class="bg-gray-800/50 rounded-lg p-3">
                                    <div class="text-white font-medium">Successful Login</div>
                                    <div class="text-gray-400 text-sm">Yesterday at 9:15 AM • Mobile Safari</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="col-12">
                    <div class="settings-card">
                        <div class="danger-zone">
                            <h3 class="text-red-400 font-bold text-xl mb-3">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
                            </h3>
                            <p class="text-gray-300 mb-4">
                                These actions are irreversible. Please proceed with caution.
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                <button class="btn-danger" onclick="deleteAccount()">
                                    <i class="fas fa-trash mr-2"></i>Delete Account
                                </button>
                                <button class="btn btn-outline-danger">
                                    <i class="fas fa-download mr-2"></i>Export Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSetting(element) {
            element.classList.toggle('active');
            showNotification('Setting updated successfully!', 'success');
        }

        function changePassword() {
            showNotification('Password changed successfully!', 'success');
        }

        function deleteAccount() {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                showNotification('Account deletion initiated. You will receive a confirmation email.', 'info');
            }
        }

        document.getElementById('accountForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showNotification('Account settings saved successfully!', 'success');
        });

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