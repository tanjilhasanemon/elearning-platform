<?php
// Footer Include File
// This file contains the footer section for all pages

// Set default path_prefix if not already set (in case footer is included independently)
if (!isset($path_prefix)) {
    $current_dir = basename(dirname($_SERVER['PHP_SELF']));
    $is_in_subdirectory = ($current_dir !== 'elearning-platform' && $current_dir !== '');
    $path_prefix = $is_in_subdirectory ? '../' : '';
}
?>

<!-- ============================================
     FOOTER SECTION
     ============================================ -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Footer Brand -->
            <div class="footer-section">
                <h4>EduLearn</h4>
                <p>Empowering learners worldwide with quality online education and expert instruction.</p>
                <div class="social-icons">
                    <a href="#" class="social-icon" title="Facebook">f</a>
                    <a href="#" class="social-icon" title="Twitter">𝕏</a>
                    <a href="#" class="social-icon" title="Instagram">📷</a>
                    <a href="#" class="social-icon" title="LinkedIn">in</a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?php echo $path_prefix; ?>index.php">Home</a></li>
                    <li><a href="<?php echo $path_prefix; ?>index.php#courses">Courses</a></li>
                    <li><a href="<?php echo $path_prefix; ?>pages/about.php">About Us</a></li>
                    <li><a href="<?php echo $path_prefix; ?>pages/contact.php">Contact</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Support</a></li>
                    <li><a href="#">Download App</a></li>
                    <li><a href="#">Community Forum</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="footer-section">
                <h4>Stay Updated</h4>
                <p>Subscribe to our newsletter for updates and special offers</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email" required>
                    <button type="submit" class="btn btn-small">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2024 EduLearn. All rights reserved. | Built with ❤️ for learners worldwide</p>
        </div>
    </div>
</footer>

</body>

<!-- JavaScript Files -->
<script src="<?php echo $path_prefix; ?>js/main.js"></script>

</html>
