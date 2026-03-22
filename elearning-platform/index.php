<?php
// E-Learning Platform - Home Page
// This is the main landing page of the platform

include 'includes/header.php';
include 'includes/db_connection.php';

// Fetch featured courses (first 6 published courses)
$featured_courses_query = "SELECT * FROM courses WHERE status = 'published' ORDER BY students_count DESC LIMIT 6";
$featured_courses_result = mysqli_query($connection, $featured_courses_query);
$featured_courses = array();

if ($featured_courses_result) {
    while ($row = mysqli_fetch_assoc($featured_courses_result)) {
        $featured_courses[] = $row;
    }
}

// Fetch all categories
$categories_query = "SELECT DISTINCT category FROM courses WHERE status = 'published' ORDER BY category";
$categories_result = mysqli_query($connection, $categories_query);
$categories = array();

if ($categories_result) {
    while ($row = mysqli_fetch_assoc($categories_result)) {
        $categories[] = $row;
    }
}
?>

<!-- ============================================
     HERO SECTION
     ============================================ -->
<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Learn Anything, Anytime, Anywhere</h1>
        <p class="hero-subtitle">Access thousands of courses and transform your career with expert instructors</p>
        <div class="hero-buttons">
            <button class="btn btn-primary" onclick="window.location.href='pages/courses.php'">Explore Courses</button>
            <button class="btn btn-secondary" onclick="window.location.href='pages/register.php'">Get Started</button>
        </div>
    </div>
    <div class="hero-image">
        <img src="images/hero-banner.png" alt="Learning illustration">
    </div>
</section>

<!-- ============================================
     ABOUT PLATFORM SECTION
     ============================================ -->
<section class="about">
    <div class="container">
        <div class="section-header">
            <h2>About Our Platform</h2>
            <p>Empowering learners worldwide with quality education</p>
        </div>
        
        <div class="about-content">
            <div class="about-text">
                <h3>Why Learn With Us?</h3>
                <p>Our E-Learning Platform connects students with world-class instructors and comprehensive courses designed to help you master new skills. Whether you're a beginner or an advanced learner, we have something for everyone.</p>
                <ul class="about-list">
                    <li><strong>Expert Instructors:</strong> Learn from industry professionals with years of experience</li>
                    <li><strong>Flexible Learning:</strong> Study at your own pace, anytime and anywhere</li>
                    <li><strong>Affordable Pricing:</strong> Quality education accessible to everyone</li>
                    <li><strong>Lifetime Access:</strong> Access course materials forever after enrollment</li>
                </ul>
            </div>
            <div class="about-image">
                <img src="images/about-platform.png" alt="About our platform">
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     STATISTICS SECTION
     ============================================ -->
<section class="statistics">
    <div class="container">
        <div class="stat-card">
            <h3 class="stat-number">50K+</h3>
            <p class="stat-label">Active Students</p>
        </div>
        <div class="stat-card">
            <h3 class="stat-number">500+</h3>
            <p class="stat-label">Premium Courses</p>
        </div>
        <div class="stat-card">
            <h3 class="stat-number">200+</h3>
            <p class="stat-label">Expert Instructors</p>
        </div>
        <div class="stat-card">
            <h3 class="stat-number">4.8/5</h3>
            <p class="stat-label">Average Rating</p>
        </div>
    </div>
</section>

<!-- ============================================
     FEATURED COURSES SECTION
     ============================================ -->
