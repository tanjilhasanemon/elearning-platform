<?php
// Courses Page
// This page displays all available courses with category filtering

session_start();
include '../includes/header.php';
include '../includes/db_connection.php';

// Get selected category from URL parameter
$selected_category = isset($_GET['category']) ? stripslashes(htmlspecialchars($_GET['category'])) : '';

// Check if user is logged in
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Fetch all categories from database
$categories_query = "SELECT DISTINCT category FROM courses ORDER BY category";
$categories_result = mysqli_query($connection, $categories_query);
$categories = array();

if ($categories_result) {
    while ($row = mysqli_fetch_assoc($categories_result)) {
        $categories[] = $row['category'];
    }
}

// Prepare courses query based on selected category
if (!empty($selected_category)) {
    $courses_query = "SELECT * FROM courses WHERE category = '" . mysqli_real_escape_string($connection, $selected_category) . "' AND status = 'published' ORDER BY created_at DESC";
    $page_title = ucfirst($selected_category) . " Courses";
} else {
    $courses_query = "SELECT * FROM courses WHERE status = 'published' ORDER BY created_at DESC";
    $page_title = "All Courses";
}

$courses_result = mysqli_query($connection, $courses_query);
$courses = array();

if ($courses_result) {
    while ($row = mysqli_fetch_assoc($courses_result)) {
        $courses[] = $row;
    }
}

// Get user's enrollments if logged in
$enrolled_courses = array();
if ($is_logged_in && $user_id) {
    $enrollments_query = "SELECT course_id FROM enrollments WHERE student_id = " . $user_id;
    $enrollments_result = mysqli_query($connection, $enrollments_query);
    
    if ($enrollments_result) {
        while ($row = mysqli_fetch_assoc($enrollments_result)) {
            $enrolled_courses[] = $row['course_id'];
        }
    }
}
?>

<!-- ============================================
     PAGE HEADER
     ============================================ -->
<section class="page-header">
    <div class="container">
        <h1><?php echo $page_title; ?></h1>
        <p><?php echo count($courses); ?> course<?php echo count($courses) !== 1 ? 's' : ''; ?> available</p>
    </div>
</section>

<!-- ============================================
     COURSES AND FILTERS SECTION
     ============================================ -->
<section class="courses-page">
    <div class="container">
        <div class="courses-layout">
            <!-- Sidebar with Category Filters -->
            <aside class="courses-sidebar">
                <div class="filter-section">
                    <h3>Filter by Category</h3>
                    <div class="category-filters">
                        <a href="courses.php" class="filter-item <?php echo empty($selected_category) ? 'active' : ''; ?>">
                            All Categories
                        </a>
                        <?php foreach ($categories as $category): ?>
                            <a href="courses.php?category=<?php echo urlencode($category); ?>" class="filter-item <?php echo $selected_category === $category ? 'active' : ''; ?>">
                                <?php echo htmlspecialchars($category); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </aside>

            <!-- Courses Grid -->
            <div class="courses-content">
                <?php if (empty($courses)): ?>
                    <div class="no-courses">
                        <h2>No Courses Found</h2>
                        <p>We are working on <?php echo !empty($selected_category) ? htmlspecialchars($selected_category) : 'more'; ?> courses. Please check back soon!</p>
                        <a href="courses.php" class="btn btn-primary">View All Categories</a>
                    </div>
                <?php else: ?>
                    <div class="courses-grid">
                        <?php foreach ($courses as $course): ?>
                            <div class="course-card">
                                <div class="course-image">
                                    <?php if (!empty($course['thumbnail'])): ?>
                                        <img src="<?php echo $path_prefix; ?>images/<?php echo htmlspecialchars($course['thumbnail']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>">
                                    <?php else: ?>
                                        <div class="no-image-placeholder">No Image</div>
                                    <?php endif; ?>
                                    <span class="course-badge"><?php echo ucfirst($course['level']); ?></span>
                                </div>
                                <div class="course-body">
                                    <h3><?php echo htmlspecialchars($course['title']); ?></h3>
                                    <p><?php echo htmlspecialchars(substr($course['description'], 0, 100)); ?>...</p>
                                    <div class="course-meta">
                                        <span class="category"><?php echo htmlspecialchars($course['category']); ?></span>
                                        <span class="rating">★★★★★ <?php echo htmlspecialchars($course['rating']); ?></span>
                                    </div>
                                    <div class="course-stats">
                                        <span class="students"><?php echo $course['students_count']; ?> students</span>
                                        <span class="price">$<?php echo number_format($course['price'], 2); ?></span>
                                    </div>
                                    <div class="course-footer">
                                        <?php if ($is_logged_in && in_array($course['id'], $enrolled_courses)): ?>
                                            <button class="btn btn-success" disabled>✓ Enrolled</button>
                                            <a href="course-detail.php?id=<?php echo $course['id']; ?>" class="btn btn-secondary">View Course</a>
                                        <?php else: ?>
                                            <a href="course-detail.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">View Details</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include '../includes/footer.php';
?>
