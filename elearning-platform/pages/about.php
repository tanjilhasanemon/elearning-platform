<?php
// About Page
// This page provides information about the platform

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/header.php';
?>

<!-- ============================================
     ABOUT PAGE CONTENT
     ============================================ -->
<section class="page-header">
    <div class="container">
        <h1>About EduLearn</h1>
        <p>Transforming education through innovative online learning</p>
    </div>
</section>

<section class="container">
    <div class="about-full">
        <h2>Our Mission</h2>
        <p>At EduLearn, our mission is to make world-class education accessible to everyone, everywhere. We believe that quality learning should not be limited by geography, financial constraints, or time. Through our platform, we're democratizing education and empowering millions of learners to achieve their dreams.</p>

        <h2>Our Vision</h2>
        <p>We envision a world where anyone, regardless of their background, can access and afford quality education. We're committed to being a catalyst for personal growth and professional development by providing comprehensive, practical, and industry-relevant courses.</p>

        <h2>Our Values</h2>
        <div class="values-grid">
            <div class="value-card">
                <h3>Quality</h3>
                <p>We maintain the highest standards in course creation, instruction, and platform functionality</p>
            </div>
            <div class="value-card">
                <h3>Accessibility</h3>
                <p>Education should be accessible to everyone, everywhere, at affordable prices</p>
            </div>
            <div class="value-card">
                <h3>Innovation</h3>
                <p>We continuously innovate to provide the best learning experience and outcomes</p>
            </div>
            <div class="value-card">
                <h3>Student-Centric</h3>
                <p>Everything we do is focused on student success and satisfaction</p>
            </div>
        </div>

        <h2>Why Choose EduLearn?</h2>
        <ul class="about-list">
            <li><strong>Expert Instructors:</strong> Learn from industry professionals with proven expertise</li>
            <li><strong>Comprehensive Curriculum:</strong> Courses covering beginner to advanced levels</li>
            <li><strong>Self-Paced Learning:</strong> Study according to your own schedule and pace</li>
            <li><strong>Lifetime Access:</strong> Access course materials forever after enrollment</li>
            <li><strong>Certificates:</strong> Earn recognized certificates to boost your resume</li>
            <li><strong>Community Support:</strong> Join a vibrant community of learners and professionals</li>
            <li><strong>Affordable Pricing:</strong> Quality education at competitive prices</li>
            <li><strong>24/7 Support:</strong> Technical and educational support whenever you need it</li>
        </ul>

        <h2>By The Numbers</h2>
        <div class="stats-full">
            <div class="stat">
                <h3>50,000+</h3>
                <p>Active Students</p>
            </div>
            <div class="stat">
                <h3>500+</h3>
                <p>Premium Courses</p>
            </div>
            <div class="stat">
                <h3>200+</h3>
                <p>Expert Instructors</p>
            </div>
            <div class="stat">
                <h3>4.8/5</h3>
                <p>Average Rating</p>
            </div>
            <div class="stat">
                <h3>98%</h3>
                <p>Satisfaction Rate</p>
            </div>
            <div class="stat">
                <h3>150+</h3>
                <p>Countries Reached</p>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include '../includes/footer.php';
?>
