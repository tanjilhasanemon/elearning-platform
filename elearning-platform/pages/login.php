<?php
// Login / Sign In Page
// This is the user login page

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/header.php';
?>

<!-- ============================================
     LOGIN SECTION
     ============================================ -->
<section class="auth-section">
    <div class="auth-container">
        <!-- Login Form -->
        <div class="auth-form-wrapper">
            <div class="auth-header">
                <h2>Welcome Back</h2>
                <p>Login to continue your learning journey</p>
            </div>

            <!-- Error Messages -->
            <?php if (isset($_SESSION['error_messages'])): ?>
                <div style="background-color: #fee2e2; border: 2px solid #ef4444; color: #7f1d1d; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <strong>Error:</strong>
                    <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                        <?php foreach ($_SESSION['error_messages'] as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['error_messages']); ?>
            <?php endif; ?>

            <!-- Success Messages -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div style="background-color: #dcfce7; border: 2px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <strong>Success:</strong> <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <form class="auth-form" id="loginForm" method="POST" action="../includes/process-login.php">
                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-footer">
                    <div class="form-group checkbox">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember"
                        >
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary-large">Sign In</button>

                <!-- Register Link -->
                <p class="auth-footer">
                    Don't have an account? <a href="register.php">Create one here</a>
                </p>
            </form>

            <!-- Demo Credentials -->
            <div class="demo-info">
                <p><strong>Demo Credentials:</strong></p>
                <p>Email: demo@example.com</p>
                <p>Password: password123</p>
            </div>
        </div>

        <!-- Login Info Panel -->
        <div class="auth-info-panel">
            <h3>Login Benefits</h3>
            <div class="info-list">
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Track Progress</h4>
                        <p>Monitor your learning progress across all enrolled courses</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Personalized Dashboard</h4>
                        <p>Get a customized dashboard with your courses and recommendations</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Save Favorites</h4>
                        <p>Bookmark and save your favorite courses for easy access</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Exclusive Access</h4>
                        <p>Access exclusive content and community features</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include '../includes/footer.php';
?>