<section id="courses" class="featured-courses">
    <div class="container">
        <div class="section-header">
            <h2>Featured Courses</h2>
            <p>Discover our most popular and highly-rated courses</p>
        </div>
        
        <div class="courses-grid">
            <?php if (!empty($featured_courses)): ?>
                <?php foreach ($featured_courses as $course): ?>
                    <div class="course-card">
                        <div class="course-image">
                            <?php if (!empty($course['thumbnail'])): ?>
                                <img src="<?php echo 'images/' . htmlspecialchars($course['thumbnail']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>">
                            <?php else: ?>
                                <div class="no-image-placeholder">No Image</div>
                            <?php endif; ?>
                            <span class="course-badge"><?php echo ucfirst($course['level']); ?></span>
                        </div>
                        <div class="course-body">
                            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p><?php echo htmlspecialchars(substr($course['description'], 0, 100)); ?>...</p>
                            <div class="course-meta">
                                <span class="instructor">By <?php echo htmlspecialchars($course['category']); ?></span>
                                <span class="rating">★★★★★ <?php echo htmlspecialchars($course['rating']); ?></span>
                            </div>
                            <div class="course-footer">
                                <span class="price">$<?php echo number_format($course['price'], 2); ?></span>
                                <a href="pages/course-detail.php?id=<?php echo $course['id']; ?>" class="btn btn-small">View Course</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No courses available yet. Check back soon!</p>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="pages/courses.php" class="btn btn-primary">View All Courses</a>
        </div>
    </div>
</section>

<!-- ============================================
     COURSE CATEGORIES SECTION
     ============================================ -->
<section class="categories">
    <div class="container">
        <div class="section-header">
            <h2>Course Categories</h2>
            <p>Browse courses by subject area</p>
        </div>
        
        <div class="categories-grid">
            <?php 
            // Get category icons mapping
            $category_icons = array(
                'web development' => '💻',
                'data science' => '📊',
                'design' => '🎨',
                'mobile apps' => '📱',
                'cybersecurity' => '🔐',
                'ai & machine learning' => '🤖',
                'programming' => '💾',
                'python' => '🐍',
                'javascript' => '⚙️',
                'database' => '🗄️'
            );
            
            if (!empty($categories)): 
                foreach ($categories as $cat):
                    $category_name = $cat['category'];
                    $cat_lower = strtolower($category_name);
                    $icon = isset($category_icons[$cat_lower]) ? $category_icons[$cat_lower] : '📚';
                    
                    // Count courses in this category
                    $count_query = "SELECT COUNT(*) as count FROM courses WHERE category = '" . mysqli_real_escape_string($connection, $category_name) . "' AND status = 'published'";
                    $count_result = mysqli_query($connection, $count_query);
                    $count_row = mysqli_fetch_assoc($count_result);
                    $course_count = $count_row['count'];
            ?>
                <a href="pages/courses.php?category=<?php echo urlencode($category_name); ?>" class="category-card">
                    <div class="category-icon"><?php echo $icon; ?></div>
                    <h3><?php echo htmlspecialchars($category_name); ?></h3>
                    <p><?php echo $course_count; ?> Course<?php echo $course_count !== 1 ? 's' : ''; ?></p>
                </a>
            <?php 
                endforeach;
            else: 
            ?>
                <p>No categories available yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============================================
     WHY CHOOSE US SECTION
     ============================================ -->
<section class="why-choose-us">
    <div class="container">
        <div class="section-header">
            <h2>Why Choose Us?</h2>
            <p>What makes our platform the best choice for your learning journey</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3>Expert Instructors</h3>
                <p>Learn from industry professionals with 10+ years of experience in their fields</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3>Lifetime Access</h3>
                <p>Once enrolled, access course materials forever with regular updates included</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3>Self-Paced Learning</h3>
                <p>Study at your own speed without time constraints or rigid schedules</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3>Certificates</h3>
                <p>Earn recognized certificates upon course completion to boost your resume</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3>24/7 Support</h3>
                <p>Get help whenever you need it with our dedicated support team always available</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3>Affordable Pricing</h3>
                <p>Quality education at prices that fit every budget with flexible payment options</p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     INSTRUCTORS SECTION
     ============================================ -->
