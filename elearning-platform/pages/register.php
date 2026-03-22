<?php
// Register / Sign Up Page
// This is the user registration page

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/header.php';
?>

<!-- ============================================
     REGISTER SECTION
     ============================================ -->
<section class="auth-section">
    <div class="auth-container">
        <!-- Register Form -->
        <div class="auth-form-wrapper">
            <div class="auth-header">
                <h2>Create Your Account</h2>
                <p>Join EduLearn and start learning today</p>
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

            <form class="auth-form" id="registerForm" method="POST" action="../includes/process-register.php">
                <!-- Full Name Field -->
                <div class="form-group">
                    <label for="fullname">Full Name *</label>
                    <input 
                        type="text" 
                        id="fullname" 
                        name="fullname" 
                        placeholder="Enter your full name"
                        required
                    >
                </div>

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

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        placeholder="Enter your phone number"
                    >
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password *</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Create a strong password"
                        required
                    >
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="confirm-password">Confirm Password *</label>
                    <input 
                        type="password" 
                        id="confirm-password" 
                        name="confirm_password" 
                        placeholder="Confirm your password"
                        required
                    >
                </div>

                <!-- Terms Checkbox -->
                <div class="form-group checkbox">
                    <input 
                        type="checkbox" 
                        id="terms" 
                        name="terms" 
                        required
                    >
                    <label for="terms">I agree to the Terms of Service and Privacy Policy</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary-large">Create Account</button>

                <!-- Login Link -->
                <p class="auth-footer">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </form>
        </div>

        <!-- Register Info Panel -->
        <div class="auth-info-panel">
            <h3>Why Join EduLearn?</h3>
            <div class="info-list">
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Access Premium Content</h4>
                        <p>Get access to hundreds of premium courses from expert instructors</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Learn at Your Pace</h4>
                        <p>Complete courses at your own speed with lifetime access to materials</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Earn Certificates</h4>
                        <p>Receive recognized certificates upon course completion</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">✓</div>
                    <div>
                        <h4>Community Support</h4>
                        <p>Join a vibrant community of learners and get expert support</p>
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