<section class="instructors">
    <div class="container">
        <div class="section-header">
            <h2>Meet Our Expert Instructors</h2>
            <p>Learn from the best minds in the industry</p>
        </div>
        
        <div class="instructors-grid">
            <div class="instructor-card">
                <img src="images/instructor-sarah.png" alt="Sarah Johnson">
                <h3>Sarah Johnson</h3>
                <p class="instructor-title">Web Design Expert</p>
                <p class="instructor-bio">10+ years of experience in creating beautiful, user-centric web designs</p>
                <div class="social-links">
                    <a href="#" title="Twitter">🐦</a>
                    <a href="#" title="LinkedIn">💼</a>
                    <a href="#" title="Portfolio">🌐</a>
                </div>
            </div>

            <div class="instructor-card">
                <img src="images/instructor-michael.png" alt="Michael Chen">
                <h3>Michael Chen</h3>
                <p class="instructor-title">Database Architect</p>
                <p class="instructor-bio">15+ years building scalable databases for Fortune 500 companies</p>
                <div class="social-links">
                    <a href="#" title="Twitter">🐦</a>
                    <a href="#" title="LinkedIn">💼</a>
                    <a href="#" title="Portfolio">🌐</a>
                </div>
            </div>

            <div class="instructor-card">
                <img src="images/instructor-david.png" alt="David Williams">
                <h3>David Williams</h3>
                <p class="instructor-title">Backend Developer</p>
                <p class="instructor-bio">12+ years of full-stack development and leading engineering teams</p>
                <div class="social-links">
                    <a href="#" title="Twitter">🐦</a>
                    <a href="#" title="LinkedIn">💼</a>
                    <a href="#" title="Portfolio">🌐</a>
                </div>
            </div>

            <div class="instructor-card">
                <img src="images/instructor-emily.png" alt="Emily Rodriguez">
                <h3>Emily Rodriguez</h3>
                <p class="instructor-title">JavaScript Specialist</p>
                <p class="instructor-bio">8+ years specializing in modern JavaScript frameworks and best practices</p>
                <div class="social-links">
                    <a href="#" title="Twitter">🐦</a>
                    <a href="#" title="LinkedIn">💼</a>
                    <a href="#" title="Portfolio">🌐</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     TESTIMONIALS SECTION
     ============================================ -->
<section class="testimonials">
    <div class="container">
        <div class="section-header">
            <h2>Student Testimonials</h2>
            <p>What our students say about their learning experience</p>
        </div>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"This platform completely changed my career! The courses are incredibly well-structured and the instructors are very supportive. Highly recommended!"</p>
                <div class="testimonial-author">
                    <img src="images/student-avatar-1.png" alt="John Doe">
                    <div>
                        <h4>John Doe</h4>
                        <p>Web Developer at TechCorp</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"I appreciate the self-paced nature of the courses. Being able to learn at my own speed while working full-time made all the difference for me."</p>
                <div class="testimonial-author">
                    <img src="images/student-avatar-2.png" alt="Jane Smith">
                    <div>
                        <h4>Jane Smith</h4>
                        <p>Data Analyst at DataSys</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"The course content is practical and directly applicable to real-world projects. I've already implemented what I learned at my current job!"</p>
                <div class="testimonial-author">
                    <img src="images/student-avatar-3.png" alt="Mike Johnson">
                    <div>
                        <h4>Mike Johnson</h4>
                        <p>Full Stack Developer at WebInc</p>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text">"The community support is amazing! I got answers to my questions within hours, and the instructors are genuinely invested in student success."</p>
                <div class="testimonial-author">
                    <img src="images/student-avatar-4.png" alt="Sarah Williams">
                    <div>
                        <h4>Sarah Williams</h4>
                        <p>UX Designer at DesignStudio</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     CTA SECTION
     ============================================ -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Ready to Start Learning?</h2>
            <p>Join thousands of students who have already transformed their careers</p>
            <button class="btn btn-primary-large" onclick="window.location.href='pages/register.php'">Get Started Today</button>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
